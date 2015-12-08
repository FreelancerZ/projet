<?php
function recupCandidatures() {
    require "inc/bd/bdd.php";
    $bdd = bdd();
    $candids = array();
    $req = $bdd->prepare("SELECT proposition.*, user_nom, user_prenom, contrat_titre, contrat_id, contrat_auteur FROM proposition JOIN contrat ON contrat_id = prop_contrat JOIN users ON user_id = prop_user WHERE contrat_auteur = :id AND prop_etat = 0");
    $req->bindParam(":id", $_SESSION['id']);
    $req->execute();

    $i = 0;
    while ($data = $req->fetch()) {
        $candids[$i] = array($data['prop_id'], $data['prop_contrat'], $data['prop_user'], $data['user_nom'], $data['user_prenom'], $data['contrat_titre'], $data['contrat_id']);
        $i++;
    }
    return $candids;
}
?>