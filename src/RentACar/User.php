<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Address.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Profile.php';

use RentACar\Address;
use RentACar\Profile;

class User extends Profile
{
    protected ?string $passwordHash = null;
    protected ?bool $isAdmin = null;

    public function __construct(
        ?string $name = null,
        ?string $email = null,
        ?string $dateOfBirth = null,
        ?string $phone = null,
        ?bool $isArchived = null,
        ?string $password = null,
        ?bool $isAdmin = null,
        ?int $address_id = null,
        ?int $id = null,
        ?Address $address = null
    ) {
        $this->tableName = 'user';

        parent::__construct(
            $name,
            $email,
            $dateOfBirth,
            $phone,
            $isArchived,
            $address_id,
            $id,
            $address,
        );

        if ($password !== null) {
            $this->passwordHash = password_hash($password, PASSWORD_BCRYPT);
        }

        if ($isAdmin !== null) {
            $this->isAdmin = $isAdmin;
        }
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPasswordHash($passwordHash): self
    {
        
        $this->passwordHash = $passwordHash;

        return $this;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password): self
    {
        $this->passwordHash = password_hash($password, PASSWORD_BCRYPT);

        return $this;
    }

    public function checkPassword(string $password): bool
    {
        // echo "<br>Password: $password<br>";
        // echo "this->passwordHash: $this->passwordHash<br>";
        return password_verify($password, $this->passwordHash);
    }

    /**
     * Get the value of isAdmin
     */ 
    public function getIsAdmin(): bool
    {
        return $this->isAdmin;
    }

    /**
     * Set the value of isAdmin
     *
     * @return  self
     */ 
    public function setIsAdmin(bool $isAdmin): self
    {
            $this->isAdmin = $isAdmin;

            return $this;
    }
}