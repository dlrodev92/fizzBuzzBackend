<?php 
// import flight microframework.

require 'vendor/autoload.php';

require 'data/fizzBuzz.data.php';

//import routes here.
require 'routes/fizzBuzz.routes.php';
require 'routes/users.routes.php';
require 'routes/auth.routes.php';


// this function starts the the api.

Flight::start();

?>