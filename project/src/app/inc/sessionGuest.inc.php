<?php
session_start();

if (empty($_SESSION['logged_id'])) {
    header('Location: /src/html/login.php');
    exit;
}