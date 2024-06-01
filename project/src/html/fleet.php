<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Category;

$categories = Category::search([]);

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/fleet.inc.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
</body>

</html>