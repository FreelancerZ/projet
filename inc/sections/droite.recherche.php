<div class="rightpart">
	<div class="right">
		<header class="head_div">
			RECHERCHE
		</header>
		<article>
			<form method="get" action="resultat.php">
				Recherche : <input type="text" name="r" /><br />
				Filtrer par : <input type="checkbox" name="filtres[]" value="Titre">Titre
							  <input type="checkbox" name="filtres[]" value="Theme">Thème
							  <input type="checkbox" name="filtres[]" value="CptsReq">Compétences requises
							  <input type="checkbox" name="filtres[]" value="Montant">Montant
							  <input type="checkbox" name="filtres[]" value="Auteur">Auteur
							  <input type="checkbox" name="filtres[]" value="Keywords">Mots-clés
				<br />
				<input type="submit" value="Rechercher" />
			</form>
		</article>
	</div>
</div>