<?php

/*
 * Cette fonction affiche via une boucle, toutes les candidatures sur un contrat
 * Elle utilise le tableau envoyé par la fonction recupCandidatures.
 */
function afficherCandidatures() {
    require "inc/recupCandidatures.php";
    $candidatures = recupCandidatures();
	
    if (!isset($candidatures[0])) {
		// Si il n'y a aucunes candidatures
        echo "<p>Il n'y a aucune candidatures pour vos contrats.</p><p>Peut être devez vous <a href=\"create.php\">créer</a> un contrat ?</p>";
    } else {
		
		// Boucle affichant les candidatures
        for ($i = 0; $i < sizeof($candidatures); $i++) {
            echo '
            <a id="lien_contrat" href="contrat.php?c='.$candidatures[$i][1].'"><div class="contrat">
                <header>
                    '.$candidatures[$i][5].'
                </header>
                <p id="theme"><b><a href="profil.php?p='.$candidatures[$i][1].'">'.$candidatures[$i][3].' '.$candidatures[$i][4].'</a></b> se propose
                <a href="acceptCandid.php?p='.$candidatures[$i][0].'&rep=true" onclick="return alert(\'Le candidat est accepté.\')">Accepter</a> - <a href="acceptCandid.php?p='.$candidatures[$i][0].'&rep=false" onclick="return alert(\'Le candidat est refusé.\')">Refuser</a>
                </p>
                </div></a>
            ';
        }
    }
}

?>