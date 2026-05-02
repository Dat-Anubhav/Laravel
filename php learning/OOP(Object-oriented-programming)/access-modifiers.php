<?php

class Access{

public $username;
private $email;

public function __construct($username, $email){
    $this->username = $username;
    $this->email = $email;
}

public function add_friend(){
    return "$this->email added a new friend";

}
}
$obj1 = new Access("Anubhav","anubhav@example.com");

echo $obj1->username;
echo '<br>';

//echo $obj1->email; //u can not call $email beacuse of access modifier private u can use it with in a classs only not outside the class

echo $obj1->add_friend() // but u can call a public function which has a private variable and it will work because it is a public function
//  and it will do its work when called even if some of its variables are private 
?>