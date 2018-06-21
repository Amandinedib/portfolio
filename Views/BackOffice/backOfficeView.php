<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./assets/css/backOfficeStyle.css">
	<script type="text/javascript" src="./assets/javascript/backOffice.js"></script>
</head>
<body>
<?php
echo NotificationHandler::showNotification();
?>
<div id="content" class="content">
		<div class="bloc_top">
			<!-- <?php var_dump($_GET); ?> -->
			<p>Bienvenue sur le Back-Office de votre portfolio</p>
			<p>Ici vous pourrez modifier certains élèments à votre guise</p>
<!-- 			<ul>
				<li><a class="btn btn-primary btn-sm " >Modifier "A Propos"</a></li>
				<li><a class="btn btn-primary btn-sm ">Espace compte administrateur</a></li>
			</ul> -->

			<!-- Sous menu navigation back office -->
			<ul class="nav justify-content-center">
			  <li class="nav-item">
			    <a class="nav-link " href="index.php?controller=section&action=afficherSectionBO" id="showAPropos">Modifier "A Propos"</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link utilisateurButton" href="index.php?controller=utilisateur&action=afficherUtilisateurBO" id="showUtilisateurBO">Espace compte administrateur</a>
			  </li>
			</ul>
			
		</div>
		<div class="conteneur1" ">

			<!-- HTML permettant de faire le formulaire d'upload de photo + infos correspondantes -->
			<div class="container ajoutphoto">
				<h2>Ajouter une photo</h2>
				<!-- Formulaire de téléchargement de photo -->
			 	<form action="index.php?controller=photo&action=uploadPhoto" method="post" enctype="multipart/form-data">
					<div class="form-group">
				      	<label for="titlePic">Titre</label>
						<input type="text" id="titlePic"  placeholder="Donnez un titre à votre photo" class="form-control" name="title">
					</div>
				    <div class="form-group">
				      	<label for="descriptionPic">Description</label>
						<textarea id="descriptionPic" placeholder="Donnez une description à votre photo" class="form-control" name="description" rows="3"></textarea>
				    </div>
					<div class="form-group">
					    <label for="album">Selectionnez un album photo</label>
							<select name="album" class="custom-select">
								<?php
								foreach ($albums as $album) {
									echo '<option value="'. $album->getAlbumId().'">'.$album->getAlbumNom().'</option>';
								}
								?>
							</select>
					</div>
					<div class="form-group">
						<label for="fileToUpload">Choisissez un fichier</label>
	    				<input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
					</div>
						<input type="submit" class="btn btn-primary" name="submit" value="Télécharger" id="addPic" />
				</form>
			</div>

			<div class="rightside">

				<!-- Création d'un nouvel album photo -->
				<div class="modifAlbum">
					<!-- Formulaire de création -->
				 	<form action="index.php?controller=album&action=ajouterAlbum" method="post">
					 	<div class="form-group">
					      	<h2>Créer un nouvel album photo</h2>
							<input type="text" id="nouvelAlbumPhoto" class="form-control" name="nouvelAlbum" placeholder="Donnez un nom à votre nouvel album" >
						</div>
						<input type="submit" name="validerNouvelAlbum" class="btn btn-primary btn-sm" value="Créer">
					</form>
				</div>
			</div>

			<!-- Visualisation des albums et option de suppression -->
			<div class="containerVueAlbum">
				<div class="form-group">
				   <span>Selectionnez l'album que vous souhaitez supprimer</span>
					<table class="table">
					  <tbody>
					    <tr>
					      <th scope="row">ID</th>
					    	<?php
				   			foreach ($albums as $album) {
					      		echo'<td><p>'.$album->getAlbumId() . '</p></td>';
					     	}
					     	?>
					    </tr>
					    <tr>
					      <th scope="row">Nom</th>
					    	<?php
				   			foreach ($albums as $album) {
					      		echo'<td><p>'.$album->getAlbumNom() . '</p></td>';
					  		}
					  		?>
					    </tr>
					    <tr>
					      <th scope="row">Supprimer</th>
					      	<?php
				   			foreach ($albums as $album) {
					      	echo'<td><a class="btn btn-outline-primary btn-sm delete supprimerButton" id="deletePic" style"border:none;" href="index.php?controller=album&action=SupprimerAlbum&idAlbum='.$album->getAlbumId().'"><span class="glyphicon glyphicon-trash" aria-hidden="true"><img style="width:15px;height:15px;" src="./assets/images/trash-alt.svg"></span></a></td>';
					  		}
					  		?>
					    </tr>
					  </tbody>
					</table>
			  	</div>
			</div>
			
		</div>

		<!-- HTML permettant de faire apparaitre les photos disponibles dans la BBD ainsi que les infos correspondantes -->
		<div  class="modifierphoto">
			<h2>Modifier une photo</h2>
			<table class="table">
			  <thead class="thead-light">
			    <tr>
			      <th scope="row">ID</th>
			      <th scope="row">Photo</th>
			      <th scope="row">Titre</th>
			      <th scope="row">Decription</th>
			      <th scope="row">Album</th>
			      <th scope="row">Modifier</th>
			      <th scope="row">Supprimer</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php
			foreach ($mesPhotos as $photo) {
			    echo'<tr>';
				echo'<td>'.$photo->getId().'</td>';
				echo'<td><img class="presentationPhoto" src="'.$photo->getUrl().'"></img></td>';
				echo'<td>'.$photo->getTitle().'</td>';
				echo'<td>'.$photo->getDescription().'</td>';
				$albumByPhoto = $model->getInfoAlbum($photo->getAlbumId());
				echo'<td><p>'.$albumByPhoto[0]->albumNom. '</p></td>';
				echo'<td><a class="btn btn-outline-primary btn-sm" style="border:none;" class="modifierButton" href="index.php?controller=backoffice&action=afficherUpdateForm&idPhoto='.$photo->getId().'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"><img style="width:15px;height:15px;" src="./assets/images/pencil-alt.svg"></span></a></td>';
				echo'<td><a class="btn btn-outline-primary btn-sm" style="border:none;" id="deletePic" href="index.php?controller=photo&action=SupprimerPhoto&idPhoto='.$photo->getId().'"><span class="glyphicon glyphicon-trash" aria-hidden="true"><img style="width:15px;height:15px;" src="./assets/images/trash-alt.svg"></span></a></td>';
				echo'</tr>';
			  }
			  ?>
			  </tbody>
			</table>
		</div>
	</div>
</body>
</html>


	