<?php
namespace RentACar;

// TODO: fix autoload
// require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Address.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Profile.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/DBModel.php';

use Carbon\Carbon;
use RentACar\Address;
use RentACar\Profile;

class User extends Profile
{
    use DBModel;

    protected ?string $passwordHash = null;
    protected ?bool $isAdmin = null;

    // protected ?string $street = null;
    // protected ?string $doorNumber = null;
    // protected ?string $apartmentNr = null;
    // protected ?string $city = null;
    // protected ?string $district = null;
    // protected ?string $postalCode = null;
    // protected ?Country $country = null;

    public function __construct(
        ?string $name = null,
        ?string $email = null,
        ?string $dateOfBirth = null,
        ?Address $address = null,
        ?string $phone = null,
        ?bool $isArchived = null,
        ?string $password = null,
        ?bool $isAdmin = null,

        ?int $id = null
    ) {
        $this->tableName = 'user';

        parent::__construct($name, $email, $dateOfBirth, $address, $phone, $isArchived, $id);

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