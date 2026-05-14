<?php
class map{
    public $merge;

    public function __construct(){
        
        $arr=[['id'=>1, 'name'=>'anubhav'],['id'=>2, 'name'=>'rishu']];//$arr has two sub arrays

        $m=function(){
            return 'Hello';

        };
        $this->merge=array_map($m,$arr);// declare merge as public so that object can remeber it and can be called outside the class.
    // Transform each sub-array into the string 'Hello' and store the resulting array.
    }
}
$obj1=new map();

echo '<pre>';
print_r($obj1->merge);
echo '</pre>';
?>