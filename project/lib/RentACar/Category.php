<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/util/helpers.php';

class Category
{
    use DBModel;
    use PropertiesTrait;
    use FormValidatorTrait;

    protected ?string $name = null;
    protected ?string $description = null;
    protected ?float $dailyRate = null;
    protected ?bool $isArchived = null;

    public function __construct(
        ?string $name = null,
        ?string $description = null,
        ?array $properties = null,
        ?float $dailyRate = null,
        ?bool $isArchived = null,
        ?int $id = null
    ) {
        $this->tableName = 'category';
        
        if ($name !== null) {
            $this->name = $name;
        }

        if ($description !== null) {
            $this->description = $description;
        }

        if ($properties !== null) {
            $this->properties = $properties;
        }

        if ($dailyRate !== null) {
            $this->dailyRate = $dailyRate;
        }

        if ($isArchived !== null) {
            $this->isArchived = $isArchived;
        }
    }

    /**
     * Get the value of id
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return self
     */ 
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of isArchived
     * 
     * @return bool
     */ 
    public function getIsArchived(): bool
    {
        return $this->isArchived;
    }

    /**
     * Set the value of isArchived
     *
     * @return self
     */ 
    public function setIsArchived($isArchived): self
    {
        $this->isArchived = $isArchived;

        return $this;
    }

    public function getObjectVars(): array
    {
        return get_object_vars($this);
    }

    /**
     * Get the value of properties
     * @return self
     */ 
    public function loadProperties(): self
    {
        try {
            $categoryId = $this->id;
            $stmt = self::rawSQL("
                SELECT p.id, p.name, cp.propertyValue FROM property p
                LEFT OUTER JOIN category_property cp ON cp.property_id = p.id
                WHERE cp.category_id = $categoryId;
            ");

            $results = [];
            while($row = $stmt->fetchObject(Property::class)) {
                $results[$row->getName()] = $row;
            }
            $this->properties = $results;
        } catch(e) {
            // TODO: error handling
        }
        
        return $this;
    }

    /**
     * Get the value of dailyRate as a string
     * 
     * @return string
     */ 
    public function getDailyRateToString(): string
    {
        return convertNumToEuros($this->dailyRate);
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

    /**
     * Calculate the total price for given dates
     *
     * @return int
     */ 
    public function calculateTotalPrice(string $pickupDate, string $dropoffDate): int
    {
        return calculateTotalPrice($this->dailyRate, $pickupDate, $dropoffDate);
    }

    /**
     * Calculate the total price in euros for given dates
     *
     * @return string
     */ 
    public function calculateTotalPriceInEuros(string $pickupDate, string $dropoffDate): string
    {
        return convertNumToEuros($this->calculateTotalPrice($pickupDate, $dropoffDate));
    }

    /**
     * Get validation rules for category form fields
     *
     * @return array
     */ 
    private static function getValidationRules(): array
    {
        return [
            'plate' => [
                'name' => 'plate',
                'maxLength' => 45,
                'required' => true,
            ],
            'description' => [
                'name' => 'description',
                'maxLength' => 90,
                'required' => true,
            ],
            'dailyRate' => [
                'name' => 'dailyRate',
                'type' => 'number',
                'required' => true,
            ],
            'property-6' => [
                'name' => 'property-6',
                'maxLength' => 45,
                'required' => true,
            ],
            'property-7' => [
                'name' => 'property-7',
                'maxLength' => 45,
                'required' => true,
            ],
            'property-8' => [
                'name' => 'property-8',
                'maxLength' => 45,
                'required' => true,
            ],
            'property-9' => [
                'name' => 'property-9',
                'maxLength' => 45,
                'required' => true,
            ],
            'property-10' => [
                'name' => 'property-10',
                'maxLength' => 45,
                'required' => true,
            ],
        ];
    }
} 