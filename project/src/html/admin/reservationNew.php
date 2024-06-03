<?php  
require_once $_SERVER['DOCUMENT_ROOT'] . "/src/html/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Category;
use RentACar\Customer;
use RentACar\Island;
use RentACar\Location;
use RentACar\Revision;
use RentACar\Status;
use RentACar\User;

try {
    $locations = Location::fetchActiveLocations();
    $statuses = Status::search([]);
    $categories = Category::search([]);
} catch(e) {

}

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>

    <div class="container pt-5">
        <h1 class="pt-5 pb-3">New Reservation</h1>
        <form action="/src/app/admin/reservationNew.php" method="post">
            <div class="row mb-1">
                <div class="col-md-6 col-12">
                    <h2 class="h4 mb-3">Pick-up</h2>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="pickup-location">Pick-Up Location:</label>
                            <select id="pickup-location" name="pickupLocation_id" class="form-select">
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
                            <select id="dropoff-location" name="dropoffLocation_id" class="form-select">
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
            <div class="row mb-3">
                <div class="col">
                    <label for="statusId">Reservation status:</label>
                    <select name="statusId" id="status" class="form-select">
                        <?php foreach ($statuses as $status) { ?>
                            <option value="<?php echo $status->getId() ?>"><?php echo $status->getStatusName() ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col">
                    <label for="categoryId">Vehicle category:</label>
                    <select name="categoryId" id="category" class="form-select">
                        <?php foreach ($categories as $category) { ?>
                            <option value="<?php echo $category->getId() ?>"><?php echo $category->getName() ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/formCustomer.inc.php'; ?>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/formAddress.inc.php'; ?>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/formPayment.inc.php'; ?>
            <div class="d-flex justify-content-center">
                <input type="submit" name="reservationNew" value="Reserve" class="btn btn-primary">
            </div>
        </form>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
</body>

</html>