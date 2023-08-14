<?php 

// import the logic functions for this routes.
require 'controllers/users.controllers.php'; 

// Path to the users database
$usersDBPath = 'db/usersDB.json';


// Retrieve all users from the database
Flight::route('GET /users', function() use ($usersDBPath) {
    getUsers($usersDBPath);
});

// Create a new user
Flight::route('POST /createUser', function() use ($usersDBPath) {
    createUsers($usersDBPath);
});

?>