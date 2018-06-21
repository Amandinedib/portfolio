<?php
/**
 * Class albumController
 * Permet de contrôler les données "album" venant de la BDD
 */
class AlbumController extends CoreController
{
	/**
	 * [ajouterAlbumAction permet de créer un album via un formulaire, 
	 * le nom sera ensuite envoyé à la BDD pour être enregistré dans la table correspondante]
	 */
	public function ajouterAlbumAction()
	{
			// On vérifie si les valeurs entrées dans le form sont correctes
			if(StringHandler::checkInput($this->data['nouvelAlbum'],TITLE_MIN,TITLE_MAX)){
				$model = new AlbumModel();
				// On ajoute le nom de l'album dans la BDD
				$model->ajoutAlbum();
				NotificationHandler::setNotification('Votre album a été créé avec succès','success');
				header('Location:index.php?controller=backoffice&action=afficherBackOffice');
				exit();
			}
			else{
				NotificationHandler::setNotification('Veuillez donner un nom valide à votre nouvel album','danger');
				header('Location:index.php?controller=backoffice&action=afficherBackOffice');
				exit();

			}
		
	}

	/**
	 * [showPhotosbyAlbumAction affiche les photos provenant de la BDD ainsi que les layout (header, main et footer + titre de la page)]
	 */
	public function showPhotosbyAlbumAction()
	{
		if(isset($this->data['showThePhotos']))
		{
					// Le titre de la page d'accueil
			$titre = "Photographies";
			//Le header commun
			$header = $this->getHeader();
			$model = new albumModel();
			$mesPhotosByAlbum = $model->getPhotosByAlbum($this->parameters['$idAlbum']);
			//Le contenu de la vue
			ob_start();
			require(VIEWS.'Photos/photosByAlbumView.php');
			$contenu = ob_get_clean();
			//Le footer  commun
			$footer = $this->getFooter();
			require(COMMON);
		}
	}
		/**
		 * [SupprimerAlbumAction permet de supprimer un album grâce à son ID]
		 */
		public function SupprimerAlbumAction()
		{
			if(isset($this->parameters['idAlbum']))
			{
				$model = new AlbumModel;
				//D'abord on récupère les infos de l'album suivant l'ID de ce dernier
				$deletedAlbum= $model->getInfoAlbum($this->parameters['idAlbum']);
				$modele = new PhotoModel;
				// Puis on récupère les informations de toutes les photos
				$photoIntoAlbum = $modele->getMyPhotos();
				for ($i=0; $i < count($photoIntoAlbum) ; $i++) { 
					//On va comparer l'ID de l'album aux ID d'album en lien avec chacune des photos, si l'ID de l'album a supprimer est lié à une ou plusieurs photos alors on ne supprime pas cet album et on laisse un message d'erreur.
					if($this->parameters['idAlbum'] == $photoIntoAlbum[$i]->albumId){
					NotificationHandler::setNotification('Impossible de supprimer cet album, il contient des photos','danger');
					header('Location:index.php?controller=backoffice&action=afficherBackOffice');
					exit();
					}
				}
				
				// Autrement on supprime l'album de la BDD et donc du tableau récapitulatif
				$deletedAlbum = $model->deleteAlbum($this->parameters['idAlbum']);
				NotificationHandler::setNotification('Album supprimé avec succès','success');
				header('Location:index.php?controller=backoffice&action=afficherBackOffice');
				exit;
			}
			else{
				NotificationHandler::setNotification('Erreur lors de la tentative de suppression de cet album','danger');
				header('Location:index.php?controller=backoffice&action=afficherBackOffice');
				exit();
			}

		}
}