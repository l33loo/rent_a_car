<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Property;

trait PropertiesTrait {
    protected ?array $properties = null;

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
     * Load properties
     * @return self
     */ 
    public function loadProperties(): self
    {
        try {
            $function = new \ReflectionClass(__CLASS__);
            $id = $this->id;
            $table = lcfirst($function->getShortName());
            $stmt = self::rawSQL(
                "SELECT p.id, p.name, tp.propertyValue FROM property p
                LEFT OUTER JOIN $table" . "_property tp ON tp.property_id = p.id
                WHERE tp.$table" . "_id = $id;"
            );

            $results = [];
            while($row = $stmt->fetchObject(Property::class)) {
                $results[$row->getName()] = $row;
            }
            $this->properties = $results;
        } catch(\Exception $e) {
            throw new \Exception('Error loading properties');
        }
        
        return $this;
    }

    /**
     * Get property
     *
     * @return ?string
     */ 
    public function __get(string $propertyName): ?string
    {
        $properties = $this->properties;
        if ($properties === null) {
            $this->loadProperties();
        }

        if ($properties === null || count($properties) === 0) {
            return null;
        }
        
        return isset($properties[$propertyName]) ? $properties[$propertyName]->getPropertyValue() : null;
    }
}