<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Property;

try {
    $propertiesForCategory = Property::search([
        [
            'column' => 'id',
            'operator' => '>=',
            'value' => 6
        ]
    ]);
} catch(e) {
    // TODO: handle error
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
                        <h1 class="text-center">Edit Category</h1>
                    </div>
                    <div class="card-body">
                        <form action="/src/app/admin/categoryNew.php" method="post">
                            <div class="row mb-3">
                                <div class="col-md-4 col-sm-12">
                                    <label for="name">
                                        Name:
                                    </label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label for="dailyRate">
                                        Daily Rate:
                                    </label>
                                    <input class="form-control" type="number" step="0.01" name="dailyRate">
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label for="isArchived">
                                        Is Archived:
                                    </label>
                                    <select class="form-select" name="isArchived" id="selectIsArchived">
                                        <option value="0">
                                            NO
                                        </option>
                                        <option value="1">
                                            YES
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="description">
                                        Description:
                                    </label>
                                    <input type="text" class="form-control" name="description">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <?php foreach ($propertiesForCategory as $property) { ?>
                                    <div class="col-md col-sm-12">
                                        <label for="property-<?php echo $property->getId(); ?>">
                                            <?php echo $property->getName(); ?>:
                                        </label>
                                        <input type="text" class="form-control" name="property-<?php echo $property->getId(); ?>" value=<?php echo $property->getPropertyValue(); ?>>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="d-flex justify-content-center">
                                <input
                                    type="submit"
                                    class="btn btn-primary"
                                    name="categoryEdit"
                                    value="Add Category"
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