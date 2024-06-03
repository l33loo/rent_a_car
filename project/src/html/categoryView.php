<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Category;
use RentACar\Property;

echo getHeader();

if (!isset($_GET['categoryId'])) {
    echo "<p>Category ID not provided.</p>";
    exit;
}

$categoryId = $_GET['categoryId'];
$category = Category::find($categoryId);

if (!$category) {
    echo "<p>Category not found.</p>";
    exit;
}

$category->loadProperties();

?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h1 class="my-5">Category Details</h1>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $category->getName(); ?></h2>
                        <p class="card-text"><?php echo $category->getDescription(); ?>
                        </p>
                        <hr>
                        <p class="card-text"><strong>Daily Rate: </strong><?php echo $category->getDailyRateToString(); ?></p>
                        <?php 
                        $properties = $category->getProperties();
                        if ($properties) {
                            foreach ($properties as $property) { 
                        ?>
                        <p class="card-text">
                            <strong><?php echo $property->getName(); ?>: </strong><?php echo $property->getPropertyValue(); ?>
                        </p>
                        <?php 
                            }
                        } else {
                            echo '<p>No properties found for this category.</p>';
                        }
                        ?>
                        <a href="/" class="btn btn-success">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
</body>

</html>