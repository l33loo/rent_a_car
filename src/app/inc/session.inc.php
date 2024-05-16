<?php
session_start();

if (isset($_SESSION['logged_id']) && $_SESSION['logged_id'] === true) {
    header('Location: /index.php');
    exit;
}