<?php
require_once '../components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/vehicle.inc.php';

session_start();

echo getHeader();
?>

<body?>
    <?php include '../components/navbar.inc.php'; ?>
    <div>
        <?php print_r($vehicle); ?>
    </div>
    <?php // TODO: uncomment => include '../components/footer.inc.php'; ?>
</body>
