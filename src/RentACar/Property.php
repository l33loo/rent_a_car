<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/DBModel.php';

class Property {
    use DBModel;

    protected ?string $name = null;
    protected ?string $value = null;

    public function __construct(
        ?string $name = null,
        ?string $value = null,
        ?int $id = null
    ) {
        if ($name !== null) {
            $this->name = $name;
        }

        if ($value !== null) {
            $this->value = $value;
        }

        if ($id !== null) {
            $this->id = $id;
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
     * Get the value of name
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    // /**
    //  * Get the value of properties
    //  * @return array
    //  */ 
    // public static function fetchVehicleProperties(int $vehicleId): array
    // {
    //     // INSERT INTO vehicle_property (vehicle_id, property_id, value)
    //     // VALUES
    //     // -- Economy Cars - São Miguel
    //     // (1, 1, "Renault"),
    //     // (1, 2, "Clio"),
    //     // (1, 3, "Red"),
    //     // (1, 4, "2022"),
    //     // (1, 5, "Volkswagen Polo"),
    //     try {
    //         $stmt = self::rawSQL("
    //             SELECT p.name, vp.value FROM property p
    //             LEFT OUTER JOIN vehicle_property vp ON vp.property_id = p.id
    //             WHERE vp.vehicle_id = $vehicleId;
    //         ");

    //         $results = [];
    //         while($row = $stmt->fetchObject(static::class)) {
    //             $results[] = $row;
    //         }
    //     } catch(e) {
    //         // TODO: error handling
    //     }
        
    //     return $results;
    // }

    /**
     * Get the value of value
     */ 
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @return  self
     */ 
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}