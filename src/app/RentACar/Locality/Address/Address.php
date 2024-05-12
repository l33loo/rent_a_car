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
}