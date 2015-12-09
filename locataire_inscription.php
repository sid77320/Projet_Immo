
<?php

// JE ME CONNECTE A LA BDD
require_once('database/connexion.php'); 
global $db;

try {
	if (isset($_POST['submit'])) {

		// INSERTION PHOTO DANS LE REPERTOIRE

		//JE CREE LE REPERTOIRE D'UPLOAD
		$repertoire_upload = "C://xampp//htdocs//Projet_Immo//upload//";
		
		
		//JE CHARGE LE FICHIER DE FICHE DE PAIE
		
		// JE DONNE UN NOUVEAU NOM A MON FICHIER COMPOSE DU TIMESTAMP + _ + LE NOM DU FICHIER TELECHARGE
		$lFichePaie = time() ."_" . basename($_FILES['lFichePaie']['name']);
		// JE DECLARE L'ADRESSE COMPLETE DE MON FICHIER (REPERTOIRE + NOM DE FICHIER)
		$fichier_upload_fichePaie = $repertoire_upload . $lFichePaie;
		// JE VERIFIE QUE LE FICHIER A BIEN ETE TELECHARGE
		if(move_uploaded_file($_FILES['lFichePaie']['tmp_name'], $fichier_upload_fichePaie))
		{
			// SI OUI, J'ECRIS 100%
			echo "Upload 100%";
		} else {
			//SI NON, J'ECRIS ERREUR
			echo "Erreur Envoi Image";
		}
		
		//JE CHARGE LE FICHIER DE CNI
		$lCNI = time() ."_" . basename($_FILES['lCNI']['name']);
				$fichier_upload_CNI = $repertoire_upload . $lCNI;
		if(move_uploaded_file($_FILES['lCNI']['tmp_name'], $fichier_upload_CNI))
		{
			echo "Upload 100%";
		} else {
			echo "Erreur Envoi Image";
		}
		
		//JE CHARGE LE FICHIER DE FICHE D'IMPOTS
		$lFicheImpots = time() ."_" . basename($_FILES['lFicheImpots']['name']);
		$fichier_upload_ficheImpots = $repertoire_upload . $lFicheImpots;
		if(move_uploaded_file($_FILES['lFicheImpots']['tmp_name'], $fichier_upload_ficheImpots))
		{
			echo "Upload 100%";
		} else {
			echo "Erreur Envoi Image";
		}
		
		//JE CHARGE LE FICHIER DE RIB
		$lRIB = time() ."_" . basename($_FILES['lRIB']['name']);
		$fichier_upload_RIB = $repertoire_upload . $lRIB;
		if(move_uploaded_file($_FILES['lRIB']['tmp_name'], $fichier_upload_RIB))
		{
			echo "Upload 100%";
		} else {
			echo "Erreur Envoi Image";
		}
		
	}}
catch(PDOException $ex){
	echo $ex->getMessage();
}


try{

	
	// SI ON A CLIQUE SUR ENVOI (LE BOUTON PORTANT LE NAME = "SUBMIT")
	if (isset($_POST["submit"])) {

		// ON "NETTOIE" LE MAIL ET LE MOT DE PASSE
		$email = trim($_POST["lEmail"]);
		$password = trim($_POST["lPassword"]);

		// SI EMAIL EST VALIDE et SI LE MOT DE PASSE N'EST PAS VIDE
		if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)) {
			// ON LE HASH (ON LE CRYPTE) ET ON LE STOCKE DANS LA VARIABLE HASH
			$hash = password_hash($password, PASSWORD_DEFAULT);
		}

		
		// JE PREPARE MA REQUETE POUR EVITER L'INJECTION DE CODE MALICIEUX
		$stmt = $db->prepare("INSERT INTO locataire (nom, prenom, adresse, cp, ville,tel_fixe, tel_portable, email, password, ressources, fichePaie, CNI, ficheImpots, RIB) VALUES (:nom, :prenom, :adresse, :cp, :ville, :tel_fixe, :tel_portable, :email, :password, :ressources, :fichePaie, :CNI, :ficheImpots, :RIB)");
		
		// J'AFFECTE DES VALEURS VENANT DU FORMULAIRE A CHAQUE VALEUR QUE JE SOUHAITE ENREGISTRER DANS MA BDD
		// PAR EXEMPLE : J'AFFECTE A NOM, LA VALEUR INSEREE DANS L'OBJET PORTANT LE NAME "lName" DANS LE FORMULAIRE
		$stmt->bindValue(':nom', $_POST["lName"], PDO::PARAM_STR);
		$stmt->bindValue(':prenom', $_POST["lFirstname"], PDO::PARAM_STR);
		$stmt->bindValue(':adresse', $_POST["lAddress"], PDO::PARAM_STR);
		$stmt->bindValue(':cp', $_POST["lCP"], PDO::PARAM_STR);
		$stmt->bindValue(':ville', $_POST["lCity"], PDO::PARAM_STR);
		$stmt->bindValue(':tel_fixe', $_POST["lPhone1"], PDO::PARAM_STR);
		$stmt->bindValue(':tel_portable', $_POST["lPhone2"], PDO::PARAM_STR);
		$stmt->bindValue(':email', $email, PDO::PARAM_STR);	
		$stmt->bindValue(':password', $hash, PDO::PARAM_STR);
		$stmt->bindValue(':ressources', $_POST["lRessources"], PDO::PARAM_STR);
		$stmt->bindValue(':fichePaie', $lFichePaie, PDO::PARAM_STR);
		$stmt->bindValue(':CNI', $lCNI, PDO::PARAM_STR);
		$stmt->bindValue(':ficheImpots', $lFicheImpots, PDO::PARAM_STR);
		$stmt->bindValue(':RIB', $lRIB, PDO::PARAM_STR);
		
		// J'EXECUTE MA REQUETE
		$stmt->execute();
		
		// JE DECLARE UNE VARIABLE $MERCI POUR POUVOIR L'UTILISER APRES LE FORMULAIRE
		$merci = "Merci de votre inscription";

	} 

}catch (PODException $ex) {
	echo $ex->getMessage();
}


