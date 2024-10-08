<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/src/html/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Category;
use RentACar\Vehicle;

session_start();

if (!empty($_SESSION['logged_id'])) {
    header('Location: /src/html/reservationBook.php');
    exit;
}

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
        <div class="d-flex flex-column align-items-center">
            <form action="/src/html/login.php" method="get">
                <input type="hidden" name="redirectTo" value="/src/html/reservationBook.php">
                <input type="submit" class="btn btn-warning" value="Already have an account">
            </form>
            <div>
                - OR -
            </div>
            <div>
                <a href="/src/html/reservationBook.php" class="btn btn-primary">Continue as Guest</a>
            </div>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
</body>

</html>