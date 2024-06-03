<fieldset>
    <Legend>
        <img src="/src/img/profile.svg" alt="" style="height: 20px; width:20px; margin-bottom:10px;">
        Customer
    </Legend>
    <div class="row mb-3">
        <div class="col">
            <img src="/src/img/profile.svg" alt="" style="height: 20px; width:20px; margin-bottom:10px;">
            <label for="name">
                Name:
            </label>
            <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['name'])) { ?>
                <div class="text-danger">
                    <small>
                        <?php echo $_SESSION['errors']['name'];
                        unset($_SESSION['errors']['name']); ?>
                    </small>
                </div>
            <?php } ?>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="col">
            <img src="/src/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
            <label for="email">
                Email:
            </label>
            <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['email'])) { ?>
                <div class="text-danger">
                    <small>
                        <?php echo $_SESSION['errors']['email'];
                        unset($_SESSION['errors']['email']); ?>
                    </small>
                </div>
            <?php } ?>
            <input type="email" class="form-control" name="email">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <img src="/src/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
            <label for="phone">
                Phone:
            </label>
            <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['phone'])) { ?>
                <div class="text-danger">
                    <small>
                        <?php echo $_SESSION['errors']['phone'];
                        unset($_SESSION['errors']['phone']); ?>
                    </small>
                </div>
            <?php } ?>
            <input type="text" class="form-control" name="phone">
        </div>
        <div class="col">
            <img src="/src/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
            <label for="dateOfBirth">
                Birthdate:
            </label>
            <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['dateOfBirth'])) { ?>
                <div class="text-danger">
                    <small>
                        <?php echo $_SESSION['errors']['dateOfBirth'];
                        unset($_SESSION['errors']['dateOfBirth']); ?>
                    </small>
                </div>
            <?php } ?>
            <input type="date" class="form-control" name="dateOfBirth">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <img src="/src/img/password.svg" alt="" style="height: 20px; width:20px; margin-bottom:10px;">
            <label for="driversLicense">
                Driver's License:
            </label>
            <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['driversLicense'])) { ?>
                <div class="text-danger">
                    <small>
                        <?php echo $_SESSION['errors']['driversLicense'];
                        unset($_SESSION['errors']['driversLicense']); ?>
                    </small>
                </div>
            <?php } ?>
            <input type="text" class="form-control" name="driversLicense">
        </div>
        <div class="col">
            <img src="/src/img/password.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
            <label for="taxNumber">
                Tax Number (optional):
            </label>
            <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['taxNumber'])) { ?>
                <div class="text-danger">
                    <small>
                        <?php echo $_SESSION['errors']['taxNumber'];
                        unset($_SESSION['errors']['taxNumber']); ?>
                    </small>
                </div>
            <?php } ?>
            <input type="text" class="form-control" name="taxNumber">
        </div>
    </div>
</fieldset>