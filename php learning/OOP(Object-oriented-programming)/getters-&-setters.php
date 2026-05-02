<?php
class Getset{
    public $username;
    public $email;

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
        if(strpos($email,'@')>-1){
            $this->email=$email;
        }
    }
}

$obj1=new Getset("Anubhav","anubhav@example.com");
$obj2=new Getset("Rishu","rishu@example.com");

echo $obj1->username;
echo '<br>';
echo $obj2->email;
echo '<br>';
echo $obj1->setEmail("anubhavrishu@example.com");
?>