<?php

session_start();

// JE ME CONNECTE A LA BDD
require_once('database/connexion.php'); 
global $db;


try {
	
	if (isset($_POST['submit'])) {

        //JE CREE LE REPERTOIRE D'UPLOAD
        $repertoire_upload = "C://xampp//htdocs//Projet_Immo//upload_bien//";

        
        $photos = [];
//        echo count($_FILES['mes_images']['name']);
        for($i=0; $i<count($_FILES['mes_images']['name']); $i++) {
            $photos[$i] = time() ."_" . basename( $_FILES['mes_images']['name'][$i]);
            $tmpFilePath = $_FILES['mes_images']['tmp_name'][$i];
            if ($tmpFilePath != ""){
                $newFilePath = "./upload_bien/" .$photos[$i];
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $messageInsertion = "Vos photos ont bien été envoyées.";
                } else {
                    $messageInsertion = "Vos photos n'ont pas été envoyées. Merci de recommencer votre annonce.";
                }
            }
        }
    }
}catch(PODException $ex) {
    echo $ex->getMessage();
}

try{

	
	// SI ON A CLIQUE SUR ENVOI (LE BOUTON PORTANT LE NAME = "SUBMIT")
	if (isset($_POST["submit"])) {

		
		// JE PREPARE MA REQUETE POUR EVITER L'INJECTION DE CODE MALICIEUX
		$stmt = $db->prepare("INSERT INTO bien (id_proprio,titre, ville, quartier, surface, descriptif, pieces, type, loyer) VALUES (:id_proprio,:titre, :ville, :quartier, :surface, :descriptif, :pieces, :type, :loyer)");
		
		// J'AFFECTE DES VALEURS VENANT DU FORMULAIRE A CHAQUE VALEUR QUE JE SOUHAITE ENREGISTRER DANS MA BDD
		// PAR EXEMPLE : J'AFFECTE A NOM, LA VALEUR INSEREE DANS L'OBJET PORTANT LE NAME "lName" DANS LE FORMULAIRE
		$stmt->bindValue(':id_proprio', $_SESSION['id'], PDO::PARAM_STR);
        $stmt->bindValue(':titre', $_POST["ptitre"], PDO::PARAM_STR);
		$stmt->bindValue(':ville', $_POST["pville"], PDO::PARAM_STR);
		$stmt->bindValue(':quartier', $_POST["pquartier"], PDO::PARAM_STR);
		$stmt->bindValue(':surface', $_POST["psurface"], PDO::PARAM_INT);
		$stmt->bindValue(':descriptif', $_POST["pdescriptif"], PDO::PARAM_STR);
		$stmt->bindValue(':pieces', $_POST["ppieces"], PDO::PARAM_STR);
		$stmt->bindValue(':type', $_POST["ptype"], PDO::PARAM_STR);
		$stmt->bindValue(':loyer', $_POST["ployer"], PDO::PARAM_INT);
		
		
		// J'EXECUTE MA REQUETE
		$stmt->execute();
    
        
        $last_id = $db->lastInsertId();
        
        foreach($photos as $photo) {
            $stmt = $db->prepare("INSERT INTO photos (bien_id, photo) VALUES (:last_id, :photo)");
            $stmt->bindValue(':last_id', $last_id, PDO::PARAM_INT);
            $stmt->bindValue(':photo', $photo, PDO::PARAM_STR);
        
        $stmt->execute();
        }
        
        
		
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
        <title>INSERTION BIEN</title>
        <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <form class="form-horizontal" method="post" enctype="multipart/form-data"> <!--action="index.php"-->
            <div class="form-group">
                <label for="titre" class="col-sm-2 control-label">Titre de l'annonce : </label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="ptitre" id="ptitre" placeholder="Titre">
                </div>
            </div>
            <div class="form-group">
                <label for="ville" class="col-sm-2 control-label">Ville : </label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="pville" id="pville" placeholder="Ville">
                </div>
            </div>
            <div class="form-group">
                <label for="quartier" class="col-sm-2 control-label">Quartier : </label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="pquartier" id="pquartier" placeholder="Quartier">
                </div>
            </div>
            <div class="form-group">
                <label for="surface" class="col-sm-2 control-label">Surface (en m²) : </label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="psurface" id="psurface" placeholder="Surface">
                </div>
            </div>
            <div class="form-group">
                <label for="pieces" class="col-sm-2 control-label">Pieces : </label>
                <div class="col-sm-3">
                    <select class="form-control" name="ppieces" id="ppieces"  size="1">
                        <!-- select = permet d'avoir un menu deroulant / size = permet de voir un nombre d'éléments defini par le chiffre dans le menu deroulant-->
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5 et +">5 et +</option>                        
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="col-sm-2 control-label">Type : </label>
                <div class="col-sm-3">
                    <select class="form-control" name="ptype" id="ptype"  size="1">
                        <!-- select = permet d'avoir un menu deroulant / size = permet de voir un nombre d'éléments defini par le chiffre dans le menu deroulant-->
                        <option value="appartement" selected>Appartement</option>
                        <option value="maison">Maison</option>                       
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="descriptif" class="col-sm-2 control-label">Descriptif : </label>
                <div class="col-sm-3">
                    <textarea class="form-control" name="pdescriptif" id="pdescriptif" rows="5" placeholder="décrivez votre bien ici ..."></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="loyer" class="col-sm-2 control-label">Loyer (en €uros) : </label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="ployer" id="ployer" placeholder="Loyer">
                </div>
            </div>
            <div class="form-group">
                <label for="images" class="col-sm-2 control-label">Choisissez vos photos : </label>
            <input name="mes_images[]" type="file" multiple="multiple" />
            </div>
            <div class="form-group">
                 <label for="submit" class="col-sm-2 control-label"></label>
            <input type="submit" name="submit" value="Envoyer" />
            </div>

        </form>
		
		<?php
			if (isset($merci)) {
				echo $merci;
				echo "<br/>";
	
			}
		if (isset($messageInsertion)) {
				echo $messageInsertion;
	
			}
		
		
		?>
    </body>
</html>