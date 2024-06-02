<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\FormValidatorTrait;

class CreditCard
{
    use DBModel;
    use FormValidatorTrait;

    protected ?string $ccNumber = null;
    // TODO: use Carbon
    protected ?string $ccExpiry = null;
    protected ?string $ccCVV = null;

    public function __construct(
        ?string $ccNumber = null,
        ?string $ccExpiry = null,
        ?string $ccCVV = null
    ) {
        $this->tableName = 'creditCard';
    
        if ($ccNumber !== null) {
            $this->ccNumber = $ccNumber;
        }

        if ($ccExpiry !== null) {
            $this->ccExpiry = $ccExpiry;
        }

        if ($ccCVV !== null) {
            $this->ccCVV = $ccCVV;
        }
    }

    /**
     * Get the value of ccNumber
     * 
     * @return string
     */ 
    public function getCcNumber(): string
    {
        return $this->ccNumber;
    }

    /**
     * Set the value of ccNumber
     *
     * @return self
     */ 
    public function setCcNumber(string $ccNumber): self
    {
        $this->ccNumber = $ccNumber;

        return $this;
    }

    /**
     * Get the value of ccExpiry
     * 
     * @return string
     */ 
    public function getCcExpiry(): string
    {
        return $this->ccExpiry;
    }

    /**
     * Set the value of ccExpiry
     *
     * @return self
     */ 
    public function setCcExpiry(string $ccExpiry): self
    {
        $this->ccExpiry = $ccExpiry;

        return $this;
    }

    /**
     * Get the value of ccCVV
     * 
     * @return string
     */ 
    public function getCcCVV(): string
    {
        return $this->ccCVV;
    }

    /**
     * Set the value of ccCVV
     *
     * @return self
     */ 
    public function setCcCVV(string $ccCVV): self
    {
        $this->ccCVV = $ccCVV;

        return $this;
    }
}