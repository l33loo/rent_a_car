<form action="/app/reservationBook.php" method="post">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/formCustomer.inc.php'; ?>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/formAddress.inc.php'; ?>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/formPayment.inc.php'; ?>
    <div class="d-flex justify-content-center">
        <input type="hidden" name="userId" value="<?php echo empty($_SESSION['logged_id']) ? null : $_SESSION['logged_id'] ?>">
        <input type="hidden" name="categoryId" value="<?php echo $_GET['categoryId'] ?>">
        <input type="hidden" name="pickupLocationId" value="<?php echo $_GET['pickupLocationId'] ?>">
        <input type="hidden" name="pickupDate" value="<?php echo $_GET['pickupDate'] ?>">
        <input type="hidden" name="pickupTime" value="<?php echo $_GET['pickupTime'] ?>">
        <input type="hidden" name="dropoffLocationId" value="<?php echo $_GET['dropoffLocationId'] ?>">
        <input type="hidden" name="dropoffDate" value="<?php echo $_GET['dropoffDate'] ?>">
        <input type="hidden" name="dropoffTime" value="<?php echo $_GET['dropoffTime'] ?>">
        <input type="submit" value="Book Now" class="btn btn-success" name="reservationBook">
    </div>
</form>