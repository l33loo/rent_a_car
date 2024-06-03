<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/inc/sessionGuest.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';

use RentACar\User;

try {
    $user = User::find($_SESSION['logged_id']);
    $revisions = $user->fetchCurrentRevisions();
} catch(Exception $e) {
    // TODO: handle error
}

echo getHeader();
?>

<body>
    <?php include 'components/navbar.inc.php'; ?>
    <div class="container mt-5">
        <h1 class="mb-4">My Reservations</h1>
        <?php $errorMsg = (empty($_SESSION['errors']) || empty($_SESSION['errors']['userReservationsPage'])) ? null : $_SESSION['errors']['userReservationsPage'];
        if ($errorMsg !== null) { ?>
            <div class="alert alert-danger">
                <?php echo $errorMsg;
                unset($_SESSION['errors']['userReservationsPage']); ?>
            </div>
        <?php } ?>
        <?php foreach ($revisions as $revision) {
            // TODO: create revision method to do this
            $revision->loadStatus();
            $vehicle = $revision->loadVehicle()->getVehicle();
            $vehicle->loadProperties();
            $category = $revision->loadCategory()->getCategory();
            $categoryProperties = $category->loadProperties()->getProperties();
        ?>
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4" style="overflow: hidden;">
                        <img src="/src/img/car.jpg" class="img-fluid rounded-start" alt="" style="object-fit: cover; height: 300px; width: 100%">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h2 class="card-title">
                                <?php echo $vehicle->Brand . ' ' . $vehicle->Model ?> <small>(<?php echo $category->getName() ?>)</small> - <?php echo $revision->getStatus()->getStatusName() ?>
                            </h2>
                            <div>
                                <?php foreach ($categoryProperties as $categoryProperty) { ?>
                                    <span class="p-1 m-1 bg-warning-subtle"><?php echo $categoryProperty->getName() . ': ' . $categoryProperty->getPropertyValue() ?></span>
                                <?php } ?>
                            </div>
                            <div class="table-responsive mt-4">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>
                                                Pick-up
                                            </th>
                                            <th>
                                                Drop-off
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Location</th>
                                            <td>
                                                <?php echo $revision->loadPickupLocation()->getPickupLocation()->getName() ?>
                                            </td>
                                            <td>
                                                <?php echo $revision->loadDropoffLocation()->getDropoffLocation()->getName() ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Date</th>
                                            <td>
                                                <?php echo $revision->getPickupDate() ?>
                                            </td>
                                            <td>
                                                <?php echo $revision->getDropoffDate() ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Time</th>
                                            <td>
                                                <?php echo $revision->getPickupTime() ?>
                                            </td>
                                            <td>
                                                <?php echo $revision->getDropoffTime() ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex">
                        <div class="card-body d-flex flex-column justify-content-evenly bg-secondary-subtle">
                            <div class="text-center">
                                <div class="h3 ">
                                    <?php echo $category->getDailyRateToString() ?> <small>per day</small>
                                </div>
                                <div class="h5">
                                    <?php echo 'Total: ' . $revision->getTotalPriceToString(); ?>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-center" style="gap:10px;">
                                <a class="btn btn-primary ml-2" href="/src/html/reservationView.php?reservationId=<?php echo $revision->getReservation_id() ?>">View</a>
                                <form action="/src/app/reservationEdit.php" method="post">
                                    <input type="hidden" name="reservationId" value="<?php echo $revision->getReservation_id() ?>">
                                    <input
                                        type="submit"
                                        value="Change"
                                        name="changeForm"
                                        class="btn btn-secondary"
                                        <?php echo $revision->canUserUpdate() === true ? null : 'disabled' ?>
                                    >
                                </form>
                                <form action="/src/app/reservationEdit.php" method="post">
                                    <input type="hidden" name="reservationId" value="<?php echo $revision->getReservation_id() ?>">
                                    <input
                                        type="submit"
                                        value="Cancel"
                                        name="reservationCancel"
                                        class="btn btn-danger"
                                        <?php echo $revision->canUserUpdate() === true ? null : 'disabled' ?>
                                    >
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <? } ?>
    </div>
    <?php include 'components/footer.inc.php'; ?>
</body>

</html>