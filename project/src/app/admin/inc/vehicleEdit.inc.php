<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Category;
use RentACar\Island;
use RentACar\Property;
use RentACar\Vehicle;

if (empty($_GET['vehicleId'])) {
    // TODO: error
} else {
    try {
        $vehicle = Vehicle::find($_GET['vehicleId']);
        $vehicle->loadRelation('island');
        $vehicle->loadProperties();
        $islands = Island::search([]);
        $island = Island::find($vehicle->getIsland()->getId());
        $categories = Category::search([
            [
                'column' => 'isArchived',
                'operator' => '=',
                'value' => false
            ]
        ]);
    } catch(e) {
        // TODO:
    }
}