<?php
	function afficherIndex() {
		
		if (!isset($_SESSION['nom'])) {
			echo "
				<p>
					Vous avez déja un compte ? <a href=\"connexion.php\">Se connecter</a><br />
					Vous n'avez pas encore de compte ? <a href=\"inscription.php\">S'inscrire</a>
				</p>
			";
		}
		
		echo "
			<p>Texte de présentation</p>
			<p>Image badasse wesh les poto, cortex les pyramides, braaaaa</p>
			<p>Texte blabla bla MAxime TMCT fait ce que tu sais faire !</p>
			<p><a href=\"qsm.php\">Qui sommes-nous ?</a></p>
		";
	}
?>