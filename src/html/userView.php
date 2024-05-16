<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/inc/sessionGuest.inc.php';

use RentACar\User;

$user = User::find($_SESSION['logged_id']);
$user->loadRelation('address');
$user->getAddress()->loadRelation('country');
$address = $user->getAddress();
$properties = get_object_vars($user);

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/navbar.inc.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h1 class="my-5">My Account</h1>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col">
                <div class="card mb-4">
                    <h2 class="card-header">Profile</h2>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $user->getName(); ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $user->getEmail(); ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Phone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $user->getPhone(); ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Date of Birth</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $user->getDateOfBirth(); ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <a href="userProfileEdit.php" class="btn btn-primary">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <h2 class="card-header">Address</h2>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Address</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $address->getAddressToString(); ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <a href="userAddressEdit.php" class="btn btn-primary">Edit Address</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <h2 class="card-header">Credentials</h2>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Password</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">**********</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <a href="userPasswordEdit.php" class="btn btn-primary">Edit Password</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/footer.inc.php'; ?>
</body>

</html>