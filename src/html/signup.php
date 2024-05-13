<?php 
require_once './components/header.php';

echo getHeader();

?>

<body>
    <?php include 'components/navbar.php'; ?>
    <div class="container">
        <div class="text-content">
            <h1 class="text-center" style="margin-top: 100px;">Sign Up</h1>
        </div>
    </div>
    <div class="container mt-5  d-flex justify-content-center">
        <div class=" text-content">
            <img src="../img/profile.svg" alt="Password" style="height: 20px; width:20px; margin-bottom:10px;">
            <span>
                Name:
            </span>
            <input type="text" style="border: none; border-bottom: 2px solid;" name="name">
        </div>
    </div>
    <div class="container mt-4 d-flex justify-content-center" style="padding-right:15px;">
        <div class="text-content">
            <img src="../img/email.svg" alt="Email" style="height: 20px; width:20px; margin-bottom:5px;">
            <span>
                Email:
            </span>
            <input type="email" style="border: none; border-bottom: 2px solid; width:210px" name="email">
        </div>
    </div>
    <div class="container mt-4  d-flex justify-content-center">
        <div class=" text-content">
            <img src="../img/password.svg" alt="Password" style="height: 20px; width:20px; margin-bottom:10px;">
            <span>
                Password:
            </span>
            <input type="password" style="border: none; border-bottom: 2px solid;" name="pwd">
        </div>
    </div>
    <div class="container mt-4 d-flex justify-content-center" style="padding-right:15px;">
        <div class="text-content">
            <img src="../img/email.svg" alt="Email" style="height: 20px; width:20px; margin-bottom:5px;">
            <span>
                Birthdate:
            </span>
            <input type="date" style="border: none; border-bottom: 2px solid; width:210px" name="dateOfBirth">
        </div>
    </div>
    <div class="container mt-4 d-flex justify-content-center" style="padding-right:15px;">
        <div class="text-content">
            <img src="../img/email.svg" alt="Email" style="height: 20px; width:20px; margin-bottom:5px;">
            <span>
                Address:
            </span>
            <input type="text" style="border: none; border-bottom: 2px solid; width:210px" name="address">
        </div>
    </div>
    <div class="container mt-4 d-flex justify-content-center" style="padding-right:15px;">
        <div class="text-content">
            <img src="../img/email.svg" alt="Email" style="height: 20px; width:20px; margin-bottom:5px;">
            <span>
                Phone:
            </span>
            <input type="text" style="border: none; border-bottom: 2px solid; width:210px" name="phone">
        </div>
    </div>
    <div class="container d-flex justify-content-center mt-4">
        <button type="button" class="btn btn-outline-success" style="border-radius: 15px; width:100px"
            name="signup">Sign Up</button>
    </div>
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