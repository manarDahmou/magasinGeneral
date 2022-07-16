<?php

$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$id = $_POST['id_adm'];
$pwd = $_POST['pwd'];
try{
    $conn = new PDO('mysql:host=localhost;dbname=mg;charset=utf8', 'root', '');
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    $sql = "UPDATE admin SET Nom_adm='$nom',Prenom_adm='$prenom',Pass_adm='$pwd' WHERE Id_adm='$id'";
  
    // Prepare statement
    $stmt = $conn->prepare($sql);
  
    // execute the query
    $stmt->execute();
  
    // echo a message to say the UPDATE succeeded
    echo $stmt->rowCount() . header('Location: template.php?result=1');
  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
  
  $conn = null;
  ?>

?>