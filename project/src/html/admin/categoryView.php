<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Category;

if (empty($_GET['categoryId'])) {
    // TODO: error
    exit;
}

try {
    $category = Category::find($_GET['categoryId']);
    $category->loadProperties();
} catch (e) {
    // TODO: manage error and redirect
}

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>
    <div class="container mt-5 pt-5">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <h1>Category - <?php echo $category->getName(); ?></h1>
            <div class="d-flex flex-wrap align-items-center">
                <a href="/src/html/admin/categoryEdit.php?categoryId=<?php echo $category->getId(); ?>" class="btn btn-secondary">
                    Edit
                </a>
                <form action="/src/app/admin/categoryEdit.php" method="POST" class="ps-2 mb-0">
                    <input type="submit" name="categoryArchive" class="btn btn-danger" value="Archive" />
                    <input type="hidden" name="categoryId" value="<?php echo $category->getId(); ?>" />
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <?php foreach ($category->getProperties() as $categoryProperty) { ?>
                            <th>
                                <?php echo $categoryProperty->getName() ?>
                            </th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><?php echo $category->getId(); ?></th>
                        <td><?php echo $category->getName(); ?></td>
                        <td><?php echo $category->getDescription(); ?></td>
                        <?php foreach ($category->getProperties() as $categoryProperty) { ?>
                            <td>
                                <?php echo $categoryProperty->getPropertyValue() ?>
                            </td>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
</body>

</html>