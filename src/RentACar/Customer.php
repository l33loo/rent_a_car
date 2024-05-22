<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Address.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Profile.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use Carbon\Carbon;
use RentACar\Address;
use RentACar\Profile;
use RentACar\User;

class Customer extends Profile {
    protected ?string $driversLicense = null;
    protected ?string $taxNumber = null;
    protected ?int $user_id = null;
    protected ?User $user = null;

    public function __construct(
        ?string $name = null,
        ?string $email = null,
        ?string $dateOfBirth = null,
        ?string $phone = null,
        ?bool $isArchived = null,
        ?int $address_id = null,
        ?string $driversLicense = null,
        ?string $taxNumber = null,
        ?int $user_id = null,
        ?Address $address = null,
        ?User $user = null,
        ?int $id = null
    ) {
        $this->tableName = 'customer';

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
        if ($driversLicense !== null) {
            $this->driversLicense = $driversLicense;
        }
        if ($taxNumber !== null) {
            $this->taxNumber = $taxNumber;
        }
        if ($address !== null) {
            $this->address = $address;
        }
        if ($user !== null) {
            $this->user = $user;
        }
        if ($id !== null) {
            $this->id = $id;
        }
    }

    /**
     * Get the value of driversLicense
     * 
     * @return string
     */ 
    public function getDriversLicense(): string
    {
        return $this->driversLicense;
    }

    /**
     * Set the value of driversLicense
     *
     * @return self
     */ 
    public function setDriversLicense(string $driversLicense): self
    {
        $this->driversLicense = $driversLicense;

        return $this;
    }

    /**
     * Get the value of taxNumber
     * 
     * @return ?string
     */ 
    public function getTaxNumber(): ?string
    {
        return $this->taxNumber;
    }

    /**
     * Set the value of taxNumber
     *
     * @return self
     */ 
    public function setTaxNumber(?string $taxNumber): self
    {
        $this->taxNumber = $taxNumber;

        return $this;
    }

    /**
     * Get the value of user
     * 
     * @return ?User
     */ 
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return self
     */ 
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of user_id
     * 
     * @return ?int
     */ 
    public function getUser_id(): ?int
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return self
     */ 
    public function setUser_id(?int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}