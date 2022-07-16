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
    $req1 = "SELECT * FROM admin WHERE Email_adm='$email' AND Pass_adm='$password'";
    $reponse1 = $bdd->query($req1);
    $etat = $reponse1->rowCount();
    $donnees1 = $reponse1->fetch();
    $id = $donnees1['Id_adm'];
    If ($etat != 0) {
        if (($email == $donnees1['Email_adm']) && ($password == $donnees1['Pass_adm'])) {
            $_SESSION['email'] = $donnees1['Email_adm'];
            $_SESSION['password'] = $donnees1['Pass_adm'];
            
                $req2 = "SELECT * FROM admin WHERE Id_adm='$id'";
                $reponse2 = $bdd->query($req2);
                $donnees2 = $reponse2->fetch();
                $_SESSION['id'] = $id;
                $_SESSION['nom'] = $donnees2['Nom_adm'];
                $_SESSION['prenom'] = $donnees2['Prenom_adm'];
                header('Location: template.php');
            
        }else {
            header('Location: index.php?erreurcnx=1');
        }
    } else {
        header('Location: index.php?erreurcnx=2');
    }
}
$reponse->closeCursor();
?>