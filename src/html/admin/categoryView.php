<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Property.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';

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
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/navbar.inc.php'; ?>
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
                        <h5 class="card-title">Category Details</h5>
                        <p class="card-text"><strong>Name: </strong><?php echo $category->getName(); ?></p>
                        <p class="card-text"><strong>Description: </strong><?php echo $category->getDescription(); ?>
                        </p>
                        <p class="card-text"><strong>Daily Rate: </strong><?php echo $category->getDailyRate(); ?></p>
                        <p class="card-text"><strong>Archived:
                            </strong><?php echo $category->getIsArchived() ? 'YES' : 'NO'; ?></p>
                        <hr>
                        <h5 class="card-title">Category Properties</h5>
                        <?php 
                        $properties = $category->getProperties();
                        if ($properties) {
                            foreach ($properties as $property) { 
                        ?>
                        <p class="card-text">
                            <strong><?php echo $property->getName(); ?>:</strong><?php echo $property->getPropertyValue(); ?>
                        </p>
                        <?php 
                            }
                        } else {
                            echo '<p>No properties found for this category.</p>';
                        }
                        ?>
                        <a href="editCategory.php?categoryId=<?php echo $category->getId(); ?>"
                            class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/footer.inc.php'; ?>
</body>

</html>