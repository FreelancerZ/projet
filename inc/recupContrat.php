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
	$req = $bdd->prepare("SELECT count(*) as nbContrats FROM contrat LEFT JOIN users ON user_id = contrat_auteur WHERE contrat_etat = 0");
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

	echo '<span>';
	for ($p=1; $p<=$nbp; $p++) {
		if ($p == $pa) {
			$page = $p==1?' '.$p.' ':'&nbsp '.$p.' ';
			echo $page;
		} else {
			$page = $p==1?' <a href="contrats.php?page='.$p.'" >'.$p.'</a> ':'&nbsp <a href="contrats.php?page='.$p.'" >'.$p.'</a> ';
			echo $page;
		}
	}
	echo '</span>';
	// FIN PAGINATION ---------------------------------------------------------------------------

    $req = $bdd->prepare("SELECT contrat_id, user_nom, user_prenom, contrat_titre, contrat_theme, contrat_montant, contrat_competences
        FROM contrat LEFT JOIN users ON user_id = contrat_auteur WHERE contrat_etat = 0 ORDER BY contrat_publication DESC  LIMIT ".($pa-1)*$cpp.",".$cpp."");
    $req->execute();
    $i = 0;
    while ($data = $req->fetch()) {
        $contrats[$i] = array($data['contrat_id'], $data['user_nom'], $data['user_prenom'], $data['contrat_titre'], $data['contrat_theme'], $data['contrat_montant'], $data['contrat_competences']);
        $i++;
    }
    return $contrats;
}

/**
 * Récupère tous les informations d'un certain contrat
 * @param int(11) idContrat - l'identifiant du contrat
 * @return Un tableau [][] contenant les informations nécessaires à l'affichage
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
 * @return Un tableau [][] contenant les informations nécessaires à l'affichage
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

    echo '<span>';
    for ($p=1; $p<=$nbp; $p++) {
        if ($p == $pa) {
            $page = $p==1?' '.$p.' ':'&nbsp '.$p.' ';
            echo $page;
        } else {
            $page = $p==1?' <a href="contrats.php?page='.$p.'" >'.$p.'</a> ':'&nbsp <a href="contrats.php?page='.$p.'" >'.$p.'</a> ';
            echo $page;
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

    echo '<span>';
    for ($p=1; $p<=$nbp; $p++) {
        if ($p == $pa) {
            $page = $p==1?' '.$p.' ':'&nbsp '.$p.' ';
            echo $page;
        } else {
            $page = $p==1?' <a href="contrats.php?page='.$p.'" >'.$p.'</a> ':'&nbsp <a href="contrats.php?page='.$p.'" >'.$p.'</a> ';
            echo $page;
        }
    }
    echo '</span>';
    // FIN PAGINATION ---------------------------------------------------------------------------

    $req = $bdd->prepare("SELECT contrat_id, user_nom, user_prenom, contrat_titre, contrat_theme, contrat_montant, contrat_competences
        FROM contrat LEFT JOIN users ON user_id = contrat_auteur LEFT JOIN proposition ON prop_contrat = contrat_id
		WHERE contrat_etat != 2 AND prop_user = :id ORDER BY contrat_publication DESC  LIMIT ".($pa-1)*$cpp.",".$cpp."");
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

?>