<div class="rightpart">
	<div class="right">
		<header class="head_div">
			RESULTAT RECHERCHE
		</header>
		<article>
			<?php
			require "inc/recupRecherche.php";
			require "inc/afficherRecherche.php";
			if (isset($_GET['r'])) {
				if (isset($_GET['filtres'])) {
					$rezRech = rechercheFiltre($_GET['r'], $_GET['filtres']);
					afficherRecherche($rezRech);
				} else {
					$rezRech = rechercheAll($_GET['r']);
					afficherRecherche($rezRech);
				}
			} else if (isset($_GET['db']) && !empty($_GET['db'])) {
				if (isset($_GET['df']) && !empty($_GET['df'])) {
					$rezRech = recherchePeriode($_GET['db'], $_GET['df']);
					afficherRecherche($rezRech);
				} else if (empty($_GET['df'])) {
					$rezRech = rechercheDebut($_GET['db']);
					afficherRecherche($rezRech);
				}
			} else if (isset($_GET['df']) && !empty($_GET['df'])) {
				$rezRech = rechercheFin($_GET['df']);
				afficherRecherche($rezRech);
			}
			?>
		</article>
	</div>
</div>