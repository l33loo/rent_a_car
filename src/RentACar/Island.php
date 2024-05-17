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
        
        $this->id;
        $this->name;
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
}