<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use RentACar\User;

$userId = $_GET['id'];

$user = User::find($userId);
$user->loadRelation('address');
$user->getAddress()->loadRelation('country');