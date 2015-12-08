<?php
session_start();
// si l'user n'est pas connecté, alors on le redirige vers la page de connexion

if (!isset($_SESSION['nom'])) {
    header("location:connexion.php");
}
include "inc/head.html";
?>
	<nav>

	</nav>

	<div class="corps">

		<!-- CORPS -->
		<!-- GAUCHE -->
		<?php include "inc/sections/gauche.profil.php"; ?>

		<!-- DROITE -->
		<?php include "inc/sections/droite.seProposer.php"; ?>

		<!-- clear both -->
		<div class="clearb"></div>
	</div>

<!-- FOOTER -->
<?php include "inc/foot.html"; ?>