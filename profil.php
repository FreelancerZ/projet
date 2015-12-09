<?php
session_start();
// si l'user n'est pas connecté, alors on le redirige vers la page de connexion

if (!isset($_SESSION['nom'])) {
	header("location:connexion.php");
}
require "inc/edition.profil.php";

if ((isset($_POST) && !empty($_POST) && ($_POST != "")) {
	editerProfil($_POST);
}

if(!empty($_FILES)) {
	editerAvatar($_FILES['avatar']);
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
		<?php include "inc/sections/droite.profil.php"; ?>
		
		<!-- clear both -->
		<div class="clearb"></div>
	</div>

<!-- FOOTER -->
<?php include "inc/foot.html"; ?>