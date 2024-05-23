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
// submittedByUser_id INT UNSIGNED NOT NULL,
// submittedTimestamp TIMESTAMP,
// -- To be added by admin when customer returns the car
// dateReturned DATE,
// -- To be added by admin when customer returns the car
// timeReturned TIME,
// -- To be added by admin when customer returns the car
// returnedLocation_id INT UNSIGNED,
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
    protected ?int $returnedLocation_id = null;
    protected ?int $collectedByUser_id = null;

    // TODO: use Carbon type
    protected ?string $dateReturned = null;
    // TODO: use Carbon type
    protected ?string $timeReturned = null;
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
    protected ?Location $returnedLocation = null;
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
        ?int $returnedLocation_id = null,
        ?int $collectedByUser_id = null,

        // TODO: use Carbon type
        ?string $dateReturned = null,
        // TODO: use Carbon type
        ?string $timeReturned = null,
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
        ?Location $returnedLocation = null,
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
        if ($returnedLocation_id !== null) {
            $this->returnedLocation_id = $returnedLocation_id;
        }
        if ($collectedByUser_id !== null) {
            $this->collectedByUser_id = $collectedByUser_id;
        }

        // TODO: use Carbon type
        if ($dateReturned !== null) {
            $this->dateReturned = $dateReturned;
        }
        // TODO: use Carbon type
        if ($timeReturned !== null) {
            $this->timeReturned = $timeReturned;
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
        if ($returnedLocation !== null) {
            $this->returnedLocation = $returnedLocation;
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
     * Set the value of totalPrice
     *
     * @return self
     */ 
    public function setTotalPrice(float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

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
     * @return int
     */ 
    public function getSubmittedByUser_id(): int
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
     * @return int
     */ 
    public function getVehicle_id(): int
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
     * Get the value of returnedLocation_id
     * 
     * @return int
     */ 
    public function getReturnedLocation_id(): int
    {
        return $this->returnedLocation_id;
    }

    /**
     * Set the value of returnedLocation_id
     *
     * @return self
     */ 
    public function setReturnedLocation_id(int $returnedLocation_id): self
    {
        $this->returnedLocation_id = $returnedLocation_id;

        return $this;
    }

    /**
     * Get the value of collectedByUser_id
     * 
     * @return int
     */ 
    public function getCollectedByUser_id(): int
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
     * Get the value of dateReturned
     * 
     * @return string
     */ 
    public function getDateReturned(): string
    {
        return $this->dateReturned;
    }

    /**
     * Set the value of dateReturned
     *
     * @return self
     */ 
    public function setDateReturned(string $dateReturned): self
    {
        $this->dateReturned = $dateReturned;

        return $this;
    }

    /**
     * Get the value of timeReturned
     * 
     * @return string
     */ 
    public function getTimeReturned(): string
    {
        return $this->timeReturned;
    }

    /**
     * Set the value of timeReturned
     *
     * @return self
     */ 
    public function setTimeReturned(string $timeReturned): self
    {
        $this->timeReturned = $timeReturned;

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
     * @return User
     */ 
    public function getSubmittedByUser(): User
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
     * @return Vehicle
     */ 
    public function getVehicle(): Vehicle
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
     * Get the value of returnedLocation
     * 
     * @return Location
     */ 
    public function getReturnedLocation(): Location
    {
        return $this->returnedLocation;
    }

    /**
     * Set the value of returnedLocation
     *
     * @return self
     */ 
    public function setReturnedLocation(Location $returnedLocation): self
    {
        $this->returnedLocation = $returnedLocation;

        return $this;
    }

    /**
     * Get the value of collectedByUser
     * 
     * @return User
     */ 
    public function getCollectedByUser(): User
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
}