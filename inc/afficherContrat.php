<?php
function afficherListeContrats() {

    require "recupContrat.php";
    $contrats = recupContrats();

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

function afficherMesPropositions() {

	require "recupContrat.php";
	$contrats = recupMesPropositions();

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

function afficherMesParticipations() {

	require "recupContrat.php";
	$contrats = recupParticipations();

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

	function afficherDetailsContrats($idContrat) {
		require "recupContrat.php";
		$contrats = recupDetailsContrats($idContrat);

		if ($contrats == -1) {
			echo "
				<div class=\"affich_contrat\">
					Ce contrat n'existe pas.
				</div>
			";
		} else {
			$etat = $contrats[5];

			echo "
			<div class=\"affich_contrat\">
			<h2>{$contrats[3]}</h2>
			<h3>Informations générales :</h3>
			<ul>
			   <li>Auteur : {$contrats[2]} {$contrats[1]}</li>
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
		   <li>Compétences requises : {$contrats[8]}</li>";

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
			if ($contrats[12] != $_SESSION['id']) {
				echo "<a href=\"proposition.php?c={$contrats[0]}\"><div>Rejoindre ce contrat</div></a>";
			}
			echo "</div>";
		}
	}

?>