<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/vehicles.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Island;
use RentACar\Property;
use RentACar\Vehicle;

if (empty($_GET['vehicleId'])) {
    // TODO: error
} else {
    try {
        $vehicle = Vehicle::find($_GET['vehicleId']);
        $vehicle->loadRelation('island');
        $vehicle->loadRelation('category');
        $vehicle->loadProperties();
        $island = $vehicle->getIsland();
        $category = $vehicle->getCategory();
    } catch(e) {
        // TODO:
    }
}

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>
    <div class="container mt-5 pt-5">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <h1>Vehicle <?php echo $vehicle->getPlate(); ?></h1>
            <div class="d-flex flex-wrap align-items-center">
                <a href="/src/html/admin/vehicleEdit.php?vehicleId=<?php echo $vehicle->getId(); ?>" class="btn btn-secondary">
                    Edit
                </a>
                <form action="/src/app/admin/vehicleEdit.php" method="POST" class="ps-2 mb-0">
                    <input type="submit" name="vehicleArchive" class="btn btn-danger" value="Archive" />
                    <input type="hidden" name="vehicleId" value="<?php echo $vehicle->getId(); ?>" />
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle" id="my_table_id" data-url="data/url.json" data-id-field="id"
                data-editable-emptytext="Default empty text." data-editable-url="/my/editable/update/path">
                <thead>
                    <tr>
                        <th class="col" data-field="id" data-sortable="true" data-align="center">ID</th>
                        <?php foreach ($vehicle->getProperties() as $vehicleProperty) { ?>
                            <th>
                                <?php echo $vehicleProperty->getName() ?>
                            </th>
                        <?php } ?>
                        <th
                            class="col"
                            data-field="description"
                            data-editable="true"
                            data-editable-emptytext="Custom empty text."
                        >
                            Category
                        </th>
                        <th
                            class="col"
                            data-field="description"
                            data-editable="true"
                            data-editable-emptytext="Custom empty text."
                        >
                            Island
                        </th>
                        <th class="col" data-field="name" data-editable="true">Rentable</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><?php echo $vehicle->getId(); ?></th>
                        <?php foreach ($vehicle->getProperties() as $vehicleProperty) { ?>
                            <td>
                                <?php echo $vehicleProperty->getPropertyValue() ?>
                            </td>
                        <?php } ?>
                        <td><?php echo $category === null ? 'None' : $category->getName(); ?></td>
                        <td><?php echo $island->getName(); ?></td>
                        <td><?php echo $vehicle->getRentable() ? 'YES' : 'NO'; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
</body>

</html>