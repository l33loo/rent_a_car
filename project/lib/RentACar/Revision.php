<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/util/helpers.php';

use RentACar\Category;
use RentACar\CreditCard;
use RentACar\Customer;
use RentACar\Location;
use RentACar\User;
use RentACar\Vehicle;

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
// submittedByUser_id INT UNSIGNED NOT NULL,
// submittedTimestamp TIMESTAMP,
// -- To be added by admin when customer returns the car
// effectiveDropoffDate DATE,
// -- To be added by admin when customer returns the car
// effectiveDropoffTime TIME,
// -- To be added by admin when customer returns the car
// effectiveDropoffLocation_id INT UNSIGNED,
// -- To be added by admin when customer returns the car
// collectedByUser_id INT UNSIGNED,
// billingAddress_id INT UNSIGNED NOT NULL,

class Revision {
    use DBModel;
    protected ?int $reservation_id = null;
    // TODO: use Carbon type
    protected ?string $pickupDate = null;
    // TODO: use Carbon type
    protected ?string $dropoffDate = null;
    // TODO: use Carbon type
    protected ?string $pickupTime = null;
    // TODO: use Carbon type
    protected ?string $dropoffTime = null;
    protected ?float $totalPrice = null;
    // TODO: use Carbon type
    protected ?string $submittedTimestamp = null;

    protected ?int $billingAddress_id = null;
    protected ?int $creditCard_id = null;
    protected ?int $submittedByUser_id = null;
    protected ?int $category_id = null;
    protected ?int $customer_id = null;
    protected ?int $status_id = null;
    protected ?int $pickupLocation_id = null;
    protected ?int $dropoffLocation_id = null;
    protected ?int $vehicle_id = null;

    protected ?int $effectivePickupLocation_id = null;
    protected ?int $givenByUser_id = null;
    // TODO: use Carbon type
    protected ?string $effectivePickupDate = null;
    // TODO: use Carbon type
    protected ?string $effectivePickupTime = null;

    protected ?int $effectiveDropoffLocation_id = null;
    protected ?int $collectedByUser_id = null;
    // TODO: use Carbon type
    protected ?string $effectiveDropoffDate = null;
    // TODO: use Carbon type
    protected ?string $effectiveDropoffTime = null;
    
    protected ?Reservation $reservation = null;
    protected ?Address $billingAddress = null;
    protected ?CreditCard $creditCard = null;
    protected ?User $submittedByUser = null;
    protected ?Category $category = null;
    protected ?Customer $customer = null;
    protected ?Status $status = null;
    protected ?Location $pickupLocation = null;
    protected ?Location $dropoffLocation = null;
    protected ?Vehicle $vehicle = null;
    protected ?Location $effectivePickupLocation = null;
    protected ?User $givenByUser = null;
    protected ?Location $effectiveDropoffLocation = null;
    protected ?User $collectedByUser = null;

