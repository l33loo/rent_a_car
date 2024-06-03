<fieldset class="mb-3">
    <legend>
        <img src="/src/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
        Payment
    </legend>
    <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['cc'])) { ?>
                <div class="text-danger">
                    <small>
                        <?php echo $_SESSION['errors']['cc'];
                        unset($_SESSION['errors']['cc']); ?>
                    </small>
                </div>
            <?php } ?>
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