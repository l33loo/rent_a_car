<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Island.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Property.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Vehicle.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';

use RentACar\Category;
use RentACar\Island;
use RentACar\Property;
use RentACar\Vehicle;

// TODO: validate fields

if (!isset($_POST['vehicleId'])) {
    // TODO: error
    exit;
}

$vehicleId = $_POST['vehicleId'];

if (isset($_POST['vehicleEdit'])) {
    try {
        $vehicle = Vehicle::find($vehicleId);
        $vehicle->loadProperties();
        $vehicle->setPlate($_POST['plate']);
        $vehicle->setIsland(Island::find($_POST['islandId']));
        $vehicle->setCategory(($_POST['categoryId'] === '' ? (new Category()) : Category::find($_POST['categoryId'])));
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
        header("Location: /html/admin/vehicleView.php?vehicleId=$vehicleId");
    } catch(e) {
    // TODO: manage error
        print_r(e);
        header('Location: /html/admin/vehicleEdit.php');
        exit;
    }
    exit;
}

if (isset($_POST['vehicleArchive'])) {
    try {
        $vehicle = Vehicle::find($vehicleId);
        $vehicle->loadRelation('island');
        $vehicle->loadRelation('category');
        $vehicle->setIsArchived(true)->save();
        $islandId = $vehicle->getIsland()->getId();
        $categoryId = empty($vehicle->getCategory()) ? '' : $vehicle->getCategory()->getId();
        header("Location: /html/admin/vehicles.php?islandId=$islandId&categoryId=$categoryId");
    } catch(e) {
        // TODO: handle error
        exit;
    }
}