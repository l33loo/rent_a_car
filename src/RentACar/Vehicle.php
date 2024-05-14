<?php
namespace RentACar;

class Vehicle {
    protected int $id;
    protected string $plate;
    protected Category $category;
    protected array $properties;
    protected bool $rentable;
    protected locality\Island $island;
    protected float $dailyRate;

    public function __construct(
        int $id,
        string $plate,
        Category $category,
        array $properties,
        bool $rentable,
        locality\Island $island,
        float $dailyRate
    ) {
        $this->id = $id;
        $this->plate = $plate;
        $this->categroy = $category;
        $this->properties = $properties;
        $this->rentable = $rentable;
        $this->island = $island;
        $this->dailyRate = $dailyRate;
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
    public function getIsland(): locality\Island
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