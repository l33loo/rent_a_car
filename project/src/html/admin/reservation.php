<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';

echo getHeader();
?>

<body?>
    <?php include '../components/navbar.inc.php'; ?>
    <div>
        <?php print_r($reservation); ?>
    </div>
    <?php // TODO: uncomment => include '../components/footer.inc.php'; ?>
</body>
