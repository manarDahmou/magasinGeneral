<?php
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$pwd = $_POST['password'];
$date = $_POST['date'];
$adr = $_POST['adr'];
$tel = $_POST['tel'];
try {
    $conn = new PDO('mysql:host=localhost;dbname=mg;charset=utf8', 'root', '');
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // begin the transaction
    $conn->beginTransaction();
    // our SQL statements
    $conn->exec("INSERT INTO `admin` (`Id_adm`, `Nom_adm`, `Prenom_adm`, `Email_adm`, `Pass_adm`) VALUES (NULL, '$nom', '$prenom', '$email', '$pwd');");
    // commit the transaction
    $conn->commit();
    header('Location: Sign_In.php?erreurins=1');
    
} catch (PDOException $e) {
    // roll back the transaction if something failed
    $conn->rollback();
    header('Location: Sign_In.php?erreurins=2');
    $e->getMessage();
}

$conn = null;
?>  