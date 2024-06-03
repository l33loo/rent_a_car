<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Reservation;
use RentACar\Revision;


if (isset($_POST['changeForm'])) {
    try {
        $reservation = Reservation::find($_POST['reservationId']);
        $revision = $reservation->findLatestRevision();

        if ($revision->canUserUpdate() !== true) {
            throw new Exception($revision->canUserUpdate());
        }

        $_SESSION['booking']['newRevision'] = serialize($revision);
        header('Location: /?reservationId=' . $reservation->getId());
        exit;
    } catch (Exception $e) {
        $_SESSION['errors']['userReservationsPage'] = $e->getMessage();
        header('Location: /src/html/reservations.php');
        exit;
    }
}

if (isset($_POST['reservationSelectVehicle'])) {
    try {
        $revision = unserialize($_SESSION['booking']['newRevision']);

        if ($revision->canUserUpdate() !== true) {
            throw new Exception($revision->canUserUpdate());
        }

        $revision
            ->setStatus_id(2) // Modification Requested
            ->setVehicle_id($_POST['vehicleId'])
            ->loadVehicle();
        $categoryId = $revision->getVehicle()->getCategory_id();
        $revision
            ->setCategory_id($categoryId)
            ->update();

        unset($_SESSION['booking']);
        header('Location: /src/html/reservationView.php?reservationId=' . $revision->getReservation_id());
    } catch (Exception $e) {
        unset($_SESSION['booking']);
        $_SESSION['errors']['userReservationsPage'] = $e->getMessage();
        header('Location: /src/html/reservations.php');
        exit;
    }
}

if (isset($_POST['reservationCancel'])) {
    try {
        $reservation = Reservation::find($_POST['reservationId']);
        $revision = $reservation->findLatestRevision();

        if ($revision->canUserUpdate() !== true) {
            throw new Exception($revision->canUserUpdate());
        }

        $revision
            ->setStatus_id(4) // Cancelled
            ->update();

        header('Location: /src/html/reservationView.php?reservationId=' . $revision->getReservation_id());
    } catch (Exception $e) {
        $_SESSION['errors']['userReservationsPage'] = $e->getMessage();
        header('Location: /src/html/reservations.php');
        exit;
    }
}
