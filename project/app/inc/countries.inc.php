<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Country.php';

use RentACar\Country;

$countries = Country::search([], 'country');