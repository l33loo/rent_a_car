<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/reservations.inc.php';
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

$stmt = Revision::rawSQL("
    SELECT revision.* FROM revision
    LEFT OUTER JOIN (
        SELECT reservation_id, max(submittedTimestamp) as maxSubmittedTimestamp
            FROM revision
            GROUP BY reservation_id
    ) latestRevision
    ON revision.reservation_id = latestRevision.reservation_id
    WHERE revision.submittedTimestamp = latestRevision.maxSubmittedTimestamp;
");

$revisions = [];
while($row = $stmt->fetchObject(Revision::class)) {
    $revisions[] = $row;
}

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/navbar.inc.php'; ?>
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
                    ?string $submittedTimestamp = null,
                    // TODO: Update UML to reflect this
                    ?array $revisions = null,

                    ?int $billingAddress_id = null,
                    ?int $creditCard_id = null,
                    ?int $submittedByUser_id = null,
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
                    ?User $submittedByUser = null,
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
                        <th>Reservation ID</th>
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
                    <?php foreach ($revisions as $revision) {
                        $revision->loadRelation('category');
                        $revision->loadRelation('reservation');
                        $reservationId = $revision->getReservation()->getId();
                    ?>
                        <tr>
                            <th><?php echo $reservationId; ?></th>
                            <td><?php echo $revision->getCategory()->getName(); ?></td>
                            <td><?php echo $revision->loadRelation('pickupLocation', 'location')->getPickupLocation()->getName(); ?></td>
                            <td><?php echo $revision->getPickupDate(); ?></td>
                            <td><?php echo $revision->getPickupTime(); ?></td>
                            <td><?php echo $revision->loadRelation('dropoffLocation', 'location')->getDropoffLocation()->getName(); ?></td>
                            <td><?php echo $revision->getDropoffDate(); ?></td>
                            <td><?php echo $revision->getDropoffTime(); ?></td>
                            <td><?php echo $revision->loadRelation('status', 'status')->getStatus()->getStatusName(); ?></td>
                            <td>
                                <a href="/html/admin/reservationView.php?reservationId=<?php echo $reservationId; ?>" class="btn btn-primary">View</a>
                                <a href="/html/admin/reservationEdit.php?reservationId=<?php echo $reservationId; ?>" class="btn btn-secondary">Edit Base Reservation</a>
                                <a href="/html/admin/reservationComplete.php?reservationId=<?php echo $reservationId; ?>" class="btn btn-warning">Complete Reservation</a>
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