<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/DBModel.php';

class Property {
    use DBModel;

    protected ?string $name = null;
    protected ?string $propertyValue = null;

    public function __construct(
        ?string $name = null,
        ?string $propertyValue = null,
        ?int $id = null
    ) {
        $this->tableName = 'property';
        
        if ($name !== null) {
            $this->name = $name;
        }

        if ($propertyValue !== null) {
            $this->propertyValue = $propertyValue;
        }

        if ($id !== null) {
            $this->id = $id;
        }
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

    /**
     * Get the value of value
     */ 
    public function getPropertyValue()
    {
        return $this->propertyValue;
    }

    /**
     * Set the value of value
     *
     * @return  self
     */ 
    public function setPropertyValue($propertyValue)
    {
        $this->propertyValue = $propertyValue;

        return $this;
    }
}