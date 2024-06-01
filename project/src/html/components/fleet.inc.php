<div class="fleet container">
    <h1 class="title">Our Fleet</h1>
    <div class="d-flex flex-wrap justify-content-center">
        <?php foreach ($categories as $category): ?>
        <div class="card">
            <img class="card-img-top" src="/src/img/<?php echo $category->getName(); ?>.jpg" alt="">
            <div class="card-info d-flex flex-column justify-content-between flex-grow-1">
                <div>
                    <h2><?php echo $category->getName(); ?></h2>
                    <p><?php echo $category->getDescription(); ?></p>
                    <p>Daily Rate: <?php echo $category->getDailyRateToString() ?></p>
                </div>
                <a href="/src/html/categoryView.php?categoryId=<?php echo $category->getId(); ?>"
                    class="btn btn-primary align-self-center">View Details</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>