<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Customer;
use RentACar\Reservation;
use RentACar\Revision;

try {
    if (empty($_GET['reservationId'])) {
        // TODO: handle error
        echo 'no reservationId';
        exit;
    }
    
    $reservation = Reservation::find($_GET['reservationId']);
    $reservation->loadRelation('ownerUser', 'user');
    $revisions = $reservation->findAllRevisions();
    $latestRevision = array_pop($revisions);
    $latestRevision->loadAllRelations();
    $vehicle = $latestRevision->getVehicle();

} catch(Exception $e) {
    // TODO: handle error
    echo 'Error: ' . $e->getMessage();
}

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>
    <div class="container mt-5">
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-5 mb-4">
            <h1>Reservation nº <?php echo $reservation->getId() ?></h1>
        </div>
        <h2 class="mb-4">Booking Details</h2>
        <div class="table-responsive mb-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Submitted On</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>Vehicle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $latestRevision->getSubmittedTimestamp() ?></td>
                        <td><?php echo $latestRevision->getStatus()->getStatusName() ?></td>
                        <td><?php echo $latestRevision->getCategory()->getName() ?></td>
                        <td><?php echo $vehicle === null ? null : $vehicle->Brand . ' ' . $vehicle->Model . ' - ' . $vehicle->getPlate() ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h2 class="mb-4">Customer</h2>
        <div class="table-responsive mb-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php $customer = $latestRevision->getCustomer() ?>
                        <td><?php echo $customer->getName() ?></td>
                        <td><?php echo $customer->getDateOfBirth() ?></td>
                        <td><?php echo $customer->getEmail() ?></td>
                        <td><?php echo $customer->getPhone() ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h2 class="mb-4">Reservation History</h2>
        <div class="table-responsive mb-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Submitted On</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($revisions as $revision) {
                        $revision->loadCategory();
                    ?>
                    <tr>
                        <td><?php echo $revision->getSubmittedTimestamp() ?></td>
                        <td><?php echo $revision->getCategory()->getName(); ?></td>
                        <td><?php echo $revision->getStatus()->getStatusName(); ?></td>
                        <td>
                            <a href="/src/html/user/reservationView.php?reservationId=<?php echo $reservation->getId(); ?>"
                                class="btn btn-primary">View</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
</body>

</html>