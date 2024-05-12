<?php
namespace locality;

class Address {
    protected int $id;
    protected string $street;
    protected string $doorNumber;
    protected string $apartmentNr;
    protected string $city;
    protected string $district;
    protected string $postalCode;
    protected Country $country;

    public function __construct(
        int $id,
        string $street,
        string $doorNumber,
        string $apartmentNr,
        string $city,
        string $district,
        string $postalCode,
        Country $country
    ) {
        $this->id = $id;
        $this->street = $street;
        $this->doorNumber = $doorNumber;
        $this->apartmentNr = $apartmentNr;
        $this->city = $city;
        $this->district = $district;
        $this->postalCode = $postalCode;
        $this->country = $country;
    }

    /**
     * Get the value of id
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of street
     */ 
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * Get the value of doorNumber
     */ 
    public function getDoorNumber(): string
    {
        return $this->doorNumber;
    }

    /**
     * Get the value of apartmentNr
     */ 
    public function getApartmentNr(): string
    {
        return $this->apartmentNr;
    }

    /**
     * Get the value of city
     */ 
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * Get the value of district
     */ 
    public function getDistrict(): string
    {
        return $this->district;
    }

    /**
     * Get the value of postalCode
     */ 
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry(): Country
    {
        return $this->country;
    }
}