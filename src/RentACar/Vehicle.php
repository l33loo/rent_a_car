<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/DBModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Island.php';

use RentACar\Category;
use RentACar\DBModel;
use RentACar\Island;

class Vehicle {
    use DBModel;

    protected ?string $plate = null;
    // protected ?Category $category = null;
    protected ?int $category_id = null;
    // protected ?array $properties = null;
    protected bool $rentable = false;
    // protected ?Island $island = null;
    protected ?int $island_id = null;
    protected ?float $dailyRate = null;


    public function __construct(
        ?string $plate = null,
        // ?Category $category = null,
        // ?array $properties = null,
        ?bool $rentable = null,
        // ?Island $island = null,
        ?int $island_id = null,
        ?float $dailyRate = null
    ) {
        // $this->id = $id;
        if ($plate !== null ) {
            $this->plate = $plate;
        }
        // $this->category = $category;
        // $this->properties = $properties;
        if ($rentable !== null) {
            $this->rentable = $rentable;
        }
        // $this->island = $island;
        if ($dailyRate !== null) {
            $this->dailyRate = $dailyRate;
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
     * Get the value of dailyRate
     */ 
    public function getDailyRate(): float
    {
        return $this->dailyRate;
    }

    /**
     * Set the value of dailyRate
     *
     * @return  self
     */ 
    public function setDailyRate(float $dailyRate): self
    {
        $this->dailyRate = $dailyRate;

        return $this;
    }
}