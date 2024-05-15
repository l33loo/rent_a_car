<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Vehicle.php';

use RentACar\Vehicle;

$vehicles = Vehicle::search([], 'vehicle');