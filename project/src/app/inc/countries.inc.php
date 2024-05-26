<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/Country.php';

use RentACar\Country;

$countries = Country::search([], 'country');