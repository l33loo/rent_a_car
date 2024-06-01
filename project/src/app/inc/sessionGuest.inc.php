<?php
session_start();

if (empty($_SESSION['logged_id'])) {
    header('Location: /src/html/login.php');
    exit;
}

function isSameUser(int $userId) {
    return $_SESSION['logged_id'] != $userId;
}

function redirectLoggedInUser(string $path) {
    header("Location: $path");
}