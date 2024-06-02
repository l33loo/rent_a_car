<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/inc/reservation.inc.php';

use RentACar\Category;
use RentACar\Location;
use RentACar\Vehicle;

// TODO: validate form fields

try {
    // TODO: Validate that pick-up and drop-off locations are on the same island

    $dropoffLocation = Location::find($revision->getDropoffLocation_id());
    $categories = Category::search([]);
    $vehiclesWithCategory = [];
    $categoriesById = [];

    foreach ($categories as $category) {
        $category->loadProperties();
        $categoryId = $category->getId();
        $vehicles = Vehicle::findAvailableVehicles(
            $categoryId,
            $dropoffLocation->getIsland_id(),
            $revision->getPickupDate(),
            $revision->getDropoffDate()
        );
        $categoriesById[$categoryId] = $category;

        foreach ($vehicles as $vehicle) {
            $vehicle->loadProperties();
            // TODO: replace this hacky way to eliminate duplicate models
            // with a proper DB query
            $vehiclesWithCategory[$vehicle->Model] = [
                'vehicle' => $vehicle,
                'categoryId' => $categoryId,
                'totalPrice' => $category->calculateTotalPriceInEuros($revision->getPickupDate(), $revision->getDropoffDate()),
                'selected' => false
            ];
        }

        if ($revision->getReservation_id() !== null) {
            $reservation = $revision->loadReservation()->getReservation();
            $latestRevision = $reservation->findLatestRevision();

            if ($revision->getPickupDate() === $latestRevision->getPickupDate() &&
            $revision->getDropoffDate() === $latestRevision->getDropoffDate()) {
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
    }
} catch(Exception $e) {
    unset($_SESSION['booking']);
    $_SESSION['errors']['indexPage'] = $e->getMessage();
    header('Location: /');
}