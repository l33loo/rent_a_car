<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/inc/reservation.inc.php';

use RentACar\Category;
use RentACar\Location;
use RentACar\Vehicle;

// TODO: validate form fields

try {
    // TODO: Validate that pick-up and drop-off locations are on the same island

    $dropoffLocation = Location::find($_GET['dropoffLocationId']);
    $categories = Category::search([]);
    $vehiclesWithCategory = [];
    $categoriesById = [];

    foreach ($categories as $category) {
        $category->loadProperties();
        $categoryId = $category->getId();
        $vehicles = Vehicle::findAvailableVehicles(
            $categoryId,
            $dropoffLocation->getIsland_id(),
            $_GET['pickupDate'],
            $_GET['dropoffDate']
        );
        $categoriesById[$categoryId] = $category;

        foreach ($vehicles as $vehicle) {
            $vehicle->loadProperties();
            // TODO: replace this hacky way to eliminate duplicate models
            // with a proper DB query
            $vehiclesWithCategory[$vehicle->Model] = [
                'vehicle' => $vehicle,
                'categoryId' => $categoryId,
                'totalPrice' => $category->calculateTotalPriceInEuros($_GET['pickupDate'], $_GET['dropoffDate']),
                'selected' => false
            ];
        }

        if (
            !empty($revision) &&
            $revision->getPickupDate() === $_GET['pickupDate'] &&
            $revision->getDropoffDate() === $_GET['dropoffDate']
        ) {
            $revision->loadVehicle()->loadCategory();
            $revisionVehicle = $revision->getVehicle();
            $vehiclesWithCategory[$revisionVehicle->Model] = [
                'vehicle' => $revision->getVehicle(),
                'categoryId' => $revision->getCategory()->getId(),
                'totalPrice' => $revision->getTotalPriceToString(),
                'selected' => true
            ];
        }
    }
} catch(e) {
    // TODO: handle errors
}