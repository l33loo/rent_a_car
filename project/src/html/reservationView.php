<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Customer;
use RentACar\Reservation;
use RentACar\Revision;
use RentACar\User;

try {
    if (empty($_GET['reservationId']) && empty($_SESSION['booking']) && empty($_SESSION['booking']['newRevision'])) {
        // TODO: handle error
        header('Location: /');
    }
    
    $hasUser = false;
    if (!empty($_GET['reservationId'])) {
        $hasUser = true;
        $reservation = Reservation::find($_GET['reservationId']);
        $reservation->loadRelation('ownerUser', 'user');

        if (!User::isLoggedInUser($reservation->getOwnerUser()->getId())) {
            header('Location: /');
        }

        $revisions = $reservation->findAllRevisions();
        $latestRevision = array_pop($revisions);
    } else if (!empty($_SESSION['booking']['newRevision'])) {
        $latestRevision = unserialize($_SESSION['booking']['newRevision']);
        $latestRevision->loadReservation();
        $reservation = $latestRevision->getReservation();
        unset($_SESSION['booking']);
    }
 
    $latestRevision->loadAllRelations();
    $vehicle = $latestRevision->getVehicle();
    $customer = $latestRevision->getCustomer();

} catch(Exception $e) {
    $errorMsg = $e->getMessage();
}

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>
    <div class="container mt-5">
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-5 mb-4">
            <h1>Reservation nº <?php echo $reservation->getId() ?> - <?php echo $latestRevision->getStatus()->getStatusName() ?></h1>
        </div>
        <?php if (!empty($errorMsg)) { ?>
            <div class="alert alert-danger">
                <?php echo $errorMsg ?>
            </div>
        <?php } ?>
        <?php if (!$hasUser) { ?>
            <div class="mb-5">
                The booking confirmation was emailed to <?php echo $customer->getEmail() ?>.
            </div>
        <?php } ?>
        <h2 class="mb-4">Booking Details</h2>
        <div class="table-responsive mb-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Submitted On</th>
                        <?php if ($hasUser) { ?>
                            <th>Submitted By</th>
                        <?php } ?>
                        <th>Category</th>
                        <th>Vehicle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $latestRevision->getSubmittedTimestamp() ?></td>
                        <?php if ($hasUser) { ?>
                            <td><?php echo $latestRevision->getSubmittedByUser() === null ? null : $latestRevision->getSubmittedByUser()->getName() ?></td>
                        <?php } ?>
                            <td><?php echo $latestRevision->getCategory()->getName() ?></td>
                        <td><?php echo $vehicle->Brand . ' ' . $vehicle->Model ?></td>
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
        <?php if ($hasUser) { ?>
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
        <?php } ?>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
</body>

</html>