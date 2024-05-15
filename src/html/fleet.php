<?php 
require_once './components/header.php';

echo getHeader();
?>

<body>
    <?php include 'components/navbar.inc.php'; ?>
    <div class="container">
        <div class="text-content">
            <h1 style="padding-top: 150px;">Fleet</h1>
        </div>
    </div>
    <div class="container" style="position: relative; top:100px;">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel" style="height:400px;">
                    <div class="carousel-inner" style="filter: drop-shadow(20px 20px 20px);">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <div class="card h-100">
                                <img src=" ../img/car.jpg" class="card-img-top" alt="suv">
                                <div class="card-body text-center"
                                    style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                                    <h5 class="card-title">Regular</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        ut sapien non urna tincidunt consectetur. Nulla facilisi.</p>
                                    <span style="font-size: 15px;">Price/day:</span><span
                                        style="font-size: 20px; margin-left:5px; padding-top:15px; font-weight:bold;">25.00€</span>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <div class="card h-100">
                                <img src="../img/car2.jpg" class="card-img-top" alt="suv">
                                <div class="card-body text-center"
                                    style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                                    <h5 class="card-title">Regular</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        ut sapien non urna tincidunt consectetur. Nulla facilisi.</p>
                                    <span style="font-size: 15px;">Price/day:</span><span
                                        style="font-size: 20px; margin-left:5px; padding-top:15px; font-weight:bold;">25.00€</span>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card h-100">
                                <img src="../img/car3.jpg" class="card-img-top" alt="suv">
                                <div class="card-body text-center"
                                    style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                                    <h5 class="card-title">Regular</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        ut sapien non urna tincidunt consectetur. Nulla facilisi.</p>
                                    <span style="font-size: 15px;">Price/day:</span><span
                                        style="font-size: 20px; margin-left:5px; padding-top:15px; font-weight:bold;">25.00€</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-3">
                <div id="carouselExampleInterval2" class="carousel slide" data-bs-ride="carousel" style="height:400px;">
                    <div class="carousel-inner" style="filter: drop-shadow(20px 20px 20px);">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <div class="card h-100">
                                <img src="../img/moto.jpg" class="card-img-top" alt="suv">
                                <div class="card-body text-center"
                                    style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                                    <h5 class="card-title">Motorcycle</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        ut sapien non urna tincidunt consectetur. Nulla facilisi.</p>
                                    <span style="font-size: 15px;">Price/day:</span><span
                                        style="font-size: 20px; margin-left:5px; padding-top:15px; font-weight:bold;">20.00€</span>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <div class="card h-100">
                                <img src="../img/moto2.jpg" class="card-img-top" alt="suv">
                                <div class="card-body text-center"
                                    style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                                    <h5 class="card-title">Motorcycle</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        ut sapien non urna tincidunt consectetur. Nulla facilisi.</p>
                                    <span style="font-size: 15px;">Price/day:</span><span
                                        style="font-size: 20px; margin-left:5px; padding-top:15px; font-weight:bold;">20.00€</span>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card h-100">
                                <img src="../img/moto3.jpg" class="card-img-top" alt="suv">
                                <div class="card-body text-center"
                                    style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                                    <h5 class="card-title">Motorcycle</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        ut sapien non urna tincidunt consectetur. Nulla facilisi.</p>
                                    <span style="font-size: 15px;">Price/day:</span><span
                                        style="font-size: 20px; margin-left:5px; padding-top:15px; font-weight:bold;">20.00€</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval2"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval2"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-3">
                <div id="carouselExampleInterval3" class="carousel slide" data-bs-ride="carousel" style="height:400px;">
                    <div class="carousel-inner" style="filter: drop-shadow(20px 20px 20px);">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <div class="card h-100">
                                <img src="../img/suv.jpg" class="card-img-top" alt="suv">
                                <div class="card-body text-center"
                                    style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                                    <h5 class="card-title">Suv</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        ut sapien non urna tincidunt consectetur. Nulla facilisi.</p>
                                    <span style="font-size: 15px;">Price/day:</span><span
                                        style="font-size: 20px; margin-left:5px; padding-top:15px; font-weight:bold;">30.00€</span>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <div class="card h-100">
                                <img src="../img/suv2.jpg" class="card-img-top" alt="suv">
                                <div class="card-body text-center"
                                    style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                                    <h5 class="card-title">Suv</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        ut sapien non urna tincidunt consectetur. Nulla facilisi.</p>
                                    <span style="font-size: 15px;">Price/day:</span><span
                                        style="font-size: 20px; margin-left:5px; padding-top:15px; font-weight:bold;">30.00€</span>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card h-100">
                                <img src="../img/suv3.jpg" class="card-img-top" alt="suv">
                                <div class="card-body text-center"
                                    style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                                    <h5 class="card-title">Suv</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        ut sapien non urna tincidunt consectetur. Nulla facilisi.</p>
                                    <span style="font-size: 15px;">Price/day:</span><span
                                        style="font-size: 20px; margin-left:5px; padding-top:15px; font-weight:bold;">30.00€</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval3"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval3"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php include 'components/footer.inc.php'; ?>
</body>

</html>