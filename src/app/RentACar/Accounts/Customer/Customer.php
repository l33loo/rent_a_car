<?php
namespace accounts;

class Customer extends Profile {
    protected string $driversLicense;
    // TODO: change class to CreditCard
    protected string $creditCard;
    protected string $taxNumber;
    protected User $user;

    /**
     * Get the value of driversLicense
     */ 
    public function getDriversLicense()
    {
        return $this->driversLicense;
    }

    /**
     * Set the value of driversLicense
     *
     * @return  self
     */ 
    public function setDriversLicense($driversLicense)
    {
        $this->driversLicense = $driversLicense;

        return $this;
    }

    /**
     * Get the value of creditCard
     */ 
    public function getCreditCard()
    {
        return $this->creditCard;
    }

    /**
     * Set the value of creditCard
     *
     * @return  self
     */ 
    public function setCreditCard($creditCard)
    {
        $this->creditCard = $creditCard;

        return $this;
    }

    /**
     * Get the value of taxNumber
     */ 
    public function getTaxNumber()
    {
        return $this->taxNumber;
    }

    /**
     * Set the value of taxNumber
     *
     * @return  self
     */ 
    public function setTaxNumber($taxNumber)
    {
        $this->taxNumber = $taxNumber;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}

