<?php

session_start();
$_SESSION = array(); //vider les données de la session
session_destroy(); //détruire la session
header('Location: login.php');
?>
