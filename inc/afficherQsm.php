<?php
	function afficherQsm() {		
		echo "
			<p>Texte TODO</p>
			<p>Texte blabla bla MAxime TMCT fait ce que tu sais faire !</p>
		";
		
		if (!isset($_SESSION['nom'])) {
			echo "
				<p><a href=\"index.php\">Retour accueil</a></p>
			";
		}
	}
?>