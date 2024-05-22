<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
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

    /* Estilos para a lista de localizações */
    .location-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .location-list-item {
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }

    .location-name {
        font-weight: bold;
    }

    .location-address {
        color: #666;
    }
    </style>
</head>

<body>
    <?php
    require_once '../html/components/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Location.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Address.php';

    echo getHeader();
    ?>

    <?php include 'components/navbar.inc.php'; ?>

    <div class="bg-image" style="position: relative;">
        <div class="gradient-overlay"></div>
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
                    <ul class="location-list">
                        <?php
                        // Criar uma instância da classe de localização
                        $locations = RentACar\Location::search([]);

                        // Exibir as localizações
                        foreach ($locations as $loc) {
                            // Certifique-se de carregar o endereço associado
                            $loc->loadRelation('address');
                            $address = $loc->getAddress();

                            // Verifique se o endereço não é nulo
                            if ($address) {
                                echo "<li class='location-list-item'>
                                        <span class='location-name'>{$loc->getName()}</span> - 
                                        <span class='location-address'>{$address->getStreet()}</span>
                                      </li>";
                            } else {
                                echo "<li class='location-list-item'>
                                        <span class='location-name'>{$loc->getName()}</span> - 
                                        <span class='location-address'>Address not available</span>
                                      </li>";
                            }
                        }
                        ?>
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
                                style="height:20px; width:20px;"> <span style="margin-left:5px;">Telephone - 296
                                649
                                385</span>
                        </li>
                        <li style="padding-top:10px;"><img src="/img/email.svg" alt="Email"
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

    <?php include 'components/footer.inc.php'; ?>
</body>

</html>