<?php

// Type hinting in PHP (officially called type declarations) is a feature that allows you to specify 
// the expected data type of function parameters, return values, class properties, and constants.
// It serves as a "contract" for your code. If you try to pass or return a value that doesn't match the declared type, 
// PHP will throw a TypeError.

function test(int | array $name){ // this is type hinting u tell the code before it executes the rest of the lines to check only for int and array
// not only data type u can also hint classes and objects too
    print_r($name);

}
echo test(['apple']);


//Hinting a class

class abc{

public function doSomething(){
    echo "Doing something";
}
}

class xyz{
    public function doSomething(){
        echo "Doing somethingelse";

}
}

function test2(xyz $obj){ //Using type hinting for a class means the code only runs if the object instance is specifically from the xyz class. If not, it throws an error
    $obj->doSomething();
}

$obj=new xyz();

echo test2($obj);