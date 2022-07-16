<?php

$Id_pro = $_POST['Id_pro'];
$Categorie = $_POST['Categorie'];
$Nom_pro= $_POST['Nom_pro'];
$Info_pro= $_POST['Info_pro'];
$Quantite= $_POST['Quantite'];
$Prix_HT= $_POST['Prix_HT'];
$Tva= $_POST['Tva'];
try{
    $conn = new PDO('mysql:host=localhost;dbname=mg;charset=utf8', 'root', '');
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    $sql = "UPDATE produit SET Categorie='$Categorie',Nom_pro='$Nom_pro',Info_pro='$Info_pro',Quantite='$Quantite',Prix_HT='$Prix_HT',`Tva%`='$Tva' WHERE Id_pro='$Id_pro'";
  
    // Prepare statement
    $stmt = $conn->prepare($sql);
  
    // execute the query
    $stmt->execute();
  
    // echo a message to say the UPDATE succeeded
    echo $stmt->rowCount() . header('Location: produit.php');
  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
  
  $conn = null;
  ?>

?>