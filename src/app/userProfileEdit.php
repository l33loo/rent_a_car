<?php

// require_once $_SERVER['DOCUMENT_ROOT'] . '/app/inc/sessionGuest.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';
clearstatcache();

session_start();

use RentACar\User;

try {
    $user = User::find($_SESSION['logged_id']);
    $user->setName($_POST['name']);
    $user->setEmail($_POST['email']);
    $user->setDateOfBirth($_POST['dateOfBirth']);
    $user->setPhone($_POST['phone']);
    $user->save();
} catch(e) {
    // TODO: error message
    echo 'ERROR SIGNING UP :(';
    print_r(e);
} finally {
    // TODO: make sure this is upon success
    header('Location: /html/userView.php');
}


