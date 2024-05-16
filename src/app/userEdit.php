<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/inc/sessionGuest.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Address.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use RentACar\Address;
use RentACar\User;

if (isset($_POST['userEditProfile'])) {
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
        header('Location: /html/userEdit.php');
    } finally {
        // TODO: make sure this is upon success
        header('Location: /html/userView.php');
    }
}

if (isset($_POST['userEditAddress'])) {
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
        header('Location: /html/userEdit.php');
        exit;
    } finally {
        // TODO: make sure this is upon success
        header('Location: /html/userView.php');
    }
}

if (isset($_POST['userEditPassword'])) {
    try {
        if (empty($_POST['password'])) {
            // TODO: error
            header('Location: /html/userEdit.php');
            exit;
        } else {
            // TODO: clear error
        }
    
        if (empty($_POST['confirmPassword'])) {
            // TODO: error
            header('Location: /html/userEdit.php');
            exit;
        }
    
        // TODO: clear errors
    
        if ($_POST['password'] !== $_POST['confirmPassword']) {
            // TODO: error
            header('Location: /html/userEdit.php');
            exit;
        }
    
        $user = User::find($_SESSION['logged_id']);
        $user->setPassword($_POST['password']);
        $user->save();
    } catch(e) {
        // TODO: error messages
        echo 'ERROR SIGNING UP :(';
        print_r(e);
        header('Location: /html/userEdit.php');
        exit;
    }
    
    // TODO: make sure this is upon success
    session_destroy();
    
    $_SESSION = [];
    setcookie('user_email', '', time() - 3600, '/');
    setcookie('user_name', '', time() - 3600, '/');
    
    header("Location: /html/login.php");
}