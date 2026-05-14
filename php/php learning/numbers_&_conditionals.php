<?php 
$a=10;
$b= 5;
$product=$a*$b;
$power=$a**$b;
echo 'The product is = '.$product;

//Note:- == check variable but === checks data types as well

echo "<br>";
echo "{$a} To the power {$b}= 
"."{$power}";

//IF-ELSE//

$age=10;
if($age <=12)
{
    echo "<br>";
echo "You are too young to watch Harry potter";
}
else
{
echo "<br>";
echo "You can watch Harry potter ";
}
echo "<br><br>";

//Switch statemets//

$day ="sunday";

switch($day)
{
    case "monday":
        echo 'day 1';
        break;
    case "tuesday":
        echo 'day 2';
        break;
    case "Wednesday":
        echo 'day 3';
        break;
    case "thrusday":
        echo 'day 4';
        break;
    case "friday":
        echo 'day 5';
        break;
    case "saturday":
        echo 'day 6';
        break;
    case "sunday":
        echo 'day 7';
        break;
        
    default:
    echo 'Invalid day';

}

?>
