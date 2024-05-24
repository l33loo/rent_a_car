<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Address.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/CreditCard.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Customer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Reservation.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Revision.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use RentACar\Address;
use RentACar\CreditCard;
use RentACar\Customer;
use RentACar\Reservation;
use RentACar\Revision;
use RentACar\User;

if (empty($_SESSION['logged_id'])) {
    $sessionUserId = null;
} else {
    $sessionUserId = strval($_SESSION['logged_id']);
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
        null, // user_id
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

    $creditCard;
    if ($creditCardDbResults === null || count($creditCardDbResults) === 0) {
        $creditCard = new CreditCard(
            trim($_POST['ccNumber']),
            trim($_POST['ccExpiry']),
            trim($_POST['ccCVV'])
        );
        $creditCard->save();
    // So as not to duplicate. Credit Cards are never deleted from the database
    // because we chose to never delete of directly modify a Revision or a
    // Revision Revision
    } else if (count($creditCardDbResults) >= 1) {
        $creditCard = $creditCardDbResults[0];
    } else {
        // TODO: error
        echo "error with credit card";
        print_r($creditCardDbResults);
        exit;
    }

    $reservation = new Reservation();
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
        // TODO: use Carbon type
        100.00, // TODO: fix totalPrice
        date("Y-m-d H:i:s", time()), // submittedTimestamp

        $address->getId(), // Billing address
        $creditCard->getId(),
        $sessionUserId, // submittedByUser_id
        $_POST['categoryId'], // category_id 
        $customer->getId(), // customer_id
        $_POST['statusId'], // status_id
        $_POST['pickupLocationId'],
        $_POST['dropoffLocationId'],
        null, // vehicle_id
        null, // effectivePickupLocation_id
        null, // givenByUser_id
        null, // effectivePickupDate
        null, // effectivePickupTime
        null, // effectiveDropoffLocation_id
        null, // collectedByUser_id
        null, // effectiveDropoffDate
        null, // effectiveDropoffTime
        $reservation,
        $address,
        $creditCard,
        null, // submittedByUser
        null, // category
        $customer,
        null, // status
        null, // pickupLocation
        null, // dropoffLocation
        null, // vehicle
        null, // effectivePickupLocation
        null, // givenByUser
        null, // effectiveDropoffLocation
        null // collectedByUser
    );
    $revision->save();
} catch(e) {
    // TODO: handle errors

    // TODO: send back to form with existing data
    echo 'error saving Revision';
    header('Location: /html/reservations.php');
    exit;
}

// // TODO: Send to Revision view, with success message
// if (!empty($userId)) {
//     header("Location: /html/userView.php?userId=$userId");
// } else {
//     header("Location: /index.php");
// }
