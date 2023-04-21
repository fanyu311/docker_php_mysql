<?php
header("Content-type: application/json; charset=utf-8");
// 这里也需要更改名字跟密码，需要跟之前的相同
$servername = "db";
$username = "root";
$password = "root";
$dbname = "training";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT ville_nom_reel FROM villes_france_free WHERE ville_code_postal LIKE '".$_GET['cp']."%' ORDER BY ville_nom_reel ASC";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
   // set the resulting array to associative
   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
//    echo "<pre>";
//    var_dump($result);

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
