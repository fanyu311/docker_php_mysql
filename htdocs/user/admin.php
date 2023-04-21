<?php
session_start();
if ( empty($_SESSION)) {
    header('location:login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin</title>
</head>
<body>
    <!-- 当只有一条html的代码的时候可以简写-->
    <h1>Welcome <?=$_SESSION['username']; ?> !</h1>
    <p>Your role is <b><?=$_SESSION["role"]; ?></b></p>
    <h3>
    <?php
    if($_SESSION['role'] === 'admin'){
        echo "Oh grand maitre vous ici !";
    } else {
        echo "Salut client !";
    }
    ?>
    </h3>
    <h2>Do you want to <a href="logout.php">Logout</a> ?</h2>
    
</body>
</html>