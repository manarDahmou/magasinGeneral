<?php
    if (isset($_COOKIE['mon_panier'])) {
    $coockie = $_COOKIE['mon_panier'];
    $arry = explode(',', $coockie);
    $a = array_count_values($arry);
    }
   
    try {
        // On se connecte à MySQL 
        $bdd = new PDO('mysql:host=localhost;dbname=mg;charset=utf8', 'root', '');
        $req = "SELECT * FROM `produit` WHERE `Id_pro` in($coockie)";
        $reponse = $bdd->query($req);
        } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    foreach ($reponse->fetchAll() as $donnee) {
    echo "<br>";
    echo $donnee['Nom_pro'];
    echo "<br>";
    echo $donnee['Prix_HT'];
    echo "<br>";
    echo $a["," . $donnee['Id_pro'] . ","] ;
    }
            
?>