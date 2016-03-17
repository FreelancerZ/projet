<?php
function afficherQsm() {
	echo "
	<h4>Mentions légales :</h4>
	<p>Ce site web a été réalisé dans le cadre d’un projet tutorés
	<br />d’étudiants en 2nd année de DUT informatique à Rodez.</p>
	<h4>Hébergeur</h4>
	<p><a href=\"http://www.hostinger.fr/\">Hostinger</a></p>
	<h4>Qui sommes-nous ?</h4>
	<p>Hugo Clément  - hugo.clément@iut-rodez.fr<br/>
	Maxime Belmon – maxime.belmon@iut-rodez.fr<br/>
	Guillaume Bernad – guillaume.bernard@iut-rodez.fr<br/>
	David Boulles – david.boulles@iut-rodez.fr</p>
	";

	if (!isset($_SESSION['nom'])) {
		echo "
		<p><a href=\"index.php\">Retour accueil</a></p>
		";
	}
}
?>
