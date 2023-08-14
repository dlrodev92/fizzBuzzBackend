<?php


require 'data/fizzBuzzNumbers.php';


Flight::route('GET /fizzbuzz', function() use ($fizzBuzzArray){
    Flight::json($fizzBuzzArray);
});


?>