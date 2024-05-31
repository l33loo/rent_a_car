<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Island;

try {
    $islands = Island::search([]);
} catch(e) {
    // TODO: handle errors
    exit;
}
