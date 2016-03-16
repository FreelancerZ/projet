<?php
/**
 * Récupére tous les informations d'un certain user
 * @return Un tableau [][] contenant les informations néssaires a l'affichage
 */
function recupDetailsProfil($idUser) {
    $details = array();
    include_once "bd/bdd.php";
    $bdd = bdd();
	$sql = "SELECT user_nom, user_prenom, user_ville, user_adresse, user_cp, user_email,
						 user_naissance, user_competences, user_site1, user_site2, user_site3, user_site4, user_site5, user_pseudo
						 FROM users WHERE user_id = :id";
	
	if (estAutoVoirPrivee($idUser) == 0) {
		$sql = "SELECT user_nom, user_prenom, user_ville, user_adresse, user_cp, user_email,
						 user_naissance, user_competences, user_site1, user_site2, user_site3, user_site4, user_site5, user_pseudo
						 FROM users_privee WHERE user_id = :id";
	}

    $req = $bdd->prepare($sql);
	$req->bindParam(":id", $id);
    $id = $idUser;
	
    $req->execute();
    $data = $req->fetch();
    $details = array($data['user_nom'], $data['user_prenom'], $data['user_ville'], $data['user_adresse'],
                                   $data['user_cp'], $data['user_email'], $data['user_naissance'], $data['user_competences'], $data['user_site1'],
                                   $data['user_site2'], $data['user_site3'], $data['user_site4'],$data['user_site5'],$data['user_pseudo']);
	return $details;
}

/** @return 0 si authorisé, 1 sinon **/
function estAutoVoirPrivee($idUserCible) {
	$idUserVoyeur = $_SESSION['id'];
	
	if ($idUserCible == $idUserVoyeur) {
		return 0;
	}	// else
	
    include_once "bd/bdd.php";
    $bdd = bdd();
	
    $req = $bdd->prepare("SELECT prop_id FROM proposition WHERE prop_user = :id");
    $req->bindParam(":id", $idUserVoyeur);
	$req->execute();
	
	while ($data = $req->fetch()) {
		if ($data['prop_id'] != null) {
			$req2 = $bdd->prepare("SELECT contrat_auteur FROM contrat WHERE contrat_id = :id");
			$req2->bindParam(":id", $data['prop_id']);
			$req2->execute();
			while ($data2 = $req2->fetch()) {
				if ($data2['contrat_auteur'] == $idUserCible) {
					return 0;
				}
			}
		}
	}
	
	return 1;
}
?>