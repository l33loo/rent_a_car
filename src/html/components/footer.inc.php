<?php

if (!empty($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
    include '/var/www/html/html/components/footer/footerAdmin.inc.php';
} else {
    include '/var/www/html/html/components/footer/footerRegular.inc.php';
}