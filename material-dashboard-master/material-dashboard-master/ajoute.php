<?php
$Categorie = $_POST['Categorie'];
$Nom_pro= $_POST['Nom_pro'];
$Info_pro= $_POST['Info_pro'];
$Quantite= $_POST['Quantite'];
$Prix_HT= $_POST['Prix_HT'];
$Tva= $_POST['Tva'];
try {
  $conn = new PDO('mysql:host=localhost;dbname=mg;charset=utf8', 'root', '');
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO `produit` (`Id_pro`, `Categorie`, `Nom_pro`, `Info_pro`, `Quantite`, `Prix_HT`, `Tva%`)
   VALUES (NULL, '$Categorie', '$Nom_pro', '$Info_pro', '$Quantite', '$Prix_HT', '$Tva');";
  // use exec() because no results are returned
  $conn->exec($sql);
  header('Location: ajoute_pro.php');
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>