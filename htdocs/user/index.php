<?php
if( !empty($_POST)) {
    $servername = "db";
    $username = "root";
    $password = "root";
    $dbname = "training";
    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $password_hash = password_hash(htmlentities($_POST["password"]), PASSWORD_DEFAULT);

    $sql = "INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES (NULL, '". htmlentities($_POST["username"]) ."', '". $password_hash ."', 'customer');";
    // use exec() because no results are returned
    $conn->exec($sql);
    //   echo "New record created successfully";
    } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <style>
         label,
        input,
        textarea,
        select {
            display: block;
            padding: 5px;
            width: 100%;
            box-sizing: border-box;
        }
        input:invalid, select:invalid {
            border: 2px red solid;
        }
    </style>
</head>
<body>
    <h3>Please Sign In or <a href="Login.php">Login</a></h3>
    <form method="POST" action="">
        <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
        <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <input type="submit" value="Sign In">
    
    </form>
</body>
</html>