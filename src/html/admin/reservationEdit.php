<?php  
require_once $_SERVER['DOCUMENT_ROOT'] . "/html/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Customer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Island.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Location.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Revisions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Status.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use RentACar\Customer;
use RentACar\Island;
use RentACar\Location;
use RentACar\Revisions;
use RentACar\Status;
use RentACar\User;

if (empty($_GET['id'])) {
    // TODO: error + redirect
    echo 'No reservation id';
    exit;
}

$latestRevisionId = $_GET['id'];
$latestRevision = Revision::rawSQL("
    SELECT * FROM revision
    WHERE reservation_id=$latestRevisionId
    ORDER BY submittedTimestamp DESC
    LIMIT 1;
");
$latestRevisionId = $latestRevision->getId();
$locations = Location::search([]);


echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/navbar.inc.php'; ?>

    <div class="container pt-5">
        <h1 class="pt-5 pb-3">Edit Reservation</h1>
        <form action="/app/admin/reservationEdit.php" method="post">
            <div class="row mb-1">
                <div class="col-md-6 col-12">
                    <h2 class="h4 mb-3">Pick-up</h2>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="pickup-location">Pick-Up Location:</label>
                            <select id="pickup-location" name="pickupLocationId" class="form-select">
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
                    <h2 class="h4 mb-3">Drop-off</h2>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="dropoff-location">Drop-Off Location:</label>
                            <select id="dropoff-location" name="dropoffLocationId" class="form-select">
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
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/footer.inc.php'; ?>
</body>

</html>