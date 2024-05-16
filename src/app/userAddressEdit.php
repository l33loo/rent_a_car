<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/inc/sessionGuest.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Address.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use RentACar\Address;
use RentACar\User;

try {
    $newAddress = new Address(
        $_POST['street'],
        $_POST['door'],
        $_POST['apartment'],
        $_POST['city'],
        $_POST['district'],
        $_POST['postalCode'],
        $_POST['countryId']
    );
    
    $newAddress->save();

    $user = User::find($_SESSION['logged_id']);
    $user->setAddress_id($newAddress->getId());

    $user->save();
    
} catch(e) {
    // TODO: error message
    echo 'ERROR SIGNING UP :(';
    print_r(e);
} finally {
    // TODO: make sure this is upon success
    header('Location: /html/userView.php');
}