<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Property.php';

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
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/navbar.inc.php'; ?>
    <div class="container mt-5">
        <div class="row mt-5 mb-2">
            <div class="col">
                <div class="card mt-5 mb-4">
                    <div class="card-header">
                        <h1 class="text-center">Edit Category - <?php echo $category->getName() ?></h1>
                    </div>
                    <div class="card-body">
                        <form action="/app/admin/categoryEdit.php" method="post">
                            <div class="row mb-3">
                                <div class="col-md-4 col-sm-12">
                                    <label for="name">
                                        Name:
                                    </label>
                                    <input type="text" class="form-control" name="name" value="<?php echo $category->getName(); ?>">
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label for="dailyRate">
                                        Daily Rate:
                                    </label>
                                    <input class="form-control" type="number" step="0.01" name="dailyRate" value="<?php echo $category->getDailyRate(); ?>">
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label for="isArchived">
                                        Is Archived:
                                    </label>
                                    <select class="form-control" name="isArchived" id="selectIsArchived">
                                        <option
                                            value="1"
                                            <?php echo $category->getIsArchived() ? 'selected' : null; ?>
                                        >
                                            YES
                                        </option>
                                        <option
                                            value="0"
                                            <?php echo $category->getIsArchived() ? null : 'selected'; ?>
                                        >
                                            NO
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="description">
                                        Description:
                                    </label>
                                    <input type="text" class="form-control" name="description" value="<?php echo $category->getDescription(); ?>">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <?php foreach ($category->getProperties() as $property) { ?>
                                    <div class="col-md col-sm-12">
                                        <label for="property-<?php echo $property->getId(); ?>">
                                            <?php echo $property->getName(); ?>:
                                        </label>
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