<?php
/**
 * Affiche toutes les informations d'un utilisateur
 * utilise les données envoyées par la fonction recupDetailsProfil du fichier recupDetailsProfil.php 
 */
function afficherDetailsProfil($idUser) {
	require "recupDetailsProfil.php";
	
	$tab = recupDetailsProfil($idUser);
	
	// Affichage des données
	echo "<div class=\"profil_infos\">";
       
	if ($_SESSION['id'] != $idUser) {   
		// Si l'utilisateur consulte son propre profil on n'affiche pas la photo (trop surchargé, déja présente dans la partie gauche)
	   echo "<img src=\"images/profil/$idUser.jpg\" alt=\"Avatar\" height=\"150\" onError=\"this.onerror=null;this.src='images/profil/unselected.jpg';\"><br>";
	}
	
	echo "<b>Pseudo : </b>".$tab[13]."<br>
		<b>Nom : </b>".$tab[0]."<br>
	    <b>Prenom : </b>".$tab[1]."<br>
	    <br>
	    <b>Ville : </b>".$tab[2]."<br>
	    <b>Adresse : </b>".$tab[3]."<br>
	    <b>Code postal : </b>".$tab[4]."<br>
	    <br>
	    <b>Adresse email : </b>".$tab[5]."<br>
	    <br>
	    <b>Date de naissance : </b>".$tab[6]."<br>
	    <br>
	    <b>Compétences : </b>".$tab[7]."<br>
	    <br>
	    <b>Autre liens : </b><br>";
		  
	echo "1 : ".(!empty($tab[8])?"<a href=\"".$tab[8]."\" target=\"_blank\">".$tab[8]."</a>":"Aucun")."<br>
	    2 : ".(!empty($tab[9])?"<a href=\"".$tab[9]."\" target=\"_blank\">".$tab[9]."</a>":"Aucun")."<br>
	    3 : ".(!empty($tab[10])?"<a href=\"".$tab[10]."\" target=\"_blank\">".$tab[10]."</a>":"Aucun")."<br>
	    4 : ".(!empty($tab[11])?"<a href=\"".$tab[11]."\" target=\"_blank\">".$tab[11]."</a>":"Aucun")."<br>
	    5 : ".(!empty($tab[12])?"<a href=\"".$tab[12]."\" target=\"_blank\">".$tab[12]."</a>":"Aucun")."<br>
		<br>";
		
	// si l'utilisateur consulte SON profil, le lien "modifier ces informations" s'affiche.	
    if ($_SESSION['id'] == $idUser) {
        echo "<div><a href=\"editionprofil.php\">Modifier ces informations</a></div></div>";
    }
	
	// si l'utilisateur est un admin, il peut le bannir
	if ($_SESSION['estAdmin'] == 1) {
		 echo "<div><a href=\"banuser.php?p={$idUser}\">Bannir cet utilisateur</a></div></div>";
	}
}

function afficherBanUser($idUser) {
	echo "
		<form method=\"post\" action=\"banuser.php\">
			Motif :<br />
			<textarea name=\"raison\" ></textarea>
			<input name=\"idban\" type=\"hidden\" value=\"{$idUser}\" />
			<input value=\"Bannir\" type=\"submit\" />
		</form>
	";
}
?>

