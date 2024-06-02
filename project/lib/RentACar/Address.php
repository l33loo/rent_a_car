<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Country;
use RentACar\FormValidatorTrait;

class Address
{
    use DBModel;
    use FormValidatorTrait;

    protected ?string $street = null;
    protected ?string $doorNumber = null;
    protected ?string $apartmentNr = null;
    protected ?string $city = null;
    protected ?string $district = null;
    protected ?string $postalCode = null;
    protected ?int $country_id = null;
    protected ?Country $country = null;

    public function __construct(
        ?string $street = null,
        ?string $doorNumber = null,
        ?string $apartmentNr = null,
        ?string $city = null,
        ?string $district = null,
        ?string $postalCode = null,
        ?int $country_id = null,
        ?int $id = null,
        ?Country $country = null,
    ) {
        $this->tableName = 'address';
        
        if ($id !== null) {
            $this->id = $id;
        }

        if ($street !== null) {
            $this->street = $street;
        }

        if ($doorNumber !== null) {
            $this->doorNumber = $doorNumber;
        }

        if ($apartmentNr !== null) {
            $this->apartmentNr = $apartmentNr;
        }

        if ($city !== null) {
            $this->city = $city;
        }

        if ($district !== null) {
            $this->district = $district;
        }

        if ($postalCode !== null) {
            $this->postalCode = $postalCode;
        }

        if ($country_id !== null) {
            $this->country_id = $country_id;
        }

        if ($country !== null) {
            $this->country = $country;
        }
    }

    /**
     * Get the value of id
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of street
     */ 
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * Get the value of doorNumber
     */ 
    public function getDoorNumber(): ?string
    {
        return $this->doorNumber;
    }

    /**
     * Get the value of apartmentNr
     */ 
    public function getApartmentNr(): ?string
    {
        return $this->apartmentNr;
    }

    /**
     * Get the value of city
     */ 
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * Get the value of district
     */ 
    public function getDistrict(): ?string
    {
        return $this->district;
    }

    /**
     * Get the value of postalCode
     */ 
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * Get the value of country_id
     */ 
    public function getCountry_id()
    {
        return $this->country_id;
    }

    /**
     * Set the value of country_id
     *
     * @return  self
     */ 
    public function setCountry_id($country_id)
    {
        $this->country_id = $country_id;

        return $this;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    public function __toString() : string
    {
        if ($this->country === null) {
            $this->loadRelation('country');
        }
        
        $addressString = $this->doorNumber . ' ' . $this->street;

        if ($this->apartmentNr !== null) {
            $addressString .= ', apt ' . $this->apartmentNr;
        }

        $addressString .= ', ' . $this->city . ', ' . $this->district . ', ' . $this->postalCode . ', ' . $this->getCountry()->getName();

        return $addressString;
    }
}