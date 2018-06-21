<?php
/**
 * Class backOfficeController gère l'affichage des informations sur la page principale du back-office
 */
class BackOfficeController extends CoreController
{
	/**
	 * afficherBackOfficeAction affiche la page principale du back-office
	 */
	public function afficherBackOfficeAction()
	{
		// Le titre de la page d'accueil
		$titre = "Back-Office";
		//Le header commun
		$header = $this->getHeader();
		$model = new photoModel();
		$mesPhotos = $model->getMyPhotos();
		$albums = $model->getAllAlbums();
		// parmi les photos, on vérifie que les photos ont un ID d'album correspondant
		foreach ($mesPhotos as $maPhoto) 
		{
		 	if(!empty($maPhoto->albumId))
		 	{
		 		$model = new AlbumModel();
		 		// On affiche l'info de l'album en lien avec chacun des photos
				$albumByPhoto = $model->getInfoAlbum($maPhoto->albumId);
		 	}
		}
		//Le contenu de la vue
		ob_start();
		require(VIEWS.'BackOffice/backOfficeView.php');
		$contenu = ob_get_clean();
		//Le footer  commun
		$footer = $this->getFooter();
		require(COMMON);

	}
	/**
	 * afficherUpdateFormAction affiche la page de modification d'infos de la photo sélectionnée
	 */
	public function afficherUpdateFormAction()
	{
		// Le titre de la page d'accueil
		$titre = "Modifier les infos d'une photo";
		//Le header commun
		$header = $this->getHeader();
		$model = new photoModel();
		// On vérifie qu'une photo a bien été sélectionné via son ID
		if(!empty($_GET['idPhoto']))
		{		
			//On invoque une fonction qui récupère toutes les infos de la photo
			$photos = $model->getNameAlbumByIdPhoto($this->parameters['idPhoto']);
			$albums = $model->getAllAlbums();
			foreach ($photos as $photo) 
			{
				// S'il y a bien un ID d'album photo lié à la photo sélectionnée
				if(!empty($photo->albumId))
				{
					$model = new AlbumModel();
					// Alors on récupère aussi les infos de la table album concernant l'album lié à la photo
					$albumByPhoto = $model->getAllInfos($photo->albumId);
				}
			}
		}
		else{
			NotificationHandler::setNotification('Erreur concernant la photo sélectionnée','danger');
			header('Location:index.php?controller=backoffice&action=afficherUpdateForm');
			exit();
		}
		ob_start();
		require(VIEWS. 'BackOffice/BackOfficeModificationFormView.php');
		$contenu = ob_get_clean();
		//Le footer commun
		$footer = $this->getFooter();
		require(COMMON);
	}
}