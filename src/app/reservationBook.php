<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Address.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/CreditCard.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Customer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Reservation.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use RentACar\Address;
use RentACar\CreditCard;
use RentACar\Customer;
use RentACar\Reservation;
use RentACar\User;

session_start();

if (empty($_SESSION('logged_id'))) {
    $sessionUserId = null;
} else {
    $sessionUserId = $_SESSION('logged_id');
}

$userId = $_POST('userId');
if ($userId !== $sessionUserId) {
    // TODO: error
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
        trim($_POST('name')),
        trim($_POST('email')),
        trim($_POST('dateOfBirth')),
        trim($_POST('phone')),
        false, // isArchived
        $address->getId(),
        trim($_POST('driversLicense')),
        trim($_POST('taxNumber')),
        $userId, // TODO:
        null, // address
        null // user
    );

    $customer->save();

    // No need to create a new credit card if it already exists
    // The credit cards will never be deleted or modified because
    // they are part of the reservation, which we decided to keep intact
    $creditCardDbResult = CreditCard::search([
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
    ]);

    if (count($creditCardDbResults) === 0) {
        $creditCard = new CreditCard(
            trim($_POST['ccNumber']),
            trim($_POST['ccExpiry']),
            trim($_POST['ccCVV'])
        );
        $creditCard->save();
    // So as not to duplicate. Credit Cards are never deleted from the database
    // because we chose to never delete of directly modify a Reservation or a
    // reservation Revision
    } else if (count($creditCardDbResults) >= 1) {
        $creditCard = $creditCard[0];
    }

    $reservation = new Reservation(
        // TODO: use Carbon type
        trim($_POST('pickupDate')),
        // TODO: use Carbon type
        trim($_POST('dropoffDate')),
        // TODO: use Carbon type
        trim($_POST('pickupTime')),
        // TODO: use Carbon type
        trim($_POST('dropoffTime')),
        // TODO: use Carbon type
        trim($_POST('totalPrice')),
        null, // reservedTimestamp
        null, // revisions

        $address->getId(), // Billing address
        $creditCard->getId(),
        $userId, // reservedByUser_id
        trim($_POST('categoryId')),
        $customer->getId(), // TODO:
        1, // status_id
        trim($_POST('pickupLocationId')),
        trim($_POST('dropoffLocationId')),
        null, // vehicle_id
        null, // returnedLocation_id
        null, // collectedByUser_id
        null, // dateReturned
        null, // timeReturned
        $address,
        $creditCard,
        null, // reservedByUser
        null, // category
        $customer,
        null, // status
        null, // pickupLocation
        null, // dropoffLocation
        null, // vehicle
        null, // returnedLocation
        null // collectedByUser
    );
    $reservation->save();
} catch(e) {
    // TODO: handle errors

    // TODO: send back to form with existing data
    header('Location: /html/reservationBook.php');
}