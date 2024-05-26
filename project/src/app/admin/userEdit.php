<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';

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
            $_POST['countryId']
        );
        $newAddress->save();
        $user->setAddress_id($newAddress->getId());
        $user->save();
    } catch(e) {
        // TODO: error message
        echo 'ERROR SIGNING UP :(';
        print_r(e);
        // header('Location: /html/admin/userEdit.php?id=' . $userId);
        exit;
    } finally {
        // TODO: make sure this is upon success
        header('Location: /html/admin/user.php?id=' . $userId);
    }
}

if (isset($_POST['archiveUser'])) {
    // TODO: try catch with error
    $user->setIsArchived(true)->save();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if (isset($_POST['unarchiveUser'])) {
    // TODO: try catch with error
    $user->setIsArchived(false)->save();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if (isset($_POST['grantAdminPrivileges'])) {
    // TODO: try catch with error
    $user->setIsAdmin(true)->save();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if (isset($_POST['removeAdminPrivileges'])) {
    // TODO: try catch with error
    $user->setIsAdmin(false)->save();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
