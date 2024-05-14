<?php
namespace RentACar;

require_once '/var/www/html/vendor/autoload.php';
require_once '/var/www/html/RentACar/Profile.php';
require_once '/var/www/html/RentACar/DBModel.php';

use Carbon\Carbon;
use RentACar\Profile;

class User extends Profile
{
    use DBModel;

    protected ?string $passwordHash = null;
    protected bool $isAdmin = false;

    public function __construct(
        ?string $name = null,
        ?string $email = null,
        ?string $dateOfBirth = null,
        // ?string $address = null,
        ?string $phone = null,
        bool $isArchived = false,
        ?string $password = null,
        bool $isAdmin = false,
        ?int $address_id = 1,
        ?int $id = null
    ) {
        $this->tableName = 'user';

        if ($id !== null) {
            $this->id = $id;
        }
        
        if ($name !== null) {
            $this->name = $name;
        }

        if ($email !== null) {
            $this->email = $email;
        }
        
        if ($dateOfBirth !== null) {
            $this->dateOfBirth = $dateOfBirth;
        }
        
        if ($phone !== null) {
            $this->phone = $phone;
        }

        if ($isArchived !== null) {
            $this->isArchived = $isArchived;
        }

        if ($password !== null) {
            $this->passwordHash = password_hash($password, PASSWORD_BCRYPT);
        }

        if ($address_id !== null) {
            $this->address_id = $address_id;
        }

        // print_r($this);ignup.php
        
        // $this->passwordHash = $passwordHash;
        // // $this->passwordHash = password_hash($password, PASSWORD_BCRYPT);
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