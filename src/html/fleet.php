<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Category.php';

use RentACar\Category;

echo getHeader();

$categories = Category::search([]);

?>

<style>
.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
}

.card {
    width: 300px;
    margin: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.card-info {
    padding: 20px;
}

.card-info h2 {
    font-size: 20px;
    margin-bottom: 10px;
}

.card-info p {
    font-size: 16px;
    margin-bottom: 8px;
}

.title {
    text-align: left;
    margin-top: 150px;
    margin-left: 170px;
}
</style>

<body>
    <?php include './components/navbar.inc.php'; ?>
    <h1 class="title">Fleet</h1>
    <div class="container" style="margin-top: 50px;">
        <?php foreach ($categories as $category): ?>
        <div class="card">
            <img class="card-img-top" src="/img/<?php echo $category->getName()?>.jpg" alt="Category Image">
            <div class="card-info">
                <h2><?php echo $category->getName(); ?></h2>
                <p><?php echo $category->getDescription(); ?></p>
                <p>Daily Rate: <?php echo number_format($category->getDailyRate(), 2); ?> €</p>
                <a href="../html/categoryView.php" class="btn btn-primary">View Details</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php include './components/footer.inc.php'; ?>
</body>

</html>