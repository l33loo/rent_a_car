<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Address.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Country.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use RentACar\Address;
use RentACar\Country;
use RentACar\User;

$userId = $_GET['id'];

$user = User::find($userId);
$address = Address::find($user->getAddress_id());
$country = Country::find($address->getCountry_id());
$address->setCountry($country);
$user->setAddress($address);

