<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/reservations.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Customer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Island.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Location.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Reservation.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Revision.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Status.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use RentACar\Customer;
use RentACar\Island;
use RentACar\Location;
use RentACar\Reservation;
use RentACar\Revision;
use RentACar\Status;
use RentACar\User;



echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>
    <div class="container mt-5">
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-5 mb-4">
            <h1>Manage Reservations</h1>
            <a class="btn btn-success" href="/html/admin/reservationNew.php">New Reservation</a>
        </div>
    </div>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Pickup Location</th>
                        <th>Pickup Date</th>
                        <th>Pickup Time</th>
                        <th>Dropoff Location</th>
                        <th>Dropoff Date</th>
                        <th>Dropoff Time</th>
                        <th>Vehicle</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $revisions = Revision::fetchAllLatestRevisions();
                    foreach ($revisions as $revision) {
                        $revision->loadCategory();
                        $revision->loadReservation();
                        $revision->loadVehicle();
                        $revision->loadPickupLocation();
                        $revision->loadDropoffLocation();

                        $reservationId = $revision->getReservation()->getId();
                    ?>
                        <tr>
                            <th><?php echo $reservationId; ?></th>
                            <td><?php echo $revision->getCategory()->getName(); ?></td>
                            <td><?php echo $revision->getPickupLocation()->getName(); ?></td>
                            <td><?php echo $revision->getPickupDate(); ?></td>
                            <td><?php echo $revision->getPickupTime(); ?></td>
                            <td><?php echo $revision->getDropoffLocation()->getName(); ?></td>
                            <td><?php echo $revision->getDropoffDate(); ?></td>
                            <td><?php echo $revision->getDropoffTime(); ?></td>
                            <td><?php echo $revision->getVehicle() === null ? null : $revision->getVehicle()->getPlate() ?></td>
                            <td><?php echo $revision->loadStatus()->getStatus()->getStatusName(); ?></td>
                            <td>
                                <a href="/html/admin/reservationView.php?reservationId=<?php echo $reservationId; ?>" class="btn btn-primary">View</a>
                                <a href="/html/admin/reservationEdit.php?reservationId=<?php echo $reservationId; ?>" class="btn btn-secondary">Edit</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include '../components/footer.inc.php'; ?>
</body>

</html>