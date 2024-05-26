<?php

// TODO: fix
// include ('autoload.php');

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/inc/sessionUser.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/User.php';
use RentACar\User;

$wrongCredsMsg = 'Wrong email or password';

if (empty($_POST)) {
    redirectToLoginPage('empty POST');
    exit;
}

$users = User::search([
    [
        'column' => 'email',
        'operator' => '=',
        'value' => trim($_POST['email'])
    ]
]);

if (count($users) !== 1 || $users[0]->getIsArchived() === true) {
    redirectToLoginPage($wrongCredsMsg);
    exit;
}

if ($users[0]->checkPassword(trim($_POST['password']))) {
    unset($_SESSION['loginError']);
    $_SESSION['logged_id'] = $users[0]->getId();
    $_SESSION['name'] = $users[0]->getName();
    $_SESSION['isAdmin'] = $users[0]->getIsAdmin();

    if ($users[0]->getIsAdmin()) {
        header('Location: /html/admin/dashboard.php');
    } else {
        header('Location: /index.php');
    }
} else {
    redirectToLoginPage($wrongCredsMsg);
    exit;
}

function redirectToLoginPage(string $errorMsg): void
{
    $_SESSION['loginError'] = $errorMsg;
    header('Location: /html/login.php');
}