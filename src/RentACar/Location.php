<?php
namespace locality;

class Location {
    protected int $id;
    protected Address $address;
    protected Island $island;

    public function __construct(int $id, Address $address, Island $island) {
        $this->id;
        $this->$address;
        $this->$island;
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