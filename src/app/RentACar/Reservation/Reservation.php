<?php
// TODO: make property names match db columns
namespace reservation;

class Reservation {
    protected int $id;
    protected fleets\Category $category;
    protected accounts\Customer $customer;
    protected Status $status;
    protected locality\Location $pickupLocation;
    protected locality\Location $dropoffLocation;
    // TODO: use Carbon type
    protected string $pickupDate;
    // TODO: use Carbon type
    protected string $dropoffDate;
    // TODO: use Carbon type
    protected string $pickupTime;
    // TODO: use Carbon type
    protected string $dropoffTime;
    protected fleets\Vehicle $vehicle;
    protected accounts\User $reservedBy;
    // TODO: use Carbon type
    protected string $reservedDate;
    // TODO: Update UML to reflect this
    protected array $revisions;
    // TODO: use Carbon type
    protected string $dateReturned;
    // TODO: use Carbon type
    protected string $timeReturned;
    protected locality\Location $returnedLocation;
    protected accounts\User $collectedBy;

    public function __construct(
        int $id,
        fleet\Category $category,
        accounts\Customer $customer,
        Status $status,
        locality\Location $pickupLocation,
        locality\Location $dropoffLocation,
        // TODO: use Carbon type
        string $pickupDate,
        // TODO: use Carbon type
        string $dropoffDate,
        // TODO: use Carbon type
        string $pickupTime,
        // TODO: use Carbon type
        string $dropoffTime,
        fleets\Vehicle $vehicle,
        accounts\User $reservedBy,
        // TODO: use Carbon type
        string $reservedDate,
        // TODO: Update UML to reflect this
        array $revisions,
        // TODO: use Carbon type
        string $dateReturned,
        // TODO: use Carbon type
        string $timeReturned,
        locality\Location $returnedLocation,
        accounts\User $collectedBy
    ) {
        $this->id = $id;
        $this->category = $category;
        $this->customer = $customer;
        $this->status = $status;
        $this->pickupLocation = $pickupLocation;
        $this->dropoffLocation = $dropoffLocation;
        // TODO: use Carbon type
        $this->pickupDate = $pickupDate;
        // TODO: use Carbon type
        $this->dropoffDate = $dropoffDate;
        // TODO: use Carbon type
        $this->pickupTime = $pickupTime;
        // TODO: use Carbon type
        $this->dropoffTime = $dropoffTime;
        $this->vehicle = $vehicle;
        $this->reservedBy = $reservedBy;
        // TODO: use Carbon type
        $this->reservedDate = $reservedDate;
        // TODO: Update UML to reflect this
        $this->revisions = $revisions;
        // TODO: use Carbon type
        $this->dateReturned = $dateReturned;
        // TODO: use Carbon type
        $this->timeReturned = $timeReturned;
        $this->returnedLocation = $returnedLocation;
        $this->collectedBy = $collectedBy;
    }
}