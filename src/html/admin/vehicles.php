<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/vehicles.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Property.php';

use RentACar\Property;

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/navbar.inc.php'; ?>
    <div class="container d-flex flex-wrap justify-content-between align-items-center mt-5 pt-5 mb-3">
        <div class="text-content">
            <h1>Manage Vehicles - <?php echo $islandName; ?></h1>
        </div>
        <div>
            <form action="" method="get">
                <div class="d-flex flex-wrap justify-content-end">
                    <div class="ms-2">
                        <select class="form-control" name="islandId" id="selectIsland">
                            <?php foreach ($islands as $island) { ?>
                                <option
                                    value="<?php echo $island->getId(); ?>"
                                    <?php echo $island->getId() == $islandId ? 'selected' : null; ?>
                                >
                                    <?php echo $island->getName();?>
                                </option>
                            <?php } ?>
                        </select>
                        <input type="hidden" value="<?php echo $island->getName(); ?>" name="islandName">
                    </div>
                    <div class="ms-2">
                        <input class="btn btn-primary" type="submit" value="Filter by island">
                    </div>
                </div>
            </form>           
        </div>
    </div>
    <div class="container mb-4">
        <div class="d-flex flex-wrap">
            <a href="/html/admin/vehicleNew.php" class="btn btn-primary me-2">
                Add New Vehicle
            </a> 
            <a href="/html/admin/categoryNew.php" class="btn btn-success me-2">
                Add New Category
            </a>                       
        </div>
    </div>
    <div class="container">
        <div class="accordion">
            <?php foreach ($vehiclesByCategoryForIsland as $categoryId => $data) {
                $categoryIsOpen = isset($_GET['categoryId']) && $_GET['categoryId'] == $categoryId;
            ?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button <?php echo $categoryIsOpen ? null : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?php echo $categoryId; ?>" aria-expanded="false" aria-controls="panelsStayOpen-collapse<?php echo $categoryId; ?>">
                            <?php echo !empty($data['categoryName']) ? $data['categoryName'] : 'Uncategorized'; ?>
                        </button>
                    </h2>
                    <div
                        id="panelsStayOpen-collapse<?php echo $categoryId; ?>"
                        class="accordion-collapse collapse <?php echo $categoryIsOpen ? 'show' : null; ?>"
                    >
                        <div class="accordion-body">
                            <?php if ($categoryId !== '') { ?>
                                <div class="mb-3 d-flex flex-wrap justify-content-end">
                                    <a href="/html/admin/categoryView.php?categoryId=<?php echo $categoryId; ?>" class="btn btn-primary ms-2">View Category</a>    
                                    <a href="/html/admin/categoryEdit.php?categoryId=<?php echo $categoryId; ?>" class="btn btn-secondary ms-2">Edit Category</a>
                                    <form action="/app/admin/categoryEdit.php" method="POST" class="ms-2">
                                        <input type="submit" name="categoryArchive" class="btn btn-danger" value="Archive Category" />
                                        <input type="hidden" name="categoryId" value="<?php echo $categoryId; ?>" />
                                    </form>
                                </div>
                            <?php } ?>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle" id="my_table_id" data-url="data/url.json" data-id-field="id"
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
                                                Properties
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
                                        <?php foreach ($data['vehicles'] as $vehicle) { 
                                            $vehicle->loadProperties();
                                            $vehicleProperties = $vehicle->getProperties();
                                        ?>
                                            <tr
                                                <?php if ($vehicle->getRentable() === false) {
                                                    echo 'class="table-active"';
                                                } ?>
                                            >
                                                <th><?php echo $vehicle->getId(); ?></th>
                                                <td><?php echo $vehicle->getPlate(); ?></td>
                                                <td><?php echo $vehicle->getRentable() ? 'YES' : 'NO'; ?></td>
                                                <td class="table-responsive">
                                                    <table  class="table table-sm mb-0">
                                                        <thead>
                                                            <tr
                                                                <?php if ($vehicle->getRentable() === false) {
                                                                    echo 'class="table-active"';
                                                                } ?>
                                                            >
                                                                <?php foreach ($vehicleProperties as $vehicleProperty) { ?>
                                                                    <th>
                                                                        <?php echo $vehicleProperty->getName() ?>
                                                                    </th>
                                                                <?php } ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr
                                                                <?php if ($vehicle->getRentable() === false) {
                                                                    echo 'class="table-active"';
                                                                } ?>
                                                            >
                                                                <?php foreach ($vehicleProperties as $vehicleProperty) { ?>
                                                                    <td>
                                                                        <?php echo $vehicleProperty->getPropertyValue() ?>
                                                                    </td>
                                                                <?php } ?>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td>
                                                    <a href="/html/admin/vehicleView.php?vehicleId=<?php echo $vehicle->getId(); ?>" class="btn btn-primary">
                                                        View
                                                    </a>
                                                    <a href="/html/admin/vehicleEdit.php?vehicleId=<?php echo $vehicle->getId(); ?>" class="btn btn-secondary">
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
                </div>
            <?php } ?>
        </div>
    </div>
    <?php include '../components/footer.inc.php'; ?>
</body>

</html>