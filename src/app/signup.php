<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Address.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use RentACar\Address;
use RentACar\User;

$address = new Address(
    $_POST['street'],
    $_POST['door'],
    $_POST['apartment'],
    $_POST['city'],
    $_POST['district'],
    $_POST['postalCode'],
    $_POST['countryId']
);

$address->save();

try {
    $user = new User(
        $_POST['name'],
        $_POST['email'],
        $_POST['dateOfBirth'],
        $_POST['phone'],
        false, // isArchived
        $_POST['password'],
        false, // isAdmin
        $address->getId()
    );

    $user->save();
} catch(e) {
    // TODO: error message
    echo 'ERROR SIGNING UP :(';
    print_r(e);
} finally {
    // TODO: make sure this is upon success
    header('Location: /html/login.php');
}


