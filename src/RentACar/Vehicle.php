<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/DBModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Island.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Property.php';

use RentACar\Category;
use RentACar\Island;
use RentACar\Property;

class Vehicle {
    use DBModel;

    protected ?string $plate = null;
    protected ?bool $rentable = null;
    protected ?int $island_id = null;
    protected ?int $category_id = null;
    protected ?Island $island = null;
    protected ?Category $category = null;
    protected ?array $properties = null;
    protected ?bool $isArchived = null;

    public function __construct(
        ?string $plate = null,
        ?bool $rentable = null,
        ?int $island_id = null,
        ?int $category_id = null,
        ?Island $island = null,
        ?Category $category = null,
        ?array $properties = null,
        ?bool $isArchived = null
    ) {
        $this->tableName = 'vehicle';

        if ($plate !== null ) {
            $this->plate = $plate;
        }

        if ($rentable !== null) {
            $this->rentable = $rentable;
        }    

        if ($category !== null) {
            $this->category = $category;
        }

        if ($category_id !== null) {
            $this->category_id = $category_id;
        }

        if ($island !== null) {
            $this->island = $island;
        }

        if ($island_id !== null) {
            $this->island_id = $island_id;
        }
        
        if ($properties !== null) {
            $this->properties = $properties;
        }

        if ($isArchived !== null) {
            $this->isArchived = $isArchived;
        }
    }

    /**
     * Get the value of id
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of plate
     */ 
    public function getPlate(): string
    {
        return $this->plate;
    }

    /**
     * Set the value of plate
     *
     * @return  self
     */ 
    public function setPlate(string $plate): self
    {
        $this->plate = $plate;

        return $this;
    }

    /**
     * Get the value of category
     */ 
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * Get the value of properties
     */ 
    public function getProperties(): array
    {
        return $this->properties;
    }

      /**
     * Set the value of properties
     *
     * @return self
     */ 
    public function setProperties($properties): self
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * Get the value of properties
     * @return self
     */ 
    public function loadProperties(): self
    {
        try {
            $vehicleId = $this->id;
            $stmt = self::rawSQL("
                SELECT p.id, p.name, vp.propertyValue FROM property p
                LEFT OUTER JOIN vehicle_property vp ON vp.property_id = p.id
                WHERE vp.vehicle_id = $vehicleId;
            ");

            $results = [];
            while($row = $stmt->fetchObject(Property::class)) {
                $results[] = $row;
            }
            $this->properties = $results;
        } catch(e) {
            // TODO: error handling
        }
        
        return $this;
    }

    /**
     * Get the value of rentable
     */ 
    public function getRentable(): bool
    {
        return $this->rentable;
    }

    /**
     * Set the value of rentable
     *
     * @return  self
     */ 
    public function setRentable(bool $rentable): self
    {
        $this->rentable = $rentable;

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
     * Get the value of isArchived
     */ 
    public function getIsArchived(): bool
    {
        return $this->isArchived;
    }

    /**
     * Set the value of isArchived
     *
     * @return  self
     */ 
    public function setIsArchived($isArchived): self
    {
        $this->isArchived = $isArchived;

        return $this;
    }

    /**
     * Get the value of island_id
     */ 
    public function getIsland_id(): int
    {
        return $this->island_id;
    }

    /**
     * Set the value of island_id
     *
     * @return  self
     */ 
    public function setIsland_id(int $island_id): self
    {
        $this->island_id = $island_id;

        return $this;
    }

    /**
     * Get the value of category_id
     */ 
    public function getCategory_id(): int
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */ 
    public function setCategory_id(int $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }
}