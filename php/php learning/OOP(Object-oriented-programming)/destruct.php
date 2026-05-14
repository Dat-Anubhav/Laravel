<?php
class Destruct{
    public $name;
    public $salary;

// constructors, destructors, get, set they all come under magic methods.
// Note:- In PHP, a magic method is a special method that is automatically triggered by the PHP engine when certain actions happen to an object.
    
public function __construct($name,$salary){
        $this->name = $name;
        $this->salary = $salary;
    }

    function __destruct(){// destruct method will executed after the code is finished from backwords means first 
    //obj3 then obj2 then obj1
        echo "I am destructi8ng $this->name".'<br>';
    }

}


$obj1=new Destruct("Anubhav","70000");
$obj2=new Destruct("Rishu","100000");
$obj3=new Destruct("Kakashi","150000");

echo $obj1->name."<br>";
echo $obj2->name."<br>";
echo $obj3->name."<br>";
echo $obj3->salary."<br>";
?>