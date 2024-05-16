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
    protected ?Category $category = null;
    protected ?int $category_id = null;
    protected ?array $properties = null;
    protected ?bool $rentable = null;
    protected ?Island $island = null;
    protected ?int $island_id = null;
    protected ?float $dailyRate = null;


    public function __construct(
        ?string $plate = null,
        ?float $dailyRate = null,
        ?bool $rentable = null,
        ?int $island_id = null,
        ?int $category_id = null,
        ?Island $island = null,
        ?Category $category = null,
        ?array $properties = null,
    ) {
        if ($plate !== null ) {
            $this->plate = $plate;
        }

        if ($dailyRate !== null) {
            $this->dailyRate = $dailyRate;
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