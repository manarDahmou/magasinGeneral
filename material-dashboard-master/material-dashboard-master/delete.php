<?php
$id=$_GET['id'];
try {
  $conn = new PDO('mysql:host=localhost;dbname=mg;charset=utf8', 'root', '');
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // sql to delete a record
  $sql = "DELETE FROM client WHERE Id_cli='$id'";

  // use exec() because no results are returned
  $conn->exec($sql);
  header('Location: client.php');
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>