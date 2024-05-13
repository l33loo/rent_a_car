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
    <form>
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
                <input type="password" style="border: none; border-bottom: 2px solid;" name="pwd">
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
    <footer class="bg-dark py-5 mt-5" style="position: relative; top:150px">
        <div class="container text-light text-center">
            <p class="display-6 mb-3">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-2">
                    <img src="../img/whatsapp.svg" alt=""
                        style="width: 36px; height:36px; color:white; filter:invert(1); margin-right:-150px;">
                </div>
                <div class="col-md-2">
                    <img src="../img/facebook.svg" alt="" style="width: 36px; height:36px; filter:invert(1);">
                </div>
                <div class="col-md-2">
                    <img src="../img/email.svg" alt=""
                        style="width: 36px; height:36px; filter:invert(1); margin-right:150px;">
                </div>
            </div>
            </p>
            <small class="text-white-50">© All rights reserved.</small>
        </div>
    </footer>
    <script type="text/javascript">
    </script>
</body>

</html>