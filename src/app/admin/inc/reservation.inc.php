<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Reservation.php';

use RentACar\Reservation;

$reservationId = $_GET['id'];

$reservation = Reservation::find($reservationId, 'reservation');