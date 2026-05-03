<?php

class Cln{
// Use 'clone' KEYWORD to create a copy: $copy = clone $obj;
// Use '__clone()' METHOD only if you need to "tweak" the copy (e.g., reset an ID).

// Shortcut: Keyword = The Action | Method = The Custom Adjustment (Optional)
   
    public $name;
    public $email;

    public function __construct($name, $email){
        $this->name = $name;
        $this->email = $email;
    }
    public function message(){
        return " ".$this->name." ".$this->email." friend added";

    
    }
    public function __clone(){//this clone method is used to modify stuffs while cloning
        $this->name = "Kakashi";
    
    }

}

$obj1 = new Cln("Anubhav","anubhav@example.com");
$obj2 = new Cln("Rishu","rishu@example.com");
$obj3 = clone $obj1;

echo $obj1->name."<br>";
echo $obj2->name."<br>";
echo $obj3->email."<br><br>";
echo $obj3->message()."<br>";


?>