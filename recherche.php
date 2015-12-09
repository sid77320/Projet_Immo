<?php

session_start();

require_once('database/connexion.php'); 
//require_once('fonctions.php'); 
global $db;
global $results;


try{

	if (isset($_POST['submit'])) {


		if (!empty($_POST['bSurface'])){
			$bSurface = " AND surface >= " . $_POST['bSurface'];
		} else {
			$bSurface = "";
		}

		if (!empty($_POST['bPieces'])){
			$bPieces = " AND pieces = " . $_POST['bPieces'];
		} else {
			$bPieces = "";
		}

		if (!empty($_POST['bType'])){
			$bType = " AND type LIKE '" . $_POST['bType'] . "'";
		} else {
			$bType = "";
		}

		if (!empty($_POST['bPrix'])){
			$bPrix = " AND loyer <= " . $_POST['bPrix'];
		} else {
			$bPrix = "";
		}



		$requete="SELECT * FROM bien WHERE ville LIKE :ville" . $bSurface . $bPieces . $bType . $bPrix;
		//				echo $requete;
		$stmt=$db->prepare($requete);
		$stmt->bindValue(':ville', $_POST['bVille'], PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		//print_r($results);

		$annonce = "";
		foreach ($results as $row) {
			$requete2="SELECT photo FROM photos WHERE bien_id =" . $row["id"];
			$stmt=$db->prepare($requete2);
			$stmt->execute();
			$results2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
			//			print_r($results2);
			$photo_annonce = "";
				echo $row["id"];
			foreach ($results2 as $row2) {
			
				$adresse_photo= "./upload_bien/" . $row2["photo"];

				$photo_annonce .= "<img src=$adresse_photo width='250' height='150'> &nbsp";

			}

			
			$annonce .= <<<EOT
<div id="globalAnnonce">
	<h3>$row[ville] - $row[titre]</h3>
	<h4>Quartier : $row[quartier]</h4>
	<h5>$row[type] - $row[pieces] Pièces - $row[surface] M² - $row[loyer] €/mois CC</h5>
	<p>$row[descriptif]<br/><br/><form method="POST"><button type="submit" alt="Je veux louer" title="Je veux louer" name="btn-louer"><i class="fa fa-envelope-o fa-2x"></i>&nbsp;Je veux louer</button></form><form method="GET"><button type="submit" alt="Je veux sauvegarder" title="Je veux sauvegarder" name="btn-sauvegarder"><i class="fa fa-floppy-o fa-2x"></i>&nbsp;Je veux sauvegarder</button></form><br/><br/>$photo_annonce</p>
	<br/></div>
EOT;
			
		}
	}
	
//		if (isset($_GET['btn-sauvegarder'])) {
//		$sql="INSERT INTO annoncessauvegardees (id_locataire, id_bien) VALUES (:idlocataire, :idbien)";
//		$stmt=$db->prepare($sql);
//		$stmt->bindValue(':idlocataire', $_SESSION['id'], PDO::PARAM_STR);
//		$stmt->bindValue(':idbien', $row['id'], PDO::PARAM_STR);
//		$stmt->execute();
//		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//			
//				echo $_SESSION['id'];
//	}

}catch (PODException $ex) {
	echo $ex->getMessage();
}




?>

<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Rechercher un bien</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>

		<form class="form-horizontal" method="post">
			<div class="form-group">
				<label for="ville" class="col-sm-2 control-label">Ville *</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="bVille" required id="bVille" placeholder="Ville">
				</div>
			</div>

			<div class="form-group">
				<label for="surface" class="col-sm-2 control-label">Surface Mini</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="bSurface" name="bSurface" placeholder="Surface minimum en M²">
				</div>
			</div>

			<div class="form-group">
				<label for="pieces" class="col-sm-2 control-label">Nombre de pièces</label>
				<div class="col-sm-6">
					<select type="text" class="form-control" id="bPieces" name="bPieces">
						<option></option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5 et +</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="type" class="col-sm-2 control-label">Type</label>
				<div class="col-sm-6">
					<select type="text" class="form-control" id="bType" name="bType">
						<option></option>
						<option>appartement</option>
						<option>maison</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="prix" class="col-sm-2 control-label">Loyer Max</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="bPrix" name="bPrix" placeholder="Loyer maximum">
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<span style="font-style:italic; color:red;">* Champ obligatoire </span><br/><br/>
					<button name="submit" type="submit" class="btn btn-default">Rechercher</button>
				</div>
			</div>
		</form>
	</body>
</html>

<?php 

	if (isset($annonce)) {
		echo $annonce;

	}




//$_SESSION['id'] = $results['id'];
//try{
//	
//	
//	if ((!isset($_SESSION['id']))) {
//echo $_SESSION['id'];
////header ("Location: locataire_connexion.php");
//
//}
//	}
//	catch(PODException $ex) {
//		echo $ex->getMessage();
//	}

?>