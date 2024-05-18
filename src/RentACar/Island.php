<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/DBModel.php';

class Island {
    use DBModel;

    protected ?string $name = null;

    public function __construct(
        ?string $name = null,
        ?int $id = null
    ) {
        $this->tableName = 'island';
    
        if ($name !== null) {
            $this->name = $name;
        }
    }

    

    /**
     * Get the value of name
     * 
     * @return string
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return self
     */ 
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}