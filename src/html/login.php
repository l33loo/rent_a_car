<?php 
require_once './components/header.php';

echo getHeader();
?>

<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">Superstar Rental Car</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Superstar Rent Car</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./fleet.php">Fleet</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="./login.php" class="nav-link"> <button class="btn btn-primary"
                                    type="submit">Login</button></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="text-content">
            <h1 class="text-center" style="margin-top: 100px;">Login</h1>
        </div>
    </div>
    <form action="../validalogin.php" method="post">
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
            <button type="button" class="btn btn-outline-success" style="border-radius: 15px; width:100px"
                name="login">Login</button>
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