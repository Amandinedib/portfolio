<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
		<script type="text/javascript" src="./assets/javascript/section.js"></script>
	<!-- <<script type="text/javascript" src="./assets/javascript/section.js"></script> -->
</head>
<body>

	<?php
	echo NotificationHandler::showNotification();
	
	foreach ($sections as $key => $value) {
	?>
	<div class="container" style="width: 50%;">
		 <form action="index.php?controller=section&action=creerAPropos" id="formSection" method="post">
		  <div class="form-group">
		    <label>Donnez un titre à votre section</label>
			<input type="text" class="form-control" name="title" value="<?php echo $value->getTitle();?>">
		  </div>
		  <div class="form-group">
		    <label>Remplissez le champ principal</label>
			<textarea name="main" class="form-control" rows="7"><?php echo $value->getMain();?></textarea>
		  </div>
		  <input type="submit" class="btn btn-primary" id="validerAPropos" name="validerAPropos">
		</form>
	</div>
	<?php
	}
	?>
</body>
</html>



