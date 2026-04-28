<?php
$name= 'Anubhav';
$s_name= 'Srivastav';
$age=25.5;
$isyoung= true;
$isold=false;

echo "Hello {$name}".' '. $s_name .' '. $age .'<br>';// {$name} like f-string python, but here it only works in double quotes.
echo $isyoung.'<br>';
echo $isold . '<br>';// if its true then it will return 1, if false it returns nothing

echo 'Data type of $name variable is ='.' '.gettype($name).'<br>';// gettype() displays the type of a variable
echo 'Data type of $name variable is ='.' '. gettype($age).'<br>';

echo "<br>";
echo 'Print_r() function: ';
print_r($name);
echo '<br>';


/*NOTE:-  <br> works only with echo if u want to change the line then type echo '<br>'; 
because echo is used Outputting text or variables directly to the browser.

print_r is used Debugging; showing the internal structure of arrays or objects.

var_dump(): Shows the data types (like string, int, bool) and lengths of everything*/

var_dump($age);
echo '<br>';
var_dump(is_string($name));

echo "<br><br>";
echo strtolower($name);
?>