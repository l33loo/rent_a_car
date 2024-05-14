<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use RentACar\User;

$vehicleId = $_GET['id'];

$user = User::find($vehicleId, 'user');