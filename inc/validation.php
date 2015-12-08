<?php
require "bd/bdd.php";
if (!isset($_GET['cle']) || !isset($_GET['email'])) {
    header('location:connexion.php');
    }   // else
    $cle = $_GET['cle'];
    $email = $_GET['email'];
    $bdd = bdd();

    $req = $bdd->query("SELECT user_actif, cle FROM users WHERE user_email = '{$email}'");
    $data = $req->fetch();

    if ($data['user_actif'] == 1) {
        echo "Le compte est déjà activé. <a href=\"../connexion.php\">Connectez vous</a> pour profiter de votre compte";
    } else {
        if ($cle == $data['cle']) {
            echo "Votre compte est bien activé. <a href=\"../connexion.php\">Connectez vous</a> pour profiter de votre compte";
            $bdd->exec("UPDATE users SET user_actif = 1 WHERE user_email like '{$email}'");
        } else {
            echo "Erreur, ce compte ne peut pas être activé. <a href=\"../connexion.php\">Connectez vous</a> pour profiter de votre compte";
        }
    }
    ?>