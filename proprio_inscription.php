
<?php
require_once('database/connexion.php'); 
global $db;

try{

	if (isset($_POST["submit"])) {

		$email = trim($_POST["pEmail"]);
		$password = trim($_POST["pPassword"]);

		if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)) {
			$hash = password_hash($password, PASSWORD_DEFAULT);
		}

		$stmt = $db->prepare("INSERT INTO proprietaire (nom, prenom, adresse, cp, ville,tel_fixe, tel_portable, email, password) VALUES (:nom, :prenom, :adresse, :cp, :ville, :tel_fixe, :tel_portable, :email, :password)");

		$stmt->bindValue(':nom', $_POST["pName"], PDO::PARAM_STR);
		$stmt->bindValue(':prenom', $_POST["pFirstname"], PDO::PARAM_STR);
		$stmt->bindValue(':adresse', $_POST["pAddress"], PDO::PARAM_STR);
		$stmt->bindValue(':cp', $_POST["pCP"], PDO::PARAM_STR);
		$stmt->bindValue(':ville', $_POST["pCity"], PDO::PARAM_STR);
		$stmt->bindValue(':tel_fixe', $_POST["pPhone1"], PDO::PARAM_STR);
		$stmt->bindValue(':tel_portable', $_POST["pPhone2"], PDO::PARAM_STR);
		$stmt->bindValue(':email', $email, PDO::PARAM_STR);	
		$stmt->bindValue(':password', $hash, PDO::PARAM_STR);
		$stmt->execute();
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
		<title>INSCRIPTION PROPRIETAIRE</title>
		<meta charset="utf-8">
		<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>

		<form class="form-horizontal" method="post">
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">Nom</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="pName" id="pName" placeholder="Nom">
				</div>
			</div>
			<div class="form-group">
				<label for="firstname" class="col-sm-2 control-label">Prénom</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="pFirstname" id="pFirstname" placeholder="Prénom">
				</div>
			</div>
			<div class="form-group">
				<label for="address" class="col-sm-2 control-label">Adresse</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="pAddress" name="pAddress" placeholder="Adresse">
				</div>
			</div>
			<div class="form-group">
				<label for="cp" class="col-sm-2 control-label">CP</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="pCP" name="pCP" placeholder="CP">
				</div>
			</div>
			<div class="form-group">
				<label for="city" class="col-sm-2 control-label">Ville</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="pCity" name="pCity" placeholder="Ville">
				</div>
			</div>
			<div class="form-group">
				<label for="phone1" class="col-sm-2 control-label">Téléphone Fixe</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="pPhone1" name="pPhone1" placeholder="Téléphone Fixe">
				</div>
			</div>
			<div class="form-group">
				<label for="phone2" class="col-sm-2 control-label">Téléphone Portable</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="pPhone2" name="pPhone2" placeholder="Téléphone Portable">
				</div>
			</div>
			<div class="form-group">				
				<label for="Email" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" id="pEmail" name="pEmail" placeholder="Email">
				</div>

			</div>
			<div class="form-group">
				<label for="password" class="col-sm-2 control-label">Mot de Passe</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="pPassword" name="pPassword" placeholder="Mot de Passe">
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button name="submit" type="submit" class="btn btn-default">S'inscrire</button>
				</div>
			</div>
		</form>

		<?php

		if (isset($merci)) {

			echo $merci;
		}

		?>
		
	</body>
</html>