<?php  
use RentACar\MyConnect;
use RentACar\Address;
session_start();
require_once "./RentACar/MyConnect.php";
require_once "./html/components/header.php";
require "./RentACar/Address.php";
echo getHeader();

// Obter localizações usando a classe Location
$cityNames = Address::search([]);
?>

<style>
.bg-image {
    position: relative;
    background-image: url(./img/homepage.jpg);
    background-size: cover;
    background-position: center;
    height: 100vh;
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

.text-content {
    position: absolute;
    color: white;
}

.container-wrapper {
    max-width: 100%;
    overflow: hidden;
    margin-left: auto;
    margin-right: auto;
}
</style>

<body>
    <?php include 'html/components/navbar.inc.php'; ?>
    <div class="bg-image" style="position: relative;">
        <div class="gradient-overlay"></div>
        <div class="container">
            <div class="text-content">
                <h1 style="padding-top: 150px;">Drive with Ease <br> Rent with Confidence</h1>
            </div>
        </div>
    </div>

    <form action="" method="post">
        <div class="container my-5 w-50"
            style="position: relative; top: -250px; background-color: rgba(189, 195, 199, 0.8); padding: 15px;border-radius: 15px;">
            <div class="row" style="text-align: center; ">
                <div class="col-md-4" style="padding-left: 40px;">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" name="pickupBtn"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="padding-right: 22px; background-color: rgba(0,0,0,0.7); color:white">
                            Pick-up Location
                        </button>
                        <select name="city">
                            <?php foreach ($cityNames as $cityName) : ?>
                            <option>
                                <?php echo ($cityName); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-2" style="padding-right: 25px;">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="padding-left: 20px; background-color: rgba(0,0,0,0.7); color:white">
                            Pick-up Date
                        </button>
                        <ul class=" dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item"><input type="date" name="pickDate"></a></li>
                        </ul>
                    </div>
                    <div class="dropdown" style="margin-top: 15px;">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="background-color: rgba(0,0,0,0.7); color:white">
                            Drop-off Date
                        </button>
                        <ul class=" dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item"><input type="date" name="dropDate"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4" style="padding-left:60px;">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="padding-left: 20px;background-color: rgba(0,0,0,0.7); color:white">
                            Pick-up Time
                        </button>
                        <ul class=" dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item">9:30</a></li>
                            <li><a class="dropdown-item">9:30</a></li>
                            <li><a class="dropdown-item">10:00</a></li>
                            <li><a class="dropdown-item">10:30</a></li>
                            <li><a class="dropdown-item">11:00</a></li>
                            <li><a class="dropdown-item">11:30</a></li>
                            <li><a class="dropdown-item">12:00</a></li>
                            <li><a class="dropdown-item">12:30</a></li>
                            <li><a class="dropdown-item">13:00</a></li>
                            <li><a class="dropdown-item">13:30</a></li>
                            <li><a class="dropdown-item">14:00</a></li>
                            <li><a class="dropdown-item">14:30</a></li>
                            <li><a class="dropdown-item">15:00</a></li>
                            <li><a class="dropdown-item">15:30</a></li>
                            <li><a class="dropdown-item">16:00</a></li>
                            <li><a class="dropdown-item">16:30</a></li>
                            <li><a class="dropdown-item">17:00</a></li>
                        </ul>
                    </div>
                    <div class="dropdown" style="margin-top: 15px;">
                        <button class=" btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="background-color: rgba(0,0,0,0.7); color:white">
                            Drop-Off Time
                        </button>
                        <ul class=" dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item"></a></li>
                            <li><a class="dropdown-item">9:30</a></li>
                            <li><a class="dropdown-item">10:00</a></li>
                            <li><a class="dropdown-item">10:30</a></li>
                            <li><a class="dropdown-item">11:00</a></li>
                            <li><a class="dropdown-item">11:30</a></li>
                            <li><a class="dropdown-item">12:00</a></li>
                            <li><a class="dropdown-item">12:30</a></li>
                            <li><a class="dropdown-item">13:00</a></li>
                            <li><a class="dropdown-item">13:30</a></li>
                            <li><a class="dropdown-item">14:00</a></li>
                            <li><a class="dropdown-item">14:30</a></li>
                            <li><a class="dropdown-item">15:00</a></li>
                            <li><a class="dropdown-item">15:30</a></li>
                            <li><a class="dropdown-item">16:00</a></li>
                            <li><a class="dropdown-item">16:30</a></li>
                            <li><a class="dropdown-item">17:00</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-1 d-flex justify-content-center align-items-center">
                    <button type="button" class="btn btn-outline-dark btn-lg" style="margin-left: 40px;">Search</button>
                </div>
            </div>
        </div>
    </form>

    <div class="container">
        <h2 style="position:relative; top: -100px;">Our Fleet</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4" style="position: relative; top: -30px">
            <div class="col">
                <div class="card h-100" style="    filter: drop-shadow(16px 16px 20px);">
                    <img src="./img/car.jpg" class="card-img-top" alt="car">
                    <div class="card-body text-center" style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                        <h5 class="card-title">Regular</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut sapien
                            non
                            urna tincidunt consectetur. Nulla facilisi.</p>
                        <button type="button" class="btn btn-outline-dark"
                            style="border-radius: 15px;">Categories</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100" style="    filter: drop-shadow(20px 20px 20px);">
                    <img src="./img/moto.jpg" class="card-img-top" alt="moto">
                    <div class="card-body text-center" style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                        <h5 class="card-title">Motorcycle</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut sapien
                            non
                            urna tincidunt consectetur. Nulla facilisi.</p>
                        <button type="button" class="btn btn-outline-dark "
                            style="border-radius: 15px;">Categories</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100" style="    filter: drop-shadow(20px 20px 20px);">
                    <img src="./img/suv.jpg" class="card-img-top" alt="suv">
                    <div class="card-body text-center" style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                        <h5 class="card-title">Suv</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut sapien
                            non
                            urna tincidunt consectetur. Nulla facilisi.
                        </p>
                        <button type="button" class="btn btn-outline-dark"
                            style="border-radius: 15px;">Categories</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'html/components/footer.inc.php'; ?>
</body>

</html>