<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/DBModel.php';

class Category {
    use DBModel;

    protected ?string $name = null;
    protected ?string $description = null;
    protected ?array $properties = null;
    protected ?float $dailyRate = null;

    public function __construct(
        ?string $name = null,
        ?string $description = null,
        ?array $properties = null,
        ?float $dailyRate = null,
        ?int $id = null
    ) {
        $this->tableName = 'category';
        
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