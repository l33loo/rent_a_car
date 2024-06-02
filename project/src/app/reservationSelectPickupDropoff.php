<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Revision;

try {
    $isOwnerEditing = false;
    if (!empty($_SESSION['booking']) && !empty($_SESSION['booking']['newRevision'])) {
        $revision = unserialize($_SESSION['booking']['newRevision']);
        $revision->loadReservation();
        $reservation = $revision->getReservation();

        if ($revision->canUserUpdate() !== true) {
            throw new Exception('Permission denied.');
        }
    } else {
        $revision = new Revision();
    }

    $isFormValid = Revision::validateForm();
    if (!$isFormValid) {
        throw new Exception('Invalid fields.');
    }

    $revision
        ->setPickupLocation_id($_POST['pickupLocation_id'])
        ->loadPickupLocation()
        ->setPickupDate($_POST['pickupDate'])
        ->setPickupTime($_POST['pickupTime'])
        ->setDropoffLocation_id($_POST['dropoffLocation_id'])
        ->loadDropoffLocation()
        ->setDropoffDate($_POST['dropoffDate'])
        ->setDropoffTime($_POST['dropoffTime']);

    $_SESSION['booking'] = [
        'newRevision' => serialize($revision),
        'timestamp' => time(),
    ];

    if ($revision->getReservation_id() !== null) {
        $isOwnerEditing = true;
    }

    header('Location: /src/html/reservationSelectVehicle.php' . ($isOwnerEditing ? '?reservationId=' . $_POST['reservationId'] : null));
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