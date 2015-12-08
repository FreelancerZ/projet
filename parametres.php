<?php
session_start();
// si l'user n'est pas connecté, alors on le redirige vers la page de connexion

if (!isset($_SESSION['nom'])) {
	header("location:connexion.php");
}
require "inc/edition.profil.php";
if (isset($_POST['mdp'])  && !empty($_POST['mdp']) && isset($_POST['mdpConf'])  && !empty($_POST['mdpConf'])) {
	editerMdp($_POST['mdp'],$_POST['mdpConf']);
}

if(isset($_POST['mail']) && !empty($_POST['mail'])) {
	editerEmail($_POST['mail']);
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
			<?php include "inc/sections/droite.parametres.php"; ?>
			
			<!-- clear both -->
			<div class="clearb"></div>
		</div>

        <!-- FOOTER -->
        <footer >

        </footer>
    </body>
</html>