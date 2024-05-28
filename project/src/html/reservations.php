<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/inc/sessionGuest.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';

use \RentACar\User;

try {
    $user = User::find($_SESSION['logged_id']);
    $revisions = $user->fetchCurrentRevisions();
} catch(\Exception $e) {
    // TODO: handle error
}

echo getHeader();
?>

<body>
    <?php include 'components/navbar.inc.php'; ?>
    <div class="container mt-5">
        <h1>Your Reservations</h1>
        <?php foreach ($revisions as $revision) {
            $vehicle = $revision->loadVehicle()->getVehicle();
            $vehicle->loadProperties();
            $category = $revision->loadCategory()->getCategory();
            $categoryProperties = $category->loadProperties()->getProperties();
            print_r($vehicle);
        ?>
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4" style="overflow: hidden;">
                        <img src="/src/img/car.jpg" class="img-fluid rounded-start" alt="" style="object-fit: cover; height: 300px; width: 100%">
                    </div>
                    <div class="col-md-5">
                        <div class="card-body">
                            <h2 class="card-title">
                                <?php echo $vehicle->Brand . ' ' . $vehicle->Model ?>
                            </h2>
                            <div class="row">
                                <?php foreach ($categoryProperties as $categoryProperty) { ?>
                                    <div class="col-6">
                                        <?php echo $categoryProperty->getName() . ': ' . $categoryProperty->getPropertyValue() ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex">
                        <div class="card-body d-flex flex-column justify-content-evenly">
                            <div>
                                <div class="h3 text-end">
                                    <?php echo $category->getDailyRateToString() ?> <small>per day</small>
                                </div>
                                <div class="h5 text-end">
                                    <?php echo 'Total: ' . $revision->getTotalPrice(); ?>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-end align-items-end" style="gap:10px;">
                                <a class="btn btn-primary ml-2" href="/src/html/reservationView.php">View</a>
                                <a class="btn btn-secondary ml-2" href="/src/html/reservationEdit.php">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <img src="/src/img/car.jpg" alt="">
                </div>
                <div class="col">
                    <h2>
                        
                    </h2>
                    <div>
                        Or similar <?php echo $category->getName() ?> car
                    </div>
                    <div class="row">
                        <?php foreach ($categoryProperties as $categoryProperty) { ?>
                            <div class="col-6">
                                <?php echo $categoryProperty->getName() . ': ' . $categoryProperty->getPropertyValue() ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="h3">
                        <?php echo $category->getDailyRateToString() ?> <small>per day</small>
                    </div>
                    <div class="h5">
                        <?php echo 'Total: ' . $revision->getTotalPrice(); ?>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-primary" href="/src/html/reservationView.php">View</a>
                        </div>
                        <div class="col">
                            <a class="btn btn-secondary" href="/src/html/reservationEdit.php">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        <? } ?>
    </div>
    <?php include 'components/footer.inc.php'; ?>
</body>

</html>