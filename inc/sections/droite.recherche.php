<div class="rightpart">
	<div class="right">
		<header class="head_div">
			RECHERCHE
		</header>
		<article>
			<form method="get" action="resultat.php">
				Rechercher par titre : <input type="text" name="titre" /><br />
				Rechercher par thème : <input type="text" name="theme" /><br />
				Rechercher par compétences : <input type="text" name="cpts" /><br />
				Rechercher par montant : <input type="text" name="montant" /><br />
				Rechercher par auteur : <input type="text" name="auteur" /><br />
				Rechercher par mots-clés : <input type="text" name="keywords" /><br />
				<input type="submit" value="Rechercher" />
			</form>
			<br /><br />
			<form method="get" action="resultat.php">
				Recherche entre : <input type="text" name="db" placeholder="aaaa-mm-jj" size="7" /> et
				<input type="text" name="df" placeholder="aaaa-mm-jj" size="7" />
				<br />
				<input type="submit" value="Rechercher sur cette période" />
			</form>
		</article>
	</div>
</div>
