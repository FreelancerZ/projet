<?php

require "bd/bdd.php";

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
Vous pouvez accepter ou refuser cette candidature ici : http://127.0.0.1/FreelancerZ/projet/candidatures.php.
Ceci est un mail généré via formulaire, Merci de ne pas y répondre.';

    @mail($destinataire, $sujet, $contenu, $entete);
	
	// Affichage du message de validation
    return "<p id=\"message_ok\">Votre proposition à ce contrat à bien été enregistrée.<br>Vous serez informé si vous êtes accepté ou non.</p>";
}

function ajouterProposition($idContrat) {
/*     require "bd/bdd.php";*/
    $bdd = bdd();

    $req = $bdd->prepare("INSERT INTO proposition (prop_user, prop_contrat, prop_etat) VALUES (:user, :idc, 0)");
    $req->bindParam(":user", $_SESSION['id']);
	$req->bindParam(":idc", $idContrat);

    $req->execute();
}

function recupInfosContrat($idContrat) {
/*     require "bd/bdd.php";*/
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