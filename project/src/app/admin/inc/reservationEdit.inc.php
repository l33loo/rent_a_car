<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/util/helpers.php';

use RentACar\Category;
use RentACar\Customer;
use RentACar\Island;
use RentACar\Location;
use RentACar\Reservation;
use RentACar\Revision;
use RentACar\Status;
use RentACar\User;

try {
    if (empty($_GET['reservationId'])) {
        //TODO: error
        echo 'No reservation id';
        exit;
    }

    $reservationId = $_GET['reservationId'];
    $reservation = Reservation::find($reservationId);
    $latestRevision = $reservation->findLatestRevision()
        ->loadCategory()
        ->loadPickupLocation()
        ->loadDropoffLocation()
        ->loadStatus()
        ->loadBillingAddress()
        ->loadEffectivePickupLocation()
        ->loadEffectiveDropoffLocation();
    $latestRevisionId = $latestRevision->getId();
    $latestRevisionPickupLocation = $latestRevision->getPickupLocation();
    $latestRevisionDropoffLocation = $latestRevision->getDropoffLocation();
    $latestRevisionDropoffLocation->loadRelation('island');
    $effectiveLocations = Location::fetchActiveLocations($latestRevisionDropoffLocation->getIsland()->getId());
    $statuses = Status::search([]);
    $availableVehicles = $latestRevision->findAvailableVehicles();
    $locations = Location::fetchActiveLocations();
    $categories = Category::search([]);
    $wasPickedUp = $latestRevision->wasPickedUp();
    $wasDroppedOff = $latestRevision->wasDroppedOff();
    $wasNoShow = $latestRevision->wasNoShow();
    $category = $latestRevision->getCategory();
    $totalPrice = $latestRevision->getTotalPrice();
} catch(e) {
    // TODO: handle error
    exit;
}