?>

<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>INSCRIPTION LOCATAIRE</title>
		<meta charset="utf-8">
		<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>

		<form class="form-horizontal" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">Nom</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="lName" id="lName" placeholder="Nom">
				</div>
			</div>
			<div class="form-group">
				<label for="firstname" class="col-sm-2 control-label">Prénom</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="lFirstname" id="lFirstname" placeholder="Prénom">
				</div>
			</div>
			<div class="form-group">
				<label for="address" class="col-sm-2 control-label">Adresse</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="lAddress" name="lAddress" placeholder="Adresse">
				</div>
			</div>
			<div class="form-group">
				<label for="cp" class="col-sm-2 control-label">CP</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="lCP" name="lCP" placeholder="CP">
				</div>
			</div>
			<div class="form-group">
				<label for="city" class="col-sm-2 control-label">Ville</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="lCity" name="lCity" placeholder="Ville">
				</div>
			</div>
			<div class="form-group">
				<label for="phone1" class="col-sm-2 control-label">Téléphone Fixe</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="lPhone1" name="lPhone1" placeholder="Téléphone Fixe">
				</div>
			</div>
			<div class="form-group">
				<label for="phone2" class="col-sm-2 control-label">Téléphone Portable</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="lPhone2" name="lPhone2" placeholder="Téléphone Portable">
				</div>
			</div>
			<div class="form-group">				
				<label for="Email" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" id="lEmail" name="lEmail" placeholder="Email">
				</div>

			</div>
			<div class="form-group">
				<label for="password" class="col-sm-2 control-label">Mot de Passe</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="lPassword" name="lPassword" placeholder="Mot de Passe">
				</div>
			</div>
			
			<div class="form-group">
				<label for="ressources" class="col-sm-2 control-label">Ressources</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="lRessources" name="lRessources" placeholder="Ressources">
				</div>
			</div>
			<div class="form-group">
				<label for="fichePaie" class="col-sm-2 control-label">Dernière Fiche de Paie</label>
				<div class="col-sm-10">
					<input type="file" class="form-control" id="lFichePaie" name="lFichePaie" placeholder="Fiche de Paie">
				</div>
			</div>
			<div class="form-group">
				<label for="cni" class="col-sm-2 control-label">Carte Identité</label>
				<div class="col-sm-10">
					<input type="file" class="form-control" id="lCNI" name="lCNI" placeholder="Carte Identité">
				</div>
			</div>
			<div class="form-group">
				<label for="ficheImpot" class="col-sm-2 control-label">Dernière Fiche d'impôt</label>
				<div class="col-sm-10">
					<input type="file" class="form-control" id="lFicheImpots" name="lFicheImpots" placeholder="Fiche d'impôts">
				</div>
			</div>
			<div class="form-group">
				<label for="rib" class="col-sm-2 control-label">RIB</label>
				<div class="col-sm-10">
					<input type="file" class="form-control" id="lRIB" name="lRIB" placeholder="RIB">
				</div>
			</div>
		
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button name="submit" type="submit" class="btn btn-default">S'inscrire</button>
				</div>
			</div>
		</form>

		
		<?php
		// SI LE FORM A ETE SOUMIS ET DES DONNEES INTEGREES EN BDD, ALORS MA VARIABLE MERCI EST CHARGEE
		// CETTE METHODE PERMET D'ECRIRE DES INFORMATIONS SUR L'INSERTION EN BDD APRES LE FORMULAIRE ET UNIQUEMENT SI CELUI CI A ETE SOUMIS
		// JE VERIFIE QU'ELLE EXISTE
		if (isset($merci)) {
				// JE L'ECRIS
			echo $merci;
		}

		?>
		
	</body>
</html>