<?php
namespace RentACar;

use RentACar\MyConnect;
use RentACar\DBModel;
use RentACar\Island;

require_once "Island.php";
require_once "MyConnect.php";
require_once 'DBModel.php';

class Location {
    use DBModel;
    
    protected string $name;
    protected Address $address;
    protected Island $island;
    protected ?int $address_id = null;
    protected ?int $island_id = null;

    public function __construct(string $name) {
        $this->name = $name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     * @return self
     */ 
    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the value of address
     */ 
    public function getAddress(): Address {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @param Address $address
     * @return self
     */ 
    public function setAddress(Address $address): self {
        $this->address = $address;
        return $this;
    }

    /**
     * Get the value of island
     */ 
    public function getIsland(): Island {
        return $this->island;
    }

    public function getName(): string {
        return $this->name;
    }
}