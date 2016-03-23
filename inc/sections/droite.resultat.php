<div class="rightpart">
	<div class="right">
		<header class="head_div">
			RESULTAT RECHERCHE
		</header>
		<article>
			<?php
			require "inc/recupRecherche.php";
			require "inc/afficherRecherche.php";

			$vide = 0;

			// Recherche par critère
			if (isset($_GET['titre']) && !empty($_GET['titre'])) {
				$tabFiltre = array("Titre");
				$rezRech = rechercheFiltre($_GET['titre'], $tabFiltre);
				$vide++;

				afficherRecherche($rezRech);
			}
			if (isset($_GET['theme']) && !empty($_GET['theme'])) {
				$tabFiltre = array("Theme");
				$rezRech = rechercheFiltre($_GET['theme'], $tabFiltre);
				$vide++;

				afficherRecherche($rezRech);
			}
			if (isset($_GET['cpts']) && !empty($_GET['cpts'])) {
				$tabFiltre = array("CptsReq");
				$rezRech = rechercheFiltre($_GET['cpts'], $tabFiltre);
				$vide++;

				afficherRecherche($rezRech);
			}
			if (isset($_GET['montant']) && !empty($_GET['montant'])) {
				$tabFiltre = array("Montant");
				$rezRech = rechercheFiltre($_GET['montant'], $tabFiltre);
				$vide++;

				afficherRecherche($rezRech);
			}
			if (isset($_GET['auteur']) && !empty($_GET['auteur'])) {
				$tabFiltre = array("Auteur");
				$rezRech = rechercheFiltre($_GET['auteur'], $tabFiltre);
				$vide++;

				afficherRecherche($rezRech);
			}
			if (isset($_GET['keywords']) && !empty($_GET['keywords'])) {
				$tabFiltre = array("Keywords");
				$rezRech = rechercheFiltre($_GET['keywords'], $tabFiltre);
				$vide++;

				afficherRecherche($rezRech);
			}

			// Recherche par dates
			if (isset($_GET['db']) && !empty($_GET['db'])) {
				if (isset($_GET['df']) && !empty($_GET['df'])) {
					$vide++;
					$rezRech = recherchePeriode($_GET['db'], $_GET['df']);
					afficherRecherche($rezRech);
				} else if (empty($_GET['df'])) {
					$vide++;
					$rezRech = rechercheDebut($_GET['db']);
					afficherRecherche($rezRech);
				}
			} else if (isset($_GET['df']) && !empty($_GET['df'])) {
				$vide++;
				$rezRech = rechercheFin($_GET['df']);
				afficherRecherche($rezRech);
			}

			// Si pas de résultat
			if (
			$vide == 0) {
				echo "Aucun résultat";
			}

			?>
		</article>
	</div>
</div>
