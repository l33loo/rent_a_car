<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/CreditCard.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Customer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/DBModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Location.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use RentACar\Category;
use RentACar\CreditCard;
use RentACar\Customer;
use RentACar\Location;
use RentACar\User;

// id INT UNSIGNED NOT NULL AUTO_INCREMENT,
// category_id INT UNSIGNED NOT NULL,
// customer_id INT UNSIGNED NOT NULL,
// status_id INT UNSIGNED NOT NULL,
// pickupLocation_id INT UNSIGNED NOT NULL,
// dropoffLocation_id INT UNSIGNED NOT NULL,
// pickupDate DATE NOT NULL,
// dropoffDate DATE NOT NULL,
// pickupTime TIME NOT NULL,
// dropoffTime TIME NOT NULL,
// -- To be added by admin when customer picks up the car
// vehicle_id INT UNSIGNED,
// reservedByUser_id INT UNSIGNED NOT NULL,
// reservedTimestamp TIMESTAMP,
// -- To be added by admin when customer returns the car
// dateReturned DATE,
// -- To be added by admin when customer returns the car
// timeReturned TIME,
// -- To be added by admin when customer returns the car
// returnedLocation_id INT UNSIGNED,
// -- To be added by admin when customer returns the car
// collectedByUser_id INT UNSIGNED,
// billingAddress_id INT UNSIGNED NOT NULL,

class Reservation {
    use DBModel;
    // TODO: use Carbon type
    protected ?string $pickupDate = null;
    // TODO: use Carbon type
    protected ?string $dropoffDate = null;
    // TODO: use Carbon type
    protected ?string $pickupTime = null;
    // TODO: use Carbon type
    protected ?string $dropoffTime = null;
    // TODO: use Carbon type
    protected ?string $reservedTimestamp = null;
    // TODO: Update UML to reflect this
    protected ?array $revisions = null;

    protected ?int $billingAddress_id = null;
    protected ?int $creditCard_id = null;
    protected ?int $reservedByUser_id = null;
    protected ?int $category_id = null;
    protected ?int $customer_id = null;
    protected ?int $status_id = null;
    protected ?int $pickupLocation_id = null;
    protected ?int $dropoffLocation_id = null;
    protected ?int $vehicle_id = null;
    protected ?int $returnedLocation_id = null;
    protected ?int $collectedByUser_id = null;

    // TODO: use Carbon type
    protected ?string $dateReturned = null;
    // TODO: use Carbon type
    protected ?string $timeReturned = null;
    protected ?Address $billingAddress = null;
    protected ?CreditCard $creditCard = null;
    protected ?User $reservedByUser = null;
    protected ?Category $category = null;
    protected ?Customer $customer = null;
    protected ?Status $status = null;
    protected ?Location $pickupLocation = null;
    protected ?Location $dropoffLocation = null;
    protected ?Vehicle $vehicle = null;
    protected ?Location $returnedLocation = null;
    protected ?User $collectedByUser = null;

    public function __construct(
        // TODO: use Carbon type
        ?string $pickupDate = null,
        // TODO: use Carbon type
        ?string $dropoffDate = null,
        // TODO: use Carbon type
        ?string $pickupTime = null,
        // TODO: use Carbon type
        ?string $dropoffTime = null,
        // TODO: use Carbon type
        ?string $reservedTimestamp = null,
        // TODO: Update UML to reflect this
        ?array $revisions = null,

        ?int $billingAddress_id = null,
        ?int $creditCard_id = null,
        ?int $reservedByUser_id = null,
        ?int $category_id = null,
        ?int $customer_id = null,
        ?int $status_id = null,
        ?int $pickupLocation_id = null,
        ?int $dropoffLocation_id = null,
        ?int $vehicle_id = null,
        ?int $returnedLocation_id = null,
        ?int $collectedByUser_id = null,

        // TODO: use Carbon type
        ?string $dateReturned = null,
        // TODO: use Carbon type
        ?string $timeReturned = null,
        ?Address $billingAddress = null,
        ?CreditCard $creditCard = null,
        ?User $reservedByUser = null,
        ?Category $category = null,
        ?Customer $customer = null,
        ?Status $status = null,
        ?Location $pickupLocation = null,
        ?Location $dropoffLocation = null,
        ?Vehicle $vehicle = null,
        ?Location $returnedLocation = null,
        ?User $collectedByUser = null
    ) {
        $this->tableName = 'reservation';

        // TODO: use Carbon type
        ?string $pickupDate = null,
        // TODO: use Carbon type
        ?string $dropoffDate = null,
        // TODO: use Carbon type
        ?string $pickupTime = null,
        // TODO: use Carbon type
        ?string $dropoffTime = null,
        // TODO: use Carbon type
        ?string $reservedTimestamp = null,
        // TODO: Update UML to reflect this
        ?array $revisions = null,

        ?int $billingAddress_id = null,
        ?int $creditCard_id = null,
        ?int $reservedByUser_id = null,
        ?int $category_id = null,
        ?int $customer_id = null,
        ?int $status_id = null,
        ?int $pickupLocation_id = null,
        ?int $dropoffLocation_id = null,
        ?int $vehicle_id = null,
        ?int $returnedLocation_id = null,
        ?int $collectedByUser_id = null,

        // TODO: use Carbon type
        ?string $dateReturned = null,
        // TODO: use Carbon type
        ?string $timeReturned = null,
        ?Address $billingAddress = null,
        ?CreditCard $creditCard = null,
        ?User $reservedByUser = null,
        ?Category $category = null,
        ?Customer $customer = null,
        ?Status $status = null,
        ?Location $pickupLocation = null,
        ?Location $dropoffLocation = null,
        ?Vehicle $vehicle = null,
        ?Location $returnedLocation = null,
        ?User $collectedByUser = null,
    }
}