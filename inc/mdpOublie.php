<?php
    /**
     * Génère un nouveau mot de passe pour le compte
     * @param $email string L'email du compte dont on change le mot de passe
     * @return string Un message indiquant si tout s'est bien passé.
     */
    function mdpOublie($email) {
        require "bd/bdd.php";
        $bdd = bdd();

        // on teste si l'email est au bon format
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return "L'email n'est pas valide, veuillez vérifiez la syntaxe.";
        }

        // on vérifie qu'un utilisateur existe avec cet email
        $req = $bdd->prepare("SELECT COUNT(*) AS nbu FROM users WHERE user_email = :email");
        $req->bindParam(":email", $email);
        $req->execute();
        $data = $req->fetch();

        if ($data['nbu'] == 0) {
            return "Aucun utilisateur ne possède cet email, veuillez vérifier votre email.";
        }

        // on génère le nouveau mot de passe de 8 caractères
        $mdp = substr(md5(microtime() * 10000),1,8);
        $mdpCrypt = md5($mdp);
        // On enregistre le nouveau mot de passe dans la BDD
        $req = $bdd->prepare("UPDATE users SET user_password = :mdp WHERE user_email = :email");
        $req->bindParam(":mdp", $mdpCrypt);
        $req->bindParam(":email", $email);
        $req->execute();

        // On envoie le mail avec le nouveau mot de passe à l'utilisateur

        $destinataire = $email;
        $sujet = "[Freelancerz] : Mot de passe oublié" ;
        $entete = "From: noreply@freelancerZ.com" ;
        $contenu = 'Oubli de mot de passe,

            Voici votre nouveau mot de passe, ne le communiquez à personne,
            un administrateur ou modérateur ne vous demandera jamais votre mot de passe.

            '.$mdp.'

            Freelancerz.

            ---------------
            Ceci est un mail automatique, Merci de ne pas y répondre.';
        // envoi du mail
        @mail($destinataire, $sujet, $contenu, $entete) ; // Envoi du mail

        return "Un email a été envoyé à ".$email." contenant le nouveau mot de passe.";
    }

?>