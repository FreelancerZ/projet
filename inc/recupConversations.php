<?php
/**
* Récupère la liste des conversations d'un membre
* @return array|int Tableau contenant les résultats de la requete
*/
function recupConversations() {
    require_once "inc/bd/bdd.php";

    $bdd = bdd();

    $req = $bdd->prepare("SELECT contrat_id, contrat_titre FROM contrat
        LEFT JOIN proposition ON prop_contrat = contrat_id
        WHERE contrat_etat = 1 AND (prop_user = :uid OR contrat_auteur = :uid)");
        $req->bindParam(":uid", $_SESSION['id']);
        $req->execute();
        $conversations = array();
        $i = 0;
        if ($req->rowCount() == 0) {
            return 1;
        }
        while ($data = $req->fetch()) {
            $conversations[$i] = array($data[0], $data[1]);
            $i++;
        }
        return $conversations;
    }

    /**
    * Récupère les messages d'une conversation
    * @param $conv int id de la conversation
    * @return array|int Tableau contenant les résultats de la requete
    */
    function recupConversation($conv) {
        require_once "inc/bd/bdd.php";

        $bdd = bdd();

        $req = $bdd->prepare("SELECT user_nom, user_prenom, message_date, message_contenu, message_user1, message_user2 FROM messagerie
            LEFT JOIN users ON message_user1 = user_id
            WHERE message_contrat = :conv
            AND (message_user1 = :uid OR message_user2 = :uid)
            ORDER BY message_date");
            $req->bindParam(":uid", $_SESSION['id']);
            $req->bindParam(":conv", $conv);
            $req->execute();
            $i = 0;
            if ($req->rowCount() == 0) {
                return 1;
            }
            while ($data = $req->fetch()) {
                $messages[$i] = array($data[0], $data[1], $data[2], $data[3], $data[4], $data[5]);
                $i++;
            }
            return $messages;
        }

        function recupDestinataire($conv) {
            require_once "inc/bd/bdd.php";
            $bdd = bdd();
            $req = $bdd->prepare("SELECT contrat_auteur, prop_user FROM proposition
                JOIN contrat ON contrat_id = :conv
                WHERE contrat_etat = 1 AND (prop_user = :uid OR contrat_auteur = :uid)");
                $req->bindParam(":uid", $_SESSION['id']);
                $req->bindParam(":conv", $conv);
                $req->execute();

                $data = $req->fetch();
                if ($data[0] == $_SESSION['id']) {
                    return $data[1];
                }
                return $data[0];
            }

            function ecrireMessage($message, $contrat, $destinataire) {
                require_once "inc/bd/bdd.php";
                $bdd = bdd();

                $message = htmlspecialchars($message);
                $req = $bdd->prepare("INSERT INTO messagerie(message_user1, message_user2, message_contrat, message_contenu)
                VALUES (:auteur, :dest, :contrat, :message)");
                $req->bindParam(":auteur", $_SESSION['id']);
                $req->bindParam(":dest", $destinataire);
                $req->bindParam(":contrat", $contrat);
                $req->bindParam(":message", $message);
                $req->execute();
            }
