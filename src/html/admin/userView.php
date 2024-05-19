<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/inc/sessionGuest.inc.php';

use RentACar\User;

echo getHeader();

if (!isset($_GET['id'])) {
    echo "<p>User ID not provided.</p>";
    exit;
}

$userId = $_GET['id'];
$user = User::find($userId);

if (!$user) {
    echo "<p>User not found.</p>";
    exit;
}

$user->loadRelation('address');
$user->getAddress()->loadRelation('country');
$address = $user->getAddress();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/navbar.inc.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h1 class="my-5">User Details</h1>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">User Details</h5>
                        <p class="card-text"><strong>Name: </strong><?php echo $user->getName(); ?></p>
                        <p class="card-text"><strong>Email: </strong><?php echo $user->getEmail(); ?></p>
                        <p class="card-text"><strong>Phone: </strong><?php echo $user->getPhone(); ?></p>
                        <p class="card-text"><strong>Date of Birth: </strong><?php echo $user->getDateOfBirth(); ?></p>
                        <hr>
                        <h5 class="card-title">User Address</h5>
                        <p class="card-text"><strong>Street: </strong><?php echo $address->getStreet(); ?></p>
                        <p class="card-text"><strong>Door Number: </strong><?php echo $address->getDoorNumber(); ?></p>
                        <p class="card-text"><strong>Apartment Number:
                            </strong><?php echo $address->getApartmentNr(); ?></p>
                        <p class="card-text"><strong>City: </strong><?php echo $address->getCity(); ?></p>
                        <p class="card-text"><strong>District: </strong><?php echo $address->getDistrict(); ?></p>
                        <p class="card-text"><strong>Postal Code: </strong><?php echo $address->getPostalCode(); ?></p>
                        <p class="card-text"><strong>Country: </strong><?php echo $address->getCountry()->getName(); ?>
                        </p>
                        <a href="editUser.php?id=<?php echo $user->getId(); ?>" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/footer.inc.php'; ?>
</body>

</html>