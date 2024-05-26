<?php  
require_once $_SERVER['DOCUMENT_ROOT'] . "/src/html/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/RentACar/Location.php";

use RentACar\Location;

session_start();

$locations = Location::fetchActiveLocations();

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
</style>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>
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
                    <h2>1. Pick-up</h2>
                    <div class="row">
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
                    <div class="row">
                        <div class="col">
                            <label for="pickup-date">Pick-Up Date:</label>
                            <input type="date" id="pickup-date" name="pickupDate" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="pickup-time">Pick-Up Time:</label>
                            <input type="time" id="pickup-time" name="pickupTime" min="09:30" max="17:30" class="form-control" required>
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
                            <input type="time" id="dropoff-time" name="dropoffTime" min="09:30:00" max="17:30:00" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>

    <div class="container">
        <h2 style="position:relative; top: -100px;">Our Fleet</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4" style="position: relative; top: -30px">
            <div class="col">
                <div class="card h-100" style="    filter: drop-shadow(16px 16px 20px);">
                    <img src="/img/car.jpg" class="card-img-top" alt="car">
                    <div class="card-body text-center" style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                        <h5 class="card-title">Regular</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut sapien
                            non
                            urna tincidunt consectetur. Nulla facilisi.</p>
                        <button type="button" class="btn btn-outline-dark"
                            style="border-radius: 15px;">Categories</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100" style="    filter: drop-shadow(20px 20px 20px);">
                    <img src="/img/moto.jpg" class="card-img-top" alt="moto">
                    <div class="card-body text-center" style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                        <h5 class="card-title">Motorcycle</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut sapien
                            non
                            urna tincidunt consectetur. Nulla facilisi.</p>
                        <button type="button" class="btn btn-outline-dark "
                            style="border-radius: 15px;">Categories</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100" style="    filter: drop-shadow(20px 20px 20px);">
                    <img src="/img/suv.jpg" class="card-img-top" alt="suv">
                    <div class="card-body text-center" style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                        <h5 class="card-title">Suv</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut sapien
                            non
                            urna tincidunt consectetur. Nulla facilisi.
                        </p>
                        <button type="button" class="btn btn-outline-dark"
                            style="border-radius: 15px;">Categories</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
</body>

</html>