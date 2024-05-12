<?php

include ('autoload.php');

use RENTAL\SRC\User;

if (empty($_POST)) {
    header('Location: login.php');
}

$users = User::search([
    [
        'column' => 'email',
        'operator' => '=',
        'value' => $_POST['email']
    ]
]);

if (count($users) != 1) {
    echo "Utilizador ou password incorrectos";
    exit;
}

if ($users[0]->checkPassword($_POST['password'])) {
    session_start();
    $_SESSION['logged_id'] = true;
    $_SESSION['name'] = $users[0]->getName();
    header('Location: index.php');
} else {
    echo "Palavra-passe Incorrecta";
    exit;
}