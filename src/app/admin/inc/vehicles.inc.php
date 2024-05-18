<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Island.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Property.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Vehicle.php';

use RentACar\Category;
use RentACar\Island;
use RentACar\Property;
use RentACar\Vehicle;

try {
    $islands = Island::search([]);

    if (!empty($_GET['islandId'])) {
        $islandId = $_GET['islandId'];
    } else {
        $islandId = $islands[0]->getId();
    }

    if (!empty($_GET['islandName'])) {
        $islandName = $_GET['islandName'];
    } else {
        $islandName = $islands[0]->getName();
    }

    $categories = Category::search([]);
    $vehiclesByCategoryForIsland = [];

    foreach ($categories as $category) {
        $vehicles = Vehicle::search([
            [
                'column' => 'category_id',
                'operator' => '=',
                'value' => $category->getId()
            ],
            [
                'column' => 'island_id',
                'operator' => '=',
                'value' => $islandId
            ]
        ]);

        $vehiclesByCategoryForIsland[$category->getId()] = $vehicles;

        // TODO: loca vehicle's properties
      


        // do this for vehicle view
        // $propertiesFilter = [
        //     'vehicle_id' => $vehicle->getId()
        // ];

        // $properties = Property::search($propertiesFilter);
        // $vehicle->setProperties = $properties;
    }
} catch (e) {

}
