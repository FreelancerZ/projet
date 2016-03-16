<?php
/**
 * Enregistre les modifications de l'édition des paramètres dans la BDD
 * @param  [type] $tab Tableau contenant toutes les données des champs du formulaire
 */
function editerProfil($tab) {
    include_once "bd/bdd.php";
	$private = "Privée";

    // Si l'élément est vide, on indique "" dans la BD
    foreach ($tab as $valeur => $k) {

        if (empty($k) || $k == null) {
            $tab[$valeur] = "";
        }
	}

	// contrôle du format du code postal
	if (empty($tab['cp']) || !is_numeric($tab['cp']) || strlen($tab['cp']) != 5) {
		$tab['cp'] = "";
	}

	// connxion à la BDD
	$bdd = bdd();

	// enregistrement des modifications dans la BDD privée
	$sql = "UPDATE users_privee SET user_ville = :ville, user_adresse = :adresse, user_cp = :cp, user_competences = :competences, user_site1 = :site1, user_site2 = :site2, user_site3 = :site3, user_site4 = :site4, user_site5 = :site5 WHERE user_id = :id";
	$req = $bdd->prepare($sql);
	$req->bindParam(':ville',$tab['ville']);
	$req->bindParam(':adresse',$tab['adresse']);
	$req->bindParam(':cp',$tab['cp']);
	$req->bindParam(':competences',$tab['competences']);
	$req->bindParam(':site1',$tab['site1']);
	$req->bindParam(':site2',$tab['site2']);
	$req->bindParam(':site3',$tab['site3']);
	$req->bindParam(':site4',$tab['site4']);
	$req->bindParam(':site5',$tab['site5']);
	$req->bindParam('id',$_SESSION['id']);

	$tab['site1'] = checkAdress($tab['site1']);
	$tab['site2'] = checkAdress($tab['site2']);
	$tab['site3'] = checkAdress($tab['site3']);
	$tab['site4'] = checkAdress($tab['site4']);
	$tab['site5'] = checkAdress($tab['site5']);

	$req->execute();

	// enregistrement des modifications dans la BDD public
	$sql = "UPDATE users SET user_ville = :ville, user_adresse = :adresse, user_cp = :cp, user_competences = :competences, user_site1 = :site1, user_site2 = :site2, user_site3 = :site3, user_site4 = :site4, user_site5 = :site5 WHERE user_id = :id";
	$req = $bdd->prepare($sql);
	if(isset($tab['villePv'])) {
		$req->bindParam(':ville',$private);
	} else {
		$req->bindParam(':ville',$tab['ville']);
	}
	if(isset($tab['adressePv'] )) {
		$req->bindParam(':adresse',$private);
	} else {
		$req->bindParam(':adresse',$tab['adresse']);
	}
	if(isset($tab['cpPv'])) {
		$req->bindParam(':cp',$private);
	}else {
		$req->bindParam(':cp',$tab['cp']);
	}
	if(isset($tab['competencesPv'])) {
		$req->bindParam(':competences',$private);
	} else {
		$req->bindParam(':competences',$tab['competences']);
	}
	if(isset($tab['site1Pv'])) {
		$req->bindParam(':site1',$private);
	} else {
		$req->bindParam(':site1',$tab['site1']);
	}
	if(isset($tab['site2Pv'])) {
		$req->bindParam(':site2',$private);
	} else {
		$req->bindParam(':site2',$tab['site2']);
	}
	if(isset($tab['site3Pv'])) {
		$req->bindParam(':site3',$private);
	} else {
		$req->bindParam(':site3',$tab['site3']);
	}
	if(isset($tab['site4Pv'])) {
		$req->bindParam(':site4',$private);
	} else {
		$req->bindParam(':site4',$tab['site4']);
	}
	if(isset($tab['site5Pv'])) {
		$req->bindParam(':site5',$private);
	} else {
		$req->bindParam(':site5',$tab['site5']);
	}
	$req->bindParam('id',$_SESSION['id']);

	$tab['site1'] = checkAdress($tab['site1']);
	$tab['site2'] = checkAdress($tab['site2']);
	$tab['site3'] = checkAdress($tab['site3']);
	$tab['site4'] = checkAdress($tab['site4']);
	$tab['site5'] = checkAdress($tab['site5']);

	$req->execute();

    return $tab; //var_dump($tab)
}

/** 
 * Modifie le mot de passe de l'utilisateur dans la base de données
 * $userMdp mot de passe 
 * $userMdpConf confirmation du mot de passe
 */
