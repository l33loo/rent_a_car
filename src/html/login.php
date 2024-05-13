<?php 
require_once './components/header.php';

session_start();

echo getHeader();
?>

<body>
    <?php include 'components/navbar.inc.php'; ?>
    <div class="container">
        <div class="text-content">
            <h1 class="text-center" style="margin-top: 100px;">Login</h1>
            <?php if (!empty($_SESSION['loginError'])) { ?>
                <h2>YOOO: <?php echo $_SESSION['loginError']; ?></h2>
            <?php } ?>
        </div>
    </div>
    <form action="../app/validateLogin.php" method="post">
        <div class="container mt-5 d-flex justify-content-center" style="padding-right:15px;">
            <div class="text-content">
                <img src="../img/email.svg" alt="Email" style="height: 20px; width:20px; margin-bottom:3px;">
                <span>
                    Email:
                </span>
                <input type="text" style="border: none; border-bottom: 2px solid; width:212px" name="email">
            </div>
        </div>
        <div class="container mt-4  d-flex justify-content-center">
            <div class=" text-content">
                <img src="../img/password.svg" alt="Password" style="height: 20px; width:20px; margin-bottom:5px;">
                <span>
                    Password:
                </span>
                <input type="text" style="border: none; border-bottom: 2px solid;" name="password">
            </div>
        </div>
        <div class="container d-flex justify-content-center mt-3" style="font-size: small;">
            <div class="text-content">
                <span class="text-muted">Don't have an account? <a href="signup.php">Create one!</a></span>
            </div>
        </div>
        <div class="container d-flex justify-content-center mt-4">
            <input
                type="submit"
                class="btn btn-outline-success"
                style="border-radius: 15px; width:100px"
                name="login"
                value="Login"
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