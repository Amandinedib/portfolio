<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./assets/css/utilisateurPwdFormStyle.css">
	<script type="text/javascript" src="./assets/javascript/utilisateurPwdForm.js"></script>
</head>
<body>
	<?php
		echo NotificationHandler::showNotification();
	?>
	<div class="conteneur">
		<form action="index.php?controller=utilisateur&action=sendMailPwd" method="POST">
			<div class="form-group">
				<label>E-mail : </label>
				<input type="text" name="mail" class="form-control" value=<?php if(!empty($this->data['mail'])){echo '"'.$this->data['mail'].'"';} ?>>
			</div>
			<input type="submit" name="Envoyer" value="Recevoir mon mot de passe" class="btn btn-primary">
		</form>
	</div>
</body>
</html>