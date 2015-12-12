<?php

	// Gestion de la validation du compte et afichage d'un messsage d'informations

	require "bd/bdd.php";
	if (!isset($_GET['cle']) || !isset($_GET['email'])) {
		header('location:connexion.php');
	}   // else
		
    $cle = $_GET['cle'];
    $email = $_GET['email'];
    $bdd = bdd();

    $req = $bdd->prepare("SELECT user_etat, user_cle FROM users WHERE user_email = :email");
	$req->bindParam(":email", $email);
	$req->execute();
    $data = $req->fetch();

    if ($data['user_etat'] == 1) {
        echo "Le compte est déjà activé. <a href=\"../connexion.php\">Connectez vous</a> pour profiter de votre compte";
    } else {
        if ($cle == $data['user_cle']) {
            echo "Votre compte est bien activé. <a href=\"../connexion.php\">Connectez vous</a> pour profiter de votre compte";
			$req2 = $bdd->prepare("UPDATE users SET user_etat = 1 WHERE user_email LIKE :email");
			$req2->bindParam(":email", $email);
			$req2->execute();
        } else {
            echo "Erreur, ce compte ne peut pas être activé. <a href=\"../connexion.php\">Connectez vous</a> pour profiter de votre compte";
        }
    }
?>