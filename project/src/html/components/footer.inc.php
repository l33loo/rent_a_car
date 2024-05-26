<?php

if (!empty($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
    include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer/footerAdmin.inc.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer/footerRegular.inc.php';
}