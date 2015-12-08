<?php
session_start();
// si l'user n'est pas connecté, alors on le redirige vers la page de connexion
$message = "";
if (!isset($_SESSION['nom'])) {
	header("location:connexion.php");
}
require "inc/edition.profil.php";
if (isset($_POST['mdp'])  && !empty($_POST['mdp']) && isset($_POST['mdpConf'])  && !empty($_POST['mdpConf'])) {
	$message .= editerMdp($_POST['mdp'],$_POST['mdpConf']);
}

if(isset($_POST['mail']) && !empty($_POST['mail'])) {
    $message .= editerEmail($_POST['mail']);
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

            <div class="rightpart">
                <div class="right">
                    <header class="head_div">
                        DETAILS
                    </header>
                    <article>
			<?php
                echo $message;
                include "inc/sections/droite.parametres.php";

            ?>
			<!-- clear both -->
			<div class="clearb"></div>
		</div>

        <!-- FOOTER -->
        <footer >

        </footer>
    </body>
</html>