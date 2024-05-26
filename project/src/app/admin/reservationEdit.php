<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/Address.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/CreditCard.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/Customer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/Reservation.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/Revision.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/Status.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/User.php';

use RentACar\Address;
use RentACar\CreditCard;
use RentACar\Customer;
use RentACar\Reservation;
use RentACar\Revision;
use RentACar\Status;
use RentACar\User;

if (empty($_SESSION['logged_id'])) {
    $sessionUserId = null;
} else {
    $sessionUserId = strval($_SESSION['logged_id']);
}

try {
    $reservationId = $_POST['reservationId'];
    $reservation = Reservation::find($reservationId);
    $latestRevision = $reservation->findLatestRevision();
    // Create a new revision instead of saving changes into existing one
} catch(e) {
    
}

if (isset($_POST['reservationEditStatus'])) {
    try {
        $latestRevision->setStatus_id($_POST['statusId']);
        $latestRevision->saveNewRevision();
    } catch(e) {
        // TODO: handle error
    }    
}

if (isset($_POST['reservationEditVehicle'])) {
    try {
        $latestRevision->setVehicle_id($_POST['vehicleId']);
        $latestRevision->saveNewRevision();
    } catch(e) {
        // TODO: handle error
    } 
}

if (isset($_POST['reservationEditEffectivePickup'])) {
    try {
        $latestRevision->setEffectivePickupLocation_id($_POST['pickupLocationId']);
        $latestRevision->setEffectivePickupDate($_POST['pickupDate']);
        $latestRevision->setEffectivePickupTime($_POST['pickupTime']);
        $latestRevision->saveNewRevision();
    } catch(e) {
        // TODO: handle error
    } 
}

if (isset($_POST['reservationEditEffectiveDropoff'])) {
    try {
        $latestRevision->setEffectiveDropoffLocation_id($_POST['dropoffLocationId']);
        $latestRevision->setEffectiveDropoffDate($_POST['dropoffDate']);
        $latestRevision->setEffectiveDropoffTime($_POST['dropoffTime']);
        $latestRevision->saveNewRevision();
    } catch(e) {
        // TODO: handle error
    } 
}

header("Location: /html/admin/reservationEdit.php?reservationId=$reservationId");