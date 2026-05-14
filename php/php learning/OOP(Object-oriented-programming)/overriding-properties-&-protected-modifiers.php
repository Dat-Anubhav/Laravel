<?php
class Getset{
    public $username;
    protected $email;
    
    //Note:- In PHP, the protected access modifier is a middle ground between public and private.
    //  It restricts visibility so that properties and methods are only accessible from within the class itself and by classes that inherit from it (subclasses).
    
    public $role="member";

    public function __construct($username,$email){
        $this->username=$username;
        $this->email=$email;
    }

    public function message(){
        return "$this->email sent a message";
    }

    //getter
    public function getEmail(){
        return $this->email;
    }

    //setters
    public function setEmail($email){
        if(strpos($email,'@') > -1){
            $this->email=$email;
        }
    }
}

class Inh extends Getset{
    public $level;
    public $role="admin";// overriding an property
    public function __construct($username,$email,$level){
        $this->level=$level;
       parent::__construct($username,$email);// calling parent constructor manually

}
    public function message(){//overriding an public function
        return "$this->email an admin, sent a message";// because of protected access modifier we can use $email directly here in this child class
    }
}

$obj1=new Getset("Anubhav","anubhav@example.com");
$obj2=new Getset("Rishu","rishu@example.com");
$obj3=new Inh("kakashi","kakashi@kamui.com",3);

echo $obj1->role;
echo '<br>';
echo $obj3->role;
echo '<br>';
echo $obj1->message() .'<br>';
echo $obj3->message() .'<br>';
?>
//private access modifier :- property or method can not be accessed outside the class, can be accessed only through getter and setter
// protected access modifier:- only child or inherient class can access the property or method
// public access modifier:- property or method can be accessed outside the class