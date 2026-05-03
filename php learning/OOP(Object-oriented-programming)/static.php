<?php

class Stc{
    // Use the static keyword before properties or methods to make them accessible without an instance(object)
    // Accessing Static Members: Use the double colon operator (::) followed by the property or method name 
    // (e.g., Weather::$tempConditions or Weather::celsiusToFahrenheit())
    public $name;

    public static function message1(){
        echo "Hi i am Anubhav".'<br>';
    }

    public static function message2($name){
        echo $name . " Hi i am Rishu";
        //Note:- // $this = "The current object I am inside of."
// Used to access non-static properties and methods.
// Forbidden in static methods.

//Note:-($this->name=$name) $this be like You are telling the object: "Take the name I just gave you and store it in your 'name' property."
    }

    }

    Stc::message1();
    Stc::message2("Kakashi");
?>