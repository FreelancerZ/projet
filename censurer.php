<?php
    session_start();
    // Si l'user n'est pas admin > redirection à la page précédente
    if (!isset($_SESSION['estAdmin'])) {
        header("location:contrats.php");
    }

    // Si aucun contrat n'est sélectionné
    if (!isset($_GET['c'])) {
        header("location:contrats.php");
    }

    require_once "inc/bd/bdd.php";
    $bdd = bdd();

    $req = $bdd->prepare("SELECT * FROM contrat WHERE contrat_id = :id");
    $req->bindParam(":id", $_GET['c']);
    $req->execute();
    $data = $req->fetch();
    var_dump($data);

    $req = $bdd->prepare("INSERT INTO historique_contrat (histo_contrat, histo_titre, histo_desc, histo_demandeur, histo_prestataire, histo_date_deb, histo_date_fin, histo_theme, histo_montant, histo_competences)
                         VALUES (:id, :titre, 'Ce message est censuré.', :demandeur, 0, :datedeb, :maintenant, :theme, :montant, :competences)");

    $req->bindParam(":id", $_GET['c']);
    $req->bindParam(":titre", $data[2]);
    $req->bindParam(":demandeur", $data[1]);
    $req->bindParam(":datedeb", $data[9]);
    $date = date("Y-m-d");
    $req->bindParam(":maintenant", $date);
    $req->bindParam(":theme", $data[3]);
    $req->bindParam(":montant", $data[6]);
    $req->bindParam(":competences", $data[7]);
    $req->execute();

    $req = $bdd->prepare("DELETE FROM contrat WHERE contrat_id = :id");
    $req->bindParam(":id", $_GET['c']);
    $req->execute();
    header("location:contrats.php");
?>