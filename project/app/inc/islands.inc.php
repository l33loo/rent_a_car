<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Island.php';

use \RentACar\Island;

try {
    $islands = Island::search([]);
} catch(e) {
    // TODO: handle errors
    exit;
}
