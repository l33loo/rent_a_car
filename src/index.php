<?php  
require_once $_SERVER['DOCUMENT_ROOT'] . "/html/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/RentACar/Location.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/html/reservationValidation.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Category.php';

use RentACar\Category;

echo getHeader();

$categories = Category::search([]);
$categories = array_slice($categories, 0, 4);

use RentACar\Location;

session_start();

$locations = Location::search([]);

echo getHeader();
?>

<style>
.bg-image {
    position: relative;
    background-image: url(/img/homepage.jpg);
    background-size: cover;
    background-position: center;
    height: 100vh;
    filter: drop-shadow(20px 20px 20px);
}

.gradient-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3));
}

.text-content {
    position: absolute;
    color: white;
}

.container-wrapper {
    max-width: 100%;
    overflow: hidden;
    margin-left: auto;
    margin-right: auto;
}

form {
    width: 300px;
    margin: 0 auto;
}

label {
    display: block;
    margin: 10px 0 5px;
}

input,
select {
    width: 100%;
    padding: 8px;
    margin: 5px 0;
}
</style>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/navbar.inc.php'; ?>
    <div class="bg-image" style="position: relative;">
        <div class="gradient-overlay"></div>
        <div class="container">
            <div class="text-content">
                <h1 style="padding-top: 150px;">Drive with Ease <br> Rent with Confidence</h1>
            </div>
        </div>
    </div>

    <div class="container my-5 w-50"
        style="position: relative; top: -250px; background-color: rgba(189, 195, 199, 0.8); padding: 15px;border-radius: 15px;">
        <h1>Reservation</h1>
        <form action="/html/reservationSelectVehicle.php" method="get">
            <div class="row">
                <div class="col-md-6 col-12">
                    <h2>Pick-up</h2>
                    <div class="row">
                        <div class="col">
                            <label for="pickup-location">1. Pick-Up Location:</label>
                            <select id="pickup-location" name="pickupLocationId" class="form-select">
                                <?php foreach ($locations as $location) : ?>
                                <option value="<?php echo $location->getId(); ?>">
                                    <?php echo $location->getName(); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="pickup-date">Pick-Up Date:</label>
                            <input type="date" id="pickup-date" name="pickupDate" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="pickup-time">Pick-Up Time:</label>
                            <input type="time" id="pickup-time" name="pickupTime" min="09:30" max="17:30"
                                class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <h2>Drop-off</h2>
                    <div class="row">
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
                    <div class="row">
                        <div class="col">
                            <label for="dropoff-date">Drop-Off Date:</label>
                            <input type="date" id="dropoff-date" name="dropoffDate" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="dropoff-time">Drop-Off Time:</label>
                            <input type="time" id="dropoff-time" name="dropoffTime" min="09:30:00" max="17:30:00"
                                class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>

    <div class="container">
        <h2 style="position:relative; top: -80px;">Our Fleet</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4" style="position: relative; top: -30px;">
            <?php foreach ($categories as $category): ?>
            <div class="col">
                <div class="card h-100">
                    <img src="/img/<?php echo ($category->getName()); ?>.jpg" class="card-img-top"
                        alt="<?php echo ($category->getName()); ?>">
                    <div class="card-info">
                        <h5><?php echo ($category->getName()); ?></h5>
                        <p><?php echo ($category->getDescription()); ?></p>
                        <p>Daily Rate: <?php echo number_format($category->getDailyRate(), 2); ?> €</p>
                        <a href="/html/fleet.php" class="btn btn-primary">Other Categories</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/footer.inc.php'; ?>
</body>

</html>