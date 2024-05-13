<?php

// include ('autoload.php');

include '/var/www/html/app/RentACar/Accounts/User/User.php';
use RentACar\User;

session_start();

// $dbh = new PDO('mysql:host=mysql;dbname=carrentals', 'root', 'secret');
if (empty($_POST)) {
    $_SESSION['loginError'] = 'empty POST';
    header('Location: html/login.php');
    exit;
}

$users = User::search([
    [
        'column' => 'email',
        'operator' => '=',
        'value' => $_POST['email']
    ]
]);

// print_r($users);

if (count($users) !== 1) {
    $_SESSION['loginError'] = "Email or Password wrong";
    // echo "Email or Password wrong";
    header('Location: html/login.php');
    exit;
}

if ($users[0]->checkPassword($_POST['password'])) {
    $_SESSION['loginError'] = "Password good";
    $_SESSION['logged_id'] = true;
    $_SESSION['name'] = $users[0]->getName();
    header('Location: ../index.php');
} else {
    $_SESSION['loginError'] = "Wrong email or Password";
    // echo "Wrong email or Password";
    header('Location: html/login.php');
    exit;
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