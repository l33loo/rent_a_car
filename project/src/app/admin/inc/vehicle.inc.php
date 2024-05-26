<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Vehicle;

$vehicleId = $_GET['id'];

$vehicle = Vehicle::find($vehicleId);