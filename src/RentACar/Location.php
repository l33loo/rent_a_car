<?php
namespace RentACar;
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/DBModel.php';

class Location {
    use DBModel;

    protected ?string $name = null;
    protected ?Address $address = null;
    protected ?int $address_id = null;
    protected ?Island $island = null;
    protected ?int $island_id = null;
    protected ?bool $isArchived = null;

    public function __construct(
        ?string $name = null,
        ?int $address_id = null,
        ?int $island_id = null,
        ?bool $isArchived = null,
        ?Address $address = null,
        ?Island $island = null,
        ?int $id = null
    ) {
        $this->tableName = 'location';

        if ($id !== null) {
            $this->id = $id;
        }

        if ($name !== null) {
            $this->name = $name;
        }
        
        if ($address !== null) {
            $this->address = $address;
        }
        
        if ($island !== null) {
            $this->island = $island;
        }

        if ($address_id !== null) {
            $this->address_id = $address_id;
        }
        
        if ($island_id !== null) {
            $this->island_id = $island_id;
        }

        if ($isArchived !== null) {
            $this->isArchived = $isArchived;
        }
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

    /**
     * Get the value of address_id
     */ 
    public function getAddress_id()
    {
            return $this->address_id;
    }

    /**
     * Set the value of address_id
     *
     * @return  self
     */ 
    public function setAddress_id($address_id)
    {
            $this->address_id = $address_id;

            return $this;
    }

    /**
     * Get the value of island_id
     */ 
    public function getIsland_id()
    {
        return $this->island_id;
    }

    /**
     * Set the value of island_id
     *
     * @return  self
     */ 
    public function setIsland_id($island_id)
    {
        $this->island_id = $island_id;

        return $this;
    }

    /**
     * Get the value of isArchived
     */ 
    public function getIsArchived()
    {
        return $this->isArchived;
    }

    /**
     * Set the value of isArchived
     *
     * @return  self
     */ 
    public function setIsArchived($isArchived)
    {
        $this->isArchived = $isArchived;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
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