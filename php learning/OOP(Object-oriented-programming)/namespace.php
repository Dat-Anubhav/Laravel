<?php
//Namespaces in PHP act like virtual "folders" for your classes, functions, and constants. 
// They solve the problem of name collisions, allowing you to have two classes with the same name 
// (like User) in the same project without conflict.

namespace abc{
    class xyz{
        public function message(){
            echo "Hi i am in abc class xyz";
        }

    }
    class al{
        public function message(){
            echo " Hi i am in different class of abc namespace ";
    }

}
}

namespace def{
    class xyz{
        public function message(){
        echo "Hi i am in namespace def in class xyz";
    }
}

$obj1 = new xyz();
echo $obj1->message();
echo '<br>';

//If u want to access function or property of another newspace:-

//method 1 (using use keyword and alias name if classes names conflict)
use abc\xyz as jkl;// if u have same class name in both the namespaces u can use alias to distinguish
$obj2 = new jkl();
echo $obj2->message();


echo '<br>';
//If have diffeent class names
//method 2 (using use keyword):-

use abc\al;
$obj3 = new al();
echo $obj3->message();

//method 2 (without use):-
echo '<br>';

$obj4 = new \abc\al();
echo $obj4->message();
}
?>