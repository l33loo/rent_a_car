<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Address;
use RentACar\Island;
use RentACar\Location;

// TODO try catch + errors
$locations = Location::fetchActiveLocations();

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>
    <div class="container">
        <div class="text-content d-flex flex-wrap align-items-center justify-content-between px-3" style="margin-top: 150px; margin-bottom:50px;">
            <h1>Manage Locations</h1>
            <a href="/src/html/admin/locationNew.php" class="btn btn-success">Add New Location</a>
        </div>
    </div>
    <div class="container">
        <table class="table table-bordered" id="my_table_id" data-url="data/url.json" data-id-field="id"
            data-editable-emptytext="Default empty text." data-editable-url="/my/editable/update/path">
            <thead>
                <tr>
                    <th class="col" data-field="id" data-sortable="true" data-align="center">
                        ID
                    </th>
                    <th
                        class="col"
                        data-field="description"
                        data-editable="true"
                        data-editable-emptytext="Custom empty text."
                    >
                        Address
                    </th>
                    <th
                        class="col"
                        data-field="description"
                        data-editable="true"
                        data-editable-emptytext="Custom empty text."
                    >
                        Name
                    </th>
                    <th
                        class="col"
                        data-field="description"
                        data-editable="true"
                        data-editable-emptytext="Custom empty text."
                    >
                        Island
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
                <?php foreach ($locations as $location) {
                    $location->loadRelation('island');
                    $location->loadRelation('address');
                    $address = $location->getAddress();
                    $address->loadRelation('country');
                    $locationId = $location->getId();

                    if ($location->getIsArchived() === false) {
                ?>
                    <tr>
                        <th><?php echo $locationId; ?></th>
                        <td><?php echo $location->getName(); ?></td>
                        <td><?php echo $address; ?></td>
                        <td><?php echo $location->getIsland()->getName(); ?></td>
                        <td class="d-flex flex-wrap justify-content-evenly">
                            <!-- <a href="locationView.php?id=<?php echo $locationId ?>" class="btn btn-primary">View</a> -->
                            <!-- <a href="" class="btn btn-secondary">Edit</a> -->
                            <form action="/src/app/admin/locationArchive.php" method="POST">
                                <input type="submit" name="archiveLocation" class="btn btn-danger" value="Archive" />
                                <input type="hidden" name="locationId" value="<?php echo $locationId; ?>" />
                            </form>
                        </td>
                    </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
</body>

</html>