    public function __construct(
        ?int $reservation_id = null,
        // TODO: use Carbon type
        ?string $pickupDate = null,
        // TODO: use Carbon type
        ?string $dropoffDate = null,
        // TODO: use Carbon type
        ?string $pickupTime = null,
        // TODO: use Carbon type
        ?string $dropoffTime = null,
        // TODO: use Carbon type
        ?float $totalPrice = null,
        ?string $submittedTimestamp = null,

        ?int $billingAddress_id = null,
        ?int $creditCard_id = null,
        ?int $submittedByUser_id = null,
        ?int $category_id = null,
        ?int $customer_id = null,
        ?int $status_id = null,
        ?int $pickupLocation_id = null,
        ?int $dropoffLocation_id = null,
        ?int $vehicle_id = null,

        ?int $effectivePickupLocation_id = null,
        ?int $givenByUser_id = null,
        // TODO: use Carbon type
        ?string $effectivePickupDate = null,
        // TODO: use Carbon type
        ?string $effectivePickupTime = null,

        ?int $effectiveDropoffLocation_id = null,
        ?int $collectedByUser_id = null,
        // TODO: use Carbon type
        ?string $effectiveDropoffDate = null,
        // TODO: use Carbon type
        ?string $effectiveDropoffTime = null,

        ?Reservation $reservation = null,
        ?Address $billingAddress = null,
        ?CreditCard $creditCard = null,
        ?User $submittedByUser = null,
        ?Category $category = null,
        ?Customer $customer = null,
        ?Status $status = null,
        ?Location $pickupLocation = null,
        ?Location $dropoffLocation = null,
        ?Vehicle $vehicle = null,
        ?Location $effectivePickupLocation = null,
        ?User $givenByUser = null,
        ?Location $effectiveDropoffLocation = null,
        ?User $collectedByUser = null
    ) {
        $this->tableName = 'revision';

        if ($reservation_id !== null) {
            $this->reservation_id = $reservation_id;
        }

        // TODO: use Carbon type
        if ($pickupDate !== null) {
            $this->pickupDate = $pickupDate;
        }
        // TODO: use Carbon type
        if ($dropoffDate !== null) {
            $this->dropoffDate = $dropoffDate;
        }
        // TODO: use Carbon type
        if ($pickupTime !== null) {
            $this->pickupTime = $pickupTime;
        }
        // TODO: use Carbon type
        if ($dropoffTime !== null) {
            $this->dropoffTime = $dropoffTime;
        }
        if ($totalPrice !== null) {
            $this->totalPrice = $totalPrice;
        }
        // TODO: use Carbon type
        if ($submittedTimestamp !== null) {
            $this->submittedTimestamp = $submittedTimestamp;
        }

        if ($billingAddress_id !== null) {
            $this->billingAddress_id = $billingAddress_id;
        }
        if ($creditCard_id !== null) {
            $this->creditCard_id = $creditCard_id;
        }
        if ($submittedByUser_id !== null) {
            $this->submittedByUser_id = $submittedByUser_id;
        }
        if ($category_id !== null) {
            $this->category_id = $category_id;
        }
        if ($customer_id !== null) {
            $this->customer_id = $customer_id;
        }
        if ($status_id !== null) {
            $this->status_id = $status_id;
        }
        if ($pickupLocation_id !== null) {
            $this->pickupLocation_id = $pickupLocation_id;
        }
        if ($dropoffLocation_id !== null) {
            $this->dropoffLocation_id = $dropoffLocation_id;
        }
        if ($vehicle_id !== null) {
            $this->vehicle_id = $vehicle_id;
        }

        if ($effectiveDropoffLocation_id !== null) {
            $this->effectiveDropoffLocation_id = $effectiveDropoffLocation_id;
        }
        if ($collectedByUser_id !== null) {
            $this->collectedByUser_id = $collectedByUser_id;
        }

        // TODO: use Carbon type
        if ($effectiveDropoffDate !== null) {
            $this->effectiveDropoffDate = $effectiveDropoffDate;
        }
        // TODO: use Carbon type
        if ($effectiveDropoffTime !== null) {
            $this->effectiveDropoffTime = $effectiveDropoffTime;
        }
        if ($reservation !== null) {
            $this->reservation = $reservation;
        }
        if ($billingAddress !== null) {
            $this->billingAddress = $billingAddress;
        }
        if ($creditCard !== null) {
            $this->creditCard = $creditCard;
        }
        if ($submittedByUser !== null) {
            $this->submittedByUser = $submittedByUser;
        }
        if ($category !== null) {
            $this->category = $category;
        }
        if ($customer !== null) {
            $this->customer = $customer;
        }
        if ($status !== null) {
            $this->status = $status;
        }
        if ($pickupLocation !== null) {
            $this->pickupLocation = $pickupLocation;
        }
        if ($dropoffLocation !== null) {
            $this->dropoffLocation = $dropoffLocation;
        }
        if ($vehicle !== null) {
            $this->vehicle = $vehicle;
        }
        if ($givenByUser !== null) {
            $this->givenByUser = $givenByUser;
        }
        if ($effectiveDropoffLocation !== null) {
            $this->effectiveDropoffLocation = $effectiveDropoffLocation;
        }
        if ($collectedByUser !== null) {
            $this->collectedByUser = $collectedByUser;
        }
    }

