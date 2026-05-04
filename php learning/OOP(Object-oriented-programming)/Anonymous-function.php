<?php

class Anonymous{
    public $a;
    public function __construct(){

    $this->a=function($n){
        return $n * $n;
    };
    }
}

$obj1=new Anonymous();
echo "Square = ".($obj1->a)(10);

//Note:- If you remove the first set of brackets and write $calc->a(4), 
// PHP will get confused. It will look for a method (a standard function) named a() 
// inside the class. Since a is a property and not a method, 
// the code will crash with a "Call to undefined method" error.

?>