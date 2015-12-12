<?php
/**
 * Affiche les informations d'un utilisateur, avecdes inputs pour qu'il
 * puisse éffectuer les modifications qu'il souhaite.
 * Cette fonction utilise les données envoyées par la fonction recupDetailsProfil, du fichier recupDetailsProfil.php
 */
function afficherEditionProfil() {

	require "inc/recupDetailsProfil.php";
	$tab2 = recupDetailsProfil($_SESSION['id']);

	// On préremplira les inputs avec les données de l'utilisateur, pour éviter qu'il remplisse tout les champs a chaque fois.
	echo "
	<form class=\"form_edition_profil\" action=\"profil.php\" method=\"post\" enctype=\"multipart/form-data\">
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
				<td id=\"formprofil_lbl\">n°5</td>
				<td><input class=\"text\" type=\"text\" name=\"site4\" value=\"".$tab2[12]."\"/></td>
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