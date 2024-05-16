<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/inc/countries.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/inc/sessionGuest.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use RentACar\User;

$user = User::find($_SESSION['logged_id']);

echo getHeader();
?>

<body>
    <?php include 'components/navbar.inc.php'; ?>
    <div class="container">
        <h1 class="text-center mb-5" style="margin-top: 100px;">Edit Profile</h1>
        <form action="/app/signup.php" method="post">
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
                    name="userProfileEdit"
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