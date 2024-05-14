<?php

if (!empty($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
    include 'navbar/navbarAdmin.inc.php';
} else {
    include 'navbar/navbarRegular.inc.php';
}