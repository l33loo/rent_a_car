<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Category;
use RentACar\Location;
use RentACar\Reservation;
use RentACar\User;

try {
    $isOwnerEditing = false;
    if (!empty($_GET['reservationId'])) {
        $existingReservation = Reservation::find($_GET['reservationId']);
        $revision = $existingReservation->findLatestRevision();

        $canUserUpdate = $revision->canUserUpdate();
        if ($canUserUpdate !== true) {
            throw new Exception($canUserUpdate);
        }
    
        $isOwnerEditing = true;
    }
} catch(Exception $e) {
    unset($_SESSION['booking']);
    $errorMsg2 = $e->getMessage();
}