<?php
echo "<pre>";
print_r($_POST);
print_r($_FILES);

$servername = "db";
$username = "root";
$password = "root";
$dbname = "training";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO `contact` (`id`, `nom`, `prenom`, `email`, `adresse`, `code_postal`, `ville`, `message`, `curriculum`) VALUES (NULL, '". htmlentities($_POST["nom"]) ."', '". htmlentities($_POST["prenom"]) ."', '". htmlentities($_POST["email"]) ."', '". htmlentities($_POST["adresse"]) ."', '". htmlentities($_POST["code_postal"]) ."', '". htmlentities($_POST["ville"]) ."', '". htmlentities($_POST["message"]) ."', '". htmlentities($_FILES["curriculum"]["name"]) ."');";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully";

  move_uploaded_file($_FILES["curriculum"]["tmp_name"], "./uploads/".$_FILES["curriculum"]["name"]);
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;