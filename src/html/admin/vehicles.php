<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/vehicles.inc.php';

echo getHeader();

print_r($vehicles);
?>

<body>
    <?php include '../components/navbar.inc.php'; ?>
    <div class="container">
        <div class="text-content">
            <h1 style="margin-top: 150px; margin-bottom:50px;">Manage Vehicles</h1>
        </div>
    </div>
    <div class="container">
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
                <?php foreach ($vehicles as $vehicle) { ?>
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
    <?php include '../components/footer.inc.php'; ?>
</body>

</html>