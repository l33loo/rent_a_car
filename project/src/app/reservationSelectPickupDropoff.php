<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Revision;

try {
    $newRevision = (new Revision())
        ->setPickupLocation_id($_POST['pickupLocationId'])
        ->loadPickupLocation()
        ->setPickupDate($_POST['pickupDate'])
        ->setPickupTime($_POST['pickupTime'])
        ->setDropoffLocation_id($_POST['dropoffLocationId'])
        ->loadDropoffLocation()
        ->setDropoffDate($_POST['dropoffDate'])
        ->setDropoffTime($_POST['dropoffTime']);

    $_SESSION['booking'] = [
        'newRevision' => serialize($newRevision),
        'timestamp' => time(),
    ];
    $isOwnerEditing = $newRevision->getReservation_id() !== null;
} catch (Exception $e) {
    unset($_SESSION['booking']);

    if ($isOwnerEditing) {
        $_SESSION['errors']['userReservationsPage'] = 'Error with booking process: ' . $e->getMessage();
        header('Location: /src/html/reservations.php');
    } else {
        $_SESSION['errors']['indexPage'] = $e->getMessage();
        header('Location: /');
    }
    exit; 
}

header('Location: /src/html/reservationSelectVehicle.php');