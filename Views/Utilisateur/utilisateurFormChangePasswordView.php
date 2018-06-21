<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.conteneur{
			width: 50%;
			padding-top: 20px;
			text-align: center;
			margin:0 auto;
		}
	</style>
</head>
<body>
	<?php
		echo NotificationHandler::showNotification();
	?>
	<div class="conteneur">
		<form action="index.php?controller=utilisateur&action=checkAndModifyPwd" method="POST">
			<div class="form-group">
				<label>Entrer le mot de passe provisoire qui vous a été envoyé par mail </label>
				<input type="text" name="temporaryPwd" class="form-control" value=<?php if(!empty($this->data['temporaryPwd'])){echo '"'.$this->data['temporaryPwd'].'"';} ?>>
			</div>
			<div class="form-group">
				<label>Nouveau mot de passe</label>
				<input type="text" name="newPwd" class="form-control" value=<?php if(!empty($this->data['newPwd'])){echo '"'.$this->data['newPwd'].'"';} ?>>
			</div>
			<div class="form-group">
				<label>Confirmer mot de passe</label>
				<input type="text" name="confirmedPwd" class="form-control" value=<?php if(!empty($this->data['confirmedPwd'])){echo '"'.$this->data['confirmedPwd'].'"';} ?>>
			</div>
			<input type="submit" name="Envoyer" value="Valider" class="btn btn-primary">
		</form>
	</div>

</body>
</html>