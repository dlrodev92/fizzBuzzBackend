<?php 
// import flight microframework.
require 'vendor/autoload.php';

//import routes here.
require 'routes/fizzBuzz.routes.php';
require 'routes/users.routes.php';
require 'routes/auth.routes.php';

// Enable CORS
Flight::before('start', function() {
    header('Access-Control-Allow-Origin: http://localhost:5173'); // this is the url of the client app.
    header('Access-Control-Allow-Methods: GET, POST,'); // only allow these methods.
    header('Access-Control-Allow-Headers: Content-Type, Authorization');// allow these headers for JWT auth.
    header('Access-Control-Allow-Credentials: true');
});

// this function starts the the api.
Flight::start();

?>