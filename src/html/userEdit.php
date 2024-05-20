<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/inc/countries.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/inc/sessionGuest.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';
clearstatcache();
use RentACar\User;

$user = User::find($_SESSION['logged_id']);
$user->loadRelation('address');
$user->getAddress()->loadRelation('country');
$address = $user->getAddress();

echo getHeader();
?>

<body>
    <?php include 'components/navbar.inc.php'; ?>
    <div class="container mt-5">
        <div class="row mt-5 mb-2">
            <div class="col">
                <div class="card mt-5 mb-4">
                    <div class="card-header">
                        <h1 class="text-center">Edit Profile</h1>
                    </div>
                    <div class="card-body">
                        <form action="/app/userEdit.php" method="post">
                            <div class="row mb-3">
                                <div class="col">
                                    <img src="/img/profile.svg" alt="" style="height: 20px; width:20px; margin-bottom:10px;">
                                    <label for="name">
                                        Name:
                                    </label>
                                    <input type="text" class="form-control" name="name" value=<?php echo $user->getName(); ?>>
                                </div>
                                <div class="col">
                                    <img src="/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
                                    <label for="email">
                                        Email:
                                    </label>
                                    <input type="email" class="form-control" name="email"  value=<?php echo $user->getEmail(); ?>>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <img src="/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
                                    <label for="phone">
                                        Phone:
                                    </label>
                                    <input type="text" class="form-control" name="phone" value=<?php echo $user->getPhone(); ?>>
                                </div>
                                <div class="col">
                                    <img src="/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
                                    <label for="dateOfBirth">
                                        Birth date:
                                    </label>
                                    <input type="date" class="form-control" name="dateOfBirth" value=<?php echo $user->getDateOfBirth(); ?>>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <input
                                    type="submit"
                                    class="btn btn-primary"
                                    name="userEditProfile"
                                    value="Edit Profile"
                                />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col">
                <div class="card mt-2 mb-4">
                    <div class="card-header">
                        <h1 class="text-center">Edit Address</h1>
                    </div>
                    <div class="card-body">
                        <form action="/app/userEdit.php" method="post">
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
                                        <select class="form-select" name="countryId" value=<?php echo $address->getCountry()->getId(); ?>>
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
                                    name="userEditAddress"
                                    value="Edit Address"
                                />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-2">
            <div class="col">
                <div class="card mt-2 mb-4">
                    <div class="card-header">
                        <h1 class="text-center">Edit Password</h1>
                    </div>
                    <div class="card-body">
                        <form action="/app/userEdit.php" method="post">
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
                            <div class="d-flex justify-content-center">
                                <input
                                    type="submit"
                                    class="btn btn-primary"
                                    name="userEditPassword"
                                    value="Edit Password"
                                />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'components/footer.inc.php'; ?>
    <script type="text/javascript">
    </script>
</body>

</html>