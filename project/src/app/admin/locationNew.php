<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Address.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Island.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Location.php';

use RentACar\Address;
use RentACar\Island;
use RentACar\Location;

// TODO: validate fields

// TODO: error handling
try {
    $address = new Address(
        $_POST['street'],
        $_POST['door'],
        $_POST['apartment'],
        $_POST['city'],
        $_POST['district'],
        $_POST['postalCode'],
        $_POST['countryId']
    );
    
    $address->save();
    
    $island = Island::find($_POST['islandId']);
    
    $newLocation = new Location(
        $_POST['name'],
        $address->getId(),
        $_POST['islandId'],
        false // isArchived
    );
    $newLocation->save();
} catch (e) {
    // TODO
    header('Location: /html/admin/locationNew.php');
    exit;
}

header('Location: /html/admin/locations.php');