    /**
     * Get the value of pickupDate
     * 
     * @return string
     */ 
    public function getPickupDate(): string
    {
        return $this->pickupDate;
    }

    /**
     * Set the value of pickupDate
     *
     * @return self
     */ 
    public function setPickupDate(string $pickupDate): self
    {
        $this->pickupDate = $pickupDate;

        return $this;
    }

    /**
     * Get the value of dropoffDate
     * 
     * @return string
     */ 
    public function getDropoffDate(): string
    {
        return $this->dropoffDate;
    }

    /**
     * Set the value of dropoffDate
     *
     * @return self
     */ 
    public function setDropoffDate(string $dropoffDate): self
    {
        $this->dropoffDate = $dropoffDate;

        return $this;
    }

    /**
     * Get the value of pickupTime
     * 
     * @return string
     */ 
    public function getPickupTime(): string
    {
        return $this->pickupTime;
    }

    /**
     * Set the value of pickupTime
     *
     * @return self
     */ 
    public function setPickupTime(string $pickupTime): self
    {
        $this->pickupTime = $pickupTime;

        return $this;
    }

    /**
     * Get the value of dropoffTime
     * 
     * @return string
     */ 
    public function getDropoffTime(): string
    {
        return $this->dropoffTime;
    }

    /**
     * Set the value of dropoffTime
     *
     * @return self
     */ 
    public function setDropoffTime(string $dropoffTime): self
    {
        $this->dropoffTime = $dropoffTime;

        return $this;
    }

    /**
     * Get the value of totalPrice
     * 
     * @return float
     */ 
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * Get the value of totalPrice as a string
     * 
     * @return string
     */ 
    public function getTotalPriceToString(): string
    {
        return convertNumToEuros($this->totalPrice);
    }

    /**
     * Calculate and set the the value of totalPrice
     *
     * @return self
     */ 
    public function calculateAndSetTotalPrice(): self
    {
        try {
            $category = Category::find($this->category_id);
            $this->totalPrice = calculateTotalPrice(
                $category->getDailyRate(), 
                $this->pickupDate, 
                $this->dropoffDate
            );
        } catch(e) {
            // TODO: error handling
        }

        return $this;
    }

    /**
     * Get the value of submittedTimestamp
     * 
     * @return string
     */ 
    public function getSubmittedTimestamp(): string
    {
        return $this->submittedTimestamp;
    }

    /**
     * Set the value of submittedTimestamp
     *
     * @return self
     */ 
    public function setSubmittedTimestamp(string $submittedTimestamp): self
    {
        $this->submittedTimestamp = $submittedTimestamp;

        return $this;
    }

    /**
     * Get the value of billingAddress_id
     * 
     * @return int
     */ 
    public function getBillingAddress_id(): int
    {
        return $this->billingAddress_id;
    }

    /**
     * Set the value of billingAddress_id
     *
     * @return self
     */ 
    public function setBillingAddress_id(int $billingAddress_id): self
    {
        $this->billingAddress_id = $billingAddress_id;

        return $this;
    }

    /**
     * Get the value of creditCard_id
     * 
     * @return int
     */ 
    public function getCreditCard_id(): int
    {
        return $this->creditCard_id;
    }

    /**
     * Set the value of creditCard_id
     *
     * @return self
     */ 
    public function setCreditCard_id(int $creditCard_id): self
    {
        $this->creditCard_id = $creditCard_id;

        return $this;
    }

    /**
     * Get the value of submittedByUser_id
     * 
     * @return ?int
     */ 
    public function getSubmittedByUser_id(): ?int
    {
        return $this->submittedByUser_id;
    }

    /**
     * Set the value of submittedByUser_id
     *
     * @return self
     */ 
    public function setSubmittedByUser_id(int $submittedByUser_id): self
    {
        $this->submittedByUser_id = $submittedByUser_id;

        return $this;
    }

