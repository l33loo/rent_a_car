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