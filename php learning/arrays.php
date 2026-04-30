<?php
$arr=['Anubhav',25,true];
echo '<pre>';

echo 'var_dump:- ';
var_dump($arr);
echo '<br>';
echo 'print_r:- ';
print_r($arr);
echo '</pre>';

/*In HTML, browsers normally ignore extra spaces and line breaks, 
squashing them into one single space. Using echo '</pre>' works with echo '<pre>' 
to fix this for your debugging.

echo '<pre>': This "opening" tag tells the browser: "Stop squashing spaces! Display everything exactly how it appears in the code".
echo '</pre>': This "closing" tag tells the browser: "Okay, go back to normal HTML formatting now".*/


//Associative array//

$a_arr =
[
    'name' => 'Anubhav',
    'age' => 25,
    'hobbies' => ['coding','walking','reading']
];

echo $a_arr['name'].'<br>';
echo '<br><br>';
echo '<pre>';
print_r($a_arr);
echo '</pre>';

?>