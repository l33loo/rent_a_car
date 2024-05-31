<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Revision;
use RentACar\User;

class Reservation {
    use DBModel;

    protected ?string $ownerUser_id = null;
    protected ?User $ownerUser = null;

    public function __construct(
        ?string $ownerUser_id = null,
        ?User $ownerUser = null
    ) {
        $this->tableName = 'reservation';
    
        if ($ownerUser_id !== null) {
            $this->ownerUser_id = $ownerUser_id;
        }

        if ($ownerUser !== null) {
            $this->ownerUser = $ownerUser;
        }
    }

    /**
     * Get the value of ownerUser_id
     * 
     * @return int
     */ 
    public function getOwnerUser_id(): int
    {
        return $this->ownerUser_id;
    }

    /**
     * Set the value of ownerUser_id
     *
     * @return self
     */ 
    public function setOwnerUser_id(int $ownerUser_id): self
    {
        $this->ownerUser_id = $ownerUser_id;

        return $this;
    }

    /**
     * Get the value of ownerUser
     * 
     * @return ?User
     */ 
    public function getOwnerUser(): ?User
    {
        return $this->ownerUser;
    }

    /**
     * Set the value of ownerUser
     *
     * @return self
     */ 
    public function setOwnerUser(User $ownerUser): self
    {
        $this->ownerUser = $ownerUser;

        return $this;
    }

    /**
     * Load the value of ownerUser
     *
     * @return self
     */ 
    public function loadOwnerUser(): self
    {
        $this->loadRelation('ownerUser', 'user');

        return $this;
    }

    /**
     * Get the latest revision of the reservation
     *
     * @return Revision
     */ 
    public function findLatestRevision(): Revision
    {
        return Revision::findLatestRevision($this->id);
    }

    /**
     * Get all the reservation's Revisions,
     * from newest to oldest
     *
     * @return array
     */ 
    public function findAllRevisions(): array
    {
        return Revision::search([
            [
                'column' => 'reservation_id',
                'operator' => '=',
                'value' => $this->id
            ]
        ], 'revision', 'submittedTimestamp', 'DESC');
    }
}