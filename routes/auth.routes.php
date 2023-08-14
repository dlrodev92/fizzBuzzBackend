<?php 
// Path to the users database
$usersDBPath = 'db/usersDB.json';

// import the logic functions for this routes
require 'controllers/auth.controllers.php';


Flight::route('POST /auth', function() use ($usersDBPath) {
    authUser($usersDBPath);
});


Flight::route('GET /validateLogin', function() use ($usersDBPath) {
    $tokenPayload = getToken();
    validateLogin($tokenPayload, $usersDBPath);
});

?>