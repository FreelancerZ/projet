<?php

require "bd/bdd.php";

/**
 * Envoie un mal à l'utilisateur recevant une proposition, qui pourra la confirmer ou non par la suite
 * @param $idContrat identifiant du contrat proposé
 * @param $tab tableau contenant le mail, la description (motivation) du candidat
 * @return phrase de confirmation
 */
function creerProposition($idContrat, $tab) {
	// Ajout de la proposition dans la BD
	ajouterProposition($idContrat);
	
	// Envoie du mail
	$tabInfosContrat = recupInfosContrat($idContrat);
    $destinataire = $tabInfosContrat[1];
    $sujet = "[Freelancerz] : Candidature pour votre contrat" ;
    $entete = "From: noreply@freelancerZ.com" ;

	// Ne pas toucher l'indentation (sinon moche dans le mail)
    $contenu = 'Bonjour,
	Une personne s\'est proposée pour votre contrat "'.$tabInfosContrat[0].'".
	Vous avez désormais accès à la partie privée de son profil.
	Voici sa candidature :
	---------------
		
	'.$tab['desc'].'

	---------------
	Vous pouvez accepter ou refuser cette candidature ici : http://127.0.0.1/freelance/candidatures.php.
	Ceci est un mail généré via formulaire, Merci de ne pas y répondre.';

    @mail($destinataire, $sujet, $contenu, $entete);
	
	// Affichage du message de validation
    return "<p id=\"message_ok\">Votre proposition à ce contrat à bien été enregistrée.<br>Vous serez informé si vous êtes accepté ou non.</p>";
}

/**
 * Ajoute à la base de données la proposition.
 * @param $idContrat identifiant du contrat
 */
function ajouterProposition($idContrat) {
    $bdd = bdd();

    $req = $bdd->prepare("INSERT INTO proposition (prop_user, prop_contrat, prop_etat) VALUES (:user, :idc, 0)");
    $req->bindParam(":user", $_SESSION['id']);
	$req->bindParam(":idc", $idContrat);

    $req->execute();
}

/**
 * Récupère les données du contrat (titre, email du créateur)
 * @param $idContrat identifiant du contrat
 * @reurn $tabInfosContrat titre et email du créateur
 */
 
function recupInfosContrat($idContrat) {
    $bdd = bdd();

    $req = $bdd->prepare("SELECT contrat_titre, user_email FROM contrat JOIN users ON user_id = contrat_auteur WHERE contrat_id = :idc");
	$req->bindParam(":idc", $idContrat);
    $req->execute();
	
	while ($data = $req->fetch()) {
		$tabInfosContrat = array($data["contrat_titre"], $data["user_email"]);
	}
	
	return $tabInfosContrat;
}

?>