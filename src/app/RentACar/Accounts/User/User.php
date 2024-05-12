<?php
namespace RENTAL\SRC;

require_once 'vendor/autoload.php';

use Carbon\Carbon;

class User extends Profile
{
    use DBModel;

    protected string $password;
    
    
    public function __construct(string $password, string $email)
    {
        $this->tableName = 'user';
        
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->email = $email;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);

        return $this;
    }

    public function checkPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }
}