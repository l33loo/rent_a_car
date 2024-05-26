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
            <input type="text" class="form-control" name="street">
        </div>
        <div class="col">
            <label for="door">Door</label>
            <input type="text" class="form-control" name="door">
        </div>
        <div class="col">
            <label for="apartment">Apartment</label>
            <input type="text" class="form-control" name="apartment">
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <label for="city">City</label>
            <input type="text" class="form-control" name="city">
        </div>
        <div class="col">
            <label for="district">District</label>
            <input type="text" class="form-control" name="district">
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <label for="postalCode">Postal Code</label>
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