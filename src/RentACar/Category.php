<?php
namespace fleet;

class Category {
    protected int $id;
    protected string $name;
    protected string $description;
    protected array $properties;
    protected float $dailyRate;

    public function __construct(
        int $id,
        string $name,
        string $description,
        array $properties,
        float $dailyRate
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->properties = $properties;
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
     * Get the value of name
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Get the value of properties
     */ 
    public function getProperties(): array
    {
        return $this->properties;
    }
}