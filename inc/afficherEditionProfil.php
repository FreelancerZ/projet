<?php
/**
 * Récupere tous les informations d'un certain user
 * @return Un tableau [][] contenant les informations nécessaires a l'affichage
 */
function afficherEditionProfil() {
	 	
	require "inc/recupDetailsProfil.php";	
	$tab2 = recupDetailsProfil($_SESSION['id']);
	
	/*
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
		<br />
		<input class=\"btn\" type=\"submit\" value=\"ENREGISTRER LES CHANGEMENTS\">
	</form>
	*/
	
	echo "
	<form class=\"form_edition_profil\" action=\"editionprofil.php\" method=\"post\" enctype=\"multipart/form-data\">
		<table>
			<tr>
				<td id=\"formprofil_lbl\">Pseudonyme : * </td>
				<td><input class=\"text\" type=\"text\" name=\"pseudo\"  value=\"".$tab2[13]."\"/></td>
				<td></td>
				<td></td>
			</tr>
			<tr><td>&nbsp</td></tr>
			<tr>
				<td id=\"formprofil_lbl\">Avatar : </td>
				<td><input id=\"avatar\" type=\"file\" name=\"avatar\" /></td>
				<td></td>
				<td></td>
			</tr>
			<tr><td>&nbsp</td></tr>
			<tr>
				<td id=\"formprofil_lbl\">Nom : * </td>
				<td><input class=\"text\" type=\"text\" name=\"nom\" value=\"".$tab2[0]."\"/></td>
				<td><input id=\"cbx\" class=\"text\" type=\"checkbox\" name=\"prenomPv\" /></td>
				<td>privé</td>
			</tr>
			<tr>
				<td id=\"formprofil_lbl\">Prenom : * </td>
				<td><input class=\"text\" type=\"text\" name=\"prenom\"  value=\"".$tab2[1]."\"/></td>
				<td><input id=\"cbx\" class=\"text\" type=\"checkbox\" name=\"prenomPv\" /></td>
				<td>privé</td>
			</tr>
			<tr><td>&nbsp</td></tr>
			<tr>
				<td id=\"formprofil_lbl\">Ville :</td>
				<td><input class=\"text\" type=\"text\" name=\"ville\"  value=\"".$tab2[2]."\"/></td>
				<td><input id=\"cbx\" class=\"text\" type=\"checkbox\" name=\"villePv\" /></td>
				<td>privé</td>
			</tr>
			<tr>
				<td id=\"formprofil_lbl\">Adresse :</td>
				<td><input class=\"text\" type=\"text\" name=\"adresse\"  value=\"".$tab2[3]."\"/></td>
				<td><input id=\"cbx\" class=\"text\" type=\"checkbox\" name=\"adressePv\" /></td>
				<td>privé</td>
			</tr>
			<tr><td>&nbsp</td></tr>
			<tr>
				<td id=\"formprofil_lbl\">Code postal :</td>
				<td><input class=\"text\" type=\"text\" name=\"cp\"  value=\"".$tab2[4]."\"/></td>
				<td><input id=\"cbx\" class=\"text\" type=\"checkbox\" name=\"cpPv\" /></td>
				<td>privé</td>
			</tr>
			<tr>
				<td id=\"formprofil_lbl\">Compétences : * </td>
				<td><input class=\"text\" type=\"text\" name=\"competences\"  value=\"".$tab2[7]."\"/></td>
				<td><input id=\"cbx\" class=\"text\" type=\"checkbox\" name=\"competencesPv\" /></td>
				<td>privé</td>
			</tr>
			<tr><td>&nbsp</td></tr>
			<tr>
				<td id=\"formprofil_lbl\">Sites web :</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td id=\"formprofil_lbl\">n°1</td>
				<td><input class=\"text\" type=\"text\" name=\"site1\" value=\"".$tab2[8]."\"/></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td id=\"formprofil_lbl\">n°2</td>
				<td><input class=\"text\" type=\"text\" name=\"site2\" value=\"".$tab2[9]."\"/></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td id=\"formprofil_lbl\">n°3</td>
				<td><input class=\"text\" type=\"text\" name=\"site3\" value=\"".$tab2[10]."\"/></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td id=\"formprofil_lbl\">n°4</td>
				<td><input class=\"text\" type=\"text\" name=\"site4\" value=\"".$tab2[11]."\"/></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td style=\"text-align:center;\" colspan=\"4\">
					<input id=\"btn_form\"class=\"btn\" type=\"submit\" value=\"ENREGISTRER LES CHANGEMENTS\">
				</td>
		</form>
	</table>
		
	
	";
	
}
?>