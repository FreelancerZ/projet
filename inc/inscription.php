<?php
require "bd/bdd.php";

/**
 * Inscrit un utilisateur au site si toutes les informations sont renseignées et valides
 * @param  array $infos Contient toutes les informations
 * @return String Message de retour de l'inscription
 */
function inscrire($infos) {
    $message = "<p id=\"message\">Une erreur est survenue lors de l'inscription : </p><br>"; // Message de retour de la fonction
    $erreur = 0; // compteur d'erreurs
    // On vérifie que toutes les infos sont renseignées
    foreach ($infos as $elem) {
        if (empty($elem)) {
            return "<p id=\"message\">Toutes les informations ne sont pas renseignées</p>";
        }
    }
    extract($infos);

    // On teste si le pseudo ou l'email existe déjà
    require_once "inc/bd/bdd.php";
    $bdd = bdd();

    $req = $bdd->prepare("SELECT COUNT(*) AS nb FROM users WHERE user_email = :email OR user_pseudo = :pseudo");
    $req->bindParam(":email", $email);
    $req->bindParam(":pseudo", $pseudo);
    $req->execute();
    if ($req->fetch()["nb"] != 0) {
        return "<p id='message'>Ce pseudonyme ou cette adresse mail est déjà utilisée.</p>";
    }

	
    // On teste si la date est valide
    if (!(is_numeric($jour) && is_numeric($mois) && is_numeric($an)) || !checkdate($mois, $jour, $an)) {
        $message = $message."<p id=\"message\">La date de naissance n'est pas valide</p><br>";
        $erreur++;
    }
    if (strtolower($email) != strtolower($emailConf)) {
        $message = $message."<p id=\"message\">Les adresses électroniques ne correspondent pas</p><br>";
        $erreur++;
    }
    if ($mdp != $mdpConf) {
        $message = $message."<p id=\"message\">Les mots de passe ne correspondent pas</p><br>";
        $erreur++;
    }
    $naissance = $an.'-'.$mois.'-'.$jour; // on convertit la date en format correct pour la BD
    if ($erreur != 0) {
        return $message;
    }

    // Si tout est ok, on contacte la BD et on enregistre le nouvel user
    $bdd = bdd();
    $mdp = md5($mdp);

    // Génération d'une clé pour le lien de validation
    $cle = md5(microtime(TRUE)*100000);

	$req = $bdd->prepare("INSERT INTO users(user_nom, user_prenom, user_pseudo, user_password, user_email, user_naissance, user_inscription, user_etat, user_cle, user_admin, user_banni) VALUES(:nom,:prenom,:pseudo,:mdp,:email,:naissance,:inscription,0,:cle, 0, 0)");
	$req->bindParam(":nom", $infos["nom"]);
	$req->bindParam(":prenom", $infos["prenom"]);
	$req->bindParam(":pseudo", $infos["pseudo"]);
	$req->bindParam(":mdp", $mdp);
	$req->bindParam(":email", $infos["email"]);
	$req->bindParam(":naissance", $infos["naissance"]);
	$req->bindParam(":inscription", $infos["inscription"]);
	$req->bindParam(":cle", $cle);
    $req->execute();
	
    $message = "<p id=\"message_ok\">Votre inscription est en cours, veuillez valider votre compte via l'email envoyé à cette adresse : ".$email."</p>";

    // Préparation du mail contenant le lien d'activation
    $destinataire = $email;
    $sujet = "[Freelancerz] : Activer votre compte" ;
    $entete = "From: noreply@freelancerZ.com" ;

    $contenu = 'Bienvenue sur Freelancerz,

    Pour activer votre compte, veuillez cliquer sur le lien ci dessous
    ou copier/coller dans votre navigateur internet.

    http://freelancerz.pe.hu/inc/validation.php?email='.urldecode($email).'&cle='.urlencode($cle).'


    ---------------
    Ceci est un mail automatique, Merci de ne pas y répondre.';

    @mail($destinataire, $sujet, $contenu, $entete) ; // Envoi du mail

    return $message;
}

?>