<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Address.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Country.php';
clearstatcache();
session_start();

use RentACar\User;
use RentACar\Address;
use RentACar\Country;

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/navbar.inc.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h1 class="my-5">Registered Users</h1>
            </div>
        </div>
        <!-- Search Form -->
        <div class="row mb-4">
            <div class="col">
                <form action="" method="GET" class="form-inline">
                    <div class="form-group">
                        <label for="email" class="mr-2">Search by Email:</label>
                        <input type="text" name="email" id="email" class="form-control mr-2">
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card-deck">
                    <?php 
                    // Verifica se foi enviada uma solicitação de pesquisa por email
                    if (isset($_GET['email'])) {
                        $email = $_GET['email'];
                        $users = User::search(['column' => 'email', 'operator' => '=', 'value' => $email]);
                    } else {
                        $users = User::search([]);
                    }

                    foreach ($users as $user) {
                        // Load user's address and country
                        $user->loadRelation('address'); 
                        $user->getAddress()->loadRelation('country');
                        $address = $user->getAddress();
                        ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <!-- User Details -->
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/footer.inc.php'; ?>
</body>

</html>