<?php

require_once '../RentACar/User.php';

use RentACar\User;

session_start();

// TODO: if user logged in, redirect to index.php

// TODO: validate form fields


// protected ?int $id = null;
// protected string $name;
// protected string $email;
// // TODO: Fix db issue with having dateOfBirth being a string
// // protected Carbon $dateOfBirth;
// protected string $dateOfBirth;
// protected Address $address;
// protected string $phone;
// protected bool $isArchived;
// protected string $passwordHash;
// protected bool $isAdmin;
// protected int $address_id;

// string $name,
// string $email,
// string $dateOfBirth,
// string $address,
// string $phone,
// bool $isArchived,
// string $passwordHash,
// bool $isAdmin

// id INT UNSIGNED NOT NULL AUTO_INCREMENT,
// email VARCHAR(90) NOT NULL,
// passwordHash VARCHAR(200) NOT NULL,
// name VARCHAR(90) NOT NULL,
// dateOfBirth DATE NOT NULL,
// address_id INT UNSIGNED NOT NULL,
// phone VARCHAR(25) NOT NULL,
// isAdmin BOOLEAN NOT NULL DEFAULT FALSE,
// isArchived BOOLEAN NOT NULL DEFAULT FALSE,

// ?string $name = null,
// ?string $email = null,
// ?string $dateOfBirth = null,
// // ?string $address = null,
// ?string $phone = null,
// ?bool $isArchived = null,
// ?string $password = null,
// ?bool $isAdmin = null,
// ?int $address_id = 1,
// ?int $id = null
try {
    // TODO: fix missing id
    $user = new User(
        $_POST['name'],
        $_POST['email'],
        $_POST['dateOfBirth'],
        // $_POST['address'],
        $_POST['phone'],
        false,
        $_POST['password'],
        false
    );

    $user->save();
} catch(e) {
    // TODO: error message
    echo 'ERROR SIGNING UP :(';
    print_r(e);
} finally {
    // print_r($user);
}


