<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
use RentACar\Location;
use RentACar\Address;

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>

    <div class="bg-image about" style="position: relative;">
        <div class="gradient-overlay"></div>
    </div>

    <div class="container">
        <div class="text-content my-4">
            <h1 style="padding-top:150px">About</h1>
        </div>
        <div class="text-content text-align-center">
            <h2 class="text-center">Who we are</h2>
            <div class="container border-dark w-70 mt-5" style="border: 4px solid; border-radius:10px;">
                <div class="text-content">
                    <p class="text-justify" style="padding-top:15px;">The Superstar Renta-A-Car is an Azorean company
                        established in
                        2002, with
                        its
                        headquarters
                        located in
                        along the island. We offer you occasional car rental services with a modern fleet that includes
                        high-quality vehicles from various segments, catering to the diverse needs and preferences of
                        our
                        customers. If you are seeking an advanced Rent-A-Car service, look no further and choose
                        Superstar
                        Rental-A-Car to drive in style through the beautiful landscapes of São Miguel.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-align-center mt-5">
        <div class="text-content">
            <h2 class="text-center">Where we are</h2>
            <div class="container border-dark w-70 mt-5" style="border: 4px solid; border-radius:10px;">
                <div class="text-content">
                    <ul class="location-list">
                        <?php $locations = Location::search([]);
                        foreach ($locations as $location) {
                            $location->loadRelation('address');
                        ?>
                            <li class='location-list-item'>
                                <span class='location-name'><?php echo $location->getName() ?></span> - 
                                <span class='location-address'><?php echo $location->getAddress() ?></span>
                            </li>
                        <?php } ?>
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
                        <li style="padding-top:15px;">
                            <img src="/src/img/telefone.svg"
                                alt="telephone"
                                style="height:20px; width:20px;"
                            > 
                            <span style="margin-left:5px;">
                                Telephone - <a href="tel:+351296649385" style="color:black; text-decoration:none;">+351 296 649 385</a>
                            </span>
                        </li>
                        <li style="padding-top:10px;"><img src="/src/img/email.svg" alt="Email"
                                style="height:20px; width:20px;"> <span style="margin-left:5px;">Email -
                                <a href="mailto:SuperstarRentACar@gmail.com" style="color:black; text-decoration:none;">SuperstarRentACar@gmail.com</a></span></li>
                        <li style="padding-top:10px;">
                            <img src="/src/img/socialMedia.svg" alt="Socia Media"
                                style="height:20px; width:20px;">
                                <span style="margin-left:5px;">
                                Social Media - </span> <a href="https://linktr.ee/azorean_tech"
                            style="color:black; text-decoration:none;">https://linktr.ee/azorean_tech</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php include 'components/footer.inc.php'; ?>
</body>

</html>