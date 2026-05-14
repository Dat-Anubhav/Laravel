<?php
$a=10;
$arr=array("Srivastav Anubhav","Srivastav Rishu","Namikaze Minato","Oututsuki Kayuga");

//for loop//
for($i=1;$i<=$a;$i++)
    {
    echo "Hello php <br>";
    }

echo '<br><br>';

//foreach loop // used to iterate over collections like array without worring about conditions and iteration i++
foreach($arr as $k)
    {
        echo "Orewa ".$k.'<br>';
    }

//While loop//
echo "<br><br>";
$j=1;
while($j<=10)
    {
        echo 'I am learning PHP <br>';
        $j++;
    }
?>