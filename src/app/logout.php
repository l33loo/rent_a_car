<?php
session_start();

session_destroy();

$_SESSION = [];
setcookie('user_email', '', time() - 3600, '/');
setcookie('user_name', '', time() - 3600, '/');

header("Location: ../html/login.php");
exit;
?>