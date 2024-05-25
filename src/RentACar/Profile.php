<?php 
namespace RentACar;

// require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Address.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/DBModel.php';

use RentACar\Address;

abstract class Profile {
    use DBModel; 

    protected ?string $name = null;
    protected ?string $email = null;
    // TODO: Fix db issue with having dateOfBirth being a string
    // protected Carbon $dateOfBirth;
    protected ?string $dateOfBirth = null;
    protected ?string $phone = null;
    protected ?bool $isArchived = null;
    protected ?int $address_id = null;
    protected ?Address $address = null;

    public function __construct(
        ?string $name,
        ?string $email,
        ?string $dateOfBirth,
        ?string $phone,
        ?bool $isArchived,
        ?int $address_id,
        ?int $id,
        ?Address $address
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

        if ($address_id !== null) {
            $this->address_id = $address_id;
        }

        if ($address !== null) {
            $this->address = $address;
        }
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
        // $this->address_id = $address->getId();

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

    /**
     * Get the value of address_id
     */ 
    public function getAddress_id()
    {
        return $this->address_id;
    }

    /**
     * Set the value of address_id
     *
     * @return  self
     */ 
    public function setAddress_id($address_id)
    {
        $this->address_id = $address_id;

        return $this;
    }
}