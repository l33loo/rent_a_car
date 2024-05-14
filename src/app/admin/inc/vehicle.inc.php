<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Vehicle.php';

use RentACar\Vehicle;

$vehicleId = $_GET['id'];

$vehicle = Vehicle::find($vehicleId, 'vehicle');