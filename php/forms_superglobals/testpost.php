<?php
echo '<pre>';
echo print_r($_POST);// if u want to save a important data then use $_post for public data use $_GET
echo '</pre>';

echo $_REQUEST['email'];// %_REQUEST works with both $_GET AND $_POST
?>
