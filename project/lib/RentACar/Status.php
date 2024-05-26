<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/DBModel.php';

// TODO: update UML and SQL Schema to add Status

class Status {
    use DBModel;

    protected ?string $statusName;

    public function __construct(?string $statusName = null, ?int $id = null) {
        $this->tableName = 'status';

        if ($statusName !== null) {
            $this->statusName = $statusName;
        }
        if ($id !== null) {
            $this->id = $id;
        }
    }

    /**
     * Get the value of statusName
     * 
     * @return string
     */ 
    public function getStatusName(): string
    {
        return $this->statusName;
    }

    /**
     * Set the value of statusName
     *
     * @return self
     */ 
    public function setStatusName(string $statusName): self
    {
        $this->statusName = $statusName;

        return $this;
    }
}