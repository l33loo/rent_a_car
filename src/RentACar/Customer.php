<?php
namespace RentACar;

class Customer extends Profile {
    protected string $driversLicense;
    // TODO: change class to CreditCard
    protected string $creditCard;
    protected string $taxNumber;
    protected User $user;

    public function __construct(
        int $id,
        string $name,
        string $email,
        // TODO: Carbon type
        string $dateOfBirth,
        \locality\Address $address,
        string $phone,
        bool $isArchived,
        string $driversLicense,
        string $creditCard,
        string $taxNumber,
        User $user
    ) {
        parent::__construct(
            $id,
            $name,
            $email,
            $dateOfBirth,
            $address,
            $phone,
            $isArchived
        );

        $this->driversLicense = $driversLicense;
        $this->creditCard = $creditCard;
        $this->taxNumber = $taxNumber;
        $this->user = $user;
    }

    /**
     * Get the value of driversLicense
     */ 
    public function getDriversLicense(): string
    {
        return $this->driversLicense;
    }

    /**
     * Set the value of driversLicense
     *
     * @return  self
     */ 
    public function setDriversLicense(string $driversLicense): self
    {
        $this->driversLicense = $driversLicense;

        return $this;
    }

    /**
     * Get the value of creditCard
     * TODO: make credit card type
     */ 
    public function getCreditCard(): string
    {
        return $this->creditCard;
    }

    /**
     * Set the value of creditCard
     *
     * @return  self
     * TODO: CreditCard type
     */ 
    public function setCreditCard(string $creditCard): self
    {
        $this->creditCard = $creditCard;

        return $this;
    }

    /**
     * Get the value of taxNumber
     */ 
    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    /**
     * Set the value of taxNumber
     *
     * @return  self
     */ 
    public function setTaxNumber(string $taxNumber): self
    {
        $this->taxNumber = $taxNumber;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser(User $user): self
    {
        $this->user = $user;

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
     * @return  self
     */ 
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}

