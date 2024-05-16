<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/inc/countries.inc.php';

session_start();

if (isset($_SESSION['logged_id']) && $_SESSION['logged_id'] === true) {
    header('Location: /index.php');
    exit;
}

echo getHeader();
?>

<body>
    <?php include 'components/navbar.inc.php'; ?>
    <div class="container">
        <h1 class="text-center" style="margin-top: 100px;">Sign Up</h1>
        <form action="/app/signup.php" method="post">
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
            <div class="row mb-3">
                <div class="col">
                    <img src="/img/password.svg" alt="" style="height: 20px; width:20px; margin-bottom:10px;">
                    <label for="password">
                        Password:
                    </label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="col">
                    <img src="/img/password.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
                    <label for="confirmPassword">
                        Confirm password:
                    </label>
                    <input type="password" class="form-control" name="confirmPassword">
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
            
            <!-- 
                protected string $city;form-group 
                protected string $district;
                protected string $postalCode;
                protected Country $country; -->
            <fieldset class="mb-3">
                <legend class>
                    <img src="../img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
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
                        <!-- TODO: make dynamic select -->
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
                        <select class="form-control" name="countryId">
                            <?php foreach($countries as $country) { ?>
                                <option value="<?php echo $country->getId(); ?>">
                                    <?php echo $country->getName(); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </fieldset>
            <div class="d-flex justify-content-center">
                <input
                    type="submit"
                    class="btn btn-outline-success"
                    name="signup"
                    value="Sign Up"
                />
            </div>
        </form>
    </div>
    <?php include 'components/footer.inc.php'; ?>
    <script type="text/javascript">
    </script>
</body>

</html>