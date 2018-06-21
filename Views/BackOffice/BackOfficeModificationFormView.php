g<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="./assets/css/boModificationFormStyle.css">
<script type="text/javascript" src="./assets/javascript/backOfficeModificationForm.js"></script>
</head>
<body>
	<h1 class="titreModifForm">Page de modification d'informations d'une photo</h1>
	<?php
	foreach ($photos as $key => $value) {
	?>
	<div class="containerModif" style="width: 50%;text-align: center; margin:0 auto; display: block; margin-top:5%;">
		<?php
			echo NotificationHandler::showNotification();
		?>
		 <form action="index.php?controller=photo&action=modifierPhoto" method="post" enctype="multipart/form-data">
		    <div class="form-group">
				<input type="hidden" name="idPhoto" value="<?php echo $value->getId();?>">
		    </div>
		    <div class="form-group">
		      <img style="width:20%" name="modifiedimage" src="<?php echo $value->getUrl()?>"></img>
		    </div>
		  <div class="form-group">
		    <label>Titre</label>
			<input type="text" class="form-control" name="title" value="<?php echo $value->getTitle();?>">
		  </div>
		  <div class="form-group">
		    <label>Description</label>
			<textarea class="form-control" rows="5" name="description"><?php echo $value->getDescription();?></textarea>
		  </div>
		  <div class="form-group">
		  	<?php
		    echo"<p>L'album pré-selectionné est : ". $albumByPhoto[0]->albumNom ."</p>";
			
			?>
				<label>Autres possibilités :</label>
				<select name="album" class="custom-select">
					<?php
					foreach ($albums as $album) {
						echo '<option value="'. $album->getAlbumId().'">'.$album->getAlbumNom().'</option>';
					}
					?>
				</select>
		  </div>
		  <input type="submit" class="btn btn-primary" name="modifierPhoto" value="Modifier" />
		</form>
	</div>
	<?php
	}
	?>
</body>
</html>
