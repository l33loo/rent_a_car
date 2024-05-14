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
    
    protected int $locationid;
    protected string $name;
    protected Address $address;
    protected Island $island;

    public function __construct(int $id,string $name, Address $address, Island $island) {
        $this->locationid = $id;
        $this->name = $name;
        $this->address = $address;
        $this->island = $island;
    }

    /**
     * Get the value of id
     */ 
    public function getId(): int
    {
        return $this->locationid;
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

    /**
     * Get the value of name
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}

$filter = [
    [
        'column' => 'id',
        'operator' => '=',
        'value' => $_POST['location']
    ]
];

try {
    $locations = Location::search($filter);

    foreach ($locations as $location) {
        echo $location->getId();
    }
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
 }