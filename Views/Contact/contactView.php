<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./assets/css/contactStyle.css">
	<script type="text/javascript" src="./assets/javascript/contact.js"></script>
</head>
<body>
<?php
	echo NotificationHandler::showNotification();
?>
	<p>Vous souhaitez me contacter ?</p>

	<div class="container">
		 <form action="index.php?controller=contact&action=envoiMail" id="formContact" method="post">
		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="Nom">Nom</label>
		      <input type="text" class="form-control commonSettings info" id="nom" name="nom" placeholder="Nom" required>
		      <span class="nomErreur erreurSettings" id="nomErreur">Champs obligatoire</span>
		    </div>
		    <div class="form-group col-md-6">
		      <label for="Prenom">Prenom</label>
		      <input type="text" class="form-control commonSettings info" id="prenom" name="prenom" placeholder="Prenom" required>
		      <span class="prenomErreur erreurSettings" id="nomErreur">Champs obligatoire</span>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail4">Email</label>
		      <input type="email" class="form-control commonSettings info" id="mail" name="mail" placeholder="Email" required>
		      <span class="mailErreur erreurSettings" id="nomErreur">Champs obligatoire</span>
		  </div>
		  <div class="form-group sujetMessageBloc">
		    <label for="sujetMessage specialSettings" style="display: none;">Combien font 2+2 ?</label>
		      <input type="text" class="form-control specialSettings commonSettings info" id="sujetMessage" name="sujetMessage" placeholder="Combien font 2+2" autocomplete="off">
		  </div>
		  <div class="form-group">
		    <label for="message">Votre message</label>
		    <textarea class="form-control commonSettings info" id="message" name="message" rows="3" required></textarea>
		    <span class="messageErreur erreurSettings" id="nomErreur">Champs obligatoire</span>
		  </div>
		  <div class="form-group">
		  <input type="submit"  class="btn btn-primary" id="submitForm" name="submit" value="Envoyer" />
			</div>
		</form>
		<!-- <div id="info"></div> -->
		<div id="formMessage"></div>
	</div>
</body>
</html>

