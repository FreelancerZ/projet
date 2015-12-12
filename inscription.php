<?php
session_start();
// Si l'user est déjà connecté, on le redirige vers la page d'accueil.
if (isset($_SESSION['nom'])) {
	header("location:index.php");
}
$message ="";
// Si toutes les infos sont entrées on traite l'inscription
if (isset($_POST) && !empty($_POST)) {
	require("inc/inscription.php");
	$message = inscrire($_POST);
}

?>
<!DOCTYPE html>

<html>
	<head>
		<!-- En-tête de la page -->
		<meta charset="utf-8" />
		<link href="connexion.css" rel="stylesheet" type="text/css">
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
					</li>
				</ul>
			</div>

		</header>
		
		<nav>
		
		</nav>

		<div class="corps">
			<!-- CORPS -->
			<div class="div_co">
				<header class="head_div">
					INSCRIPTION
				</header>
				<form action="inscription.php" method="post">
					<p>Nom : *<br></p>
					<input class="text" type="text" name="nom"><br>
					<p>Prénom : *<br></p>
					<input class="text" type="text" name="prenom"><br>
					<p>Pseudo : *<br></p>
					<input class="text" type="text" name="pseudo"><br>
					<p>Date de naissance : *<br></p>
					<input class="date" type="text" name="jour" placeholder="jj" size="7">
					<input class="date" type="text" name="mois" placeholder="mm" size="7">
					<input class="date" type="text" name="an" placeholder="aaaa" size="10"><br><br>

					<p>Adresse email : *<br></p>
					<input class="text" type="email" name="email"><br>
					<p>Confirmation de l'adresse email : *<br></p>
					<input class="text" type="email" name="emailConf"><br><br>

					<p>Mot de passe : *<br></p>
					<input class="text" type="password" name="mdp"><br>
					<p>Confirmation du mot de passe : *<br></p>
					<input class="text" type="password" name="mdpConf"><br><br>
					<input class="btn" type="submit" value="S'INSCRIRE">
					<p id="subtitle">Vous avez déja un compte ? &nbsp &nbsp &nbsp <a href="connexion.php">Se connecter</a></p><p><?php echo $message; ?></p>
				</form>

			</div>
		</div>

	</body>
</html>