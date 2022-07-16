<?php

session_start();
if (isset($_POST['email']) && isset($_POST['password'])) {
    try {
        // On se connecte à MySQL 
        $bdd = new PDO('mysql:host=localhost;dbname=mg;charset=utf8', 'root', '');
    } catch (Exception $e) {

        die('Erreur : ' . $e->getMessage());
    }
    $email = $_POST['email'];
    $password = $_POST['password'];

    //$req = "SELECT login,password FROM compte WHERE login='$login' AND password='$password'";
    $req1 = "SELECT * FROM client WHERE Email_cli='$email' AND Pass_cli='$password'";
    $reponse1 = $bdd->query($req1);
    $etat = $reponse1->rowCount();
    $donnees1 = $reponse1->fetch();
    $id = $donnees1['Id_cli'];
    $_SESSION['id'] = $id;
    If ($etat != 0) {
        if (($email == $donnees1['Email_cli']) && ($password == $donnees1['Pass_cli'])) {
            $_SESSION['email'] = $donnees1['Email_cli'];
            $_SESSION['password'] = $donnees1['Pass_cli'];
            
                $req2 = "SELECT * FROM client WHERE Id_cli='$id'";
                $reponse2 = $bdd->query($req2);
                $donnees2 = $reponse2->fetch();
                $_SESSION['nom'] = $donnees2['Nom_cli'];
                $_SESSION['prenom'] = $donnees2['Prenom_cli'];
                $_SESSION['date'] = $donnees2['Date_ness'];
                $_SESSION['adr'] = $donnees2['Adr_cli'];
                $_SESSION['tel'] = $donnees2['Tel_cli'];
                header('Location: index.php');
            
        }else {
            header('Location: login.php?erreurcnx=1');
        }
    } else {
        header('Location: login.php?erreurcnx=2');
    }
}
$reponse->closeCursor();
?>