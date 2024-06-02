<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/src/html/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/inc/reservation.inc.php';

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
        <?php $errorMsg = (empty($_SESSION['errors']) || empty($_SESSION['errors']['userReservationBookingPage'])) ? null : $_SESSION['errors']['userReservationBookingPage'];
        if ($errorMsg !== null) { ?>
            <div class="alert alert-danger">
                <?php echo $errorMsg;
                unset($_SESSION['errors']['userReservationBookingPage']); ?>
            </div>
        <?php } ?>
        <form action="/src/app/reservationBook.php" method="post">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/formCustomer.inc.php'; ?>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/formAddress.inc.php'; ?>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/formPayment.inc.php'; ?>
            <div class="d-flex justify-content-center">
                <input type="submit" value="Book Now" class="btn btn-success" name="reservationBook">
            </div>
        </form>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
</body>

</html>