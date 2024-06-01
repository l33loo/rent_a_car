<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/inc/sessionGuest.inc.php';

use RentACar\User;

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

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>
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
                        <p class="card-text"><strong>Name: </strong><?php echo $user->getName(); ?></p>
                        <p class="card-text"><strong>Email: </strong><?php echo $user->getEmail(); ?></p>
                        <p class="card-text"><strong>Phone: </strong><?php echo $user->getPhone(); ?></p>
                        <p class="card-text"><strong>Date of Birth: </strong><?php echo $user->getDateOfBirth(); ?></p>
                        <p class="card-text"><strong>Street: </strong><?php echo $address; ?></p>
                        <hr>
                        <div class="d-flex flex-wrap">
                            <a href="/src/html/admin/userEdit.php?id=<?php echo $user->getId(); ?>" class="btn btn-primary">
                                Edit
                            </a>
                            <?php if ($user->getIsArchived()) { ?>
                                <form action="/src/app/admin/userEdit.php" method="POST">
                                    <input type="submit" name="unarchiveUser" class="btn btn-success" value="Unarchive" />
                                    <input type="hidden" name="userId" value="<?php echo $userId; ?>" />
                                </form>
                            <?php } else { ?>
                                <form action="/src/app/admin/userEdit.php" method="POST">
                                    <input type="submit" name="archiveUser" class="btn btn-danger" value="Archive" />
                                    <input type="hidden" name="userId" value="<?php echo $userId; ?>" />
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
</body>

</html>