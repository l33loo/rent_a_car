<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Property.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Vehicle.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';

use RentACar\Property;
use RentACar\Vehicle;

// TODO: validate fields

try {
    $vehicle = new Vehicle(
        $_POST['plate'],
        $_POST['rentable'],
        $_POST['islandId'],
        $_POST['categoryId'] === '' ? null : $_POST['categoryId'],
        null, // island
        null, // category
        null, // properties
        false // isArchived
    );

    $vehicle->save();
    $vehicleId= $vehicle->getId();

    $propertiesForVehicle = Property::search([
        [
            'column' => 'id',
            'operator' => '<=',
            'value' => 5
        ]
    ]);

    foreach ($propertiesForVehicle as $property) {
        $propertyId = $property->getId();
        if (!isset($_POST['property-' . $propertyId])) {
            echo 'NO PROPERTY ' . $property->getName();
            // TODO: error
            exit;
        }

        $formPropertyValue = trim($_POST['property-' . $propertyId]);
        Vehicle::rawSQL("
            INSERT INTO vehicle_property (propertyValue, vehicle_id, property_id)
            VALUES ('$formPropertyValue', $vehicleId, $propertyId); 
        ");
    }
} catch(e) {
// TODO: manage error
    print_r(e);
    header('Location: /html/admin/vehicleEdit.php');
    exit;
}

header("Location: /html/admin/vehicleView.php?vehicleId=$vehicleId");