function editerMdp($userMdp,$userMdpConf) {
    include_once "bd/bdd.php";
	if($userMdp === $userMdpConf) {
		$mdpBD = md5($userMdp);

		// connxion à la BDD
		$bdd = bdd();

		// enregistrement des modifications dans users
		$sql = "UPDATE users SET user_password = :mdp WHERE user_id = :id";
		$req = $bdd->prepare($sql);
		$req->bindParam(':mdp',$mdpBD);
		$req->bindParam('id',$_SESSION['id']);
		$req->execute();
		
		// enregistrement des modifications dans users_privee
		$sql = "UPDATE users_privee SET user_password = :mdp WHERE user_id = :id";
		$req = $bdd->prepare($sql);
		$req->bindParam(':mdp',$mdpBD);
		$req->bindParam('id',$_SESSION['id']);
		$req->execute();
		
		return "<p id=\"message_ok\">Le mot de passe a bien été modifié.</p>";
	} else {
		return "<p id=\"message\">Les deux mots de passes ne correspondent pas. Le mot de passe n'a pas été modifié</p>";
	}
}

/**
 * Modifie le mail de l'utilisateur dans la base de données
 * @param $userEmail email de l'utilisateur
 */
function editerEmail($userEmail) {
    include_once "bd/bdd.php";

	// connexion à la BDD
	$bdd = bdd();

	// enregistrement des modifications dans users
	$sql = "UPDATE users SET user_email = :mail WHERE user_id = :id";
	$req = $bdd->prepare($sql);
	$req->bindParam(':mail',$userEmail);
	$req->bindParam('id',$_SESSION['id']);
	$req->execute();
	
	// enregistrement des modifications dans users_privee
	$sql = "UPDATE users_privee SET user_email = :mail WHERE user_id = :id";
	$req = $bdd->prepare($sql);
	$req->bindParam(':mail',$userEmail);
	$req->bindParam('id',$_SESSION['id']);
	$req->execute();

	return "<p id=\"message_ok\">Le mail a bien été modifié.</p>";
}

/*
 * Vérifie le format des liens entrés par l'utilisateur (remplace tatata par http://tatata)
 * @param $adress adresse de l'utilisateur
 */
function checkAdress($adress) {
	if (empty($adress) || $adress == "") {
		return $adress;
	} else if (substr($adress, 0, 7) != 'http://' && substr($adress, 0, 8) != 'https://') {
		return "http://".$adress;
	} else {
		return $adress;
	}
}

/** 
 * Modifie l'avatar de l'utilisateur
 * $userAvatar contient le nom de l'image
 */
function editerAvatar($userAvatar) {
	$tabExt = array('jpg','png','gif');
	$extension = pathinfo($userAvatar['name'], PATHINFO_EXTENSION);
	if(in_array(strtolower($extension),$tabExt)) {
		// On enregistre l'image avant de la redimensionner
		move_uploaded_file($userAvatar['tmp_name'],"images/profil/".$_SESSION['id'].".".$extension);
		// On enregistre le chemin de l'image pour pouvoir la redimenssioner
		$avatarOriginal = "images/profil/".$_SESSION['id'].".".$extension."";
		// Dimensions standard d'une image
		$mlargeur = 400;
		$mhauteur = 400;

		// On récupère les dimensions de l'image
		$dimension=getimagesize($avatarOriginal);

		// On crée une image à partir du fichier récup
		if(substr(strtolower($avatarOriginal),-4)==".jpg"){$avatarOriginal = imagecreatefromjpeg($avatarOriginal); }
		else if(substr(strtolower($avatarOriginal),-4)==".png"){$avatarOriginal = imagecreatefrompng($avatarOriginal); }
		else if(substr(strtolower($avatarOriginal),-4)==".gif"){$avatarOriginal = imagecreatefromgif($avatarOriginal); }
		// L'image ne peut etre redimensionne
		else{return false; }

		// On crée une image vide de la largeur et hauteur voulue
		$image =imagecreatetruecolor ($mlargeur,$mhauteur);
		// On va gérer la position et le redimensionnement de la grande image
		if($dimension[0]>($mlargeur/$mhauteur)*$dimension[1] ){ $dimY=$mhauteur; $dimX=$mhauteur*$dimension[0]/$dimension[1]; $decalX=-($dimX-$mlargeur)/2; $decalY=0;}
		if($dimension[0]<($mlargeur/$mhauteur)*$dimension[1]){ $dimX=$mlargeur; $dimY=$mlargeur*$dimension[1]/$dimension[0]; $decalY=-($dimY-$mhauteur)/2; $decalX=0;}
		if($dimension[0]==($mlargeur/$mhauteur)*$dimension[1]){ $dimX=$mlargeur; $dimY=$mhauteur; $decalX=0; $decalY=0;}
		// on modifie l'image crée en y plaçant la grande image redimensionné et décalée
		imagecopyresampled($image,$avatarOriginal,$decalX,$decalY,0,0,$dimX,$dimY,$dimension[0],$dimension[1]);
		// On sauvegarde le tout
		imagejpeg($image,"images/profil/".$_SESSION['id'].".jpg",90);
		return true;
	}
}
?>