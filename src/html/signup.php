<?php 
require_once './components/header.php';

echo getHeader();

?>

<body>
    <?php include 'components/navbar.inc.php'; ?>
    <div class="container">
        <div class="text-content">
            <h1 class="text-center" style="margin-top: 100px;">Sign Up</h1>
        </div>
    </div>
    <form action="../app/signup.php" method="post">
        <div class="container mt-5  d-flex justify-content-center">
            <div class=" text-content">
                <img src="../img/profile.svg" alt="" style="height: 20px; width:20px; margin-bottom:10px;">
                <label for="name">
                    Name:
                </label>
                <input type="text" style="border: none; border-bottom: 2px solid;" name="name">
            </div>
        </div>
        <div class="container mt-4 d-flex justify-content-center" style="padding-right:15px;">
            <div class="text-content">
                <img src="../img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
                <label for="email">
                    Email:
                </label>
                <input type="email" style="border: none; border-bottom: 2px solid; width:210px" name="email">
            </div>
        </div>
        <div class="container mt-4  d-flex justify-content-center">
            <div class=" text-content">
                <img src="../img/password.svg" alt="" style="height: 20px; width:20px; margin-bottom:10px;">
                <label for="password">
                    Password:
                </label>
                <input type="password" style="border: none; border-bottom: 2px solid;" name="password">
            </div>
        </div>
        <div class="container mt-4 d-flex justify-content-center" style="padding-right:15px;">
            <div class="text-content">
                <img src="../img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
                <label for="dateOfBirth">
                    Birthdate:
                </label>
                <input type="date" style="border: none; border-bottom: 2px solid; width:210px" name="dateOfBirth">
            </div>
        </div>
        <div class="container mt-4 d-flex justify-content-center" style="padding-right:15px;">
            <div class="text-content">
                <img src="../img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
                <label for="address">
                    Address:
                </label>
                <input type="text" style="border: none; border-bottom: 2px solid; width:210px" name="address">
            </div>
        </div>
        <div class="container mt-4 d-flex justify-content-center" style="padding-right:15px;">
            <div class="text-content">
                <img src="../img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
                <label for="phone">
                    Phone:
                </label>
                <input type="text" style="border: none; border-bottom: 2px solid; width:210px" name="phone">
            </div>
        </div>
        <div class="container d-flex justify-content-center mt-4">
            <input
                type="submit"
                class="btn btn-outline-success"
                style="border-radius: 15px; width:100px"
                name="signup"
                value="Sign Up"
            />
        </div>
    </form>
    <?php include 'components/footer.inc.php'; ?>
    <script type="text/javascript">
    </script>
</body>

</html>