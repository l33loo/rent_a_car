<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/inc/reservation.inc.php';

try {
    if (empty($_POST['sessionKey'])) {
        // TODO: error
        header('Location: /src/html/reservations.php');
        exit;
    }
    
    $sessionKey = $_POST['sessionKey'];
    $latestRevision = unserialize($_SESSION[$sessionKey])
        ->setStatus_id(2)
        ->setCategory_id($_POST['categoryId'])
        ->setVehicle_id($_POST['vehicleId'])
        ->setPickupLocation_id($_POST['pickupLocationId'])
        ->setPickupDate($_POST['pickupDate'])
        ->setPickupTime($_POST['pickupTime'])
        ->setDropoffLocation_id($_POST['dropoffLocationId'])
        ->setDropoffDate($_POST['dropoffDate'])
        ->setDropoffTime($_POST['dropoffTime'])
        ->calculateAndSetTotalPrice();
    $update = $latestRevision->updateByUser();

    if ($update === false) {
        // TODO: throw error
    }

    unset($_SESSION[$sessionKey]);
    header('Location: /src/html/reservations.php');
} catch(\Exception $e) {

}
