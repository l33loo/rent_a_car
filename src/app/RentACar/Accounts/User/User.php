<?php
namespace accounts;

class User extends Profile {
    // The username is the email address inherited from Profile
    protected string $password;
}