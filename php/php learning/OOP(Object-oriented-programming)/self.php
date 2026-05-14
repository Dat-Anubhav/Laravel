<?php
//In PHP, self is a keyword used within a class to refer to the class itself. 
// It is most commonly used to access static properties, static methods, and class constants.
// Unlike $this, which refers to a specific object instance, self refers to the class definition as a whole

//NOTE: - Use $this-> to access "instance" data (unique to each object).
//  - Use self:: to access "static" data (shared by the whole class).
//  - Variables without these prefixes are "local" (temporary/private to the function).

class Weather{
    public static $tempcondition =['cold', 'mild', 'warm'];

    public static function celsiustofahrenheit($f){
        if($f<40){
            return self::$tempcondition['0'];
        }
        else if($f>40 & $f<70){
            return self::$tempcondition['1'];
        }
        else{
            return self::$tempcondition['2'];
        }
    }

}

echo weather::celsiustofahrenheit(30);
?>