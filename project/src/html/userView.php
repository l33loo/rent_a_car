<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/inc/sessionGuest.inc.php';
clearstatcache();
session_start();

use RentACar\User;

$user = User::find($_SESSION['logged_id']);
$user->loadRelation('address');
$user->getAddress()->loadRelation('country');
$address = $user->getAddress();

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h1 class="my-5">My Account</h1>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card mb-4">
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
                                <p class="mb-0">Address</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $address; ?></p>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-wrap">
            <a href="/src/html/userEdit.php" class="btn btn-primary">Edit Account</a>
            <a href="/src/html/reservations.php" class="btn btn-secondary">View Reservations</a>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
</body>

</html>