<?php
namespace RentACar;

require_once '/var/www/html/vendor/autoload.php';
require_once '/var/www/html/app/RentACar/Accounts/Profile/Profile.php';
require_once '/var/www/html/DBModel.php';

use Carbon\Carbon;
use RentACar\Profile;

class User extends Profile
{
    use DBModel;

    protected string $passwordHash;
    protected bool $isAdmin;
    protected int $address_id;
    
    
    public function __construct()
    {
        $this->tableName = 'user';
        
        // $this->passwordHash = $passwordHash;
        // // $this->passwordHash = password_hash($password, PASSWORD_BCRYPT);
        // $this->email = $email;

        print_r($this);
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password): self
    {
        $this->passwordHash = $password;
        // $this->passwordHash = password_hash($password, PASSWORD_BCRYPT);

        return $this;
    }

    public function checkPassword(string $password): bool
    {
        echo "<br>Password: $password<br>";
        echo "this->passwordHash: $this->passwordHash<br>";
        return password_verify($password, $this->passwordHash);
    }
}