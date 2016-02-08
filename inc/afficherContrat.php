<?php
// Ce fichier contient toute les fonctions d'affichage de données liées au contrats.
// Les fonctions de ce fichier utilisent des tableaux de données,
// envoyés par les fonctions du fichier recupContrats.php

/**
 * Cette fonction affiche via une boucle, tout les contrats
 * Elle utilise le tableau envoyé par la fonction recupContrats.
 */
function afficherListeContrats() {

    require "recupContrat.php";
    $contrats = recupContrats();

	if ($contrats == -1) {
		// Si il n'y a aucune valeurs
		echo '<div>&nbsp&nbsp&nbspAucun contrat n\'est actuellement disponible.</div>';
	} else {
		// Sinon on affiche les contrats sous forme de DIVs
		for ($i=0; $i < sizeof($contrats); $i++) {

		   echo '
		   <a id="lien_contrat" href="contrat.php?c='.$contrats[$i][0].'"><div class="contrat">
			 <header>
			  '.$contrats[$i][3].'
			  </header>
			  <p id="theme"><b>Thème :</b> '.$contrats[$i][4].'</p>
			  <p id="pers"><b>Proposeur :</b> '.$contrats[$i][2].' '.$contrats[$i][1].'</p>
			  <p id="comp"><b>Requis :</b> '.$contrats[$i][6].'</p>
			  <p id="remu"><b>Rémunération :</b> '.number_format($contrats[$i][5], 2, ',', ' ').' €</p>
		  </div></a>';
		}
	}
}

/**
 * Cette fonction affiche via une boucle, tout les contrats que l'utilisateur à proposé
 * Elle utilise le tableau envoyé par la fonction recupMesPropositions.
 */
function afficherMesPropositions() {

	require "recupContrat.php";
	$contrats = recupMesPropositions();
	
	if ($contrats == -1) {
		// Si il n'y a aucune valeurs
		echo '<div>&nbsp&nbsp&nbspVous n\'avez aucun contrat.</div></a>';
	} else {
		// Sinon on affiche les contrats sous forme de DIVs
		for ($i=0; $i < sizeof($contrats); $i++) {

			echo '
			<a id="lien_contrat" href="contrat.php?c='.$contrats[$i][0].'"><div class="contrat">
				<header>
					'.$contrats[$i][3].'
				</header>
				<p id="theme"><b>Thème :</b> '.$contrats[$i][4].'</p>
				<p id="pers"><b>Proposeur :</b> '.$contrats[$i][2].' '.$contrats[$i][1].'</p>
				<p id="comp"><b>Requis :</b> '.$contrats[$i][6].'</p>
				<p id="remu"><b>Rémunération :</b> '.number_format($contrats[$i][5], 2, ',', ' ').' €</p>
			</div></a>';

		}
	}
}

/**
 * Cette fonction affiche via une boucle, tout les contrats où l'utilisateur à participé
 * Elle utilise le tableau envoyé par la fonction recupParticipations.
 */
function afficherMesParticipations() {

	require "recupContrat.php";
	$contrats = recupParticipations();

	if ($contrats == -1) {
		// Si il n'y a aucune valeurs
		echo '<div>&nbsp&nbsp&nbspVous ne participez à aucun contrat.</div></a>';
	} else {
		// Sinon on affiche les contrats sous forme de DIVs
		for ($i=0; $i < sizeof($contrats); $i++) {

			echo '
			<a id="lien_contrat" href="contrat.php?c='.$contrats[$i][0].'"><div class="contrat">
				<header>
					'.$contrats[$i][3].'
				</header>
				<p id="theme"><b>Thème :</b> '.$contrats[$i][4].'</p>
				<p id="pers"><b>Proposeur :</b> '.$contrats[$i][2].' '.$contrats[$i][1].'</p>
				<p id="comp"><b>Requis :</b> '.$contrats[$i][6].'</p>
				<p id="remu"><b>Rémunération :</b> '.number_format($contrats[$i][5], 2, ',', ' ').' €</p>
			</div></a>';

		}
	}
}

/**
 * Cette fonction affiche les details complets d'un contrat
 * Elle utilise les données envoyées par la fonction recupDetailsContrat.
 */
