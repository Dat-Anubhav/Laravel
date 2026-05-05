<?php

//arrow function is kind of short form of anonymous function
class arrow{
    public $a;
    public $ar;
    public function __construct(){
        $s=[1,2,3,4,5];
        
        //normal anonymous function
        
        $an=function($n){
            return $n*10;};// this is an anonymous function
        
        $this->a=array_map($an, $s);//mapping

        //with Arrow function
        $arrow=fn($n) => $n*100; // this is an arrow function
        $this->ar=array_map($arrow, $s);



    }
}

$obj=new arrow();
echo '<pre>';
print_r($obj->a);
echo '</pre>';

echo '<pre>';
print_r($obj->ar);
echo '</pre>';
?>