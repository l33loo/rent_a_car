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
        echo 'No reservation id';
        exit;
    }

    $reservationId = $_GET['reservationId'];
    $reservation = Reservation::find($reservationId);
    $latestRevision = $reservation->findLatestRevision();
    $latestRevision->loadRelation('dropoffLocation', 'location');
    $latestRevision->loadRelation('status');
    $latestRevisionId = $latestRevision->getId();
    $latestRevisionDroppoffLocation = $latestRevision->getDropoffLocation();
    $latestRevisionDroppoffLocation->loadRelation('island');
    $effectiveLocations = Location::fetchActiveLocations($latestRevisionDroppoffLocation->getIsland()->getId());
    $statuses = Status::search([]);
    $avaiableVehicles = $latestRevision->findAvailableVehicles();
    $locations = Location::fetchActiveLocations();
    $categories = Category::search([]);
} catch(e) {
    // TODO: handle error
    exit;
}

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/navbar.inc.php'; ?>

    <div class="container pt-5">
        <h1 class="pt-5 pb-3">Admin Reservation Updates</h1>
        <div class="row bg-secondary-subtle py-3 my-4">
            <div class="col-sm-12 col-md border-end border-primary">
                <form action="/app/admin/revervationEdit.php" method="post">
                    <label for="statusId" class="h4">
                        1. Reservation status:
                    </label>
                    <select name="statusId" id="status" class="form-select">
                        <?php foreach ($statuses as $status) { ?>
                            <option
                                value="<?php echo $status->getId() ?>"
                                <?php echo $latestRevision->getStatus()->getId() === $status->getId() ? 'selected' : null ?>
                            >
                                <?php echo $status->getStatusName() ?>
                            </option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="reservationId" value="<?php echo $reservationId ?>">
                    <input class="btn btn-primary mt-3" type="submit" name="reservationEditStatus" value="Update Status">
                </form>
            </div>
            <div class="col-sm-12 col-md">
                <form action="/app/admin/revervationEdit.php" method="post">
                    <label for="vehicleId" class="h4">
                        2. Vehicle:
                    </label>
                    <select name="vehicleId" id="vehicle" class="form-select">
                        <option value="none">None</option>
                        <?php foreach ($avaiableVehicles as $vehicle) {
                            $vehicle->loadProperties();
                            $properties = $vehicle->getProperties();
                        ?>
                            <option
                                value="<?php echo $vehicle->getId() ?>"
                                <?php echo $vehicle->getId() === $latestRevision->getVehicle_id() ? 'selected' : null ?>
                            >
                                <?php echo $properties['Model']->getPropertyValue() . ' ' . $properties['Brand']->getPropertyValue() . ' - ' . $vehicle->getPlate() ?>
                            </option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="reservationId" value="<?php echo $reservationId ?>">
                    <input class="btn btn-primary mt-3" type="submit" name="reservationEditVehicle" value="Assign Vehicle">
                </form>
            </div>
        </div>
        <div class="row bg-secondary-subtle py-3 my-4">
            <div class="col-12">
                <h2 class="h4 mb-3">3. Effective Pick-up</h2>
            </div>
            <div class="col-12">
                <form action="/app/admin/revervationEdit.php" method="post">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <label for="pickupLocation">Pick-Up Location:</label>
                            <select id="pickupLocation" name="pickupLocationId" class="form-select">
                                <option value="none">None</option>
                                <?php foreach ($effectiveLocations as $location) : ?>
                                    <option value="<?php echo $location->getId(); ?>">
                                        <?php echo $location->getName(); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="pickupDate">Pick-Up Date:</label>
                            <input
                                type="date"
                                id="pickupDate"
                                name="pickupDate"
                                class="form-control"
                                required
                            >
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="pickupTime">Pick-Up Time:</label>
                            <input type="time" id="pickupTime" name="pickupTime" min="09:30" max="17:30" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <input type="hidden" name="reservationId" value="<?php echo $reservationId ?>">
                            <input class="btn btn-primary mt-3" type="submit" name="reservationEditPickup" value="Record Pickup">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row bg-secondary-subtle py-3 my-4">
            <div class="col-12">
                <h2 class="h4 mb-3">4. Effective Drop-Off</h2>
            </div>
            <div class="col-12">
                <form action="/app/admin/revervationEdit.php" method="post">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <label for="dropoffLocation">Drop-Off Location:</label>
                            <select id="dropoffLocation" name="dropoffLocationId" class="form-select">
                                <option value="none">None</option>
                                <?php foreach ($effectiveLocations as $location) : ?>
                                    <option value="<?php echo $location->getId(); ?>">
                                        <?php echo $location->getName(); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="dropoffDate">Drop-Off Date:</label>
                            <input type="date" id="dropoffDate" name="dropoffDate" class="form-control" required>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="dropoffTime">Drop-Off Time:</label>
                            <input type="time" id="dropoffTime" name="dropoffTime" min="09:30" max="17:30" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <input type="hidden" name="reservationId" value="<?php echo $reservationId ?>">
                            <input class="btn btn-primary mt-3" type="submit" name="reservationEditDropoff" value="Record Dropoff">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <h1 class="py-3">Edit Base Reservation</h1>
            <form action="/app/admin/reservationEdit.php" method="post">
                <div class="row mb-1">
                    <div class="col-md-6 col-12">
                        <h2 class="h4 mb-3">Pick-up</h2>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="pickupLocation">Pick-Up Location:</label>
                                <select id="pickupLocation" name="pickupLocationId" class="form-select">
                                    <?php foreach ($locations as $location) : ?>
                                        <option value="<?php echo $location->getId(); ?>">
                                            <?php echo $location->getName(); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="pickupDate">Pick-Up Date:</label>
                                <input type="date" id="pickupDate" name="pickupDate" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="pickupTime">Pick-Up Time:</label>
                                <input type="time" id="pickupTime" name="pickupTime" min="09:30" max="17:30" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <h2 class="h4 mb-3">Drop-off</h2>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="dropoffLocation">Drop-Off Location:</label>
                                <select id="dropoffLocation" name="dropoffLocationId" class="form-select">
                                    <?php foreach ($locations as $location) : ?>
                                        <option value="<?php echo $location->getId(); ?>">
                                            <?php echo $location->getName(); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="dropoffDate">Drop-Off Date:</label>
                                <input type="date" id="dropoffDate" name="dropoffDate" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="dropoffTime">Drop-Off Time:</label>
                                <input type="time" id="dropoffTime" name="dropoffTime" min="09:30:00" max="17:30:00" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm col-md-6">
                        <label for="categoryId">Vehicle category:</label>
                        <select name="categoryId" id="category" class="form-select">
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->getId() ?>"><?php echo $category->getName() ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <input type="hidden" name="latestRevisionId" value="<?php echo $latestRevisionId ?>">
                    <input type="submit" name="reservationEditRes" value="Edit Reservation" class="btn btn-primary">
                </div>
            </form>
            <form action="/app/admin/reservationEdit.php" method="post">
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/formCustomer.inc.php'; ?>
                <div class="d-flex justify-content-center">
                    <input type="hidden" name="latestRevisionId" value="<?php echo $latestRevisionId ?>">
                    <input type="submit" name="reservationEditCustomer" value="Edit Customer" class="btn btn-primary">
                </div>
            </form>
            <form action="/app/admin/reservationEdit.php" method="post">
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/formAddress.inc.php'; ?>
                <div class="d-flex justify-content-center">
                    <input type="hidden" name="latestRevisionId" value="<?php echo $latestRevisionId ?>">
                    <input type="submit" name="reservationEditAddress" value="Edit Address" class="btn btn-primary">
                </div>
            </form>
            <form action="/app/admin/reservationEdit.php" method="post">
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/formPayment.inc.php'; ?>
                <div class="d-flex justify-content-center">
                    <input type="hidden" name="latestRevisionId" value="<?php echo $latestRevisionId ?>">
                    <input type="submit" name="reservationEditPayment" value="Edit Payment" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/footer.inc.php'; ?>
</body>

</html>