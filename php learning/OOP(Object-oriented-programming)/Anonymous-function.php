<?php

// Anonymous functions also know as closureds or lambda, allow the creation of functions which have no specified name.
// Anonymous fuhnctions can be stored in a variable, can be returned in a function and can also be pass in a function
// note normal function don't end end with a semi colon but in anonymous function semi colon (;) is mandatory.

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

//How to use Global variables in Anonymous function:
class Glo{
    public $s=30;
    
    public $b;
    
    public function __construct(){
        
    //Method 1:
        $this->b=function($p){//work as lambda: giving arguments later while calling 
            echo '<br>';
    echo " global variable $p in anonymous function method 1";
};

    }
    public function method_2(){
    $k=function(){//closure: capture the variable $s
        echo "Global variable" . $this->s . " in anonymous function method 2";
    };
        return $k;

}
}
$obj2=new Glo();
echo "  ".($obj2->b)($obj2->s);
echo '<br>';
echo ($obj2->method_2())();// first () for the public method_2 2nd () for the anonymous function 
// or u can call $k(); the anonymous function within the method_2 function then u don't have to write 2 parenthesis () here.


class Retrn{
    
        public function return_anonymous($str){
            return function($a_str) use ($str){
                return "Hello anubhav $a_str $str";
            };
         }

    }
    

$obj3=new Retrn();
echo '<br><br><br>';
$a=$obj3->return_anonymous("Hehehe");//closure
echo $a("rishu");
/* OR */

echo "<br>";
echo $obj3->return_anonymous("Hehe")("kakashi");
?>