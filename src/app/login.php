<?php

// include ('autoload.php');

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';
use RentACar\User;

session_start();

// TODO: redirect to ../index.php if user already logged in

$wrongCredsMsg = 'Wrong email or password';

// $dbh = new PDO('mysql:host=mysql;dbname=carrentals', 'root', 'secret');
if (empty($_POST)) {
    redirectToLoginPage('empty POST');
    exit;
}

$users = User::search([
    [
        'column' => 'name',
        'operator' => '=',
        'value' => $_POST['email']
    ]]);

// print_r($users);

if (count($users) !== 1) {
    // echo "Email or Password wrong";
    redirectToLoginPage($wrongCredsMsg);
    exit;
}

if ($users[0]->checkPassword($_POST['password'])) {
    unset($_SESSION['loginError']);
    $_SESSION['logged_id'] = true;
    $_SESSION['name'] = $users[0]->getName();
    $_SESSION['isAdmin'] = $users[0]->getIsAdmin();
    // TODO: send admins to admin dashboard, and non-admins to index.php
    if ($users[0]->getIsAdmin()) {
        header('Location: ../html/admin/dashboard.php');
    } else {
        header('Location: ../index.php');
    }
} else {
    // echo "Wrong email or Password";
    redirectToLoginPage($wrongCredsMsg);
    exit;
}

function redirectToLoginPage(string $errorMsg): void {
    $_SESSION['loginError'] = $errorMsg;
    header('Location: ../html/login.php');
}

// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
//     if (!$email) {
//         echo "Email inválido";
//         exit;
//     }

//     // Filtra a senha (aqui você pode adicionar mais validações, como tamanho mínimo/máximo)
//     $password = $_POST['password'];


//     $stmt = $dbh->prepare("SELECT * FROM users WHERE email = ?");
//     $stmt->execute([$email]);
//     $user = $stmt->fetchObject('User');

//     setcookie('user_email', $email, time() + (86400 * 30), "/"); 
//     setcookie('user_name', $user->getName(), time() + (86400 * 30), "/");
    
//     if (!$user) {
//         echo "Email ou senha incorretos";
//         exit;
//     }

//     if ($user->checkPassword($password)) {
//         session_start();
//         $_SESSION['logged_id'] = true;
//         $_SESSION['name'] = $user->getName();
//         header('Location: index.php');
//         exit;
//     } else {
//         echo "Email ou senha incorretos";
//         exit;
//     }
// } else {
//     header('Location: login.php');
//     exit;
// }