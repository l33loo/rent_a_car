<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Category;

$categories = Category::search([]);

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>
    <div class="fleet container">
        <h1 class="title">Our Fleet</h1>
        <div class="d-flex flex-wrap justify-content-around">
            <?php foreach ($categories as $category): ?>
            <div class="card">
                <img class="card-img-top" src="/src/img/<?php echo $category->getName(); ?>.jpg" alt="">
                <div class="card-info">
                    <h2><?php echo $category->getName(); ?></h2>
                    <p><?php echo $category->getDescription(); ?></p>
                    <p>Daily Rate: <?php echo number_format($category->getDailyRate(), 2); ?> €</p>
                    <a href="/src/html/categoryView.php?categoryId=<?php echo $category->getId(); ?>"
                        class="btn btn-primary">View Details</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
</body>

</html>