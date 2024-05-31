<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Reservation;

session_start();

try {
    $isOwnerEditing = false;

    if (!empty($_GET['reservationId']) || !empty($_POST['reservationId'])) {
        $reservationId = empty($_GET['reservationId']) ? $_POST['reservationId'] : $_GET['reservationId'];
        $reservation = Reservation::find($reservationId);
        $reservation->loadOwnerUser();
        $ownerUserId = $reservation->getOwnerUser()->getId();

        if (!isset($_SESSION['logged_id']) || (isset($_SESSION['logged_id']) && $_SESSION['logged_id'] != $ownerUserId)) {
            header('Location: /');
            // TODO: ERROR
            exit;
        }

        $isOwnerEditing = true;
        $sessionKey = 'userReservationEditLatestRevision' . $reservationId;
        if (!empty($_SESSION[$sessionKey])) {
            $revision = unserialize($_SESSION[$sessionKey]);
        } else {
            $revision = $reservation->findLatestRevision();
            $_SESSION[$sessionKey] = serialize($revision);
        }

        if (!$revision->canUserUpdate()) {
            // TODO: handle error
            unset($_SESSION[$sessionKey]);
            header('Location: /src/html/reservations/php');
        }
    }
    $isSessionKeySet = isset($sessionKey);
} catch(\Exception $e) {
    // TODO: ...
}