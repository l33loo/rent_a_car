<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/User.php';

use RentACar\User;

// session_start();

$user = User::find($_SESSION['logged_id']);
$user->loadRelation('address');
$address = $user->getAddress();
$address->loadRelation('country');
