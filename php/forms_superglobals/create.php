<?php
var_dump($_FILES);
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    $name=filter_input(INPUT_POST,"name",FILTER_SANITIZE_SPECIAL_CHARS);
    $email=filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
    $phone=filter_input(INPUT_POST,"phone",FILTER_SANITIZE_NUMBER_INT);

    
    if($name && $email && $phone && isset($_FILES['image']))
        {
            echo "Contact added: $name ($email, $phone)";
        }
    else
        {
            echo "INVALID INPUT";
        }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name">

<?php echo '<br><br>'; ?>

        <label>Email:</label>
        <input type="text" name="email">
<br><br>
        <label>phone:</label>
        <input type="text" name="phone">
<br><br>
        <label>Contact image:</label>
        <input type="file" name="image"
        accept="image/*" required>
<br><br>

        <button type="submit">Add contact</button>
    </form>
</body>
</html>