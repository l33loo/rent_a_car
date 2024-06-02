<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Category;
use RentACar\Location;
use RentACar\Reservation;

try {
    $isOwnerEditing = null;
    if (!empty($_SESSION['booking']) && !empty($_SESSION['booking']['newRevision']) && !empty($_SESSION['booking']['timestamp'])) {
        $revision = unserialize($_SESSION['booking']['newRevision']);
        $isOwnerEditing = $revision->getReservation_Id() !== null;

        if ($isOwnerEditing) {
            $canUserUpdate = $revision->canUserUpdate();
            if ($canUserUpdate !== true) {
                throw new Exception($canUserUpdate);
            }
        }
    }
} catch(Exception $e) {
    unset($_SESSION['booking']);
    $errorMsg2 = $e->getMessage();
    exit;
}