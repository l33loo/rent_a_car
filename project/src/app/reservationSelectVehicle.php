<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/util/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Revision;

try {
    if (empty($_SESSION['booking']) || empty($_SESSION['booking']['newRevision']) || empty($_SESSION['booking']['timestamp'])) {
        throw new Exception('Missing booking information.');
    }
    
    if (calculateDiffMinutes($_SESSION['booking']['timestamp'], time()) > 15) {
        throw new Exception('Booking process expired after 15 minutes.');
    }

    $revision = unserialize($_SESSION['booking']['newRevision']);
    $isOwnerEditing = $revision->getReservation_Id() !== null;

    if ($isOwnerEditing) {
        $canUserUpdate = $revision->canUserUpdate();
        if ($canUserUpdate !== true) {
            throw new Exception($canUserUpdate);
        }
    }

    $categoryId = $revision
        ->setVehicle_id($_POST['vehicleId'])
        ->loadVehicle()
        ->getVehicle()
        ->getCategory_id();

    $revision->setCategory_id($categoryId);

    $_SESSION['booking']['newRevision'] = serialize($revision);

    if (empty($_SESSION['logged_id'])) {
        header('Location: /src/html/reservationLoginOrGuest.php');
    } else {
        header('Location: /src/html/reservationBook.php');
    }
} catch(Exception $e) {
    unset($_SESSION['booking']);
    $_SESSION['errors']['indexPage'] = $e->getMessage();
    header('Location: /');
    exit;
}
