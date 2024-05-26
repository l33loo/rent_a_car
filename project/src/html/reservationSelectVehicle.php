<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/src/html/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Category;
use RentACar\Vehicle;

session_start();

// TODO: validate form fields

try {
    // TODO: Validate that pick-up and drop-off locations are on the same island

    $categories = Category::search([]);
    $vehiclesWithCategory = [];
    $categoriesById = [];

    foreach ($categories as $category) {
        $category->loadProperties();
        $categoryId = $category->getId();
        $vehicles = Vehicle::search([], '', 2);
        $categoriesById[$categoryId] = $category;

        foreach ($vehicles as $vehicle) {
            $vehicle->loadProperties();
            $vehiclesWithCategory[] = [
                'vehicle' => $vehicle,
                'categoryId' => $categoryId
            ];
        }
    }
} catch(e) {
    // TODO: handle errors
}

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
        <h1>2. Select a car</h1>
        <?php foreach ($vehiclesWithCategory as $vehicleWithCategory) {
            $vehicle = $vehicleWithCategory['vehicle'];
            $vehicleProperties = $vehicle->getProperties();
            $category = $categoriesById[$vehicleWithCategory['categoryId']];
            $categoryProperties = $category->getProperties();
        ?>
            <div class="row mb-3">
                <div class="col">
                    <img src="/src/img/car.jpg" alt="">
                </div>
                <div class="col">
                    <h2>
                        <?php echo $vehicleProperties['Brand']->getPropertyValue() . ' ' . $vehicleProperties['Model']->getPropertyValue() ?>
                    </h2>
                    <div>
                        Or similar <?php echo $category->getName() ?> car
                    </div>
                    <div class="row">
                        <?php foreach ($categoryProperties as $categoryProperty) { ?>
                            <div class="col-6">
                                <?php echo $categoryProperty->getName() . ': ' . $categoryProperty->getPropertyValue() ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="h3">
                        <?php echo $category->getDailyRate() ?> Euros <small>per day</small>
                    </div>
                    <form action="/src/html/reservationBook.php" method="get">
                        <input type="hidden" name="categoryId" value="<?php echo $categoryId ?>">
                        <input type="hidden" name="pickupLocationId" value="<?php echo $_GET['pickupLocationId'] ?>">
                        <input type="hidden" name="pickupDate" value="<?php echo $_GET['pickupDate'] ?>">
                        <input type="hidden" name="pickupTime" value="<?php echo $_GET['pickupTime'] ?>">
                        <input type="hidden" name="dropoffLocationId" value="<?php echo $_GET['dropoffLocationId'] ?>">
                        <input type="hidden" name="dropoffDate" value="<?php echo $_GET['dropoffDate'] ?>">
                        <input type="hidden" name="dropoffTime" value="<?php echo $_GET['dropoffTime'] ?>">
                        <input type="submit" value="Book Now" class="btn btn-success" name="reservationSelectVehicle">
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
</body>

</html>

