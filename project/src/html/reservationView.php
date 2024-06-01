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
                        <th>Submitted By</th>
                        <th>Category</th>
                        <th>Vehicle</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $latestRevision->getSubmittedTimestamp() ?></td>
                        <td><?php echo $latestRevision->getSubmittedByUser() === null ? null : $latestRevision->getSubmittedByUser()->getName() ?></td>
                        <td><?php echo $latestRevision->getCategory()->getName() ?></td>
                        <td><?php echo $vehicle->Brand . ' ' . $vehicle->Model ?></td>
                        <td><?php echo $latestRevision->getStatus()->getStatusName() ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h2 class="mb-4">Customer</h2>
        <div class="table-responsive mb-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Driver's License</th>
                        <th>Tax number</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php $customer = $latestRevision->getCustomer() ?>
                        <th><?php echo $customer->getId() ?></th>
                        <td><?php echo $customer->getName() ?></td>
                        <td><?php echo $customer->getDateOfBirth() ?></td>
                        <td><?php echo $customer->getEmail() ?></td>
                        <td><?php echo $customer->getAddress() ?></td>
                        <td><?php echo $customer->getPhone() ?></td>
                        <td><?php echo $customer->getDriversLicense() ?></td>
                        <td><?php echo $customer->getTaxNumber() ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h2 class="mb-4">Payment</h2>
        <div class="table-responsive mb-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Amount</th>
                        <th>Credit Card Number</th>
                        <th>Credit Card Expiry</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php $cc = $latestRevision->getCreditCard() ?>
                        <td><?php echo $latestRevision->getTotalPriceToString() ?></td>
                        <td><?php echo $cc->getCcNumber() ?></td>
                        <td><?php echo $cc->getCcExpiry() ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h2 class="mb-4">Pick-up and Drop-off</h2>
        <div class="table-responsive mb-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>Scheduled Pick-up</th>
                        <th>Scheduled Drop-off</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Location</th>
                        <td><?php echo $latestRevision->getPickupLocation()->getName() ?></td>
                        <td><?php echo $latestRevision->getDropoffLocation()->getName() ?></td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td><?php echo  $latestRevision->getPickupDate() ?></td>
                        <td><?php echo  $latestRevision->getDropoffDate() ?></td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td><?php echo  $latestRevision->getPickupTime() ?></td>
                        <td><?php echo  $latestRevision->getDropoffTime() ?></td>
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
                        <th>Pickup Location</th>
                        <th>Pickup Date</th>
                        <th>Pickup Time</th>
                        <th>Dropoff Location</th>
                        <th>Dropoff Date</th>
                        <th>Dropoff Time</th>
                        <th>Vehicle</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($revisions as $revision) {
                        $revision->loadCategory()
                            ->loadStatus()
                            ->loadVehicle()
                            ->loadPickupLocation()
                            ->loadDropoffLocation();
                        $vehicle = $revision->getVehicle();
                        $vehicle->loadProperties();
                    ?>
                        <tr>
                            <td><?php echo $revision->getSubmittedTimestamp() ?></td>
                            <td><?php echo $revision->getCategory()->getName(); ?></td>
                            <td><?php echo $revision->getPickupLocation()->getName(); ?></td>
                            <td><?php echo $revision->getPickupDate(); ?></td>
                            <td><?php echo $revision->getPickupTime(); ?></td>
                            <td><?php echo $revision->getDropoffLocation()->getName(); ?></td>
                            <td><?php echo $revision->getDropoffDate(); ?></td>
                            <td><?php echo $revision->getDropoffTime(); ?></td>
                            <td><?php echo $vehicle->Brand . ' ' . $vehicle->Model ?></td>
                            <td><?php echo $revision->getStatus()->getStatusName(); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
</body>

</html>