<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Property.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Vehicle.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';

use RentACar\Property;
use RentACar\Vehicle;

// TODO: validate fields

if (!isset($_POST['vehicleId'])) {
    // TODO: error
    exit;
}

$vehicleId = $_POST['vehicleId'];

try {
    $vehicle = Vehicle::find($vehicleId);
    $vehicle->loadProperties();
    $vehicle->setPlate($_POST['plate']);
    $vehicle->setIsland_id($_POST['islandId']);
    $vehicle->setRentable($_POST['rentable']);
    $vehicle->save();

    foreach ($vehicle->getProperties() as $property) {
        $propertyId = $property->getId();
        if (!isset($_POST['property-' . $propertyId])) {
            echo 'NO PROPERTY ' . $property->getName();
            // TODO: error
            exit;
        }

        $formPropertyValue = trim($_POST['property-' . $propertyId]);
        if ($formPropertyValue !== $property->getPropertyValue()) {
            $stmt = Vehicle::rawSQL("
                UPDATE vehicle_property
                SET propertyValue = '$formPropertyValue'
                WHERE vehicle_id=$vehicleId
                AND property_id=$propertyId; 
            ");
        }
    }
} catch(e) {
// TODO: manage error
    print_r(e);
    header('Location: /html/admin/vehicleEdit.php');
    exit;
}
$vehicleIsland_id = $vehicle->getIsland_id();
$vehicleCategory_id = $vehicle->getCategory_id();
header("Location: /html/admin/vehicles.php?islandId=$vehicleIsland_id&categoryId=$vehicleCategory_id");