<?php
$insert = false;
// Only run this if the 'name' field is sent from the form
if(isset($_POST['name'])){
    $host = "";
    $user = "";
    $password = "";
    $db = "";

    try {
        // 1. Establish the connection
        $dsn = "pgsql:host=$host;port=5432;dbname=$db;";
        $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        // 2. Capture the data from your form
        $name = $_POST['name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $desc = $_POST['desc'];

        // 3. Prepare the SQL query
        $sql = "INSERT INTO trip (name, age, gender, email, phone, other) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        // 4. Execute and save
        if($stmt->execute([$name, $age, $gender, $email, $phone, $desc])){
            $insert = true;
        }

    } catch (PDOException $e) {
        echo "Connection Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Travel Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="container">
        <?php
if($insert == true){
    echo "<p class='submitMsg'>Thanks for submitting your form. We are happy to see you joining us for the trip</p>";
}
?>
    <h1>International Travel Registration Portal</h1>
    <p>Complete the form below to confirm your registration and eligibility for the travel program.</p>
    
    <form action="index.php" method="post">
        <input type="text" name="name" id="name" placeholder="Please enter your name" required>
        <input type="text" name="age" id="age" placeholder="Please enter your age " required>
        <input type="text" name="gender" id="gender" placeholder="Please enter your gender" required>
        <input type="text" name="email" id="email" placeholder="Please enter your email" required>
        <input type="text" name="phone" id="phone" placeholder="Please enter your phone" required>
        <textarea name="desc" cols="30" rows="10" placeholder="Enter any other information here"></textarea>
        <button class="btn">Submit</button>
        
    
    </form>
    </div>
    <script src="index.js"></script>
</body>
</html>