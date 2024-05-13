<?php 
require_once '../html/components/header.php';

echo getHeader();
?>
<style>
.bg-image {
    position: relative;
    background-image: url(../img/droppingKey.jpg);
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
    <?php include 'components/navbar.php'; ?>
    <div class="bg-image" style="position: relative;">
        <div class="gradient-overlay"></div>
    </div>
    <div class="container">
        <div class="row">
            <a href="./book.php"><button>Book</button></a>
        </div>
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
            <h1 style="padding-top:90px">Book</h1>
        </div>
    </div>

    <small class="text-white-50">© All rights reserved.</small>
    </div>
    </footer>
</body>

</html>