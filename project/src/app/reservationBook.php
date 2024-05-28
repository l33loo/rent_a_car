<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Address;
use RentACar\CreditCard;
use RentACar\Customer;
use RentACar\Reservation;
use RentACar\Revision;
use RentACar\User;

session_start();

if (empty($_SESSION['logged_id'])) {
    $sessionUserId = null;
} else {
    $sessionUserId = strval($_SESSION['logged_id']);
}

$userId = $_POST['userId'];
if ($userId !== $sessionUserId) {
    // TODO: error
    echo 'Not same user ids';
    exit;
}

// TODO: validate fields

try {
    // TODO: figure out how to revert changes already made when something fails

    // TODO: get userId from session here, not from form?

    // TODO: do we want separate Customer and Billing addresses?
    // keep same address for now, for simplicity

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

    $revision = new Revision(
        $reservation->getId(),
        // TODO: use Carbon type
        trim($_POST['pickupDate']),
        // TODO: use Carbon type
        trim($_POST['dropoffDate']),
        // TODO: use Carbon type
        trim($_POST['pickupTime']),
        // TODO: use Carbon type
        trim($_POST['dropoffTime']),
        NULL, // totalPrice - added below
        // TODO: use Carbon type
        date("Y-m-d H:i:s", time()), // submittedTimestamp

        $address->getId(), // billingAddress_id
        $creditCard->getId(),
        $userId, // submittedByUser_id
        $_POST['categoryId'],
        $customer->getId(), // TODO:
        1, // status_id: Confirmed
        $_POST['pickupLocationId'],
        $_POST['dropoffLocationId'],
        $_POST['vehicleId'], // vehicle_id
        null, // effectivePickupLocation_id
        null, // givenByUser_id
        null, // effectivePickupDate
        null, // effectivePickupTime
        null, // effectiveDropoffLocation_id
        null, // collectedByUser_id
        null, // effectiveDropoffDate
        null, // effectiveDropoffTime
        $reservation,
        $address, //
        $creditCard,
        null, // submittedByUser
        null, // category
        $customer,
        NULL, // status
        null, // pickupLocation
        null, // dropoffLocation
        null, // vehicle
        null, // effectivePickupLocation
        null, // givenByUser
        null, // effectiveDropoffLocation
        null // collectedByUser
    );
    $revision->calculateAndSetTotalPrice();
    $revision->save();
} catch(e) {
    // TODO: handle errors

    // TODO: send back to form with existing data
    echo 'error saving Revision';
    header('Location: /src/html/RevisionBook.php');
    exit;
}

// TODO: Send to Revision view, with success message
if (!empty($userId)) {
    header("Location: /src/html/userView.php?userId=$userId");
} else {
    header("Location: /");
}
