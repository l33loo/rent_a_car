<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/inc/countries.inc.php';
?>

<fieldset class="mb-3">
    <legend>
        <img src="/src/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
        Address
    </legend>
    <div class="row mb-4">
        <div class="col-8">
            <label for="street">Street</label>
            <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['street'])) { ?>
                <div class="text-danger">
                    <small>
                        <?php echo $_SESSION['errors']['street'];
                        unset($_SESSION['errors']['street']); ?>
                    </small>
                </div>
            <?php } ?>
            <input type="text" class="form-control" name="street">
        </div>
        <div class="col">
            <label for="door">Door</label>
            <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['door'])) { ?>
                <div class="text-danger">
                    <small>
                        <?php echo $_SESSION['errors']['door'];
                        unset($_SESSION['errors']['door']); ?>
                    </small>
                </div>
            <?php } ?>
            <input type="text" class="form-control" name="door">
        </div>
        <div class="col">
            <label for="apartment">Apartment</label>
            <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['apartment'])) { ?>
                <div class="text-danger">
                    <small>
                        <?php echo $_SESSION['errors']['apartment'];
                        unset($_SESSION['errors']['apartment']); ?>
                    </small>
                </div>
            <?php } ?>
            <input type="text" class="form-control" name="apartment">
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <label for="city">City</label>
            <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['city'])) { ?>
                <div class="text-danger">
                    <small>
                        <?php echo $_SESSION['errors']['city'];
                        unset($_SESSION['errors']['city']); ?>
                    </small>
                </div>
            <?php } ?>
            <input type="text" class="form-control" name="city">
        </div>
        <div class="col">
            <label for="district">District</label>
            <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['district'])) { ?>
                <div class="text-danger">
                    <small>
                        <?php echo $_SESSION['errors']['district'];
                        unset($_SESSION['errors']['district']); ?>
                    </small>
                </div>
            <?php } ?>
            <input type="text" class="form-control" name="district">
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <label for="postalCode">Postal Code</label>
            <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['postalCode'])) { ?>
                <div class="text-danger">
                    <small>
                        <?php echo $_SESSION['errors']['postalCode'];
                        unset($_SESSION['errors']['postalCode']); ?>
                    </small>
                </div>
            <?php } ?>
            <input type="text" class="form-control" name="postalCode">
        </div>
        <div class="col">
            <label for="country">Country</label>
            <select class="form-select" name="countryId">
                <?php foreach($countries as $country) { ?>
                    <option value="<?php echo $country->getId(); ?>">
                        <?php echo $country->getName(); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>
</fieldset>