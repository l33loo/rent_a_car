<?php
session_start();

if (!empty($_SESSION['logged_id'])) {
    header('Location: /');
    exit;
}