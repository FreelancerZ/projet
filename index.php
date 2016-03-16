<?php
session_start();
// si l'user n'est pas connecté, alors on le redirige vers la page de connexion

include "inc/head.html";
?>

	<nav>

	</nav>

        <div class="corps">
		
		<!-- CORPS -->
		<?php
			if (isset($_SESSION['nom'])) {
				// GAUCHE
				include "inc/sections/gauche.profil.php";

				// DROITE
				include "inc/sections/droite.accueil.php";
			} else {
				include "inc/sections/nonco.accueil.php";
			}
		?>

		
		<!-- clear both -->
		<div class="clearb"></div>
	</div>
	
<!-- FOOTER -->
<?php include "inc/foot.html"; ?>