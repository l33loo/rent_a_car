<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Property;
use RentACar\Vehicle;

if (isset($_POST['vehicleEdit'])) {
    try {
        if (!isset($_POST['vehicleId'])) {
            throw new Exception('No vehicle ID.');
        }
        
        $vehicleId = $_POST['vehicleId'];

        $isVehicleFormValid = Vehicle::validateForm();
        if (!$isVehicleFormValid) {
            throw new Exception('Invalid fields.');
        }

        $vehicle = Vehicle::find($vehicleId);
        $vehicle->loadProperties();
        $vehicle->setPlate($_POST['plate']);
        $vehicle->setIsland_id($_POST['islandId']);
        $vehicle->setCategory_id($_POST['categoryId'] === '' ? null : $_POST['categoryId']);
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
        header("Location: /src/html/admin/vehicleView.php?vehicleId=$vehicleId");
    } catch(Exception $e) {
        if (empty($vehicleId)) {
            $_SESSION['errors']['adminVehiclesPage'] = $e->getMessage();
            header('Location: /src/html/admin/vehicles.php');
        } else {
            $_SESSION['errors']['adminVehEditPage'] = $e->getMessage();
            header("Location: /src/html/admin/vehicleEdit.php?vehicleId=$vehicleId");
        }
        exit;
    }
}

if (isset($_POST['vehicleArchive'])) {
    try {
        if (!isset($_POST['vehicleId'])) {
            throw new Exception('No vehicle ID.');
        }
        
        $vehicleId = $_POST['vehicleId'];
        $vehicle = Vehicle::find($vehicleId);
        $vehicle->setIsArchived(true)->save();
        $islandId = $vehicle->getIsland_id();
        $categoryId = $vehicle->getCategory_id();
        header("Location: /src/html/admin/vehicles.php?islandId=$islandId&categoryId=$categoryId");
    } catch(Exception $e) {
        $_SESSION['errors']['adminVehiclesPage'] = $e->getMessage();
        header('Location: /src/html/admin/vehicles.php');
        exit;
    }
}