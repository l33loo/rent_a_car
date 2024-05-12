<?php

// include ('autoload.php');

include '/var/www/html/app/RentACar/Accounts/User/User.php';
use RentACar\User;

$msg = '';

// $dbh = new PDO('mysql:host=mysql;dbname=carrentals', 'root', 'secret');
// if (empty($_POST)) {
//     $msg = 'empty POST';
//     header('Location: login.php');
//     exit;
// }

if (!empty($_POST)) {
    $users = User::search([
        [
            'column' => 'email',
            'operator' => '=',
            'value' => $_POST['email']
        ]
    ]);

    print_r($users);
    
    if (count($users) != 1) {
        $msg = "Email or Password wrong";
        echo "Email or Password wrong";
        exit;
    }
    
    if ($users[0]->checkPassword($_POST['password'])) {
        $msg = "Password good";
        session_start();
        $_SESSION['logged_id'] = true;
        $_SESSION['name'] = $users[0]->getName();
        header('Location: index.php');
    } else {
        $msg = "Wrong email or Password";
        echo "Wrong email or Password";
        exit;
    }
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