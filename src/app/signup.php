<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Address.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Country.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use RentACar\Address;
use RentACar\Country;
use RentACar\User;

session_start();

$country = Country::find($_POST['country'], 'country');
$country->save();

$address = new Address(
    $_POST['street'],
    $_POST['door'],
    $_POST['apartment'],
    $_POST['city'],
    $_POST['district'],
    $_POST['postalCode'],
    $country
);

$address->save();

try {
    
    $user = new User(
        $_POST['name'],
        $_POST['email'],
        $_POST['dateOfBirth'],
        $address,
        $_POST['phone'],
        false,
        $_POST['password'],
        false
    );

    $user->save();
} catch(e) {
    // TODO: error message
    echo 'ERROR SIGNING UP :(';
    print_r(e);
} finally {
    // print_r($user);
}


