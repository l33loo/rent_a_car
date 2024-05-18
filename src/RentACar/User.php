<?php
namespace RentACar;

use RentACar\DBModel;
use RentACar\Profile;

class User extends Profile
{
    use DBModel;

    protected ?string $passwordHash = null;
    protected ?bool $isAdmin = null;

    public function __construct(
        ?string $name = null,
        ?string $email = null,
        ?string $dateOfBirth = null,
        ?string $phone = null,
        bool $isArchived = false,
        ?string $password = null,
        bool $isAdmin = false,
        ?int $address_id = null,
        ?int $id = null
    ) {
        $this->tableName = 'user';

        parent::__construct($id, $name, $email, $dateOfBirth, $phone, $isArchived);

        if ($password !== null) {
            $this->passwordHash = password_hash($password, PASSWORD_BCRYPT);
        }

        // Set the value of $address_id directly
        $this->address_id = $address_id;

        // Set the value of $isAdmin
        $this->isAdmin = $isAdmin;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password): self
    {
        $this->passwordHash = $password;
        // $this->passwordHash = password_hash($password, PASSWORD_BCRYPT);

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
}