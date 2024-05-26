<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/src/html/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Vehicle.php';

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
        <h1>3. Book</h1>
        <?php if (empty($_SESSION['logged_id'])) {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/reservationBookFormGuest.inc.php';
        } else {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/reservationBookForm.inc.php';
        } ?>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/footer.inc.php'; ?>
</body>

</html>