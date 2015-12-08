<?php
/**
 * Récupére tous les informations d'un certain user
 * @return Un tableau [][] contenant les informations néssaires a l'affichage
 */
function recupDetailsProfil($idUser) {
    $details = array();
    require "bd/bdd.php";
    $bdd = bdd();

    $req = $bdd->prepare("SELECT user_nom, user_prenom, user_ville, user_adresse, user_cp, user_email,
						 user_naissance, user_competences, user_site1, user_site2, user_site3, user_site4, user_site5, user_pseudo
						 FROM users WHERE user_id = :id");
    $req->bindParam(":id", $id);
    $id = $idUser;
	
    $req->execute();
    $data = $req->fetch();
    $details = array($data['user_nom'], $data['user_prenom'], $data['user_ville'], $data['user_adresse'],
                                   $data['user_cp'], $data['user_email'], $data['user_naissance'], $data['user_competences'], $data['user_site1'],
                                   $data['user_site2'], $data['user_site3'], $data['user_site4'],$data['user_site5'],$data['user_pseudo']);
	return $details;
}
?>

