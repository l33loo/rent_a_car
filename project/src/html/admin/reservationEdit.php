<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/src/html/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

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
    $latestRevision->loadPickupLocation();
    $latestRevision->loadDropoffLocation();
    $latestRevision->loadStatus();
    $latestRevision->loadEffectivePickupLocation();
    $latestRevision->loadEffectiveDropoffLocation();
    $latestRevisionId = $latestRevision->getId();
    $latestRevisionPickupLocation = $latestRevision->getPickupLocation();
    $latestRevisionDroppoffLocation = $latestRevision->getDropoffLocation();
    $latestRevisionDroppoffLocation->loadRelation('island');
    $effectiveLocations = Location::fetchActiveLocations($latestRevisionDroppoffLocation->getIsland()->getId());
    $statuses = Status::search([]);
    $availableVehicles = $latestRevision->findAvailableVehicles();
    $locations = Location::fetchActiveLocations();
    $categories = Category::search([]);
    $disabledFromPickup = $latestRevision->getEffectivePickupLocation() !== null;
    $disabledFromDropoff = $latestRevision->getEffectiveDropoffLocation() !== null;
} catch(e) {
    // TODO: handle error
    exit;
}

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>

    <div class="container pt-5">
        <h1 class="pt-5 pb-3">Admin Reservation Updates</h1>
        <div class="row bg-secondary-subtle py-3 my-4">
            <div class="col-sm-12 col-md border-end border-primary">
                <form action="/src/app/admin/reservationEdit.php" method="post">
                    <label for="statusId" class="h4">
                        1. Reservation Status:
                    </label>
                    <select name="statusId" id="status" class="form-select" <?php echo $disabledFromPickup ? 'disabled' : null ?>>
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
                    <input class="btn btn-primary mt-3" type="submit" name="reservationEditStatus" value="Update Status" <?php echo $disabledFromPickup ? 'disabled' : null ?>>
                </form>
            </div>
            <div class="col-sm-12 col-md">
                <form action="/src/app/admin/reservationEdit.php" method="post">
                    <label for="vehicleId" class="h4">
                        2. Vehicle:
                    </label>
                    <select name="vehicleId" id="vehicleId" class="form-select" <?php echo $disabledFromPickup ? 'disabled' : null ?>>
                        <option value="none">None</option>
                        <?php if ($latestRevision->getVehicle_id() !== null) {
                            $latestRevision->loadVehicle();
                            $revisionVehicle = $latestRevision->getVehicle();
                            $revisionVehicle->loadProperties();
                            $revisionVehicleProperties = $revisionVehicle->getProperties();
                        ?>
                            <option
                                value="<?php echo $revisionVehicle->getId() ?>"
                                selected
                            >
                                <?php echo $revisionVehicleProperties['Model']->getPropertyValue() . ' ' . $revisionVehicleProperties['Brand']->getPropertyValue() . ' - ' . $revisionVehicle->getPlate() ?>
                            </option>
                        <?php } ?>
                        <?php foreach ($availableVehicles as $vehicle) {
                            $vehicle->loadProperties();
                            $properties = $vehicle->getProperties();
                        ?>
                            <option value="<?php echo $vehicle->getId() ?>">
                                <?php echo $properties['Model']->getPropertyValue() . ' ' . $properties['Brand']->getPropertyValue() . ' - ' . $vehicle->getPlate() ?>
                            </option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="reservationId" value="<?php echo $reservationId ?>">
                    <input class="btn btn-primary mt-3" type="submit" name="reservationEditVehicle" value="Assign Vehicle" <?php echo $disabledFromPickup ? 'disabled' : null ?>>
                </form>
            </div>
        </div>
        <div class="row bg-secondary-subtle py-3 my-4">
            <div class="col-12">
                <h2 class="h4 mb-3">3. Effective Pick-up</h2>
            </div>
            <div class="col-12">
                <form action="/src/app/admin/reservationEdit.php" method="post">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <label for="pickupLocationId">Pick-Up Location:</label>
                            <select
                                id="pickupLocationId"
                                name="pickupLocationId"
                                class="form-select"
                                <?php echo $disabledFromPickup ? 'disabled' : null ?>
                            >
                                <option value="none">None</option>
                                <?php foreach ($effectiveLocations as $location) : ?>
                                    <option
                                        value="<?php echo $location->getId(); ?>"
                                        <?php echo $location->getId() === $latestRevisionPickupLocation->getId() ? 'selected' : null ?> 
                                    >
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
                                value="<?php echo date('Y-m-d', time()) ?>"
                                <?php echo $disabledFromPickup ? 'disabled' : null ?>  
                            >
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="pickupTime">Pick-Up Time:</label>
                            <input
                                type="time"
                                id="pickupTime"
                                name="pickupTime"
                                class="form-control"
                                value="<?php echo date('H:i:s', time()) ?>"
                                <?php echo $disabledFromPickup ? 'disabled' : null ?>
                            >
                        </div>
                        <div class="col-12">
                            <input
                                type="hidden"
                                name="reservationId"
                                value="<?php echo $reservationId ?>"
                                <?php echo $disabledFromPickup ? 'disabled' : null ?>
                            >
                            <input
                                class="btn btn-primary mt-3"
                                type="submit"
                                name="reservationEditEffectivePickup"
                                value="Record Pickup"
                                <?php echo $disabledFromPickup ? 'disabled' : null ?>
                            >
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
                <form action="/src/app/admin/reservationEdit.php" method="post">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <label for="dropoffLocation">Drop-Off Location:</label>
                            <select id="dropoffLocation" name="dropoffLocationId" class="form-select" <?php echo $disabledFromDropoff ?>>
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
                            <input type="date" id="dropoffDate" name="dropoffDate" class="form-control" <?php echo $disabledFromDropoff ?>>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="dropoffTime">Drop-Off Time:</label>
                            <input type="time" id="dropoffTime" name="dropoffTime" min="09:30" max="17:30" class="form-control" <?php echo $disabledFromDropoff ?>>
                        </div>
                        <div class="col-12">
                            <input type="hidden" name="reservationId" value="<?php echo $reservationId ?>">
                            <input class="btn btn-primary mt-3" type="submit" name="reservationEditEffectiveDropoff" value="Record Dropoff" <?php echo $disabledFromDropoff ?>>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <h1 class="py-3">Edit Base Reservation</h1>
            <form action="/src/app/admin/reservationEdit.php" method="post">
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
                                <input type="date" id="pickupDate" name="pickupDate" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="pickupTime">Pick-Up Time:</label>
                                <input type="time" id="pickupTime" name="pickupTime" min="09:30" max="17:30" class="form-control">
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
                                <input type="date" id="dropoffDate" name="dropoffDate" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="dropoffTime">Drop-Off Time:</label>
                                <input type="time" id="dropoffTime" name="dropoffTime" min="09:30:00" max="17:30:00" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm col-md-6">
                        <label for="categoryId">Vehicle category:</label>
                        <select name="categoryId" id="category" class="form-select" disabled="<?php echo $disabledFromPickup ?>">
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
            <form action="/src/app/admin/reservationEdit.php" method="post">
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/formCustomer.inc.php'; ?>
                <div class="d-flex justify-content-center">
                    <input type="hidden" name="latestRevisionId" value="<?php echo $latestRevisionId ?>">
                    <input type="submit" name="reservationEditCustomer" value="Edit Customer" class="btn btn-primary">
                </div>
            </form>
            <form action="/src/app/admin/reservationEdit.php" method="post">
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/formAddress.inc.php'; ?>
                <div class="d-flex justify-content-center">
                    <input type="hidden" name="latestRevisionId" value="<?php echo $latestRevisionId ?>">
                    <input type="submit" name="reservationEditAddress" value="Edit Address" class="btn btn-primary">
                </div>
            </form>
            <form action="/src/app/admin/reservationEdit.php" method="post">
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/formPayment.inc.php'; ?>
                <div class="d-flex justify-content-center">
                    <input type="hidden" name="latestRevisionId" value="<?php echo $latestRevisionId ?>">
                    <input type="submit" name="reservationEditPayment" value="Edit Payment" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
</body>

</html>