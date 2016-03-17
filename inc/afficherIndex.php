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
	<p>Freelancerz est un site de partage de contrats Freelances.<br /><br />
	Le but de notre plateforme d’échange est de vous mettre en relation
	avec d’autres travailleurs indépendants <br />afin de vous permettre de
	collaborer pour atteindre votre objectif.<br /><br />
	Grâce à Freelancerz vous pourrez tout aussi bien proposer des interventions
	<br />que candidater aux propositions d’autres personnes.<br /><br />
	Pas de restriction sur le nombre d’interventions, pas de pub,
	du travail proposé de façon simple et concise.<br /><br />
	En d’autres mots travaillez indépendamment mais efficacement !</p>
	<p><a href=\"qsm.php\">Qui sommes-nous ?</a></p>
	";
}
?>
