<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/DBModel.php';

use RentACar\DBModel;

class Country {
    use DBModel;

    public ?string $name = null;
    public ?string $code = null;

    public function __construct(?string $name = null, ?string $code = null, ?int $id = null) {
        $this->tableName = 'country';

        if ($id !== null) {
            $this->id = $id;
        }

        if ($name !== null) {
            $this->name = $name;
        }

        if ($code !== null) {
            $this->code = $code;
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
     * Get the value of code
     */ 
    public function getCode(): string
    {
        return $this->code;
    }
}