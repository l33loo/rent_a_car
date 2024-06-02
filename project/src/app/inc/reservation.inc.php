<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/util/helpers.php';

try {
    if (empty($_SESSION['booking']) || empty($_SESSION['booking']['newRevision'])) {
        throw new Exception('Missing booking info.');
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
} catch(Exception $e) {
    unset($_SESSION['booking']);
    $_SESSION['errors']['indexPage'] = $e->getMessage();
    header('Location: /');
    exit;
}