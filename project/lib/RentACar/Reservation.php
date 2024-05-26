<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/DBModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/Revision.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/User.php';

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
     * @return User
     */ 
    public function getOwnerUser(): User
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
     * Get the latest revision of the reservation
     *
     * @return Revision
     */ 
    public function findLatestRevision(): Revision
    {
        $reservationId = $this->id;
        $stmt = Revision::rawSQL("
            SELECT * FROM revision
            WHERE reservation_id=$reservationId
            ORDER BY submittedTimestamp DESC, id DESC
            LIMIT 1;
        ");

        $results = [];
        while($row = $stmt->fetchObject(Revision::class)) {
            $results[] = $row;
        }

        if (count($results) !== 1) {
            echo 'Error retrieving latest revision';
            // TODO: error and redirect
        }

        return $results[0];
    }
}