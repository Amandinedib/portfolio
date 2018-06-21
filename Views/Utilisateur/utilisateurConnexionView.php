<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./assets/css/utilisateurConnexionStyle.css">
	<script type="text/javascript" src="./assets/javascript/utilisateur.js"></script>
</head>
<body>
<?php
	echo NotificationHandler::showNotification();
?>
	<div class="conteneur">
		<form action="index.php?controller=utilisateur&action=connexion" method="POST">
			<div class="form-group">
				<label>Pseudo :</label>
				<input type="text" name="pseudo" class="form-control" value=<?php if(!empty($this->data['pseudo'])){echo '"'.$this->data['pseudo'].'"';} ?>>
			</div>
			<div class="form-group">
				<label>Mot de passe :</label>
				<input type="password" class="form-control" name="password">
			</div>
			<div class="form-group">
				<a class="lienPwdForm" href="index.php?controller=utilisateur&action=showForgottenPwdForm">J'ai oublié mon mot de passe</a>
			</div>
			<input type="submit" class="btn btn-primary">
		</form>
	</div>
</body>
</html>
