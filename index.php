<?php 
// import flight microframework.

require 'vendor/autoload.php';

require 'data/fizzBuzz.data.php';

//import routes here.
require 'routes/fizzBuzz.routes.php';

Flight::route('GET /tusmuertos', function() {
    print_r("Welcome to the FizzBuzz API");
});




// this function starts the the api.

Flight::start();

?>