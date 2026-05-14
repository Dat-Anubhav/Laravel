<?php

// oop is very helpfull u can create an template as class and reuse that template to create different objects each for different use
class car{
    // $name is a property
    //getCarname is known as method inside class and as a function outside the class
    public $name="Car name"; // Public is a keyword by which we can access this variable name even out of this class car

    public function getCarname(){
        return $this->name; 
        // In PHP, $this is a special variable that only works inside the curly braces {} of your class methods. 
        // It tells the code, "look at the current object I'm inside of."
    }

    public function __construct($carname){
        $this->name=$carname;
    }

    }

//Creating object
$obj1=new car("ferrai");
$obj2=new car("Honda");


//calling through object
echo $obj1->getCarname();
echo '<br>';
echo $obj1->name;
echo '<br>';
echo $obj2->name;
echo'<br>';
echo $obj2->getCarname();
echo '<br>';
echo $obj1->name="Bmw";// redefining/rewriting the variable
// echo '<br>';

// echo $obj2->getCarname();
// echo '<br>';
// echo $obj2->setCarname("Ferrari");
// echo '<br>';


?>