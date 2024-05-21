<form action="" method="post">
    <div class="row mb-3">
        <div class="col">
            <img src="/img/profile.svg" alt="" style="height: 20px; width:20px; margin-bottom:10px;">
            <label for="name">
                Name:
            </label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="col">
            <img src="/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
            <label for="email">
                Email:
            </label>
            <input type="email" class="form-control" name="email">
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <img src="/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
            <label for="phone">
                Phone:
            </label>
            <input type="text" class="form-control" name="phone">
        </div>
        <div class="col">
            <img src="/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
            <label for="dateOfBirth">
                Birthdate:
            </label>
            <input type="date" class="form-control" name="dateOfBirth">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <img src="/img/password.svg" alt="" style="height: 20px; width:20px; margin-bottom:10px;">
            <label for="driversLicense">
                Driver's License:
            </label>
            <input type="text" class="form-control" name="driversLicense">
        </div>
        <div class="col">
            <img src="/img/password.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
            <label for="taxNumber">
                Tax Number (optional):
            </label>
            <input type="text" class="form-control" name="taxNumber">
        </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/formAddress.inc.php'; ?>
    <fieldset class="mb-3">
        <legend>
            <img src="/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
            Payment
        </legend>
        <div class="row mb-4">
            <div class="col-12 col-md-8">
                <label for="ccNumber">Credit Card Number</label>
                <input type="text" class="form-control" name="ccNumber">
            </div>
            <div class="col-12 col-md">
                <label for="ccExpiry">Expiry</label>
                <input type="date" class="form-control" name="ccExpiry">
            </div>
            <div class="col-12 col-md">
                <label for="ccCVV">CVV</label>
                <input type="text" class="form-control" name="ccCVV">
            </div>
        </div>
    </fieldset>
    <div class="d-flex justify-content-center">
        <input type="hidden" name="userId" value="<?php echo empty($_SESSION['logged_id']) ? null : $_SESSION['logged_id'] ?>">
        <input type="hidden" name="categoryId" value="<?php echo $_GET['categoryId'] ?>">
        <input type="hidden" name="pickupLocation" value="<?php echo $_GET['pickupLocation'] ?>">
        <input type="hidden" name="pickupDate" value="<?php echo $_GET['pickupDate'] ?>">
        <input type="hidden" name="pickupTime" value="<?php echo $_GET['pickupTime'] ?>">
        <input type="hidden" name="dropoffLocation" value="<?php echo $_GET['dropoffLocation'] ?>">
        <input type="hidden" name="dropoffDate" value="<?php echo $_GET['dropoffDate'] ?>">
        <input type="hidden" name="dropoffTime" value="<?php echo $_GET['dropoffTime'] ?>">
        <input type="submit" value="Book Now" class="btn btn-success" name="reservationBook">
    </div>
</form>