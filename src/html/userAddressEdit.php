<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/inc/countries.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/inc/sessionGuest.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use RentACar\User;

$user = User::find($_SESSION['logged_id']);
$user->loadRelation('address');
$user->getAddress()->loadRelation('country');
$address = $user->getAddress();

echo getHeader();
?>

<body>
    <?php include 'components/navbar.inc.php'; ?>
    <div class="container">
        <h1 class="text-center mb-3" style="margin-top: 100px;">Edit Address</h1>
        <form action="/app/userAddressEdit.php" method="post">
            <fieldset class="mb-3">
                <legend class>
                    <img src="../img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
                    Address
                </legend>
                <div class="row mb-4">
                    <div class="col-8">
                        <label for="street">Street</label>
                        <input type="text" class="form-control" name="street" value=<?php echo $address->getStreet(); ?>>
                    </div>
                    <div class="col">
                        <label for="door">Door</label>
                        <input type="text" class="form-control" name="door" value=<?php echo $address->getDoorNumber(); ?>>
                    </div>
                    <div class="col">
                        <label for="apartment">Apartment</label>
                        <input type="text" class="form-control" name="apartment" value=<?php echo $address->getApartmentNr(); ?>>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <label for="city">City</label>
                        <input type="text" class="form-control" name="city" value=<?php echo $address->getCity(); ?>>
                    </div>
                    <div class="col">
                        <label for="district">District</label>
                        <input type="text" class="form-control" name="district" value=<?php echo $address->getDistrict(); ?>>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <label for="postalCode">Postal Code</label>
                        <input type="text" class="form-control" name="postalCode" value=<?php echo $address->getPostalCode(); ?>>
                    </div>
                    <div class="col">
                        <label for="country">Country</label>
                        <select class="form-control" name="countryId" value=<?php echo $address->getCountry()->getId(); ?>>
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
                    class="btn btn-primary"
                    name="userAddressEdit"
                    value="Edit Profile"
                />
            </div>
        </form>
    </div>
    <?php include 'components/footer.inc.php'; ?>
    <script type="text/javascript">
    </script>
</body>

</html>