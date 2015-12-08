<?php
function afficherCandidatures() {
    require "inc/recupCandidatures.php";
    $candidatures = recupCandidatures();
    if (!isset($candidatures[0])) {
        echo "<p>Il n'y a aucune candidatures pour vos contrats.</p><p>Peut être devez vous <a href=\"create.php\">créer</a> un contrat ?</p>";
    } else {
        for ($i = 0; $i < sizeof($candidatures); $i++) {
            echo '
            <a id="lien_contrat" href="contrat.php?c='.$candidatures[$i][1].'"><div class="contrat">
                <header>
                    '.$candidatures[$i][5].'
                </header>
                <p id="theme"><b><a href="profil.php?p='.$candidatures[$i][1].'">'.$candidatures[$i][3].' '.$candidatures[$i][4].'</a></b> se propose
                <a href="">Accepter</a> - <a href="">Refuser</a>
                </p>
                </div></a>
            ';
        }
    }
}

?>