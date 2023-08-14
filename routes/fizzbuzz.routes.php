<?php
require 'data/fizzBuzz.data.php';
// import the logic functions for this routes.
require 'controllers/fizzBuzz.controllers.php';

Flight::route('GET /fiz', function() use ($fizzBuzzArray){
    Flight::json($fizzBuzzArray);
});


?>