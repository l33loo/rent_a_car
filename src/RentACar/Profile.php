<?php 
namespace RentACar;

require_once '/var/www/html/vendor/autoload.php';

use Carbon\Carbon;

abstract class Profile {
// protected int $id;
protected ?int $id = null;
protected string $name;
protected string $email;
// TODO: Fix db issue with having dateOfBirth being a string
// protected Carbon $dateOfBirth;
protected string $dateOfBirth;
protected Address $address;
protected string $phone;
protected bool $isArchived;

public function __construct(
int $id,
string $name,
string $email,
string $dateOfBirth,
string $address,
string $phone,
bool $isArchived
) {
$this->id = $id;
$this->name = $name;
$this->email = $email;
$this->dateOfBirth = $dateOfBirth;
$this->address = $address;
$this->phone = $phone;
$this->isArchived = $isArchived;
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
public function setDateOfBirth(string $dateOfBirth)
{
$this->dateOfBirth = $dateOfBirth;

return $this;
}

/**
* Get the value of address
*/
public function getAddress()
{
return $this->address;
}

/**
* Set the value of address
*
* @return self
*/
public function setAddress($address)
{
$this->address = $address;

return $this;
}

/**
* Get the value of phone
*/
public function getPhone()
{
return $this->phone;
}

/**
* Set the value of phone
*
* @return self
*/
public function setPhone($phone)
{
$this->phone = $phone;

return $this;
}

/**
* Get the value of isArchived
*/
public function getIsArchived()
{
return $this->isArchived;
}

/**
* Set the value of isArchived
*
* @return self
*/
public function setIsArchived($isArchived)
{
$this->isArchived = $isArchived;

return $this;
}
}