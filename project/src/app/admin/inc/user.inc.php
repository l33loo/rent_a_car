<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\User;

$userId = $_GET['id'];

$user = User::find($userId);
$user->loadRelation('address');
$user->getAddress()->loadRelation('country');