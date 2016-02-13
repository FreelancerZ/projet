<?php
	function bannir($idUser, $raison) {
	    include_once "bd/bdd.php";
		
		// connexion à la BDD
		$bdd = bdd();

		// récupération du destinataire
		$sql2 = "SELECT user_email, user_admin FROM users WHERE user_id = :id";
		$req2 = $bdd->prepare($sql2);
		$req2->bindParam(':id', $idUser);

		$req2->execute();
		$data = $req2->fetch();
		$destinataire = $data['user_email'];

		// Si l'user est aussi un modérateur / administrateur alors on ne peut pas le bannir
		if ($data['user_admin'] == 1) {

			echo "<script>window.alert('Cet utilisateur est un modérateur et ne peut donc pas être banni');</script>";
		} else {
			// bannisement de l'utilisateur
			$sql = "UPDATE users SET user_banni = 1 WHERE user_id = :id";
			$req = $bdd->prepare($sql);
			$req->bindParam(':id', $idUser);

			$req->execute();


			echo "<script>window.alert('Cet utilisateur est désormais banni');</script>";

			// envoi du mail
			$sujet = "[Freelancerz] : Votre compte est suspendu !";
			$entete = "From: noreply@freelancerZ.com";

			$contenu = 'Bonjour,

		Votre compte a été bloqué. Vous ne pouvez plus accéder à nos services.
		
		' . $raison . '

		Cordialement, l\'équipe d\'administration.

		---------------
		Ceci est un mail automatique, Merci de ne pas y répondre.';


			mail($destinataire, $sujet, $contenu, $entete) ; // Envoi du mail
		}
	}
	
	function estBanni($idUser) {
	    include_once "bd/bdd.php";
		
		// connexion à la BDD
		$bdd = bdd();
		
		$sql = "SELECT user_banni FROM users WHERE user_id = :id";
		$req = $bdd->prepare($sql);
		$req->bindParam(':id', $idUser);

		$req->execute();
		$data = $req->fetch();
		
		if ($data['user_banni'] == 1) {
			return true;
		}	// else
		
		return false;
	}
	
	function estBannisable($idUser) {
	    include_once "bd/bdd.php";
		
		// connexion à la BDD
		$bdd = bdd();
		
		$sql = "SELECT user_admin, user_banni FROM users WHERE user_id = :id";
		$req = $bdd->prepare($sql);
		$req->bindParam(':id', $idUser);

		$req->execute();
		$data = $req->fetch();
		
		if ($data['user_admin'] == 1 || $data['user_banni'] == 1) {
			return false;
		}	// else
		
		return true;
	}
?>