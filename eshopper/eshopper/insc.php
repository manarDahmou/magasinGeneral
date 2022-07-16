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
    $conn->exec("INSERT INTO `client` (`Id_cli`, `Nom_cli`, `Prenom_cli`, `Email_cli`, `Pass_cli`, `Date_ness`, `Adr_cli`, `Tel_cli`) VALUES (NULL, '$nom', '$prenom', '$email', '$pwd', '$date', '$adr', '$tel');");
    // commit the transaction
    $conn->commit();
    header('Location: login.php?erreurins=1');
    
} catch (PDOException $e) {
    // roll back the transaction if something failed
    $conn->rollback();
    header('Location: login.php?erreurins=2');
    $e->getMessage();
}

$conn = null;
?>  