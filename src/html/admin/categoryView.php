<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/inc/sessionGuest.inc.php';

use RentACar\Category;

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/navbar.inc.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h1 class="my-5">Categories</h1>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card-deck">
                    <?php 
                    $categories = Category::search([]); // Assuming this fetches all categories

                    foreach ($categories as $category) {
                        $category->loadProperties(); // Load properties if needed
                        $properties = $category->getProperties();
                    ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Category Details</h5>
                            <p class="card-text"><strong>Name:
                                </strong><?php echo htmlspecialchars($category->getName()); ?></p>
                            <p class="card-text"><strong>Description:
                                </strong><?php echo htmlspecialchars($category->getDescription()); ?></p>
                            <p class="card-text"><strong>Daily Rate:
                                </strong><?php echo htmlspecialchars($category->getDailyRate()); ?></p>
                            <p class="card-text"><strong>Archived:
                                </strong><?php echo $category->getIsArchived() ? 'YES' : 'NO'; ?></p>
                            <hr>
                            <h5 class="card-title">Properties</h5>
                            <?php foreach ($properties as $property) { ?>
                            <p class="card-text"><strong><?php echo htmlspecialchars($property->getName()); ?>:</strong>
                                <?php echo htmlspecialchars($property->getPropertyValue()); ?></p>
                            <?php } ?>
                            <a href="editCategory.php?id=<?php echo $category->getId(); ?>"
                                class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/footer.inc.php'; ?>
</body>

</html>