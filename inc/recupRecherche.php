<?php

/**
 * Recherche et affiche les valeurs de la base de données qui corresponde à la recherche de l'utilisateur
 * @param $resRech contient tout les mots tapés dans le champ de recherche, séparés par un espace.
 * @return array Un tableau [][] contenant les informations nécessaires à l'affichage
 */
function rechercheAll($resRech) {
	// Connexion à la base de données
	require "bd/bdd.php";
	$bdd = bdd();
	
	// La requête SQL
	$sql = "SELECT * FROM v_recherche_texte";
	
	// Traitement des paramètres multiples
	$tabRech = explode(" ", $resRech);
	$i = 0;
	foreach($tabRech as $mot) {
		$mot = addslashes($mot);
		if (strlen($mot) >= 3) {
			if ($i == 0) {
				$sql.=" WHERE ";
			} else {
				$sql.=" OR ";
			}
			$sql.="contrat_titre LIKE '%$mot%' OR contrat_theme LIKE '%$mot%' OR contrat_competences LIKE '%$mot%'";
			$sql.="OR contrat_montant LIKE '%$mot%' OR user_nom LIKE '%$mot%' OR user_prenom LIKE '%$mot%' OR contrat_description LIKE '%$mot%'";
			$i++;
		}
	}
	
	$req = $bdd->prepare($sql);
	$req->execute();
	
	$i = 0;
	$resultats = null;
	while ($data = $req->fetch()) {
		$resultats[$i] = array($data['contrat_id'], $data['user_nom'], $data['user_prenom'], $data['contrat_titre'], $data['contrat_theme'], $data['contrat_montant'], $data['contrat_competences']);
		$i++;
	}

	if ($resultats == null) {
		return -1;
	} else {
		return $resultats;
	}
}

/**
 * Recherche et affiche les valeurs de la base de données qui corresponde à la recherche de l'utilisateur
 * @param $resRech contient tout les mots tapés dans le champ de recherche, séparés par un espace.
 * @param $filtres tableau contenant pour chaque filtre, 1 ou 0 (utilisé ou non)
 * @return $resultats Un tableau [][] contenant les informations nécessaires à l'affichage
 */
function rechercheFiltre($resRech, $filtres) {
	// Connexion à la base de données
	require "bd/bdd.php";
	$bdd = bdd();
	
	$sql = "SELECT * FROM v_recherche_texte";
	
	// Traitement des paramètres multiples
	$tabRech = explode(" ", $resRech);
	$i = 0;
	foreach($tabRech as $mot) {
		$mot = addslashes($mot);
		if (strlen($mot) >= 3) {
			if ($i == 0) {
				$sql.=" WHERE ";
			} else {
				$sql.=" OR ";
			}
			
			foreach ($filtres as $leFiltre){
				switch ($leFiltre) {
					case "Titre":
						$sql.="contrat_titre LIKE '%$mot%'";
						break;
					case "Theme":
						$sql.="contrat_theme LIKE '%$mot%'";
						break;
					case "CptsReq":
						$sql.="contrat_competences LIKE '%$mot%'";
						break;
					case "Montant":
						$sql.="contrat_montant LIKE '%$mot%'";
						break;
					case "Auteur":
						$sql.="user_nom LIKE '%$mot%' OR user_prenom LIKE '%$mot%'";
						break;
					case "Keywords":
						$sql.="contrat_description LIKE '%$mot%'";
						break;
					default:
						$sql.="contrat_titre LIKE '%$mot%' OR contrat_theme LIKE '%$mot%' OR contrat_competences LIKE '%$mot%'";
						$sql.="OR contrat_montant LIKE '%$mot%' OR user_nom LIKE '%$mot%' OR user_prenom LIKE '%$mot%' OR contrat_description LIKE '%$mot%'";
				}
			}
			$i++;
		}
	}

	$req = $bdd->prepare($sql);
	$req->execute();
	
	$i = 0;
	$resultats = null;
	while ($data = $req->fetch()) {
		$resultats[$i] = array($data['contrat_id'], $data['user_nom'], $data['user_prenom'], $data['contrat_titre'], $data['contrat_theme'], $data['contrat_montant'], $data['contrat_competences']);
		$i++;
	}

	if ($resultats == null) {
		return -1;
	} else {
		return $resultats;
	}
}

/**
 * Recherche et affiche les valeurs de la base de données qui corresponde à la periode entrée par l'utilisateur
 * @param $debut date de début
 * @param $fin date de fin
 * @return $resultats Un tableau [][] contenant les informations nécessaires à l'affichage
 */
function recherchePeriode($debut, $fin) {
	// Connexion à la base de données
	require "bd/bdd.php";
	$bdd = bdd();
	
	// La requête SQL
	$req = $bdd->prepare("SELECT * FROM v_recherche_periode WHERE contrat_debut_prevue BETWEEN :debut AND :fin
														  AND contrat_fin_prevue BETWEEN :debut AND :fin");
	$req->bindParam(":debut", $debut);
	$req->bindParam(":fin", $fin);
	$req->execute();
	
	$i = 0;
	$resultats = null;
	while ($data = $req->fetch()) {
		$resultats[$i] = array($data['contrat_id'], $data['user_nom'], $data['user_prenom'], $data['contrat_titre'], $data['contrat_theme'], $data['contrat_montant'], $data['contrat_competences']);
		$i++;
	}

	if ($resultats == null) {
		return -1;
	} else {
		return $resultats;
	}
}

/**
 * Recherche et affiche les valeurs de la base de données qui corresponde à la periode entrée par l'utilisateur
 * @param $debut date de début
 * @return $resultats Un tableau [][] contenant les informations nécessaires à l'affichage
 */
function rechercheDebut($debut) {
	// Connexion à la base de données
	require "bd/bdd.php";
	$bdd = bdd();
	
	// La requête SQL
	$req = $bdd->prepare("SELECT * FROM v_recherche_periode WHERE contrat_debut_prevue >= :debut");
	$req->bindParam(":debut", $debut);
	$req->execute();
	
	$i = 0;
	$resultats = null;
	while ($data = $req->fetch()) {
		$resultats[$i] = array($data['contrat_id'], $data['user_nom'], $data['user_prenom'], $data['contrat_titre'], $data['contrat_theme'], $data['contrat_montant'], $data['contrat_competences']);
		$i++;
	}

	if ($resultats == null) {
		return -1;
	} else {
		return $resultats;
	}
}

/**
 * Recherche et affiche les valeurs de la base de données qui corresponde à la periode entrée par l'utilisateur
 * @param $fin date de fin
 * @return $resultats Un tableau [][] contenant les informations nécessaires à l'affichage
 */
function rechercheFin($fin) {
	// Connexion à la base de données
	require "bd/bdd.php";
	$bdd = bdd();
	
	// La requête SQL
	$req = $bdd->prepare("SELECT * FROM v_recherche_periode WHERE contrat_fin_prevue <= :fin");
	$req->bindParam(":fin", $fin);
	$req->execute();
	
	$i = 0;
	$resultats = null;
	while ($data = $req->fetch()) {
		$resultats[$i] = array($data['contrat_id'], $data['user_nom'], $data['user_prenom'], $data['contrat_titre'], $data['contrat_theme'], $data['contrat_montant'], $data['contrat_competences']);
		$i++;
	}

	if ($resultats == null) {
		return -1;
	} else {
		return $resultats;
	}
}
?>