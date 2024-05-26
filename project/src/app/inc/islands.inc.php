<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/Island.php';

use \RentACar\Island;

try {
    $islands = Island::search([]);
} catch(e) {
    // TODO: handle errors
    exit;
}
