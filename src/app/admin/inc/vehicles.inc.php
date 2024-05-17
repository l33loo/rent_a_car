<?php

// require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Property.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Vehicle.php';

// use RentACar\Property;
use RentACar\Vehicle;

$vehicles = Vehicle::search([], 'vehicle');

foreach ($vehicles as $vehicle) {
    print_r($vehicle);
    $vehicle->loadRelation('category');
    $vehicle->loadRelation('island');

    // TODO: loca vehicle's properties
    // do this for vehicle view
    // $propertiesFilter = [
    //     'vehicle_id' => $vehicle->getId()
    // ];

    // $properties = Property::search($propertiesFilter);
    // $vehicle->setProperties = $properties;
}