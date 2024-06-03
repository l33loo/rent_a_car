<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

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
        $latestRevision->update();
    } catch(e) {
        // TODO: handle error
    }    
}

if (isset($_POST['reservationEditVehicle'])) {
    try {
        $latestRevision->setVehicle_id($_POST['vehicleId']);
        $latestRevision->update();
    } catch(e) {
        // TODO: handle error
    } 
}

if (isset($_POST['reservationEditEffectivePickup'])) {
    try {
        $latestRevision->setEffectivePickupLocation_id($_POST['pickupLocation_id']);
        $latestRevision->setEffectivePickupDate($_POST['pickupDate']);
        $latestRevision->setEffectivePickupTime($_POST['pickupTime']);
        $latestRevision->update();
    } catch(e) {
        // TODO: handle error
    } 
}

if (isset($_POST['reservationEditEffectiveDropoff'])) {
    try {
        $latestRevision->setEffectiveDropoffLocation_id($_POST['dropoffLocation_id']);
        $latestRevision->setEffectiveDropoffDate($_POST['dropoffDate']);
        $latestRevision->setEffectiveDropoffTime($_POST['dropoffTime']);
        $latestRevision->update();
    } catch(e) {
        // TODO: handle error
    } 
}

if (isset($_POST['reservationEditRes'])) {
    try {
        $latestRevision->setPickupLocation_id($_POST['pickupLocation_id']);
        $latestRevision->setPickupDate($_POST['pickupDate']);
        $latestRevision->setPickupTime($_POST['pickupTime']);
        $latestRevision->setDropoffLocation_id($_POST['dropoffLocation_id']);
        $latestRevision->setDropoffDate($_POST['dropoffDate']);
        $latestRevision->setDropoffTime($_POST['dropoffTime']);
        $latestRevision->setCategory_id($_POST['categoryId']);
        $latestRevision->update();
    } catch(e) {
        // TODO: handle error
    } 
}

header("Location: /src/html/admin/reservationEdit.php?reservationId=$reservationId");