    /**
     * Get the value of category_id
     * 
     * @return int
     */ 
    public function getCategory_id(): int
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return self
     */ 
    public function setCategory_id(int $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Get the value of customer_id
     * 
     * @return int
     */ 
    public function getCustomer_id(): int
    {
        return $this->customer_id;
    }

    /**
     * Set the value of customer_id
     *
     * @return self
     */ 
    public function setCustomer_id(int $customer_id): self
    {
        $this->customer_id = $customer_id;

        return $this;
    }

    /**
     * Get the value of status_id
     * 
     * @return int
     */ 
    public function getStatus_id(): int
    {
        return $this->status_id;
    }

    /**
     * Set the value of status_id
     *
     * @return self
     */ 
    public function setStatus_id(int $status_id): self
    {
        $this->status_id = $status_id;

        return $this;
    }

    /**
     * Get the value of dropoffLocation_id
     * 
     * @return int
     */ 
    public function getDropoffLocation_id(): int
    {
        return $this->dropoffLocation_id;
    }

    /**
     * Set the value of dropoffLocation_id
     *
     * @return self
     */ 
    public function setDropoffLocation_id(int $dropoffLocation_id): self
    {
        $this->dropoffLocation_id = $dropoffLocation_id;

        return $this;
    }

    /**
     * Get the value of vehicle_id
     * 
     * @return ?int
     */ 
    public function getVehicle_id(): ?int
    {
        return $this->vehicle_id;
    }

    /**
     * Set the value of vehicle_id
     *
     * @return self
     */ 
    public function setVehicle_id(int $vehicle_id): self
    {
        $this->vehicle_id = $vehicle_id;

        return $this;
    }

    /**
     * Get the value of effectiveDropoffLocation_id
     * 
     * @return int
     */ 
    public function getEffectiveDropoffLocation_id(): int
    {
        return $this->effectiveDropoffLocation_id;
    }

    /**
     * Set the value of effectiveDropoffLocation_id
     *
     * @return self
     */ 
    public function setEffectiveDropoffLocation_id(int $effectiveDropoffLocation_id): self
    {
        $this->effectiveDropoffLocation_id = $effectiveDropoffLocation_id;

        return $this;
    }

    /**
     * Get the value of collectedByUser_id
     * 
     * @return ?int
     */ 
    public function getCollectedByUser_id(): ?int
    {
        return $this->collectedByUser_id;
    }

    /**
     * Set the value of collectedByUser_id
     *
     * @return self
     */ 
    public function setCollectedByUser_id(int $collectedByUser_id): self
    {
        $this->collectedByUser_id = $collectedByUser_id;

        return $this;
    }

    /**
     * Get the value of effectiveDropoffDate
     * 
     * @return ?string
     */ 
    public function getEffectiveDropoffDate(): ?string
    {
        return $this->effectiveDropoffDate;
    }

    /**
     * Set the value of effectiveDropoffDate
     *
     * @return self
     */ 
    public function setEffectiveDropoffDate(string $effectiveDropoffDate): self
    {
        $this->effectiveDropoffDate = $effectiveDropoffDate;

        return $this;
    }

    /**
     * Get the value of effectiveDropoffTime
     * 
     * @return ?string
     */ 
    public function getEffectiveDropoffTime(): ?string
    {
        return $this->effectiveDropoffTime;
    }

    /**
     * Set the value of effectiveDropoffTime
     *
     * @return self
     */ 
    public function setEffectiveDropoffTime(string $effectiveDropoffTime): self
    {
        $this->effectiveDropoffTime = $effectiveDropoffTime;

        return $this;
    }

    /**
     * Get the value of billingAddress
     * 
     * @return Address
     */ 
    public function getBillingAddress(): Address
    {
        return $this->billingAddress;
    }

    /**
     * Set the value of billingAddress
     *
     * @return self
     */ 
    public function setBillingAddress(Address $billingAddress): self
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    /**
     * Get the value of creditCard
     * 
     * @return CreditCard
     */ 
    public function getCreditCard(): CreditCard
    {
        return $this->creditCard;
    }

    /**
     * Set the value of creditCard
     *
     * @return self
     */ 
    public function setCreditCard(CreditCard $creditCard): self
    {
        $this->creditCard = $creditCard;

        return $this;
    }

    /**
     * Get the value of submittedByUser
     * 
     * @return ?User
     */ 
    public function getSubmittedByUser(): ?User
    {
        return $this->submittedByUser;
    }

    /**
     * Set the value of submittedByUser
     *
     * @return self
     */ 
    public function setSubmittedByUser(User $submittedByUser): self
    {
        $this->submittedByUser = $submittedByUser;

        return $this;
    }

    /**
     * Get the value of category
     * 
     * @return Category
     */ 
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return self
     */ 
    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the value of customer
     * 
     * @return Customer
     */ 
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * Set the value of customer
     *
     * @return self
     */ 
    public function setCustomer(Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get the value of status
     * 
     * @return Status
     */ 
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return self
     */ 
    public function setStatus(Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of pickupLocation
     * 
     * @return Location
     */ 
    public function getPickupLocation(): Location
    {
        return $this->pickupLocation;
    }

    /**
     * Set the value of pickupLocation
     *
     * @return self
     */ 
    public function setPickupLocation(Location $pickupLocation): self
    {
        $this->pickupLocation = $pickupLocation;

        return $this;
    }

    /**
     * Get the value of dropoffLocation
     * 
     * @return Location
     */ 
    public function getDropoffLocation(): Location
    {
        return $this->dropoffLocation;
    }

    /**
     * Set the value of dropoffLocation
     *
     * @return self
     */ 
    public function setDropoffLocation(Location $dropoffLocation): self
    {
        $this->dropoffLocation = $dropoffLocation;

        return $this;
    }

    /**
     * Get the value of vehicle
     * 
     * @return ?Vehicle
     */ 
    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    /**
     * Set the value of vehicle
     *
     * @return self
     */ 
    public function setVehicle(Vehicle $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    /**
     * Get the value of effectiveDropoffLocation
     * 
     * @return ?Location
     */ 
    public function getEffectiveDropoffLocation(): ?Location
    {
        return $this->effectiveDropoffLocation;
    }

    /**
     * Set the value of effectiveDropoffLocation
     *
     * @return self
     */ 
    public function setEffectiveDropoffLocation(Location $effectiveDropoffLocation): self
    {
        $this->effectiveDropoffLocation = $effectiveDropoffLocation;

        return $this;
    }

    /**
     * Get the value of collectedByUser
     * 
     * @return ?User
     */ 
    public function getCollectedByUser(): ?User
    {
        return $this->collectedByUser;
    }

    /**
     * Set the value of collectedByUser
     *
     * @return self
     */ 
    public function setCollectedByUser(User $collectedByUser): self
    {
        $this->collectedByUser = $collectedByUser;

        return $this;
    }

    /**
     * Get the value of reservation
     * 
     * @return Reservation
     */ 
    public function getReservation(): Reservation
    {
        return $this->reservation;
    }

    /**
     * Set the value of reservation
     *
     * @return self
     */ 
    public function setReservation(Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get the value of reservation_id
     * 
     * @return int
     */ 
    public function getReservation_id(): int
    {
        return $this->reservation_id;
    }

    /**
     * Get the value of pickupLocation_id
     */ 
    public function getPickupLocation_id(): int
    {
        return $this->pickupLocation_id;
    }

    /**
     * Set the value of pickupLocation_id
     *
     * @return self
     */ 
    public function setPickupLocation_id($pickupLocation_id)
    {
        $this->pickupLocation_id = $pickupLocation_id;

        return $this;
    }

    /**
     * Get the value of effectivePickupLocation_id
     */ 
    public function getEffectivePickupLocation_id()
    {
        return $this->effectivePickupLocation_id;
    }

    /**
     * Set the value of effectivePickupLocation_id
     *
     * @return  self
     */ 
    public function setEffectivePickupLocation_id($effectivePickupLocation_id)
    {
        $this->effectivePickupLocation_id = $effectivePickupLocation_id;

        return $this;
    }

    /**
     * Get the value of effectivePickupLocation
     */ 
    public function getEffectivePickupLocation()
    {
        return $this->effectivePickupLocation;
    }

    /**
     * Set the value of effectivePickupLocation
     *
     * @return  self
     */ 
    public function setEffectivePickupLocation($effectivePickupLocation)
    {
        $this->effectivePickupLocation = $effectivePickupLocation;

        return $this;
    }

    /**
     * Get the value of givenByUser
     * 
     * @return ?User
     */ 
    public function getGivenByUser(): ?User
    {
        return $this->givenByUser;
    }

    /**
     * Set the value of givenByUser
     *
     * @return  self
     */ 
    public function setGivenByUser($givenByUser)
    {
        $this->givenByUser = $givenByUser;

        return $this;
    }

    /**
     * Get the value of effectivePickupDate
     * 
     * @return ?string
     */ 
    public function getEffectivePickupDate(): ?string
    {
        return $this->effectivePickupDate;
    }

    /**
     * Set the value of effectivePickupDate
     *
     * @return self
     */ 
    public function setEffectivePickupDate($effectivePickupDate)
    {
        $this->effectivePickupDate = $effectivePickupDate;

        return $this;
    }

    /**
     * Get the value of effectivePickupTime
     */ 
    public function getEffectivePickupTime()
    {
        return $this->effectivePickupTime;
    }

    /**
     * Set the value of effectivePickupTime
     *
     * @return  self
     */ 
    public function setEffectivePickupTime($effectivePickupTime)
    {
        $this->effectivePickupTime = $effectivePickupTime;

        return $this;
    }

    /**
     * Get the value of givenByUser_id
     */ 
    public function getGivenByUser_id()
    {
        return $this->givenByUser_id;
    }

    /**
     * Set the value of givenByUser_id
     *
     * @return  self
     */ 
    public function setGivenByUser_id($givenByUser_id)
    {
        $this->givenByUser_id = $givenByUser_id;

        return $this;
    }

    /**
     * Get the the available vehicles for the island,
     * category, and reservation dates
     *
     * @return array
     */ 
    public function findAvailableVehicles(): array
    {
        $this->loadRelation('dropoffLocation', 'location');
        $dropoffLocation = $this->dropoffLocation;
        $dropoffLocation->loadRelation('island');
        $islandId = $dropoffLocation->getIsland()->getId();

        return Vehicle::findAvailableVehicles(
            $this->category_id,
            $islandId,
            $this->pickupDate,
            $this->dropoffDate
        );
    }

    /**
     * Load revision's Status
     *
     * @return self
     */ 
    public function loadStatus(): self
    {
        try {
            $this->loadRelation('status');
        } catch(e) {

        }
        return $this;
    }

    /**
     * Load revision's Status
     *
     * @return self
     */ 
    public function loadCreditCard(): self
    {
        try {
            $this->loadRelation('creditCard');
        } catch(e) {

        }
        return $this;
    }

    /**
     * Load revision's Category
     *
     * @return self
     */ 
    public function loadCategory(): self
    {
        try {
            $this->loadRelation('category');
        } catch(e) {

        }
        
        return $this;
    }

    /**
     * Load revision's Reservation
     *
     * @return self
     */ 
    public function loadReservation(): self
    {
        try {
            $this->loadRelation('reservation');
        } catch(e) {

        }
        
        return $this;
    }

    /**
     * Load revision's Customer
     *
     * @return self
     */ 
    public function loadCustomer(): self
    {
        try {
            $this->loadRelation('customer');
        } catch(e) {

        }
        
        return $this;
    }

    /**
     * Load revision's Customer
     *
     * @return self
     */ 
    public function loadBillingAddress(): self
    {
        try {
            $this->loadRelation('billingAddress', 'address');
        } catch(e) {

        }
        
        return $this;
    }

    /**
     * Load revision's pickup Location
     *
     * @return self
     */ 
    public function loadPickupLocation(): self
    {
        try {
            $this->loadRelation('pickupLocation', 'location');
        } catch(e) {
        
        }
        
        return $this;
    }

    /**
     * Load revision's effective pickup Location
     *
     * @return self
     */ 
    public function loadEffectivePickupLocation(): self
    {
        try {
            if ($this->effectivePickupLocation_id !== null) {
                $this->loadRelation('effectivePickupLocation', 'location');
            }
        } catch(e) {
        
        }
        
        return $this;
    }

    /**
     * Load revision's dropoff Location
     *
     * @return self
     */ 
    public function loadDropoffLocation(): self
    {
        try {
            $this->loadRelation('dropoffLocation', 'location');
        } catch(e) {
        
        }
        
        return $this;
    }

    /**
     * Load revision's effective dropoff Location
     *
     * @return self
     */ 
    public function loadEffectiveDropoffLocation(): self
    {
        try {
            if ($this->effectiveDropoffLocation_id !== null) {
                $this->loadRelation('effectiveDropoffLocation', 'location');
            }
        } catch(e) {
        
        }
        
        return $this;
    }

    /**
     * Load revision's Vehicle
     *
     * @return self
     */ 
    public function loadVehicle(): self
    {
        try {
            if ($this->vehicle_id !== null) {
                $this->loadRelation('vehicle');
            }
        } catch(e) {

        }
        
        return $this;
    }

    /**
     * Load all revision's relations
     *
     * @return self
     */ 
    public function loadAllRelations(): self
    {
        try {
            $this
                ->loadReservation()
                ->loadCategory()
                ->loadStatus()
                ->loadVehicle()
                ->loadPickupLocation()
                ->loadDropoffLocation()
                ->loadEffectivePickupLocation()
                ->loadEffectiveDropoffLocation()
                ->loadCustomer()
                ->loadBillingAddress()
                ->loadCreditCard()
                ->loadRelation('submittedByUser', 'user')
                ->loadRelation('givenByUser', 'user')
                ->loadRelation('collectedByUser', 'user')
                ->getCustomer()
                ->loadRelation('user')
                ->loadRelation('address')
                ->getAddress()
                ->loadRelation('country');
            $this
                ->getCustomer()
                ->loadRelation('user')
                ->getUser()
                ->loadRelation('address')
                ->getAddress()
                ->loadRelation('country');
            $this
                ->getBillingAddress()
                ->loadRelation('country');
        } catch(e) {

        }
        
        return $this;
    }

    /**
     * Fetch all latest revisions
     *
     * @return array
     */ 
    public static function fetchAllLatestRevisions(): array
    {
        try {
            $revisions = [];
            $stmt = Revision::rawSQL("
                SELECT revision.* FROM revision
                LEFT OUTER JOIN (
                    SELECT reservation_id, max(submittedTimestamp) as maxSubmittedTimestamp
                        FROM revision
                        GROUP BY reservation_id
                ) latestRevision
                ON revision.reservation_id = latestRevision.reservation_id
                WHERE revision.submittedTimestamp = latestRevision.maxSubmittedTimestamp;
            ");
            while($row = $stmt->fetchObject(Revision::class)) {
                $revisions[] = $row;
            }
        } catch(e) {

        }

        return $revisions;
    }

    /**
     * Update category on active revisions 
     *
     * @return array
     */ 
    public static function updateActiveRevisionsCategory(int $categoryIdBefore, int $categoryIdAfter): array
    {
        try {
            $revisions = [];
            $stmt = Revision::rawSQL("
                UPDATE revision r
                LEFT OUTER JOIN (
                    SELECT reservation_id, max(submittedTimestamp) as maxSubmittedTimestamp
                        FROM revision
                        GROUP BY reservation_id
                ) latestRevision
                ON r.reservation_id = latestRevision.reservation_id
                LEFT OUTER JOIN status s
                ON r.status_id=s.id
                SET r.category_id=$categoryIdAfter
                WHERE r.submittedTimestamp = latestRevision.maxSubmittedTimestamp
                AND r.category_id=$categoryIdBefore
                AND r.pickupDate > CURRENT_DATE()
                AND s.statusName != 'Cancelled'
                AND s.statusName != 'Modification Declined'
                AND s.statusName != 'Payment Declined';
            ");
            while($row = $stmt->fetchObject(Revision::class)) {
                $revisions[] = $row;
            }
        } catch(e) {

        }

        return $revisions;
    }

    /**
     * Save revision as a new db row
     *
     * @return self
     */ 
    public function update(): self
    {
        try {
            $this->id = null;
            $this->submittedTimestamp = date("Y-m-d H:i:s", time());
            $this->submittedByUser_id = $_SESSION['logged_id'];
            $this->save();
        } catch(e) {

        }
        return $this;
    }
}