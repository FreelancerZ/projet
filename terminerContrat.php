<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header("location:connexion.php");
    }
    require_once "inc/bd/bdd.php";
    $bdd = bdd();
    // On vérifie que le paramètre en GET soit conforme
    if (isset($_GET['c']) && is_numeric($_GET['c'])) {

        // on vérifie que l'user a le droit de mettre fin à ce contrat
        $req = $bdd->prepare("SELECT contrat_auteur FROM contrat WHERE contrat_id = :cid");
        $req->bindParam(":cid", $_GET['c']);
        $req->execute();
        $data = $req->fetch();

        if ($_SESSION['id'] != $data['contrat_auteur']) {
            // L'auteur n'est pas propriétaire du contrat
            header("location:index.php");
        }
        // On modifie l'état et la date du contrat à fermer
        $req = $bdd->prepare("UPDATE contrat SET contrat_etat = 2, contrat_fin_reelle = :datefin WHERE contrat_etat = 1 AND contrat_id = :cid");
        $req->bindParam(":cid", $_GET['c']);
        $datefin = date("Y-m-d");
        $req->bindParam(":datefin", $datefin);
        $req->execute();

        $req = $bdd->prepare("SELECT contrat.*, prop_user FROM contrat LEFT JOIN proposition ON prop_contrat = :cid WHERE contrat_id = :cid");
        $req->bindParam(":cid", $_GET['c']);
        $req->execute();
        $data = $req->fetch();


        $req = $bdd->prepare("INSERT INTO historique_contrat (histo_contrat, histo_titre, histo_desc, histo_demandeur, histo_prestataire, histo_date_deb, histo_date_fin, histo_theme, histo_montant, histo_competences)
                              VALUES (:cid, :titre, :desc, :demandeur, :prestataire, :datedeb, :datefin, :theme, :montant, :competences)");
        $req->bindParam(":cid", $data['contrat_id']);
        $req->bindParam(":titre", $data['contrat_titre']);
        $req->bindParam(":desc", $data['contrat_description']);
        $req->bindParam(":demandeur", $data['contrat_auteur']);
        $req->bindParam(":prestataire", $data['prop_user']);
        $req->bindParam(":datedeb", $data['contrat_debut_reel']);
        $req->bindParam(":datefin", $data['contrat_fin_reelle']);
        $req->bindParam(":theme", $data['contrat_theme']);
        $req->bindParam(":montant", $data['contrat_montant']);
        $req->bindParam(":competences", $data['contrat_competences']);
        $req->execute();


        // On archive aussi la conversation de ce contrat
        archiverConversation($_GET['c']);

       $req = $bdd->prepare("DELETE FROM contrat WHERE contrat_id = :cid AND contrat_etat = 2");
       $req->bindParam(":cid", $data['contrat_id']);
       $req->execute();

        header("location:index.php");

    } else {
        header("location:index.php");
    }

    function archiverConversation($cid) {
        require_once "inc/bd/bdd.php";
        $bdd = bdd();
        // On récupère les messages de la conversation
        $req = $bdd->prepare("SELECT * FROM messagerie WHERE message_contrat = :contrat");
        $req->bindParam(":contrat", $cid);
        $req->execute();
        while ($message = $req->fetch()) {
            // On ajoute les messages dans les archives
            $rqt = $bdd->prepare("INSERT INTO histo_messagerie(message_user1, message_user2, message_contrat, message_contenu, message_date) VALUES (:u1, :u2, :cid, :content, :date)");
            $rqt->bindParam(":u1", $message['message_user1']);
            $rqt->bindParam(":u2", $message['message_user2']);
            $rqt->bindParam(":cid", $cid);
            $rqt->bindParam(":content", $message['message_contenu']);
            $rqt->bindParam(":date", $message['message_date']);
            $rqt->execute();
        }


        // On supprime les messages originaux
        $req = $bdd->prepare("DELETE FROM messagerie WHERE message_contrat = :cid");
        $req->bindParam(":cid", $cid);
        $req->execute();
    }
?>