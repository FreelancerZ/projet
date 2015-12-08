<?php
session_start();
// Si l'user est déjà connecté, on le redirige vers la page d'accueil.
if (isset($_SESSION['nom'])) {
	header("location:index.php");
}

$message = "";
// Est-ce que le formulaire est rempli ?
if (isset($_POST['email']) && isset($_POST['mdp']) && !empty($_POST['email']) && !empty($_POST['mdp'])) {
	require "inc/connexion.php";
	$message = connexion($_POST['email'],$_POST['mdp']);
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
					CONNEXION
				</header>
				<form action="	connexion.php" method="post">
					<p>Adresse email :<br></p>
					<input class="text" type="email" name="email"><br><br>
					<p>Mot de passe :<br></p>
					<input class="text" type="password" name="mdp"><br>
					<p id="subtitle"><a href="mdpoublie.html">Mot de passe oublié ?</a></p>
					<input class="btn" type="submit" value="SE CONNECTER">
					<p id="subtitle">Vous n'avez pas encore de compte ? <a href="inscription.php">S'inscrire</a></p>
					<?php echo $message; ?>
				</form>

			</div>
		</div>

	</body>
</html>