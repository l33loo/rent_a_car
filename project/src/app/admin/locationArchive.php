<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Location;

// TODO: error
try {
    $location = Location::find($_POST['locationId']);
    $location->setIsArchived(true)->save();

    // TODO: do we want location_id on Vehicle??
    // If so, will need to be deleted here. 
} catch (e) {
    echo "error";
    exit;
} finally {
    header('Location: /src/html/admin/locations.php');
}