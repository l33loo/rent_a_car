<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Category.php';

use RentACar\Category;

if (empty($_GET['categoryId'])) {
    // TODO: error
    exit;
}

try {
    $category = Category::find($_GET['categoryId']);
    $category->loadProperties();
    // print_r($category);
    $categoryObjectVars = $category->getObjectVars();
    // print_r($categoryObjectVars);
} catch (e) {
    // TODO: manage error and redirect
}

echo getHeader();
?>

<body?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/navbar.inc.php'; ?>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <?php foreach ($categoryObjectVars as $varKey => $varValue) { ?>
                        <th>
                            <?php echo $varKey; ?>
                        </th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($categoryObjectVars as $varKey => $varValue) { ?>
                        <td>
                            <?php print_r($varValue); ?>
                        </td>
                    <?php } ?>
                </tr>
            </tbody>
        </table>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/footer.inc.php'; ?>
</body>
