<?php


require_once('database/connexion.php'); 
//require_once('fonctions.php'); 
global $db, $params;

//  print_r($params);

try{

	if (isset($params['submit'])) {


		if (!empty($params['bSurface'])){
			$bSurface = " AND surface >= " . $params['bSurface'];
		} else {
			$bSurface = "";
		}

		if (!empty($params['bPieces'])){
			$bPieces = " AND pieces = " . $params['bPieces'];
		} else {
			$bPieces = "";
		}

		if (!empty($params['bType'])){
			$bType = " AND type LIKE '" . $params['bType'] . "'";
		} else {
			$bType = "";
		}

		if (!empty($params['bPrix'])){
			$bPrix = " AND loyer <= " . $params['bPrix'];
		} else {
			$bPrix = "";
		}


		$requete="SELECT * FROM bien WHERE ville LIKE :ville" . $bSurface . $bPieces . $bType . $bPrix;
		//				echo $requete;
		$stmt=$db->prepare($requete);
		$stmt->bindValue(':ville', $params['bVille'], PDO::PARAM_STR);
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

}catch (PODException $ex) {
	echo $ex->getMessage();
}

if(isset($annonce)){
	echo $annonce;

}




?>
