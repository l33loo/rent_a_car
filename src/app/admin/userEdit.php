<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';

use RentACar\User;

// TODO: if id is not set, send back with error msg

if (isset($_POST['archiveUser']) && !empty($_POST['userId'])) {
    // TODO: try catch with error
    $user = User::find($_POST['userId']);
    $user->setIsArchived(true)->save();
    header('Location: /html/admin/users.php');
    exit;
}

if (isset($_POST['unarchiveUser']) && !empty($_POST['userId'])) {
    // TODO: try catch with error
    $user = User::find($_POST['userId']);
    $user->setIsArchived(false)->save();
    header('Location: /html/admin/users.php');
    exit;
}

$user = User::find($userId);
$userId = $_GET['id'];

if (empty($userId)) {
    // TODO: redirect with error
    exit;
}
