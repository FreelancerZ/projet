<?php
/**
 * Récupere tous les informations d'un certain user
 * @return Un tableau [][] contenant les informations nécessaires a l'affichage
 */
function afficherEditionProfil($idUser) {
	require "recupDetailsProfil.php";	
	
	$tab2 = recupDetailsProfil($idUser);
	
	echo "<form action=\"editionprofil.php\" method=\"post\" enctype=\"multipart/form-data\">
		Pseudonyme :
		<input class=\"text\" type=\"text\" name=\"pseudo\"  value=\"".$tab2[13]."\"/><br />
		
		Avatar :
		<input type=\"file\" name=\"avatar\" /><br /><br />

		Nom :
		<input class=\"text\" type=\"text\" name=\"nom\" value=\"".$tab2[0]."\"/>
		privée : <input class=\"text\" type=\"checkbox\" name=\"nomPv\" /><br />
		Prenom :
		<input class=\"text\" type=\"text\" name=\"prenom\"  value=\"".$tab2[1]."\"/>
		privée : <input class=\"text\" type=\"checkbox\" name=\"prenomPv\" /><br />
		<br />
		
		Ville :
		<input class=\"text\" type=\"text\" name=\"ville\"  value=\"".$tab2[2]."\"/>
		privée : <input class=\"text\" type=\"checkbox\" name=\"villePv\" /><br />
		Adresse :
		<input class=\"text\" type=\"text\" name=\"adresse\"  value=\"".$tab2[3]."\"/>
		privée : <input class=\"text\" type=\"checkbox\" name=\"adressePv\" /><br />
		Code postal :
		<input class=\"text\" type=\"text\" name=\"cp\"  value=\"".$tab2[4]."\"/>
		privée : <input class=\"text\" type=\"checkbox\" name=\"cpPv\" /><br />
		<br>
		Adresse email :
		<input class=\"text\" type=\"email\" name=\"mail\"  value=\"".$tab2[5]."\"/><br />
		Mot de passe :
		<input class=\"text\" type=\"password\" name=\"mdp\" /><br />
		Valider mot de passe :
		<input class=\"text\" type=\"password\" name=\"mdpConf\" /><br />
		<br />
		Date de naissance :
		<input class=\"text\" type=\"text\" name=\"dateNaissance\" value=\"".$tab2[6]."\" />
		privée : <input class=\"text\" type=\"checkbox\" name=\"dateNaissancePv\" /><br />
		<br />
		Compétences :
		<input class=\"text\" type=\"text\" name=\"competences\"  value=\"".$tab2[7]."\"/>
		privée : <input class=\"text\" type=\"checkbox\" name=\"competencesPv\" /><br />
		Sites web : <br>
		<input class=\"text\" type=\"text\" name=\"site1\" value=\"".$tab2[8]."\"/>
		privée : <input class=\"text\" type=\"checkbox\" name=\"site1Pv\" /><br />
		<input class=\"text\" type=\"text\" name=\"site2\" value=\"".$tab2[9]."\" />
		privée : <input class=\"text\" type=\"checkbox\" name=\"site2Pv\" /><br />
		<input class=\"text\" type=\"text\" name=\"site3\" value=\"".$tab2[10]."\" />
		privée : <input class=\"text\" type=\"checkbox\" name=\"site3Pv\" /><br />
		<input class=\"text\" type=\"text\" name=\"site4\" value=\"".$tab2[11]."\" />
		privée : <input class=\"text\" type=\"checkbox\" name=\"site4Pv\" /><br />
		<input class=\"text\" type=\"text\" name=\"site5\" value=\"".$tab2[12]."\" />
		privée : <input class=\"text\" type=\"checkbox\" name=\"site5Pv\" /><br />
		<br />
		<input class=\"btn\" type=\"submit\" value=\"ENREGISTRER LES CHANGEMENTS\">
	</form>
	";
}
?>