<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/Island.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/Property.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/Vehicle.php';

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

    $island = Island::find($islandId);
    $islandName = $island->getName();

    $categories = Category::search([
        [
            'column' => 'isArchived',
            'operator' => '=',
            'value' => false
        ]
    ]);
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
            ],
            [
                'column' => 'isArchived',
                'operator' => '=',
                'value' => false
            ]
        ]);

        $vehiclesByCategoryForIsland[$category->getId()] = [
            'categoryName' => $category->getName(),
            'vehicles' => $vehicles
        ];
    }
} catch (e) {

}
