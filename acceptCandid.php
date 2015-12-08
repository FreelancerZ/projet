<?php
session_start();
require "inc/bd/bdd.php";
// Si personne n'est connecté alors on renvoie au login.php
if (!isset($_SESSION['login'])) {
    header("index.php");
}
$bdd = bdd();

// Si les parametres du GET sont incorrects on renvoie aux candidatures
if (!isset($_GET['p']) || !isset($_GET['rep'])) {
    header("candidatures.php");
}
if ($_GET['rep'] == "true") {
   // Si on accepte la candidature
 $req = $bdd->prepare("UPDATE proposition SET prop_etat = 1 WHERE prop_id = :pid AND prop_etat = 0");
 $req->bindParam(":pid", $_GET['p']);
 $req->execute();

$req = $bdd->prepare("SELECT prop_contrat FROM proposition WHERE prop_id = :pid");
$req->bindParam(":pid", $_GET['p']);
$req->execute();
$data = $req->fetch();

$req = $bdd->prepare("DELETE FROM proposition WHERE prop_contrat = :cid AND prop_etat != 1");
$req->bindParam(":cid", $data['prop_contrat']);
$req->execute();

header("location:candidatures.php");

} else if ($_GET['rep'] == "false") {
   // Si on refuse la candidature
    $req = $bdd->prepare("UPDATE proposition SET prop_etat = 2 WHERE prop_id = :pid AND prop_etat = 0");
    $req->bindParam(":pid", $_GET['p']);
    $req->execute();

    header("location:candidatures.php");
} else {
    // Si rep != true et != false
    header("location:candidatures.php");
}
?>
<a href="candidatures.php">retour</a>