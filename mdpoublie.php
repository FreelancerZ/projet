<!DOCTYPE html>

<html>
    <head>
        <!-- En-tête de la page -->
        <meta charset="utf-8" />
		<LINK href="connexion.css" rel="stylesheet" type="text/css"> 
        <title>FREELANCE</title>
    </head>
	
    <body>
		<!-- HEADER -->
		<header>
			<!-- Logo et titre -->
			<a href=""><img class="header_logo" src="images/logos/logo6.png" alt="logo Freelancerz"></a>
			<p class="header_title">FREELANCERZ</p>
			
			<!-- Selection des langues -->
			<div class="langues">
				<ul class="menulan">
					<li id="actual">
						<img src="images/langues/fr.png" alt="FR"><b>FR</b>
						<ul class="menulan listelan">
							<a href=""><li><img src="images/langues/gb.png" alt="GB">GB</li></a>
							<a href=""><li><img src="images/langues/de.png" alt="DE">DE</li></a>
							<a href=""><li><img src="images/langues/es.png" alt="ES">ES</li></a>
						</ul>
					</li></a>
				</ul>
			</div>
			
		</header>
		
		<nav>
		
		</nav>
		
		
		<div class="corps">
			<!-- CORPS -->		
			<div class="div_co">
				<header class="head_div">
				MOT DE PASSE OUBLIÉ
				</header>
				<form action="" method="post">
					<p>Entrez votre adresse email associée :<br></p>
					<input class="text" type="email" name="ndc"><br><br>
					<input class="btn" type="submit" value="RECUPERER">
					<p id="subtitle"><a href="connexion.php">Retour</a></p>

					<p>
						<?php
							if (isset($_POST['ndc']) && !empty($_POST['ndc'])) {
								require "inc/mdpOublie.php";
								echo mdpOublie($_POST['ndc']);
							}
						?>
					</p>
				</form>

				
			</div>
		</div>

    </body>
</html>