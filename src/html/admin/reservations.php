<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/reservations.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Customer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Island.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Location.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Reservation.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Status.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use RentACar\Customer;
use RentACar\Island;
use RentACar\Location;
use RentACar\Reservation;
use RentACar\Status;
use RentACar\User;

$reservations = Reservation::search([]);

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/navbar.inc.php'; ?>
    <div class="container">
        <div class="text-content">
            <h1 style="margin-top: 150px; margin-bottom:50px;">Manage Reservations</h1>
        </div>
    </div>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <?php /*
                    // TODO: use Carbon type
                    ?string $pickupDate = null,
                    // TODO: use Carbon type
                    ?string $dropoffDate = null,
                    // TODO: use Carbon type
                    ?string $pickupTime = null,
                    // TODO: use Carbon type
                    ?string $dropoffTime = null,
                    // TODO: use Carbon type
                    ?float $totalPrice = null,
                    ?string $reservedTimestamp = null,
                    // TODO: Update UML to reflect this
                    ?array $revisions = null,

                    ?int $billingAddress_id = null,
                    ?int $creditCard_id = null,
                    ?int $reservedByUser_id = null,
                    ?int $category_id = null,
                    ?int $customer_id = null,
                    ?int $status_id = null,
                    ?int $pickupLocation_id = null,
                    ?int $dropoffLocation_id = null,
                    ?int $vehicle_id = null,
                    ?int $returnedLocation_id = null,
                    ?int $collectedByUser_id = null,

                    // TODO: use Carbon type
                    ?string $dateReturned = null,
                    // TODO: use Carbon type
                    ?string $timeReturned = null,
                    ?Address $billingAddress = null,
                    ?CreditCard $creditCard = null,
                    ?User $reservedByUser = null,
                    ?Category $category = null,
                    ?Customer $customer = null,
                    ?Status $status = null,
                    ?Location $pickupLocation = null,
                    ?Location $dropoffLocation = null,
                    ?Vehicle $vehicle = null,
                    ?Location $returnedLocation = null,
                    ?User $collectedByUser = null
                    */ ?>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Pickup Location</th>
                        <th>Pickup Date</th>
                        <th>Pickup Time</th>
                        <th>Dropoff Location</th>
                        <th>Dropoff Date</th>
                        <th>Dropoff Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $reservation) {
                        $reservation->loadRelation('category', 'category');
                    ?>
                        <tr>
                            <th><?php echo $reservation->getId(); ?></th>
                            <td><?php echo $reservation->getCategory()->getName(); ?></td>
                            <td><?php echo $reservation->loadRelation('pickupLocation', 'location')->getPickupLocation()->getName(); ?></td>
                            <td><?php echo $reservation->getPickupDate(); ?></td>
                            <td><?php echo $reservation->getPickupTime(); ?></td>
                            <td><?php echo $reservation->loadRelation('dropoffLocation', 'location')->getDropoffLocation()->getName(); ?></td>
                            <td><?php echo $reservation->getDropoffDate(); ?></td>
                            <td><?php echo $reservation->getDropoffTime(); ?></td>
                            <td><?php echo $reservation->loadRelation('status', 'status')->getStatus()->getStatusName(); ?></td>
                            <td>
                                <a href="/html/admin/reservationView.php?id=<?php echo $reservation->getId(); ?>" class="btn btn-primary">View</a>
                                <a href="/html/admin/reservationEdit.php?id=<?php echo $reservation->getId(); ?>" class="btn btn-secondary">Edit</a>
                                <!-- <a href="" class="btn btn-danger">Delete</a> -->
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