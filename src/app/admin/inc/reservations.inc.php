<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Reservation.php';

use RentACar\Reservation;

$reservations = Reservation::search([], 'reservation');