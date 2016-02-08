<?php
require "bd/bdd.php";

/**
 * Traitement du formulaire de connexion
 * contrôle les identifiants de l'utilisateur pour lui attribuer une session
 * @param $email email de l'utilisateur (nom de compte)
 * @param $mdp mot de passe de l'utilisateur 
 */
function connexion($email, $mdp) {
	$bdd = bdd();
		// encodage du mot de passe
	$mdp = md5($mdp);

	$email = strtolower($email);

		// connexion à la BD pour tester si l'utilisateur existe et que les données correspondent
	$sql = "SELECT COUNT(*) AS nb_users, user_id, user_nom, user_prenom, user_pseudo, user_etat, user_admin, user_banni FROM users WHERE user_email = :email AND user_password = :mdp";
	$req = $bdd->prepare($sql);
	$req->bindParam(":email", $email);
	$req->bindParam(":mdp", $mdp);
	$req->execute();
	$data = $req->fetch();
	if ($data['nb_users'] == 1) {
		if ($data['user_banni'] == 1) {
			return "<p id=\"message\">Votre compte a été bloqué. Vous ne pouvez plus accéder à nos services.</p>";
		}
		$_SESSION = array (
			'nom' => strtoupper($data['user_nom']),
			'prenom' => ucfirst($data['user_prenom']),
			'pseudo' => $data['user_pseudo'],
			'id' => $data['user_id'],
			'actif' => $data['user_etat'],
			'estAdmin' => $data['user_admin']
			);
			
		// redirection sur le menu principal si connexion bien éffectuée	
		header("location:index.php");
		return "Connexion réussie, bienvenue ". $_SESSION['prenom']. " ".$_SESSION['nom'].". Si vous n'êtes pas redirigé automatiquement, veuillez cliquer <a href=\"index.php\">ici</a> pour poursuivre la navigation.";
	} else {
		return "<p id=\"message\">Le mot de passe ou l'adresse électronique sont incorrects.</p>";
	}
}
?>