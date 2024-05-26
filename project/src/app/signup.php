<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/inc/sessionUser.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/Address.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/User.php';

use RentACar\Address;
use RentACar\User;

try {
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
    
    $user = new User(
        $_POST['name'],
        trim($_POST['email']),
        $_POST['dateOfBirth'],
        $_POST['phone'],
        false, // isArchived
        trim($_POST['password']),
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
    header('Location: /src/html/login.php');
}


