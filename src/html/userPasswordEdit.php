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
$properties = get_object_vars($user);

echo getHeader();
?>

<body>
    <?php include 'components/navbar.inc.php'; ?>
    <div class="container">
        <h1 class="text-center" style="margin-top: 100px;">Edit Profile</h1>
        <form action="/app/signup.php" method="post">
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
    <?php include 'components/footer.inc.php'; ?>
    <script type="text/javascript">
    </script>
</body>

</html>