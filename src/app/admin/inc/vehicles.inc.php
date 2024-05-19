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

    $islandName = Island::find($islandId)->getName();

    $categories = Category::search([]);
    // Add null category so we can get vehicles
    // without a category
    $categories[] = new Category();

    $vehiclesByCategoryForIsland = [];

    foreach ($categories as $category) {
        $vehicles = Vehicle::search([
            [
                'column' => 'category_id',
                'operator' => '<=>',
                'value' => $category->getId()
            ],
            [
                'column' => 'island_id',
                'operator' => '=',
                'value' => $islandId
            ]
        ]);

        $vehiclesByCategoryForIsland[$category->getId()] = [
            'categoryName' => $category->getName(),
            'vehicles' => $vehicles
        ];
    }
} catch (e) {

}
