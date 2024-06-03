<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/inc/sessionUser.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Address;
use RentACar\User;

try {
    $isUserFormValid = User::validateForm();
    $isAddressFormValid = Address::validateForm();
    if (!$isUserFormValid || !$isAddressFormValid) {
        throw new Exception('Invalid fields.');
    }

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

    header('Location: /src/html/login.php');
} catch(Exception $e) {
    $_SESSION['errors']['signupPage'] = $e->getMessage();
    header('Location: /src/html/signup.php');
}


