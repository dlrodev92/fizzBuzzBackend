<?php


require 'data/fizzBuzz.data.php';


Flight::route('GET /fiz', function() use ($fizzBuzzArray){
    Flight::json($fizzBuzzArray);
});


?>