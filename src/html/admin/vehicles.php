<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/vehicles.inc.php';

echo getHeader();
?>
<!-- public function __construct(
?string $plate = null,
?bool $rentable = null,
?int $island_id = null,
?int $category_id = null,
?Island $island = null,
?Category $category = null,
?array $properties = null,
) -->
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/navbar.inc.php'; ?>
    <div class="container d-flex flex-wrap justify-content-between align-items-center mt-5 pt-5 mb-3">
        <div class="text-content">
            <h1>Manage Vehicles - <?php echo $islandName; ?></h1>
        </div>
        <div>
            <form action="" method="get">
                <div class="d-flex flex-wrap">
                    <select class="form-control" name="islandId" id="selectIsland">
                        <?php foreach ($islands as $island) { ?>
                            <option value="<?php echo $island->getId(); ?>"><?php echo $island->getName(); ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" value="<?php echo $island->getName(); ?>" name="islandName">
                    <input class="btn btn-primary" type="submit" name="selectIsland" value="Filter by island">
                </div>
            </form>           
        </div>
    </div>
    <div class="container">
        <div class="accordion">
            <?php foreach ($vehiclesByCategoryForIsland as $categoryName => $vehicles) { ?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                            <?php echo $categoryName; ?>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <table id="my_table_id" data-url="data/url.json" data-id-field="id"
                                data-editable-emptytext="Default empty text." data-editable-url="/my/editable/update/path">
                                <thead>
                                    <tr>
                                        <th class="col" data-field="id" data-sortable="true" data-align="center">ID</th>
                                        <th
                                            class="col"
                                            data-field="description"
                                            data-editable="true"
                                            data-editable-emptytext="Custom empty text."
                                        >
                                            Plate
                                        </th>
                                        <th class="col" data-field="name" data-editable="true">Rentable</th>
                                        <th
                                            class="col"
                                            data-field="description"
                                            data-editable="true"
                                            data-editable-emptytext="Custom empty text."
                                        >
                                            TODO: Others...
                                        </th>
                                        <th
                                            class="col"
                                            data-field="description"
                                            data-editable="true"
                                            data-editable-emptytext="Custom empty text."
                                        >
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($vehicles as $vehicle) {
                                        $vehicle->loadProperties();
                                    ?>
                                        <tr>
                                            <td><?php echo $vehicle->getId(); ?></td>
                                            <td><?php echo $vehicle->getPlate(); ?></td>
                                            <td><?php echo $vehicle->getRentable(); ?></td>
                                            <td>TODO: Others...</td>
                                            <td>
                                                <a href="vehicle.php?id=<?php echo $vehicle->getId(); ?>" class="btn btn-primary">
                                                    View
                                                </a>
                                                <a href="" class="btn btn-secondary">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php include '../components/footer.inc.php'; ?>
</body>

</html>