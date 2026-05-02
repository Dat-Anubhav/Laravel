<?php
class Getset{
    public $username;
    private $email;

    public function __construct($username,$email){
        $this->username=$username;
        $this->email=$email;
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
    public function __construct($username,$email,$level){
        $this->level=$level;
       parent::__construct($username,$email);// calling parent constructor manually

}
}

$obj1=new Getset("Anubhav","anubhav@example.com");
$obj2=new Getset("Rishu","rishu@example.com");
$obj3=new Inh("kakashi","kakashi@kamui.com",3);

echo $obj1->username."<br>".$obj2->username.'<br>'.$obj3->username.'<br>'.$obj3->getEmail().'<br>'.$obj3->level;
//echo $obj3->email;

//Note1:- In inheritance, the logic of getters and setters is used to share data safely between a "Parent" class and a "Child" class without making that data available to everyone else.
// without setters and getters child class can not read the private variables of the parent class

//NOTE2:- a child class inherits the constructor and all public and protected functions from the parent class automatically.
//imp Note3: But, if you define a new constructor in the child class, PHP will run the child's constructor instead of the parent's. To run both, you must call the parent manually.