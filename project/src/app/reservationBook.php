<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Address;
use RentACar\CreditCard;
use RentACar\Customer;
use RentACar\Reservation;
use RentACar\Revision;
use RentACar\User;

// TODO: validate fields

if (empty($_SESSION['logged_id'])) {
    $userId = null;
} else {
    $userId = strval($_SESSION['logged_id']);
}

try {
    $address = new Address(
        trim($_POST['street']),
        trim($_POST['door']),
        trim($_POST['apartment']),
        trim($_POST['city']),
        trim($_POST['district']),
        trim($_POST['postalCode']),
        trim($_POST['countryId'])
    );
    $address->save();

    $customer = new Customer(
        trim($_POST['name']),
        trim($_POST['email']),
        trim($_POST['dateOfBirth']),
        trim($_POST['phone']),
        false, // isArchived
        $address->getId(),
        trim($_POST['driversLicense']),
        trim($_POST['taxNumber']),
        $userId, // TODO:
        null, // address
        null // user
    );

    $customer->save();

    // No need to create a new credit card if it already exists
    // The credit cards will never be deleted or modified because
    // they are part of the Revision, which we decided to keep intact
    $creditCardDbResults = CreditCard::search([
        [
            'column' => 'ccNumber',
            'operator' => '=',
            'value' => trim($_POST['ccNumber'])
        ],
        [
            'column' => 'ccExpiry',
            'operator' => '=',
            'value' => trim($_POST['ccExpiry'])
        ],
        [
            'column' => 'ccCVV',
            'operator' => '=',
            'value' => trim($_POST['ccCVV'])
        ]
    ], 'creditCard');

    // This is where the payment would normally be accepted or declined
    $creditCard;
    if ($creditCardDbResults === null || count($creditCardDbResults) === 0) {
        $creditCard = new CreditCard(
            trim($_POST['ccNumber']),
            trim($_POST['ccExpiry']),
            trim($_POST['ccCVV'])
        );
        $creditCard->save();
    // So as not to duplicate. Credit Cards are never deleted from the database
    // because we chose to never delete of directly modify a Reservation or a
    // Reservation Revision
    } else if (count($creditCardDbResults) >= 1) {
        $creditCard = $creditCardDbResults[0];
    } else {
        // TODO: error
        echo "error with credit card";
        print_r($creditCardDbResults);
        exit;
    }

    $reservation = new Reservation($userId);
    $reservation->save();

    $revision = unserialize($_SESSION['booking']['newRevision'])
        ->setReservation_id($reservation->getId())
        ->setSubmittedTimestamp(date("Y-m-d H:i:s", time()))
        ->setSubmittedByUser_id($userId)
        ->setBillingAddress_id($address->getId())
        ->setCustomer_id($customer->getId())
        ->setCreditCard_id($creditCard->getId())
        ->calculateAndSetTotalPrice()
        ->save();
    
    // TODO: Send to Reservation view, with success message
    if (!empty($userId)) {
        header('Location: /src/html/reservationView.php?reservationId=' . $revision->getReservation_id());
    } else {
        header('Location: /');
    }
    unset($_SESSION['booking']);
} catch(Exception $e) {
    unset($_SESSION['booking']);
    $_SESSION['errors']['indexPage'] = 'Error saving booking: ' . $e->getMessage();
    header('Location: /');
    exit;
}
