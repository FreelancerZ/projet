<?php
/**
 * Récupère les champs remplis par l'utilisateur et vériie leur contenu
 * Converti le texte BBcode en format html
 * @param $tab tableau contenant les valeurs des champs que l'utilisateur a rempli.
 */
function creerContrat($tab) {
	
	// pour chaque champ on teste si il est rempli ou non
    foreach ($tab as $value) {
        if (empty($value)) {	
            return "<p id=\"message\">Tous le champs ne sont pas renseignés.</p>";
        }
    }
	
    if (!is_numeric($tab['remuneration'])) {
        return "<p id=\"message\">La rémunération doit être un nombre.</p>";
    }
    $tab['desc'] = htmlspecialchars($tab['desc']);
    $tab['titre'] = htmlspecialchars($tab['titre']);
    $tab['competences'] = htmlspecialchars($tab['competences']);
    $tab['theme'] = htmlspecialchars($tab['theme']);

    $conversion = array(
        '[b]' => '<strong>',
        '[/b]' => '</strong>',
        '[i]' => '<em>',
        '[/i]' => '</em>',
        '[s]' => '<s>',
        '[/s]' => '</s>',
        '[li]' => '<li>',
        '[/li]' => '</li>',
        '[ul]' => '<ul>',
        '[/ul]' => '</ul>',
        '[ol]' => '<ol>',
        '[/ol]' => '</ol>'
    );

    foreach($conversion as $k => $v) {
        $tab['desc'] = str_replace($k,$v, $tab['desc']);
    }
	ajouterContrat($tab);
    return "<p id=\"message_ok\">Votre proposition de contrat à bien été ajoutée.<br>Pour la consulter, rendez vous dans la section \"<a href=\"mes-propositions.php\">Mes propositions</a>\".</p>";
}

/**
 * Ajoute un contrat dans la base de données
 * @param $tab tableau contenant les valeurs du contrat à ajouter
 */
function ajouterContrat($tab) {
    require "bd/bdd.php";
    $bdd = bdd();

    $req = $bdd->prepare("INSERT INTO contrat (contrat_auteur, contrat_titre, contrat_theme, contrat_etat, contrat_description,  contrat_montant, contrat_competences,contrat_debut_prevue, contrat_fin_prevue, contrat_publication) VALUES (:auteur, :titre, :theme, 0, :description, :montant, :competences, :datedeb, :datefin, :publication)");
    $req->bindParam(":auteur", $_SESSION['id']);
    $req->bindParam(":titre", $tab['titre']);
    $req->bindParam(":theme", $tab['theme']);
    $req->bindParam(":description", $tab['desc']);
    $req->bindParam(":montant", $tab['remuneration']);
    $req->bindParam(":competences", $tab['competences']);
    $req->bindParam(":datedeb", $tab['date_deb']);
    $req->bindParam(":datefin", $tab['date_fin']);
    $publication = date("Y-m-d");
    $req->bindParam(":publication",$publication);

    $req->execute();
}

?>