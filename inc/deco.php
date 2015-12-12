<?php
// Ferme la session actuelle de l'utilisateur, puis le redirige sur la page de connexion
session_start();
session_destroy();
header("location:../connexion.php");
?>