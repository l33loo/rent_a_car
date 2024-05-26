<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/inc/sessionUser.inc.php';

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
    <form action="../app/login.php" method="post">
        <div class="container mt-5 d-flex justify-content-center" style="padding-right:15px;">
            <div class="text-content">
                <img src="/src/img/email.svg" alt="Email" style="height: 20px; width:20px; margin-bottom:3px;">
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
    <?php include 'components/footer.inc.php'; ?>
</body>

</html>