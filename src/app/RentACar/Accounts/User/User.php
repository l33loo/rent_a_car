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

    protected string $password;
    
    
    public function __construct(string $password = '', string $email = '')
    {
        $this->tableName = 'user';
        
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->email = $email;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password): self
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);

        return $this;
    }

    public function checkPassword(string $password): bool
    {
        echo "<br>Password: $password<br>";
        echo "this->password: $this->password<br>";
        return password_verify($password, $this->password);
    }
}