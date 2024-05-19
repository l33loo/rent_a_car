<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';

echo getHeader();
?>

<body?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/navbar.inc.php'; ?>
    <div>
        <?php print_r($vehicle); ?>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/footer.inc.php'; ?>
</body>
