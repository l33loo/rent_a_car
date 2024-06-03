<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/src/html/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/reservationEdit.inc.php';

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>

    <div class="container pt-5">
        <h1 class="pt-5 pb-3">Admin Reservation Updates</h1>
        <div class="row bg-secondary-subtle py-3 my-4">
            <div class="col-sm-12 col-md border-end border-primary">
                <form action="/src/app/admin/reservationEdit.php" method="post">
                    <label for="statusId" class="h4">
                        1. Reservation Status:
                    </label>
                    <select name="statusId" id="statusId" class="form-select" <?php echo $wasPickedUp ? 'disabled' : null ?>>
                        <?php if ($wasNoShow) { ?>
                            <option value="4">Cancelled</option>
                        <?php } else {
                            foreach ($statuses as $status) { ?>
                                <option
                                    value="<?php echo $status->getId() ?>"
                                    <?php echo $latestRevision->getStatus()->getId() === $status->getId() ? 'selected' : null ?>
                                >
                                    <?php echo $status->getStatusName() ?>
                                </option>
                            <?php }
                        } ?>
                    </select>
                    <input type="hidden" name="reservationId" value="<?php echo $reservationId ?>">
                    <input class="btn btn-primary mt-3" type="submit" name="reservationEditStatus" value="Update Status" <?php echo $wasPickedUp ? 'disabled' : null ?>>
                </form>
            </div>
            <div class="col-sm-12 col-md">
                <form action="/src/app/admin/reservationEdit.php" method="post">
                    <label for="vehicleId" class="h4">
                        2. Vehicle:
                    </label>
                    <select name="vehicleId" id="vehicleId" class="form-select" <?php echo ($wasPickedUp || $wasNoShow) ? 'disabled' : null ?>>
                        <option value="none">None</option>
                        <?php if ($latestRevision->getVehicle_id() !== null) {
                            $latestRevision->loadVehicle();
                            $revisionVehicle = $latestRevision->getVehicle();
                            $revisionVehicle->loadProperties();
                        ?>
                            <option
                                value="<?php echo $revisionVehicle->getId() ?>"
                                selected
                            >
                                <?php echo $revisionVehicle->Model . ' ' . $revisionVehicle->Brand . ' - ' . $revisionVehicle->getPlate() ?>
                            </option>
                        <?php } ?>
                        <?php foreach ($availableVehicles as $vehicle) {
                            $vehicle->loadProperties();
                        ?>
                            <option value="<?php echo $vehicle->getId() ?>">
                                <?php echo $vehicle->Model . ' ' . $vehicle->Brand . ' - ' . $vehicle->getPlate() ?>
                            </option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="reservationId" value="<?php echo $reservationId ?>">
                    <input class="btn btn-primary mt-3" type="submit" name="reservationEditVehicle" value="Assign New Vehicle" <?php echo ($wasPickedUp || $wasNoShow) ? 'disabled' : null ?>>
                </form>
            </div>
        </div>
        <div class="row bg-secondary-subtle py-3 my-4">
            <div class="col-12">
                <h2 class="h4 mb-3">3. Effective Pick-up</h2>
            </div>
            <div class="col-12">
                <form action="/src/app/admin/reservationEdit.php" method="post">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <label for="pickupLocation_id">Pick-Up Location:</label>
                            <select
                                id="pickupLocation_id"
                                name="pickupLocation_id"
                                class="form-select"
                                <?php echo ($wasPickedUp || $wasNoShow) ? 'disabled' : null ?>
                            >
                                <option value="none">None</option>
                                <?php foreach ($effectiveLocations as $location) : ?>
                                    <option
                                        value="<?php echo $location->getId(); ?>"
                                        <?php if ($wasPickedUp) { 
                                            echo $location->getId() === $latestRevision->getEffectivePickupLocation()->getId() ? 'selected' : null;
                                        } else {
                                            echo $location->getId() === $latestRevisionPickupLocation->getId() ? 'selected' : null;
                                        }?> 
                                    >
                                        <?php echo $location->getName(); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="pickupDate">Pick-Up Date:</label>
                            <input
                                type="date"
                                id="pickupDate"
                                name="pickupDate"
                                class="form-control"
                                value="<?php if ($wasPickedUp) { 
                                    echo $latestRevision->getEffectivePickupDate();
                                } else {
                                    echo date('Y-m-d', time());
                                } ?>"
                                <?php echo $wasPickedUp ? 'disabled' : null ?>  
                            >
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="pickupTime">Pick-Up Time:</label>
                            <input
                                type="time"
                                id="pickupTime"
                                name="pickupTime"
                                class="form-control"
                                value="<?php if ($wasPickedUp) { 
                                    echo $latestRevision->getEffectivePickupTime();
                                } else {
                                    echo date('H:i', time());
                                } ?>"
                                <?php echo ($wasPickedUp || $wasNoShow) ? 'disabled' : null ?>
                            >
                        </div>
                        <div class="col-12">
                            <input
                                type="hidden"
                                name="reservationId"
                                value="<?php echo $reservationId ?>"
                                <?php echo ($wasPickedUp || $wasNoShow) ? 'disabled' : null ?>
                            >
                            <input
                                class="btn btn-primary mt-3"
                                type="submit"
                                name="reservationEditEffectivePickup"
                                value="Record Pickup"
                                <?php echo ($wasPickedUp || $wasNoShow) ? 'disabled' : null ?>
                            >
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row bg-secondary-subtle py-3 my-4">
            <div class="col-12">
                <h2 class="h4 mb-3">4. Effective Drop-Off</h2>
            </div>
            <div class="col-12">
                <form action="/src/app/admin/reservationEdit.php" method="post">
                    <fieldset <?php echo ($wasDroppedOff || $wasNoShow) ? 'disabled' : null ?>>
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <label for="dropoffLocation">Drop-Off Location:</label>
                                <select
                                    id="dropoffLocation"
                                    name="dropoffLocation_id"
                                    class="form-select"
                                >
                                    <option value="none">None</option>
                                    <?php foreach ($effectiveLocations as $location) : ?>
                                        <option value="<?php echo $location->getId(); ?>"
                                            <?php if ($wasDroppedOff) { 
                                                echo $location->getId() === $latestRevision->getEffectiveDropoffLocation()->getId() ? 'selected' : null;
                                            } else {
                                                echo $location->getId() === $latestRevisionDropoffLocation->getId() ? 'selected' : null;
                                            }?> 
                                        >
                                            <?php echo $location->getName(); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="dropoffDate">Drop-Off Date:</label>
                                <input
                                    type="date"
                                    id="dropoffDate"
                                    name="dropoffDate"
                                    class="form-control"
                                    value="<?php if ($wasDroppedOff) { 
                                        echo $latestRevision->getEffectiveDropoffDate();
                                    } else {
                                        echo date('Y-m-d', time());
                                    } ?>"
                                >
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="dropoffTime">Drop-Off Time:</label>
                                <input
                                    type="time"
                                    id="dropoffTime"
                                    name="dropoffTime"
                                    min="09:30"
                                    max="17:30"
                                    class="form-control"
                                    value="<?php if ($wasDroppedOff) { 
                                        echo $latestRevision->getEffectiveDropoffTime();
                                    } else {
                                        echo date('H:i', time());
                                    } ?>"
                                >
                            </div>
                            <div class="col-12">
                                <input type="hidden" name="reservationId" value="<?php echo $reservationId ?>">
                                <input class="btn btn-primary mt-3" type="submit" name="reservationEditEffectiveDropoff" value="Record Dropoff">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div>
            <h1 class="py-3">Edit Base Reservation</h1>
            <form action="/src/app/admin/reservationEdit.php" method="post">
                <div class="row mb-1">
                    <div class="col-md-6 col-12">
                        <h2 class="h4 mb-3">Pick-up</h2>
                        <fieldset <?php echo ($wasPickedUp || $wasNoShow) ? 'disabled' : null ?>>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="pickupLocation">Pick-Up Location:</label>
                                    <select id="pickupLocation" name="pickupLocation_id" class="form-select">
                                        <?php foreach ($locations as $location) : ?>
                                            <option
                                                value="<?php echo $location->getId(); ?>"
                                                <?php echo $location->getId() === $latestRevisionPickupLocation->getId() ? 'selected' : null; ?>
                                            >
                                                <?php echo $location->getName(); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="pickupDate">Pick-Up Date:</label>
                                    <input
                                        type="date"
                                        id="pickupDate"
                                        name="pickupDate"
                                        class="form-control"
                                        value="<?php echo $latestRevision->getPickupDate() ?>"
                                    >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="pickupTime">Pick-Up Time:</label>
                                    <input
                                        type="time"
                                        id="pickupTime"
                                        name="pickupTime"
                                        min="09:30"
                                        max="17:30"
                                        class="form-control"
                                        value="<?php echo $latestRevision->getPickupTime() ?>"
                                    >
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-6 col-12">
                        <h2 class="h4 mb-3">Drop-off</h2>
                        <fieldset <?php echo ($wasDroppedOff || $wasNoShow) ? 'disabled' : null ?>>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="dropoffLocation">Drop-Off Location:</label>
                                    <select id="dropoffLocation" name="dropoffLocation_id" class="form-select">
                                        <?php foreach ($locations as $location) : ?>
                                            <option
                                                value="<?php echo $location->getId(); ?>"
                                                <?php echo $location->getId() === $latestRevisionDropoffLocation->getId() ? 'selected' : null; ?>
                                            >
                                                <?php echo $location->getName(); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="dropoffDate">Drop-Off Date:</label>
                                    <input
                                        type="date"
                                        id="dropoffDate"
                                        name="dropoffDate"
                                        class="form-control"
                                        value="<?php echo $latestRevision->getDropoffDate() ?>"
                                    >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="dropoffTime">Drop-Off Time:</label>
                                    <input
                                        type="time"
                                        id="dropoffTime"
                                        name="dropoffTime"
                                        min="09:30:00"
                                        max="17:30:00"
                                        class="form-control"
                                        value="<?php echo $latestRevision->getPickupTime() ?>"
                                    >
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm col-md-6">
                        <label for="categoryId">Vehicle category:</label>
                        <select
                            name="categoryId"
                            id="categoryId"
                            class="form-select"
                            <?php echo ($wasPickedUp || $wasNoShow) ? 'disabled' : null ?>
                        >
                            <?php foreach ($categories as $category) { ?>
                                <option
                                    value="<?php echo $category->getId() ?>"
                                    <?php echo $category->getId() === $latestRevision->getCategory()->getId() ? 'selected' : null ?>
                                >
                                    <?php echo $category->getName() ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <input type="hidden" name="reservationId" value="<?php echo $reservationId ?>">
                    <input
                        type="submit"
                        name="reservationEditRes"
                        value="Edit Reservation"
                        class="btn btn-primary"
                        <?php echo ($wasDroppedOff || $wasNoShow) ? 'disabled' : null ?>
                    >
                </div>
            </form>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
</body>

</html>