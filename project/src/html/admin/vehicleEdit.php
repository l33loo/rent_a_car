<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Island.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Property.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Vehicle.php';

use RentACar\Category;
use RentACar\Island;
use RentACar\Property;
use RentACar\Vehicle;

if (empty($_GET['vehicleId'])) {
    // TODO: error
} else {
    try {
        $vehicle = Vehicle::find($_GET['vehicleId']);
        $vehicle->loadRelation('island');
        $vehicle->loadProperties();
        $islands = Island::search([]);
        $island = Island::find($vehicle->getIsland()->getId());
        $categories = Category::search([
            [
                'column' => 'isArchived',
                'operator' => '=',
                'value' => false
            ]
        ]);
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
                        <h1 class="text-center">Edit Vehicle</h1>
                    </div>
                    <div class="card-body">
                        <form action="/app/admin/vehicleEdit.php" method="post">
                            <div class="row mb-3">
                                <div class="col-md-3 col-sm-12">
                                    <label for="plate">
                                        Plate:
                                    </label>
                                    <input type="text" class="form-control" name="plate" value="<?php echo $vehicle->getPlate(); ?>">
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="categoryId">
                                        Category:
                                    </label>
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