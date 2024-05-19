<?php  
require_once $_SERVER['DOCUMENT_ROOT'] . "/html/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/RentACar/Location.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/html/reservationValidation.php";

use RentACar\Location;

session_start();
echo getHeader();

$locations = Location::search([]);

?>

<style>
.bg-image {
    position: relative;
    background-image: url(./img/homepage.jpg);
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
    <?php include 'html/components/navbar.inc.php'; ?>
    <div class="bg-image" style="position: relative;">
        <div class="gradient-overlay"></div>
        <div class="container">
            <div class="text-content">
                <h1 style="padding-top: 150px;">Drive with Ease <br> Rent with Confidence</h1>
            </div>
        </div>
    </div>

    <form action="reservationValidation.php" method="post" style="padding:140px 0;" class="container">
        <h2 style="padding-bottom: 50px;">Reservation</h2>
        <label for="pickup-location">Pick-Up Location:</label>
        <select id="pickup-location" name="pickup_location">
            <?php foreach ($locations as $location) : ?>
            <option value="<?php echo $location->getId(); ?>"><?php echo $location->getName(); ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="dropoff-location">Drop-Off Location:</label>
        <select id="dropoff-location" name="dropoff_location">
            <?php foreach ($locations as $location) : ?>
            <option value="<?php echo $location->getId(); ?>"><?php echo $location->getName(); ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="pickup-date">Pick-Up Date:</label>
        <input type="date" id="pickup-date" name="pickup_date" required>
        <br>

        <label for="dropoff-date">Drop-Off Date:</label>
        <input type="date" id="dropoff-date" name="dropoff_date" required>
        <br>

        <label for="pickup-time">Pick-Up Time:</label>
        <input type="time" id="pickup-time" name="pickup_time" min="09:30" max="17:30" required>
        <br>

        <label for="dropoff-time">Drop-Off Time:</label>
        <input type="time" id="dropoff-time" name="dropoff_time" min="09:30:00" max="17:30:00" required>
        <br>

        <input type="submit" value="Submit">
    </form>

    <div class="container">
        <h2 style="position:relative; top: -100px;">Our Fleet</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4" style="position: relative; top: -30px">
            <div class="col">
                <div class="card h-100" style="    filter: drop-shadow(16px 16px 20px);">
                    <img src="./img/car.jpg" class="card-img-top" alt="car">
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
                    <img src="./img/moto.jpg" class="card-img-top" alt="moto">
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
                    <img src="./img/suv.jpg" class="card-img-top" alt="suv">
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

    <?php include 'html/components/footer.inc.php'; ?>
</body>

</html>