<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Category;
use RentACar\Property;

if (empty($_GET['categoryId'])) {
    // TODO: error
} else {
    try {
        $category = Category::find($_GET['categoryId']);
        $category->loadProperties();
    } catch(e) {
        // TODO:
    }
}

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>
    <div class="container mt-5">
        <div class="row mt-5 mb-2">
            <div class="col">
                <div class="card mt-5 mb-4">
                    <div class="card-header">
                        <h1 class="text-center">Edit Category - <?php echo $category->getName() ?></h1>
                    </div>
                    <div class="card-body">
                    <?php $errorMsg = (empty($_SESSION['errors']) || empty($_SESSION['errors']['adminCatEditPage'])) ? null : $_SESSION['errors']['adminCatEditPage'];
                    if (!empty($errorMsg)) { ?>
                        <div class="alert alert-danger">
                            <?php echo $errorMsg;
                            unset($_SESSION['errors']['adminCatEditPage']); ?>
                        </div>
                    <?php } ?>
                        <form action="/src/app/admin/categoryEdit.php" method="post">
                            <div class="row mb-3">
                                <div class="col-md-4 col-sm-12">
                                    <label for="name">
                                        Name:
                                    </label>
                                    <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['name'])) { ?>
                                        <div class="text-danger">
                                            <small>
                                                <?php echo $_SESSION['errors']['name'];
                                                unset($_SESSION['errors']['name']); ?>
                                            </small>
                                        </div>
                                    <?php } ?>
                                    <input type="text" class="form-control" name="name" value="<?php echo $category->getName(); ?>">
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <label for="dailyRate">
                                        Daily Rate:
                                    </label>
                                    <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['dailyRate'])) { ?>
                                        <div class="text-danger">
                                            <small>
                                                <?php echo $_SESSION['errors']['dailyRate'];
                                                unset($_SESSION['errors']['dailyRate']); ?>
                                            </small>
                                        </div>
                                    <?php } ?>
                                    <input class="form-control" type="number" step="0.01" name="dailyRate" value="<?php echo $category->getDailyRate(); ?>">
                                </div>
                                <div class="col-sm-12 col-md">
                                    <label for="description">
                                        Description:
                                    </label>
                                    <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['description'])) { ?>
                                        <div class="text-danger">
                                            <small>
                                                <?php echo $_SESSION['errors']['description'];
                                                unset($_SESSION['errors']['description']); ?>
                                            </small>
                                        </div>
                                    <?php } ?>
                                    <input type="text" class="form-control" name="description" value="<?php echo $category->getDescription(); ?>">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <?php foreach ($category->getProperties() as $property) { ?>
                                    <div class="col-md col-sm-12">
                                        <label for="property-<?php echo $property->getId(); ?>">
                                            <?php echo $property->getName(); ?>:
                                        </label>
                                        <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['property-' . $property->getId()])) { ?>
                                            <div class="text-danger">
                                                <small>
                                                    <?php echo $_SESSION['errors']['property-' . $property->getId()];
                                                    unset($_SESSION['errors']['property-' . $property->getId()]); ?>
                                                </small>
                                            </div>
                                        <?php } ?>
                                        <input type="text" class="form-control" name="property-<?php echo $property->getId(); ?>" value=<?php echo $property->getPropertyValue(); ?>>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="hidden" name="categoryId" value="<?php echo $category->getId(); ?>" />
                                <input
                                    type="submit"
                                    class="btn btn-primary"
                                    name="categoryEdit"
                                    value="Edit Category"
                                    <?php echo $category->getIsArchived() === true ? 'disabled' : null ?>
                                />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>