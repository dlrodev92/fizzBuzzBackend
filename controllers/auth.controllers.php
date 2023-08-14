<?php 
//import jwr library to create tokens
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

 function authUser($usersDBPath){
    $users = json_decode(file_get_contents($usersDBPath), true);
    
    $username = Flight::request()->data->username;
    $password = Flight::request()->data->password;
    
    $filteredUsers = array_filter($users, function($u) use ($username) {
        return $u['username'] === $username;
    });
    
    // Get the first user that matches the username from the previous filter
    $user = reset($filteredUsers);

    // 1.Verify password with the password hash
    if ($user && password_verify($password, $user['password'])) {
        $now = strtotime('now');
        $key = 'THIS_SHOULD_BE_A_ENVIRONMENT_VARIABLE'; // FOR DEMO PURPOSES ONLY!
        $payload = array(
            'exp' => $now + 3600, // Token expires in 1 hour
            'data' => $user['id'] // User ID from the database
        );
        $jwt = JWT::encode($payload, $key, 'HS256');
        Flight::json(array('token' => $jwt));
    } else {
        Flight::halt(401, 'Unauthorized'); // Return 401 Unauthorized status
    }
 }
 
// Use this function on the routes that require authentication as middleware
 function getToken(){
    $headers = apache_request_headers();
    $authorization = $headers['Authorization'];
    $tokenArray = explode(' ', $authorization);
    $token = $tokenArray[1];

    try {
        $decodedToken = JWT::decode($token, new Key('THIS_SHOULD_BE_A_ENVIRONMENT_VARIABLE','HS256'));
        return $decodedToken;
    } catch (\Throwable $th) {
        error_log('Error: ' . $th->getMessage());
        error_log('Status: ' . $th->getCode());
        return null; 
    }
}

function validateLogin($tokenPayload, $usersDBPath){
    try {
        $users = json_decode(file_get_contents($usersDBPath), true);
    // Filter the users array to get the user that matches the token payload "user id"
        $filteredUsers = array_filter($users, function($user) use ($tokenPayload) {
            return $user['id'] === $tokenPayload->data;
        });
    
        if (count($filteredUsers) > 0) {
            Flight::json(['authorized' => true]);
        } else {
            Flight::json(['authorized' => false]);
        }
    } catch (\Throwable $th) {
        Flight::halt(401, 'Unauthorized');
    }
}
?>
