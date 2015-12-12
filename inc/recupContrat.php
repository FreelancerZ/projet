<?php
/**
 * Récupère tous les contrats ouverts stockés dans la base de données
 * @return Un tableau [][] contenant les informations nécessaires à l'affichage
 */
function recupContrats() {
    $contrats = array();
    require "bd/bdd.php";
    $bdd = bdd();

	// PAGINATION ---------------------------------------------------------------------------
	$req = $bdd->prepare("SELECT count(*) as nbContrats FROM contrat LEFT JOIN users ON user_id = contrat_auteur
						  WHERE contrat_etat = 0 AND contrat_auteur != :id");
	$req->bindParam(":id",$_SESSION["id"]);
    $req->execute();
    $data = $req->fetch();

	$nbc = $data['nbContrats'];	// nombre total de contrats
	$cpp = 4;					// nombre de contrats affichés par pages
	$nbp = ceil($nbc/$cpp);		// nombre total de pages à afficher
	$pa = 1;					// numéro de page actuelle

	if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbp) {
		$pa = $_GET['page'];
	} else {
		$pa = 1;
	}

	echo '<span id="pagination">';	
	if ($nbp > 0) {
		echo '&nbsp&nbsp&nbspPage(s) :  ';
		for ($p=1; $p<=$nbp; $p++) {
			if ($p == $pa) {
				$page = $p==1?' '.$p.' ':'&nbsp '.$p.' ';
				echo $page;
			} else {
				$page = $p==1?' <a href="index.php?page='.$p.'" >'.$p.'</a> ':'&nbsp <a href="index.php?page='.$p.'" >'.$p.'</a> ';
				echo $page;
			}
		}
	}
	echo '</span>';
	// FIN PAGINATION ---------------------------------------------------------------------------

    $req = $bdd->prepare("SELECT contrat_id, user_nom, user_prenom, contrat_titre, contrat_theme, contrat_montant, contrat_competences
						  FROM contrat LEFT JOIN users ON user_id = contrat_auteur
						  WHERE contrat_auteur != :id
						  AND contrat_etat = 0 ORDER BY contrat_publication DESC  LIMIT ".($pa-1)*$cpp.",".$cpp."");
    $req->bindParam(":id",$_SESSION["id"]);
	$req->execute();
	
    $i = 0;
	$contrats = null;
    while ($data = $req->fetch()) {
        $contrats[$i] = array($data['contrat_id'], $data['user_nom'], $data['user_prenom'], $data['contrat_titre'], $data['contrat_theme'], $data['contrat_montant'], $data['contrat_competences']);
        $i++;
    }
    
	if ($contrats == null) {
		return -1;
	} else {
		return $contrats;
	}
}

/**
 * Récupère tous les informations d'un certain contrat
 * @param int idContrat - l'identifiant du contrat
 * @return array Un tableau [][] contenant les informations nécessaires à l'affichage
 */
function recupDetailsContrats($idContrat) {
    $contrats = null;
    require "bd/bdd.php";
    $bdd = bdd();

    $req = $bdd->prepare("SELECT contrat_id, user_nom, user_prenom, contrat.*, user_id
                                             FROM contrat LEFT JOIN users ON user_id = contrat_auteur WHERE contrat_id = :id");

    $req->bindParam(":id", $id);
    $id = $idContrat;

    $req->execute();
    while ($data = $req->fetch()) {
		$contrats = array($data['contrat_id'], $data['user_nom'], $data['user_prenom'], $data['contrat_titre'],
						$data['contrat_theme'], $data['contrat_etat'], $data['contrat_description'], $data['contrat_montant'], $data['contrat_competences'],
						$data['contrat_publication'], $data['contrat_debut_prevue'],
						$data['contrat_debut_reel'], $data['contrat_fin_prevue'], $data['contrat_fin_reelle'],$data['contrat_auteur']); // user_id
	}

	if ($contrats == null) {
		return -1;
	} else {
		return $contrats;
	}
}


 /**
 * Récupère toutes les participations en cours de l'utilisateur
 * @return array Un tableau [][] contenant les informations nécessaires à l'affichage
 */
function recupMesPropositions() {
    $contrats = array();
    require "bd/bdd.php";
    $bdd = bdd();

    // PAGINATION ---------------------------------------------------------------------------
    $req = $bdd->prepare("SELECT count(*) as nbContrats FROM contrat LEFT JOIN users ON user_id = contrat_auteur WHERE contrat_auteur = :id");
    $req->bindParam(":id", $_SESSION['id']);
    $req->execute();
    $data = $req->fetch();

    $nbc = $data['nbContrats']; // nombre total de contrats
    $cpp = 4;                   // nombre de contrats affichés par pages
    $nbp = ceil($nbc/$cpp);     // nombre total de pages à afficher
    $pa = 1;                    // numéro de page actuelle

    if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbp) {
        $pa = $_GET['page'];
    } else {
        $pa = 1;
    }

	echo '<span id="pagination">';	
	if ($nbp > 0) {
		echo '&nbsp&nbsp&nbspPage(s) :  ';
		for ($p=1; $p<=$nbp; $p++) {
			if ($p == $pa) {
				$page = $p==1?' '.$p.' ':'&nbsp '.$p.' ';
				echo $page;
			} else {
				$page = $p==1?' <a href="mes-propositions.php?page='.$p.'" >'.$p.'</a> ':'&nbsp <a href="mes-propositions.php?page='.$p.'" >'.$p.'</a> ';
				echo $page;
			}
		}
	}
	echo '</span>';
    // FIN PAGINATION ---------------------------------------------------------------------------

    $req = $bdd->prepare("SELECT contrat_id, user_nom, user_prenom, contrat_titre, contrat_theme, contrat_montant, contrat_competences
        FROM contrat LEFT JOIN users ON user_id = contrat_auteur WHERE contrat_etat != 2 AND contrat_auteur = '{$_SESSION['id']}' ORDER BY contrat_publication DESC  LIMIT ".($pa-1)*$cpp.",".$cpp."");
    $req->execute();
	
    $i = 0;
	$contrats = null;
    while ($data = $req->fetch()) {
        $contrats[$i] = array($data['contrat_id'], $data['user_nom'], $data['user_prenom'], $data['contrat_titre'], $data['contrat_theme'], $data['contrat_montant'], $data['contrat_competences']);
        $i++;
    }
	
	if ($contrats == null) {
		return -1;
	} else {
		return $contrats;
	}
}

 /**
 * Récupère toutes les participations en cours de l'utilisateur
 * @return Un tableau [][] contenant les informations nécessaires à l'affichage
 */
function recupParticipations() {
    $contrats = array();
    require "bd/bdd.php";
    $bdd = bdd();

    // PAGINATION ---------------------------------------------------------------------------
    $req = $bdd->prepare("SELECT count(*) as nbContrats FROM contrat LEFT JOIN proposition ON prop_contrat = contrat_id WHERE prop_user = :id");
    $req->bindParam(":id", $_SESSION['id']);
    $req->execute();
    $data = $req->fetch();

    $nbc = $data['nbContrats']; // nombre total de contrats
    $cpp = 4;                   // nombre de contrats affichés par pages
    $nbp = ceil($nbc/$cpp);     // nombre total de pages à afficher
    $pa = 1;                    // numéro de page actuelle

    if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbp) {
        $pa = $_GET['page'];
    } else {
        $pa = 1;
    }

	echo '<span id="pagination">';	
	if ($nbp > 0) {
		echo '&nbsp&nbsp&nbspPage(s) :  ';
		for ($p=1; $p<=$nbp; $p++) {
			if ($p == $pa) {
				$page = $p==1?' '.$p.' ':'&nbsp '.$p.' ';
				echo $page;
			} else {
				$page = $p==1?' <a href="participations.php?page='.$p.'" >'.$p.'</a> ':'&nbsp <a href="participations.php?page='.$p.'" >'.$p.'</a> ';
				echo $page;
			}
		}
	}
	echo '</span>';
	
	
    // FIN PAGINATION ---------------------------------------------------------------------------

    $req = $bdd->prepare("SELECT contrat_id, user_nom, user_prenom, contrat_titre, contrat_theme, contrat_montant, contrat_competences
        FROM contrat LEFT JOIN users ON user_id = contrat_auteur LEFT JOIN proposition ON prop_contrat = contrat_id
		WHERE contrat_etat != 2 AND prop_etat != 2
		AND prop_user = :id ORDER BY contrat_publication DESC  LIMIT ".($pa-1)*$cpp.",".$cpp."");
	$req->bindParam(":id", $_SESSION['id']);
    $req->execute();
	
    $i = 0;
	$contrats = null;
    while ($data = $req->fetch()) {
        $contrats[$i] = array($data['contrat_id'], $data['user_nom'], $data['user_prenom'], $data['contrat_titre'], $data['contrat_theme'], $data['contrat_montant'], $data['contrat_competences']);
        $i++;
    }
	
	if ($contrats == null) {
		return -1;
	} else {
		return $contrats;
	}
}

/**
 * Récupère tous les contrats fermés stockés dans la base de données
 * @return Un tableau [][] contenant les informations nécessaires à l'affichage
 */
function recupHistorique() {
    $contrats = array();
    require "bd/bdd.php";
    $bdd = bdd();

	// PAGINATION ---------------------------------------------------------------------------
	$req = $bdd->prepare("SELECT count(*) as nbContrats FROM historique_contrat LEFT JOIN users ON user_id = histo_prestataire
						  WHERE histo_prestataire = :id OR histo_demandeur = :id");
	$req->bindParam(":id",$_SESSION["id"]);
    $req->execute();
    $data = $req->fetch();

	$nbc = $data['nbContrats'];	// nombre total de contrats
	$cpp = 4;					// nombre de contrats affichés par pages
	$nbp = ceil($nbc/$cpp);		// nombre total de pages à afficher
	$pa = 1;					// numéro de page actuelle

	if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbp) {
		$pa = $_GET['page'];
	} else {
		$pa = 1;
	}

	echo '<span id="pagination">';	
	if ($nbp > 0) {
		echo '&nbsp&nbsp&nbspPage(s) :  ';
		for ($p=1; $p<=$nbp; $p++) {
			if ($p == $pa) {
				$page = $p==1?' '.$p.' ':'&nbsp '.$p.' ';
				echo $page;
			} else {
				$page = $p==1?' <a href="index.php?page='.$p.'" >'.$p.'</a> ':'&nbsp <a href="index.php?page='.$p.'" >'.$p.'</a> ';
				echo $page;
			}
		}
	}
	echo '</span>';
	// FIN PAGINATION ---------------------------------------------------------------------------

    $req = $bdd->prepare("SELECT historique_contrat.*, users.user_pseudo AS pseudo_dem, users_privee.user_pseudo AS pseudo_prest
						  FROM historique_contrat LEFT JOIN users ON user_id = histo_demandeur LEFT JOIN users_privee ON privee_id = histo_prestataire
						  WHERE histo_prestataire = :id OR histo_demandeur = :id
						  ORDER BY histo_date_fin DESC LIMIT ".($pa-1)*$cpp.",".$cpp." ");
    $req->bindParam(":id",$_SESSION["id"]);
	$req->execute();
	
    $i = 0;
	$contrats = array();
    while ($data = $req->fetch()) {
        $contrats[$i] = array($data['histo_contrat'], $data['histo_titre'], $data['pseudo_dem'], $data['pseudo_prest'], $data['histo_desc'], $data['histo_demandeur'], $data['histo_prestataire'], $data['histo_date_deb'], $data['histo_date_fin'], $data['histo_theme'], $data['histo_montant'], $data['histo_competences']);
        $i++;
    }
	if ($contrats == null) {
		return -1;
	} else {
		return $contrats;
	}
}


function recupDetailContratFerme() {
	
    $tabcontrats = array();
    require "bd/bdd.php";
    $bdd = bdd();

    $req = $bdd->prepare("SELECT historique_contrat.*, users.user_pseudo AS pseudo_dem, users_privee.user_pseudo AS pseudo_prest
						  FROM historique_contrat LEFT JOIN users ON user_id = histo_demandeur LEFT JOIN users_privee ON privee_id = histo_prestataire
						  WHERE histo_contrat = :id");
    $req->bindParam(":id",$_GET["c"]);
	$req->execute();

	$tabcontrats = null;
    while ($data = $req->fetch()) {
        $tabcontrats = array($data['histo_contrat'], $data['histo_titre'], $data['pseudo_dem'], $data['pseudo_prest'], $data['histo_desc'], $data['histo_demandeur'], $data['histo_prestataire'], $data['histo_date_deb'], $data['histo_date_fin'], $data['histo_theme'], $data['histo_montant'], $data['histo_competences']);
    }
	
	if ($tabcontrats == null) {
		return -1;
	} else {
		return $tabcontrats;
	}	
}
?>