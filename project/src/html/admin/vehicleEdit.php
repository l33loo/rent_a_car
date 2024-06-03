<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/vehicleEdit.inc.php';

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>
    <div class="container mt-5">
        <div class="row mt-5 mb-2">
            <div class="col">
                <div class="card mt-5 mb-4">
                    <div class="card-header">
                        <h1 class="text-center">Edit Vehicle</h1>
                    </div>
                    <div class="card-body">
                        <?php $errorMsg = (empty($_SESSION['errors']) || empty($_SESSION['errors']['adminVehEditPage'])) ? null : $_SESSION['errors']['adminVehEditPage'];
                        if (!empty($errorMsg)) { ?>
                            <div class="alert alert-danger">
                                <?php echo $errorMsg;
                                unset($_SESSION['errors']['adminVehEditPage']); ?>
                            </div>
                        <?php } ?>
                        <form action="/src/app/admin/vehicleEdit.php" method="post">
                            <div class="row mb-3">
                                <div class="col-md-3 col-sm-12">
                                    <label for="plate">
                                        Plate:
                                    </label>
                                    <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['plate'])) { ?>
                                        <div class="text-danger">
                                            <small>
                                                <?php echo $_SESSION['errors']['plate'];
                                                unset($_SESSION['errors']['plate']); ?>
                                            </small>
                                        </div>
                                    <?php } ?>
                                    <input type="text" class="form-control" name="plate" value="<?php echo $vehicle->getPlate(); ?>">
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="categoryId">
                                        Category:
                                    </label>
                                    <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['categoryId'])) { ?>
                                        <div class="text-danger">
                                            <small>
                                                <?php echo $_SESSION['errors']['categoryId'];
                                                unset($_SESSION['errors']['categoryId']); ?>
                                            </small>
                                        </div>
                                    <?php } ?>
                                    <select class="form-select" name="categoryId" id="selectCategory">
                                            <option value="">
                                                No category
                                            </option>
                                        <?php foreach ($categories as $category) { ?>
                                            <option
                                                value="<?php echo $category->getId(); ?>"
                                                <?php echo $category->getId() === $vehicle->getCategory_id() ? 'selected' : null; ?>
                                            >
                                                <?php echo $category->getName();?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="islandId">
                                        Island:
                                    </label>
                                    <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['islandId'])) { ?>
                                        <div class="text-danger">
                                            <small>
                                                <?php echo $_SESSION['errors']['islandId'];
                                                unset($_SESSION['errors']['islandId']); ?>
                                            </small>
                                        </div>
                                    <?php } ?>
                                    <select class="form-select" name="islandId" id="selectIsland">
                                        <?php foreach ($islands as $island) { ?>
                                            <option
                                                value="<?php echo $island->getId(); ?>"
                                                <?php echo $island->getId() === $vehicle->getIsland()->getId() ? 'selected' : null; ?>
                                            >
                                                <?php echo $island->getName();?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="rentable">
                                        Rentable:
                                    </label>
                                    <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['rentable'])) { ?>
                                        <div class="text-danger">
                                            <small>
                                                <?php echo $_SESSION['errors']['rentable'];
                                                unset($_SESSION['errors']['rentable']); ?>
                                            </small>
                                        </div>
                                    <?php } ?>
                                    <select class="form-select" name="rentable" id="selectRentable">
                                        <option
                                            value="1"
                                            <?php echo $vehicle->getRentable() ? 'selected' : null; ?>
                                        >
                                            YES
                                        </option>
                                        <option
                                            value="0"
                                            <?php echo $vehicle->getRentable() ? null : 'selected'; ?>
                                        >
                                            NO
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <?php foreach ($vehicle->getProperties() as $property) { ?>
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
                                <input type="hidden" name="vehicleId" value="<?php echo $vehicle->getId(    ); ?>" />
                                <input
                                    type="submit"
                                    class="btn btn-primary"
                                    name="vehicleEdit"
                                    value="Edit Vehicle"
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