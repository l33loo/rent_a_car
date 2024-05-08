<?php 
require_once '../html/components/header.php';
echo getHeader();
?>
<style>
.bg-image {
    position: relative;
    background-image: url(../img/selectingVehicle.jpg);
    background-size: cover;
    background-position: center;
    height: 50vh;
    filter: drop-shadow(20px 20px 20px);
    top: 50px;
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
    <div class="bg-image" style="position: relative;">
        <div class="gradient-overlay"></div>
    </div>
    <div class="container d-flex justify-content-center" style="margin-top:150px;">
        <div class="col-auto ">
            <a href="./book.php" style="text-decoration:none;"><button class="btn btn-info">Book</button></a>
        </div>
        <div class="col-auto">
            <img src="../img/arrowLeft.svg" alt="Arrow Left" style="width: 36px; margin-left:10px;">
        </div>
        <div class="col-auto" style="margin-left: 10px;">
            <a href="./selectVehicle.php" style=" text-decoration:none;"><button class="btn btn-info">Select
                    Vehicle</button></a>
        </div>
        <div class="col-auto" style="margin-left: 10px;">
            <img src="../img/arrowLeft.svg" alt="Arrow Left" style="width: 36px; margin-left:10;">
        </div>
        <div class="col-auto" style="margin-left: 10px;">
            <a href="./details.php" style="text-decoration:none;"><button class="btn btn-info">Details</button></a>
        </div>
    </div>


    <div class="container">
        <div class="text-content">
            <h1 style="padding-top:90px">Select a Vehicle</h1>
        </div>
    </div>
    <script src="text/javascript">
    </script>
</body>

</html>