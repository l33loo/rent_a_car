<?php
namespace locality;

class Island {
    protected int $id;
    protected string $name;

    public function __construct(int $id, string $name) {
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