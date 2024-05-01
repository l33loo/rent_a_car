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
    <div class="bg-image">
        <div class="gradient-overlay"></div>
        <div class="container">
        </div>
    </div>
    <div class="container">
        <div class="text-content">
            <h1 style="padding-top:150px">About</h1>
        </div>
    </div>
    <div class="container text-align-center" style="padding-top: 20px;">
        <div class="text-content">
            <h2 class="text-center">Who we are</h2>
            <div class="container border-dark w-70 mt-5" style="border: 4px solid; border-radius:10px;">
                <div class="text-content">
                    <p class="text-justify" style="padding-top:15px;">The Superstart Rental Car is an Azorean company
                        established in
                        2002, with
                        its
                        headquarters
                        located in
                        along the island. We offer you occasional car rental services with a modern fleet that includes
                        high-quality vehicles from various segments, catering to the diverse needs and preferences of
                        our
                        customers. If you are seeking an advanced Rent a Car service, look no further and choose
                        Superstart
                        Rental Car to drive in style through the beautiful landscapes of São Miguel.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container text-align-center mt-5">
        <div class="text-content">
            <h2 class="text-center">Where we are</h2>
            <div class="container border-dark w-70 mt-5" style="border: 4px solid; border-radius:10px;">
                <div class="text-content">
                    <ul>
                        <li style="padding-top:15px;">R. da Mãe de Deus, 9500-321 Ponta Delgada, nº 11</li>
                        <li style="padding-top:5px;">R. Av. Eng. Arantes de Oliveira, Ribeira Grande, nº 22</li>
                        <li style="padding-top:5px;">R. Alameda do Conhecimento 3, 9560-421 Lagoa, nº 33</li>
                        <li style="padding-top:5px;">R. Ponta do Arnel, 9630-158 Nordeste, nº 44</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container text-align-center mt-5">
        <div class="text-content">
            <h2 class="text-center">Contacts</h2>
            <div class="container border-dark w-70 mt-5" style="border: 4px solid; border-radius:10px;">
                <div class="text-content">
                    <ul style="list-style-type:none;">
                        <li style="padding-top:15px;"><img src="../img/telefone.svg" alt="telephone"
                                style="height:20px; width:20px;"> <span style="margin-left:5px;">Telephone - 296 649
                                385</span>
                        </li>
                        <li style="padding-top:10px;"><img src="../img/email.svg" alt="Email"
                                style="height:20px; width:20px;"> <span style="margin-left:5px;">Email -
                                SuperstarRentalCar@gmail.com</span></li>
                        <li style="padding-top:10px;"><img src="../img/socialMedia.svg" alt="Socia Media"
                                style="height:20px; width:20px;"><span style="margin-left:5px;"> Social
                                Media - </span> <a href="https://linktr.ee/azorean_tech"
                                style="color:black; text-decoration:none;">https://linktr.ee/azorean_tech</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark py-5 mt-5">
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
</body>

</html>