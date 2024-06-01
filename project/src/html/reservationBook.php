<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/src/html/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Category;
use RentACar\Vehicle;

session_start();

// if (empty($_SESSION['logged_id'])) {
//     header('Location: /src/html/reservationLoginOrGuest.php');
//     exit;
// }

// TODO: validate form fields

echo getHeader();
?>

<style>
.bg-image {
    position: relative;
    background-image: url(/src/img/homepage.jpg);
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
        <h1>3. Book</h1>
        <form action="/src/app/reservationBook.php" method="post">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/formCustomer.inc.php'; ?>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/formAddress.inc.php'; ?>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/formPayment.inc.php'; ?>
            <div class="d-flex justify-content-center">
                <input type="hidden" name="userId" value="<?php echo empty($_SESSION['logged_id']) ? null : $_SESSION['logged_id'] ?>">
                <input type="hidden" name="categoryId" value="<?php echo $_GET['categoryId'] ?>">
                <input type="hidden" name="vehicleId" value="<?php echo $_GET['vehicleId'] ?>">
                <input type="hidden" name="pickupLocationId" value="<?php echo $_GET['pickupLocationId'] ?>">
                <input type="hidden" name="pickupDate" value="<?php echo $_GET['pickupDate'] ?>">
                <input type="hidden" name="pickupTime" value="<?php echo $_GET['pickupTime'] ?>">
                <input type="hidden" name="dropoffLocationId" value="<?php echo $_GET['dropoffLocationId'] ?>">
                <input type="hidden" name="dropoffDate" value="<?php echo $_GET['dropoffDate'] ?>">
                <input type="hidden" name="dropoffTime" value="<?php echo $_GET['dropoffTime'] ?>">

                <input type="submit" value="Book Now" class="btn btn-success" name="reservationBook">
            </div>
        </form>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
</body>

</html>