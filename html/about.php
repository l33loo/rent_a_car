<?php 
require_once '../html/components/header.php';

echo getHeader();
?>
<style>
.bg-image {
    position: relative;
    background-image: url(../img/WhoweAre.png);
    background-size: cover;
    background-position: center;
    height: 50vh;
    filter: drop-shadow(20px 20px 20px);
}

.gradient-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3));
}
</style>

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
                            <a class="nav-link" href="./html/fleet.php">Fleet</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="./html/login.php" class="nav-link"> <button class="btn btn-primary"
                                    type="submit">Login</button></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="bg-image" style="position: relative;">
        <div class="gradient-overlay"></div>
        <div class="container">
        </div>
    </div>
    <div class="container">
        <div class="text-content">
            <h1 style="padding-top:150px">About</h1>
        </div>
    </div>
</body>

</html>