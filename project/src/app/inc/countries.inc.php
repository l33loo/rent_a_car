<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Country;

$countries = Country::search([], 'country');