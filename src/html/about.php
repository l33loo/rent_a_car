<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
    }

    .bg-image {
        position: relative;
        background-image: url('../img/WhoweAre.png');
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

    .container {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
    }

    .text-content {
        padding-top: 150px;
    }

    .text-content h1,
    .text-content h2 {
        text-align: center;
    }

    .text-content p {
        text-align: justify;
        padding: 15px;
    }

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

    .contact-list {
        list-style: none;
        padding: 0;
    }

    .contact-list li {
        padding: 10px 0;
    }

    .contact-list img {
        height: 20px;
        width: 20px;
        vertical-align: middle;
    }

    .contact-list span {
        margin-left: 5px;
    }

    .border-container {
        border: 4px solid #000;
        border-radius: 10px;
        margin-top: 20px;
        padding: 15px;
    }
    </style>
</head>

<body>
    <?php
    require_once '../html/components/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Location.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Address.php';

    if (function_exists('getHeader')) {
        echo getHeader();
    } else {
        echo '<p>Error loading header.</p>';
    }
    ?>

    <?php include 'components/navbar.inc.php'; ?>

    <div class="bg-image">
        <div class="gradient-overlay"></div>
    </div>

    <div class="container">
        <div class="text-content">
            <h1>About</h1>
            <h2>Who We Are</h2>
            <div class="border-container">
                <p>The Superstart Rental Car is an Azorean company established in 2002, with its headquarters located
                    along the island. We offer you occasional car rental services with a modern fleet that includes
                    high-quality vehicles from various segments, catering to the diverse needs and preferences of our
                    customers. If you are seeking an advanced Rent a Car service, look no further and choose Superstart
                    Rental Car to drive in style through the beautiful landscapes of São Miguel.</p>
            </div>
        </div>
    </div>

    <div class="container text-align-center mt-5">
        <div class="text-content">
            <h2>Where we are</h2>
            <div class="border-container">
                <ul class="location-list">
                    <?php
                try {
                    $locations = RentACar\Location::search([]);
                    foreach ($locations as $loc) {
                        if ($loc) {
                            $loc->loadRelation('address');
                            $address = $loc->getAddress();
                            if ($address) {
                                echo "<li class='location-list-item'>
                                        <span class='location-name'>" . htmlspecialchars($loc->getName()) . "</span> - 
                                        <span class='location-address'>" . htmlspecialchars($address->getAddressToString()) . "</span>
                                      </li>";
                            } else {
                                echo "<li class='location-list-item'>
                                        <span class='location-name'>" . htmlspecialchars($loc->getName()) . "</span> - 
                                        <span class='location-address'>Address not available</span>
                                      </li>";
                            }
                        } else {
                            echo "<li class='location-list-item'>Location not available</li>";
                        }
                    }
                } catch (Exception $e) {
                    echo '<li class="location-list-item">Error loading locations: ' . htmlspecialchars($e->getMessage()) . '</li>';
                }
                ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="container text-align-center mt-5">
        <div class="text-content">
            <h2>Contact Us</h2>
            <div class="border-container">
                <ul class="contact-list">
                    <li><img src="../img/telefone.svg" alt="telephone"> <span>Telephone - 296 649 385</span></li>
                    <li><img src="../img/email.svg" alt="Email"> <span>Email - SuperstarRentalCar@gmail.com</span></li>
                    <li><img src="../img/socialMedia.svg" alt="Social Media"> <span>Social Media - </span> <a
                            href="https://linktr.ee/azorean_tech"
                            style="color:black; text-decoration:none;">https://linktr.ee/azorean_tech</a></li>
                </ul>
            </div>
        </div>
    </div>

    <?php include '../components/footer.inc.php'; ?>
</body>

</html>