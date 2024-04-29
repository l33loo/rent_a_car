<?php 
require_once './components/header.php';
require_once './components/nav.php';

echo getHeader();
?>

<body>
    <?php echo getNav();?>

    <div class="container">
        <div class="text-content" style="position: relative; top:150px;">
            <h1>Fleet</h1>
        </div>
    </div>
    <div class="container" style="position: relative; top:200px;">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel" style="height:400px;">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <div class="card h-100" style="filter: drop-shadow(20px 20px 20px);">
                                <img src=" ../img/car.jpg" class="card-img-top" alt="suv">
                                <div class="card-body text-center"
                                    style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                                    <h5 class="card-title">Regular</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        ut sapien non urna tincidunt consectetur. Nulla facilisi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <div class="card h-100" style="filter: drop-shadow(20px 20px 20px);">
                                <img src="../img/car2.jpg" class="card-img-top" alt="suv">
                                <div class="card-body text-center"
                                    style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                                    <h5 class="card-title">Regular</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        ut sapien non urna tincidunt consectetur. Nulla facilisi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card h-100" style="filter: drop-shadow(20px 20px 20px);">
                                <img src="../img/car3.jpg" class="card-img-top" alt="suv">
                                <div class="card-body text-center"
                                    style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                                    <h5 class="card-title">Regular</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        ut sapien non urna tincidunt consectetur. Nulla facilisi.</p>
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
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <div class="card h-100" style="filter: drop-shadow(20px 20px 20px);">
                                <img src="../img/moto.jpg" class="card-img-top" alt="suv">
                                <div class="card-body text-center"
                                    style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                                    <h5 class="card-title">Motorcycle</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        ut sapien non urna tincidunt consectetur. Nulla facilisi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <div class="card h-100" style="filter: drop-shadow(20px 20px 20px);">
                                <img src="../img/moto2.jpg" class="card-img-top" alt="suv">
                                <div class="card-body text-center"
                                    style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                                    <h5 class="card-title">Motorcycle</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        ut sapien non urna tincidunt consectetur. Nulla facilisi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card h-100" style="filter: drop-shadow(20px 20px 20px);">
                                <img src="../img/moto3.jpg" class="card-img-top" alt="suv">
                                <div class="card-body text-center"
                                    style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                                    <h5 class="card-title">Motorcycle</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        ut sapien non urna tincidunt consectetur. Nulla facilisi.</p>
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
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <div class="card h-100" style="filter: drop-shadow(20px 20px 20px);">
                                <img src="../img/suv.jpg" class="card-img-top" alt="suv">
                                <div class="card-body text-center"
                                    style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                                    <h5 class="card-title">Suv</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        ut sapien non urna tincidunt consectetur. Nulla facilisi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <div class="card h-100" style="filter: drop-shadow(20px 20px 20px);">
                                <img src="../img/suv2.jpg" class="card-img-top" alt="suv">
                                <div class="card-body text-center"
                                    style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                                    <h5 class="card-title">Suv</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        ut sapien non urna tincidunt consectetur. Nulla facilisi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card h-100" style="filter: drop-shadow(20px 20px 20px);">
                                <img src="../img/suv3.jpg" class="card-img-top" alt="suv">
                                <div class="card-body text-center"
                                    style="background-color: rgba(25, 135, 84, 0.7); color: white;">
                                    <h5 class="card-title">Suv</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        ut sapien non urna tincidunt consectetur. Nulla facilisi.</p>
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