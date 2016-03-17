<?php
function bdd() {

		// LOCAL
    $login	= "root";
    $pass	= "";
    $host	= "localhost";
    $dbname	= "bd_freelancerz";

	
	/*
		//INTERNET
    $login	= "u611306472_freel";
    $pass	= "Gn*aRB86`>V&py";
    $host	= "mysql.hostinger.fr";
    $dbname	= "u611306472_freel";
	*/
    try {
        $bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',$login, $pass);
        return $bdd;
    } catch (Exception $e) {
        return "<p>Impossible de se connecter à la base de données</p>";
    }
}
?>