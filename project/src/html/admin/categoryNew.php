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
} catch(Exception $e) {
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
                        <h1 class="text-center">Add New Category</h1>
                    </div>
                    <div class="card-body">
                    <?php $errorMsg = (empty($_SESSION['errors']) || empty($_SESSION['errors']['adminCatNewPage'])) ? null : $_SESSION['errors']['adminCatNewPage'];
                    if (!empty($errorMsg)) { ?>
                        <div class="alert alert-danger">
                            <?php echo $errorMsg;
                            unset($_SESSION['errors']['adminCatNewPage']); ?>
                        </div>
                    <?php } ?>
                        <form action="/src/app/admin/categoryNew.php" method="post">
                            <div class="row mb-3">
                                <div class="col-md-3 col-sm-12">
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
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="col-md-7 col-sm-12">
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
                                    <input type="text" class="form-control" name="description">
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
                                    <input class="form-control" type="number" step="0.01" name="dailyRate">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <?php foreach ($propertiesForCategory as $property) { ?>
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