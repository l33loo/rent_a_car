<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/inc/countries.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use RentACar\User;

$userId;

if (!empty($_GET['id'])) {
    $userId = $_GET['id'];
} else {
    $userId = $_SESSION['logged_id'];
}

// TODO: try catch + error
$user = User::find($userId);
$user->loadRelation('address');
$address = $user->getAddress();
$address->loadRelation('country');

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/navbar.inc.php'; ?>
    <div class="container mt-5">
        <div class="row mt-5 mb-2">
            <div class="col">
                <div class="card mt-5 mb-4">
                    <div class="card-header">
                        <h1 class="text-center">Edit Profile</h1>
                    </div>
                    <div class="card-body">
                        <form action="/app/admin/userEdit.php" method="post">
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
                                <input type="hidden" name="userId" value="<?php echo $userId; ?>" />
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
                        <form action="/app/admin/userEdit.php" method="post">
                            <fieldset class="mb-3">
                                <legend class>
                                    <img src="/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
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
                                <input type="hidden" name="userId" value="<?php echo $userId; ?>" />
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
                        <h1 class="text-center">Edit Credentials</h1>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <div class="card m-1">
                                    <?php if ($user->getIsArchived()) { ?>
                                        <h2 class="card-header h5">The user is Archived:</h2>
                                        <form action="/app/admin/userEdit.php" method="POST" class="card-body">
                                            <input type="submit" name="unarchiveUser" class="btn btn-success" value="Unarchive" />
                                            <input type="hidden" name="userId" value="<?php echo $userId; ?>" />
                                        </form>
                                    <?php } else { ?>
                                        <h2 class="card-header h5">The user is Active:</h2>
                                        <form action="/app/admin/userEdit.php" method="POST" class="card-body">
                                            <input type="submit" name="archiveUser" class="btn btn-danger" value="Archive" />
                                            <input type="hidden" name="userId" value="<?php echo $userId; ?>" />
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card m-1">
                                    <?php if ($user->getIsAdmin()) { ?>
                                        <h2 class="card-header h5">The user is an Admin:</h2>
                                        <form action="/app/admin/userEdit.php" method="POST" class="card-body">
                                            <input type="submit" name="removeAdminPrivileges" class="btn btn-warning" value="Remove admin priviledges" />
                                            <input type="hidden" name="userId" value="<?php echo $userId; ?>" />
                                        </form>
                                    <?php } else { ?>
                                        <h2 class="card-header h5">The user is not an Admin:</h2>
                                        <form action="/app/admin/userEdit.php" method="POST" class="card-body">
                                            <input type="submit" name="grantAdminPrivileges" class="btn btn-danger" value="Grant admin priviledges" />
                                            <input type="hidden" name="userId" value="<?php echo $userId; ?>" />
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/footer.inc.php'; ?>
    <script type="text/javascript">
    </script>
</body>

</html>