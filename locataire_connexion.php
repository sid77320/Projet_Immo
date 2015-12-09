<?php

// JE DEMARRE UNE SESSION
//session_start();

// JE ME CONNECTE A LA BDD
require_once('database/connexion.php'); 
global $db;


	try{
		if (isset($_POST["submit"])) {
			
			$requete="SELECT id, email, password, prenom FROM locataire WHERE email LIKE :email";
			$stmt=$db->prepare($requete);
			$stmt->bindValue(':email', $_POST["lEmail"], PDO::PARAM_STR);
			$stmt->execute();
			$results = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if (password_verify($_POST["lPassword"], $results['password'])) {
				$msg = 'Bonjour ' . $results['prenom'];
				$_SESSION['login']=$results['prenom'];
			} else {
				$msg = 'Votre mot de passe est invalide.';
			}
            $_SESSION['id']=$results['id'];
		}	

	}catch (PODException $ex) {
		echo $ex->getMessage();
	}

?>


<form class="form-horizontal" method="post">
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
		<div class="col-sm-offset-2 col-sm-10">
			<button name="submit" type="submit" class="btn btn-default">Se connecter</button>
		</div>
	</div>
</form>

<?php
		if (isset($msg)) {
			echo $msg;
		}

?>