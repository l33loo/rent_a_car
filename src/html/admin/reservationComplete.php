<?php  
require_once $_SERVER['DOCUMENT_ROOT'] . "/html/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Customer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Island.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Location.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Reservation.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Revision.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Status.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use RentACar\Category;
use RentACar\Customer;
use RentACar\Island;
use RentACar\Location;
use RentACar\Reservation;
use RentACar\Revision;
use RentACar\Status;
use RentACar\User;

try {
    if (empty($_GET['reservationId'])) {
        //TODO: error
    }
    $reservationId = $_GET['reservationId'];
    $reservation = Reservation::find($reservationId);
    $latestRevision = $reservation->findLatestRevision();
    $latestRevision->loadRelation('dropoffLocation', 'location');
    $latestRevisionDroppoffLocation = $latestRevision->getDropoffLocation();
    $latestRevisionDroppoffLocation->loadRelation('island');
    $effectiveLocations = Location::fetchActiveLocations($latestRevisionDroppoffLocation->getIsland()->getId());
    $statuses = Status::search([]);
    $avaiableVehicles = $latestRevision->findAvailableVehicles();
} catch(e) {
    // TODO: handle error
    exit;
}

//     ?int $reservation_id = null,
//     // TODO: use Carbon type
//     ?string $pickupDate = null,
//     // TODO: use Carbon type
//     ?string $dropoffDate = null,
//     // TODO: use Carbon type
//     ?string $pickupTime = null,
//     // TODO: use Carbon type
//     ?string $dropoffTime = null,
//     // TODO: use Carbon type
//     ?float $totalPrice = null,
//     ?string $submittedTimestamp = null,

//     ?int $billingAddress_id = null,
//     ?int $creditCard_id = null,
//     ?int $submittedByUser_id = null,
//     ?int $category_id = null,
//     ?int $customer_id = null,
//     ?int $status_id = null,
//     ?int $pickupLocation_id = null,
//     ?int $dropoffLocation_id = null,
//     ?int $vehicle_id = null,
//     ?int $returnedLocation_id = null,
//     ?int $collectedByUser_id = null,

//     // TODO: use Carbon type
//     ?string $dateReturned = null,
//     // TODO: use Carbon type
//     ?string $timeReturned = null,
//     ?Reservation $reservation = null,
//     ?Address $billingAddress = null,
//     ?CreditCard $creditCard = null,
//     ?User $submittedByUser = null,
//     ?Category $category = null,
//     ?Customer $customer = null,
//     ?Status $status = null,
//     ?Location $pickupLocation = null,
//     ?Location $dropoffLocation = null,
//     ?Vehicle $vehicle = null,
//     ?Location $returnedLocation = null,
//     ?User $collectedByUser = null

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/navbar.inc.php'; ?>

    <div class="container pt-5">
        <h1 class="pt-5 pb-3">Complete Reservation</h1>
        <form action="/app/admin/reservationNew.php" method="post">
            <div class="row mb-4">
                <div class="col-sm-12 col-md-6">
                    <label for="vehicleId" class="h4">
                        Vehicle:
                    </label>
                    <select name="vehicleId" id="vehicle" class="form-select">
                        <option value="none">None</option>
                        <?php foreach ($avaiableVehicles as $vehicle) {
                            $vehicle->loadProperties();
                            $properties = $vehicle->getProperties();
                        ?>
                            <option value="<?php echo $vehicle->getId() ?>"><?php echo $properties['Model']->getPropertyValue() . ' ' . $properties['Brand']->getPropertyValue() . ' - ' . $vehicle->getPlate() ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-12 col-md-6">
                    <label for="statusId" class="h4">
                        Reservation status:
                    </label>
                    <select name="statusId" id="status" class="form-select">
                        <?php foreach ($statuses as $status) { ?>
                            <option value="<?php echo $status->getId() ?>"><?php echo $status->getStatusName() ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-6 col-12">
                    <h2 class="h4 mb-3">Effective Pick-up</h2>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="pickup-location">Pick-Up Location:</label>
                            <select id="pickup-location" name="pickupLocationId" class="form-select">
                                <option value="none">None</option>
                                <?php foreach ($effectiveLocations as $location) : ?>
                                    <option value="<?php echo $location->getId(); ?>">
                                        <?php echo $location->getName(); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="pickup-date">Pick-Up Date:</label>
                            <input type="date" id="pickup-date" name="pickupDate" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="pickup-time">Pick-Up Time:</label>
                            <input type="time" id="pickup-time" name="pickupTime" min="09:30" max="17:30" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <h2 class="h4 mb-3">Effective Drop-off</h2>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="dropoff-location">Drop-Off Location:</label>
                            <select id="dropoff-location" name="dropoffLocationId" class="form-select">
                                <option value="none">None</option>
                                <?php foreach ($effectiveLocations as $location) : ?>
                                    <option value="<?php echo $location->getId(); ?>">
                                        <?php echo $location->getName(); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="dropoff-date">Drop-Off Date:</label>
                            <input type="date" id="dropoff-date" name="dropoffDate" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="dropoff-time">Drop-Off Time:</label>
                            <input type="time" id="dropoff-time" name="dropoffTime" min="09:30:00" max="17:30:00" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" name="reservationNew" value="Update" class="btn btn-primary">
            </div>
        </form>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/footer.inc.php'; ?>
</body>

</html>