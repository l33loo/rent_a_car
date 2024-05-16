<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';

use RentACar\User;

// TODO: if id is not set, send back with error msg

if (isset($_POST['archiveUser']) && !empty($_POST['userId'])) {
    // TODO: try catch with error
    $user = User::find($_POST['userId']);
    $user->setIsArchived(true)->save();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if (isset($_POST['unarchiveUser']) && !empty($_POST['userId'])) {
    // TODO: try catch with error
    $user = User::find($_POST['userId']);
    $user->setIsArchived(false)->save();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if (isset($_POST['grantAdminPrivileges']) && !empty($_POST['userId'])) {
    // TODO: try catch with error
    $user = User::find($_POST['userId']);
    $user->setIsAdmin(true)->save();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if (isset($_POST['removeAdminPrivileges']) && !empty($_POST['userId'])) {
    // TODO: try catch with error
    $user = User::find($_POST['userId']);
    $user->setIsAdmin(false)->save();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

$user = User::find($userId);
$userId = $_GET['id'];

if (empty($userId)) {
    // TODO: redirect with error
    exit;
}
