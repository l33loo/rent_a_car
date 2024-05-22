<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Address.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Country.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';

use RentACar\Address;
use RentACar\Country;
use RentACar\User;

if (empty($_POST['userId']) && empty($_GET['id']) && empty($_SESSION['logged_id'])) {
    // TODO: send back with error
    exit;
}

if (!empty($_POST['userId'])) {
    $userId = $_POST['userId'];
} else if (!empty($_GET['id'])) {
    $userId = $_GET['id'];
} else {
    $userId = $_SESSION['logged_id'];
}

// TODO: try catch
$user = User::find($userId);

if (isset($_POST['userEditProfile'])) {
    try {
        $user->setName($_POST['name']);
        $user->setEmail(trim($_POST['email']));
        $user->setDateOfBirth($_POST['dateOfBirth']);
        $user->setPhone($_POST['phone']);
        $user->loadRelation('address');
        $user->save();
    } catch(e) {
        // TODO: error message
        echo 'ERROR SIGNING UP :(';
        print_r(e);
    } finally {
        header('Location: /html/admin/userEdit.php?id=' . $userId);
    }
    exit;
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
            null,
            Country::find($_POST['countryId'])
        );
        $newAddress->save();
        $user->setAddress($newAddress);
        $user->save();
    } catch(e) {
        // TODO: error message
        echo 'ERROR SIGNING UP :(';
        print_r(e);
        // header('Location: /html/admin/userEdit.php?id=' . $userId);
        exit;
    } finally {
        // TODO: make sure this is upon success
        header('Location: /html/admin/userEdit.php?id=' . $userId);
    }
}

if (isset($_POST['archiveUser'])) {
    // TODO: try catch with error
    $user->loadRelation('address');
    $user->setIsArchived(true)->save();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if (isset($_POST['unarchiveUser'])) {
    // TODO: try catch with error
    $user->loadRelation('address');
    $user->setIsArchived(false)->save();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if (isset($_POST['grantAdminPrivileges'])) {
    // TODO: try catch with error
    $user->loadRelation('address');
    $user->setIsAdmin(true)->save();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if (isset($_POST['removeAdminPrivileges'])) {
    // TODO: try catch with error
    $user->loadRelation('address');
    $user->setIsAdmin(false)->save();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
