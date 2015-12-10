<div class="rightpart">
	<div class="right">
		<header class="head_div">
			RESULTAT RECHERCHE
		</header>
		<article>
			<?php
			if (isset($_GET['r'])) {
				require "inc/recupRecherche.php";
				require "inc/afficherRecherche.php";
				if (isset($_GET['filtres'])) {
					$rezRech = rechercheFiltre($_GET['r'], $_GET['filtres']);
					afficherRecherche($rezRech);
				} else {
					$rezRech = rechercheAll($_GET['r']);
					afficherRecherche($rezRech);
				}
			}
			?>
		</article>
	</div>
</div>