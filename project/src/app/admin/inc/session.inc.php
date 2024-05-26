<?php

session_start();

if (empty($_SESSION['logged_id'])) {
    header('Location: /html/login.php');
    exit;
} else if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === false) {
    header('Location: /index.php');
    exit;
}