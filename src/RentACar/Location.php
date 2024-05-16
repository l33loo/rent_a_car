<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/DBModel.php';

class Location {
    use DBModel;

    protected ?Address $address = null;
    protected ?Island $island = null;

    public function __construct(
        ?Address $address = null,
        ?Island $island = null,
        ?int $id = null
    ) {
        $this->tableName = 'location';

        $this->id = $id;
        $this->address = $address;
        $this->island = $island;
    }

    /**
     * Get the value of id
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of address
     */ 
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */ 
    public function setAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of island
     */ 
    public function getIsland(): Island
    {
        return $this->island;
    }

    /**
     * Set the value of island
     *
     * @return  self
     */ 
    public function setIsland(Island $island): self
    {
        $this->island = $island;

        return $this;
    }
}