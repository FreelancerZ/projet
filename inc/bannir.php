<?php
	function bannir($idUser, $raison) {
	    include_once "bd/bdd.php";
		
		// connexion à la BDD
		$bdd = bdd();
		
		// bannisement de l'utilisateur
		$sql = "UPDATE users SET user_banni = 1 WHERE user_id = :id";
		$req = $bdd->prepare($sql);
		$req->bindParam(':id', $idUser);
		
		$req->execute();
		
		// récupération du destinataire
		$sql2 = "SELECT user_email FROM users WHERE user_id = :id";
		$req2 = $bdd->prepare($sql2);
		$req2->bindParam(':id', $idUser);
		
		$req2->execute();
		$data = $req->fetch();
		
		$destinataire = $data['user_email'];
		
		// envoie du mail
		$sujet = "[Freelancerz] : Votre compte a été bloqué !" ;
		$entete = "From: noreply@freelancerZ.com" ;

		$contenu = 'Bonjour,

		Votre compte a été bloqué. Vous ne pouvez plus accéder à nos services.
		
		'.$raison.'

		Cordialement, l\'équipe d\'administration.

		---------------
		Ceci est un mail automatique, Merci de ne pas y répondre.';

		@mail($destinataire, $sujet, $contenu, $entete) ; // Envoi du mail
		
		return "L'utilisateur a bien été banni !";
	}
?>