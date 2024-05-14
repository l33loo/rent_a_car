<?php 
namespace RentACar;

// require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Carbon\Carbon;

abstract class Profile {
    protected ?string $name = null;
    protected ?string $email = null;
    // TODO: Fix db issue with having dateOfBirth being a string
    // protected Carbon $dateOfBirth;
    protected ?string $dateOfBirth = null;
    // protected ?Address $address = null;
    protected ?string $phone = null;
    protected bool $isArchived = false;
    // TODO: fix issue with address
    protected ?int $address_id = null;

    public function __construct(
        ?int $id,
        ?string $name,
        ?string $email,
        ?string $dateOfBirth,
        // string $address,
        ?string $phone,
        bool $isArchived = false
    ) {
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
        // $this->id = $id;
        // $this->name = $name;
        // $this->email = $email;
        // $this->dateOfBirth = $dateOfBirth;
        // // $this->address = $address;
        // $this->phone = $phone;
        // $this->isArchived = $isArchived;
    }

    /**
    * Get the value of id
    */
    public function getId(): int
    {
        return $this->id;
    }

    /**
    * Set the value of id
    *
    * @return self
    */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
    * Get the value of name
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

    /**
    * Get the value of email
    */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
    * Set the value of email
    *
    * @return self
    */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
    * Get the value of dateOfBirth
    *
    */
    public function getDateOfBirth(): string
    {
        return $this->dateOfBirth;
    }

    /**
    * Set the value of dateOfBirth
    *
    * @return self
    */
    public function setDateOfBirth(string $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
    * Get the value of address
    */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
    * Set the value of address
    *
    * @return self
    */
    public function setAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
    * Get the value of phone
    */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
    * Set the value of phone
    *
    * @return self
    */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
    * Get the value of isArchived
    */
    public function getIsArchived(): bool
    {
        return $this->isArchived;
    }

    /**
    * Set the value of isArchived
    *
    * @return self
    */
    public function setIsArchived(bool $isArchived): self
    {
        $this->isArchived = $isArchived;

        return $this;
    }
}