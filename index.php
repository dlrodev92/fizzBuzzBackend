<?php 
// import flight microframework.

require 'vendor/autoload.php';

//import routes here.
require 'routes/fizzBuzzRoutes.php';

Flight::route('GET /', function() {
    print_r("Welcome to the FizzBuzz API");
});
// this function starts the the api.

Flight::start();

?>