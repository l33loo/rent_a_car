<?php

require_once '../RentACar/User';

use RentACar\User;

session_start();

// TODO: if user logged in, redirect to index.php

// TODO: validate form fields

$user = new User($_POST[''])