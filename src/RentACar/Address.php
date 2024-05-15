<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Country.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/DBModel.php';

use RentACar\Country;
use RentACar\DBModel;

class Address {
    use DBModel;

    protected ?string $street = null;
    protected ?string $doorNumber = null;
    protected ?string $apartmentNr = null;
    protected ?string $city = null;
    protected ?string $district = null;
    protected ?string $postalCode = null;
    protected ?Country $country = null;

    public function __construct(
        ?string $street = null,
        ?string $doorNumber = null,
        ?string $apartmentNr = null,
        ?string $city = null,
        ?string $district = null,
        ?string $postalCode = null,
        ?Country $country = null,
        ?int $id = null,
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
     * Get the value of country
     */ 
    public function getCountry(): Country
    {
        return $this->country;
    }
}