<?php

session_start();

if (empty($_SESSION['logged_id'])) {
    header('Location: /src/html/login.php');
    exit;
} else if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === false) {
    header('Location: /src/index.php');
    exit;
}