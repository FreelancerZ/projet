<div class="leftpart">
	<div class="left">
		<header class="head_div">
			PROFIL
		</header>
			<div id="btn_deco">
				<a href="inc/deco.php" >DECONNEXION</a>
			</div>		
		<article>
			<?php
				if ($_SESSION['actif'] == 0) {
					echo "<p>Votre compte n'est pas encore activé, veuillez vérifier vos emails.</p>";
				}
			?>
			<table class="profil">
				<tr>
					<td rowspan="3" id="photo" ><img src="images/profil/<?php echo $_SESSION['id'] ?>.jpg" alt="nom prénom" onError="this.onerror=null;this.src='images/profil/unselected.jpg';"></td>
					<!-- Nom -->
					<td id="prenom"><?php echo $_SESSION['prenom']; ?></td>
				</tr>
				<tr>
					<!-- Prénom -->
					<td id="nom"><?php echo $_SESSION['nom']; ?></td>
				</tr>
				<tr>
					<!-- Pseudo -->
					<td id="pseudo"><?php echo $_SESSION['pseudo']; ?></td>
				</tr>
				<tr id="cat">
					<th colspan="2" id="categorie">Utilisateur</th>
				</tr>
				<tr>
					<td colspan="2" id="contenu">
													
					<a href="profil.php">Profil</a><br>
					<a href="parametres.php">Paramètres</a><br>
					
					</td>
				</tr>
				<tr  id="cat">
					<th colspan="2" id="categorie">Contrats</th>
				</tr>
				<tr>
					<td colspan="2" id="contenu">
                        <a href="index.php">Tous</a><br>
                        <a href="recherche.php">Rechercher</a><br>
                        <a href="create.php">Proposer</a><br>
                        <a href="mes-propositions.php">Mes propositions</a><br>
                        <a href="participations.php">Mes participations</a><br>
                        <a href="candidatures.php">Candidatures</a><br>
                        <a href="historique.php">Effectués</a><br>
					</td>
				</tr>
				<!--<tr  id="cat">
					<th colspan="2" id="categorie">Autres</th>
				</tr>
				<tr>
					<td colspan="2" id="contenu">
					<a href="">Autre</a>
					</td>
				</tr>-->				
			</table>
			
			<!-- Version smartphone (else display:none) -->
			<table class="profil_smartphone">
				<tr>
					<td rowspan="3" id="photo" ><img src="images/profil/<?php echo $_SESSION['id'] ?>.jpg" alt="nom prénom" onError="this.onerror=null;this.src='images/profil/unselected.jpg';"></td>
					<!-- Nom -->
					<td id="prenom"  colspan="2" ><?php echo $_SESSION['prenom']; ?></td>
				</tr>
				<tr>
					<!-- Prénom -->
					<td id="nom"  colspan="2" ><?php echo $_SESSION['nom']; ?></td>
				</tr>
				<tr>
					<!-- Pseudo -->
					<td id="pseudo"><?php echo $_SESSION['pseudo']; ?></td>
				</tr>
				<tr >
					<th id="categorie">Utilisateur</th>
					<th id="categorie">Contrats</th>
					<!--<th id="categorie">Autres</th>-->
				</tr>
				<tr>
					<td id="contenu">								
						<a href="profil.php">Profil</a><br>
						<a href="parametres.php">Paramètres</a><br>					
					</td>
					<td id="contenu">
                        <a href="index.php">Tous</a><br>
						<a href="recherche.php">Rechercher</a><br>
						<a href="create.php">Proposer</a><br>
						<a href="mes-propositions.php">Mes propositions</a><br>
						<a href="participations.php">Mes participations</a><br>
						<a href="candidatures.php">Candidatures</a><br>
						<a href="historique.php">Effectués</a><br>
					</td>
					<!--<td id="contenu">
						<a href="">Autre</a>
					</td>-->
				</tr>					
			</table>
		</article>
	</div>
</div>