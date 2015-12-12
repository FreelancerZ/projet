<?php
function bdd() {
	
    $login	= "root";
    $pass	= "";
    $host	= "localhost";
    $dbname	= "bd_freelancerz";

    try {
        $bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',$login, $pass);
        return $bdd;
    } catch (Exception $e) {
        return "<p>Impossible de se connecter à la base de données</p>";
    }
}
?>