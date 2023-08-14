<?php

//import uuid generator library

use Ramsey\Uuid\Uuid;

//loadUsers() and saveUsers() functions here
function loadUsers($usersDBPath) {
    $usersData = json_decode(file_get_contents($usersDBPath), true);
    return $usersData ? $usersData : [];
}

function saveUsers($users, $usersDBPath) {
    file_put_contents($usersDBPath, json_encode($users, JSON_PRETTY_PRINT));
}

// "/users" route logic here.

function getUsers($usersDBPath) {
    $users = loadUsers($usersDBPath);
    Flight::json($users);
}

// "/createUser" route logic here.

function createUsers($usersDBPath){
    $id = Uuid::uuid4()->toString(); // Generate UUID
    $username = Flight::request()->data->username;
    $password = Flight::request()->data->password;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash password for security.

    $users = loadUsers($usersDBPath);

    $newUser = [
        "id" => $id,
        "username" => $username,
        "password" => $hashedPassword
    ];

    $users[] = $newUser;

    saveUsers($users, $usersDBPath); // Save new user to users.json db.

    Flight::json(['message' => 'User created successfully']);
}


?>