function afficherDetailsContrats($idContrat) {
	require "recupContrat.php";
	$contrats = recupDetailsContrats($idContrat);

	if ($contrats == -1) {
		// Si le contrat n'existe pas
		echo "
			<div class=\"affich_contrat\">
				&nbsp&nbsp&nbspCe contrat n'existe pas.
			</div>
		";
	} else {
		// Sinon on affiche les details du contrat
		$etat = $contrats[5];

		echo "
			<div class=\"affich_contrat\">
			<h2>{$contrats[3]}</h2>
			<h3>Informations générales :</h3>
			<ul>
			   <li>Auteur : <a href=\"profil.php?p={$contrats[14]}\">{$contrats[2]} {$contrats[1]}</a></li>
			   <li>Thème : {$contrats[4]}</li>
			   <li>Etat : ";

				// Affichage de l'état du contrat
				  if ($etat == 0) {
				   echo "Ouvert";
			   } else if ($etat == 1) {
				   echo "En cours";
			   } else if ($etat == 2) {
				   echo "Fermé";
			   }

			   echo "
			   </li>
			</ul>
			<h3>Description :</h3>
			<p>{$contrats[6]}</p>
			<h3>Informations complémentaires :</h3>
			<ul>
			   <li>Montant : ".number_format($contrats[7], 2, ',', ' ')." €</li>
			   <li>Compétences requises : {$contrats[8]}</li>
			   ";

				// Affichage des dates du contrat
				if ($etat == 0) {
					echo "
					<li>Date de début prévue : {$contrats[10]}</li>
					<li>Date de fin prévue : {$contrats[12]}</li>
					";
				} else if ($etat == 1) {
					echo "
					<li>Date de début prévue : {$contrats[10]}</li>
					<li>Date de début réelle : {$contrats[11]}</li>
					<li>Date de fin prévue : {$contrats[12]}</li>
					";
				} else if ($etat == 2) {
					echo "
					<li>Date de début : {$contrats[11]}</li>
					<li>Date de fin : {$contrats[13]}</li>
					";
				}

			echo "
			</ul>
		<p id=\"date_publi\">Contrat publié le {$contrats[9]}</p>
		";
		
		// Gestion des boutons Rejoindre et Mettre fin, en fonction de l'utilisateur courant
		if ($contrats[14] != $_SESSION['id'] && $etat == 0) {
			echo "<a href=\"proposition.php?c={$contrats[0]}\"><div>Rejoindre ce contrat</div></a>";
		} else if ($_SESSION['id'] == $contrats[14] && $etat == 1) {
			// Seul l'auteur du contrat peut y mettre fin.
			echo "<a href=\"terminerContrat.php?c={$contrats[0]}\" onclick=\"return window.confirm('Le contrat va se terminer, cette action est irréversible. Voulez vous continuer ?.')\"><div>Mettre fin au contrat</div></a>";
		}

		echo "</div>";
	}
}

/**
 * Cette fonction affiche les details complets d'un contrat fermé
 * Elle utilise les données envoyées par la fonction recupDetailContratFerme.
 * @param $id identifiant d'un contrat
 */
function afficherDetailsContratsFerme($idContrat) {
	require "recupContrat.php";
	$contrats = recupDetailContratFerme($idContrat);
	
	if ($contrats == -1) {
		// Si le contrat n'existe pas
		echo "
			<div class=\"affich_contrat\">
				&nbsp&nbsp&nbspCe contrat n'existe pas.
			</div>
		";
	} else {
		// Sinon on affiche les details du contrat terminé
		echo "
		<div class=\"affich_contrat\">
		<h2>{$contrats[1]} (contrat terminé)</h2>
		<h3>Informations générales :</h3>
		<ul>
		   <li>Auteur : <a href=\"profil.php?p={$contrats[5]}\">{$contrats[2]}</a></li>
		   <li>Thème : {$contrats[9]}</li>
		   <li>Etat : Fermé</li>
		</ul>
		<h3>Description :</h3>
		<p>{$contrats[4]}</p>
		<h3>Informations complémentaires :</h3>
		<ul>
			<li>Montant : ".number_format($contrats[10], 2, ',', ' ')." €</li>
			<li>Compétences requises : {$contrats[11]}</li>
			<li>Date de début : {$contrats[7]}</li>
			<li>Date de fin : {$contrats[8]}</li>
		</ul>
		";
		// bouton retour
		echo "<a href=\"historique.php\"> &nbsp&nbspRETOUR</a>";
		
		echo "</div>";
	}
}

/**
 * Cette fonction affiche la liste des contrats terminés où l'utilisateur à participé.
 * Elle utilise les données envoyées par la fonction recupHistorique.
 */
function afficherHistorique() {

	require "recupContrat.php";
	$contrats = recupHistorique();

	if ($contrats == -1) {
		// Si il n'y a aucunes valeurs
		echo '<div>&nbsp&nbsp&nbspVous n\'avez participé à aucun contrat pour le moment.</div></a>';
	} else {
		// Sinon on affiche les contrats sous forme de DIVs
		for ($i=0; $i < sizeof($contrats); $i++) {
	
			echo '
			<a id="lien_contrat" href="contrat-ferme.php?c='.$contrats[$i][0].'"><div class="contrat_hist">
				<header>
					'.$contrats[$i][1].' (Contrat terminé)
				</header>
				<p id="theme"><b>Thème :</b> '.$contrats[$i][9].'</p>
				<p id="pers"><b>Proposeur :</b> '.$contrats[$i][2].'</p>
				<p><b>A duré du </b>'.$contrats[$i][7].'<b> au </b>'.$contrats[$i][8].'</p>

			</div></a>';			
		}
	}
}

?>