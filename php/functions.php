<?php

//Functions//
function display_name($n,$b)
{
    return $n*$b;
}

$r=display_name(10,20);
echo "Product_1 =".$r.'<br>';
echo "Product_2 = ".display_name(5,10);
?>