<?php
if ( !empty($_POST)){
    $servername = "db";
    $username = "root";
    $password = "root";
    $dbname = "training";
    
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT * FROM user WHERE username = '".htmlentities($_POST["username"])."' LIMIT 1"; 
      $stmt = $conn->prepare($sql);
      $stmt->execute();
       // set the resulting array to associative
       $result = $stmt->fetch(PDO::FETCH_ASSOC);
       echo "<pre>";
        // var_dump($result);
        // si le mot-de-passe entré dans le formulaire correspond à celui de la base 
        // de donnée Alors on redirige sur admin.php
        // sinon on affiche un message
        if( !empty($result) && password_verify((htmlentities($_POST["password"])), $result["password"] )) {
            session_start();
            $_SESSION = $result;
            header("Location:./admin.php");
            exit;
        }else {
            $error = "Mauvais pioche Username/Password !";
        }
    
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
<h3>Please Login</h3>
        <?php
        if(isset($error)){
            echo "<h2 style=\"color:red\">".$error."</h2>";
        }
        ?>
    <form method="POST" action="">
        <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
        <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <input type="submit" value="Login In">
    
    </form>
</body>
</html>