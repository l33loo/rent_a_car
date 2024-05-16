<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/inc/sessionGuest.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use RentACar\User;

try {
    if (empty($_POST['password'])) {
        // TODO: error
        header('Location: /html/userPasswordEdit.php');
        exit;
    } else {
        // TODO: clear error
    }

    if (empty($_POST['confirmPassword'])) {
        // TODO: error
        header('Location: /html/userPasswordEdit.php');
        exit;
    }

    // TODO: clear errors

    if ($_POST['password'] !== $_POST['confirmPassword']) {
        // TODO: error
        header('Location: /html/userPasswordEdit.php');
        exit;
    }

    $user = User::find($_SESSION['logged_id']);
    $user->setPassword($_POST['password']);
    $user->save();
} catch(e) {
    // TODO: error messages
    echo 'ERROR SIGNING UP :(';
    print_r(e);
    header('Location: /html/userView.php');
    exit;
}

// TODO: make sure this is upon success
session_destroy();

$_SESSION = [];
setcookie('user_email', '', time() - 3600, '/');
setcookie('user_name', '', time() - 3600, '/');

header("Location: /html/login.php");
