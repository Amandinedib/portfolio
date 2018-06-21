<?php
/**
 * Class photoController gère les méthodes à appeler concernant les photos  suivant l'action entre le modèle et la view
 */
class PhotoController extends CoreController
{

	public function afficherPhotoPageAction()
	{
		// Le titre de la page d'accueil
		$titre = "Photographies";
		//Le header commun
		$header = $this->getHeader();
		$model = new photoModel();
		$mesphotos = $model->getMyPhotos();
		//Le contenu de la vue
		ob_start();
		require(VIEWS.'Photos/photosView.php');
		$contenu = ob_get_clean();
		//Le footer  commun
		$footer = $this->getFooter();
		require(COMMON);
	}

	/**
     * uploadPhotoAction description]Recupere les informations entrees dans formulaire d'upload de photos,puis les envoie au gestionnaire de string. Si le gestionnaire retourne un tableau vide, on verifie que la photo est valide, que la taille est correcte, qu'elle n'existe pas dans la base de donne puis on télécharge la photo, on enregistre les informations et l'url de la photo dans la bas de données, sinon, on recupere les messages d'erreur et on les affiches sur la page d'inscription la ou les erreur ont eu lieu
     */
	public function uploadPhotoAction()
	{
		// Informations de la photo téléchargée
		$imgSize = $_FILES['fileToUpload']['size'];
		$valid_extensions = array('.jpeg', '.jpg', '.png', '.gif');
		$photo = $_FILES['fileToUpload']['name'];
		$target = PHOTO_PATH . basename($photo);
		// On vérifie que le titre donné par l'utilisateur est valide et sans danger
		if(StringHandler::checkInput($this->data['title'],TITLE_MIN,TITLE_MAX))
		{
			// On vérifie que la description donnée par l'utilisateur est valide et sans danger
			if(StringHandler::checkInput($this->data['description'],DESCRIPTION_MIN,DESCRIPTION_MAX))
			{
				// Informations supplémentaires de la photo données par l'utilisateur
				$infoPhoto['p_title'] = htmlentities($this->data['title']); 
				$infoPhoto['p_description'] = htmlentities($this->data['description']);
				$infoPhoto['a_id_fk'] = $this->data['album'];
				// Le nom de la photo en BDD est fait d'un nombre aléatoire évitant ainsi les doublonsj
				$randomName = rand(10,100000);
				$infoPhoto['p_url'] = PHOTO_PATH.$randomName.substr($target, -4);
				// On vérifie que le fichier image ait le bon format c'est à dire une extension valide
				if(in_array(substr($target, -4), $valid_extensions))
				{
					// On vérifie la taille de la photo
					if($imgSize < 5000000)
					{
						// On vérifie que la photo n'existe pas déjà en base de données
						if(!file_exists($data['p_url']))
						{
							// On vérifie que la photo a été téléchargée avec le bon titre
							if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], PHOTO_PATH.$randomName.substr($target, -4)))
							{
								$model = new PhotoModel();
								// On envoie la photo enregistrée dans la base de données avec toutes les informations correspondantes
								$model->insertPhotoFromUpload($infoPhoto);
								
								// Puis on redirige l'utilisateur sur la page de base du back-office avec un message de succès
								NotificationHandler::setNotification('Votre photo a été téléchargé !','success');
								header('Location:index.php?controller=backoffice&action=afficherBackOffice');
								exit();
							}
							else{
								NotificationHandler::setNotification('Désolé, il y a eu un problème pendant le téléchargement','danger');
								header('Location:index.php?controller=backoffice&action=afficherBackOffice');
								exit();
							}
						}
						else{
							NotificationHandler::setNotification('Fichier invalide','danger');
							header('Location:index.php?controller=backoffice&action=afficherBackOffice');
							exit();
						}
					}
					else{
						NotificationHandler::setNotification('Taille du fichier invalide','danger');
						header('Location:index.php?controller=backoffice&action=afficherBackOffice');
						exit();

					}
						
				}
				else{ 
					NotificationHandler::setNotification('Erreur : fichier invalide','danger');
					header('Location:index.php?controller=backoffice&action=afficherBackOffice');
					exit();
				}	
			}
			else{	
				NotificationHandler::setNotification('Donnez une description valide','danger');
				header('Location:index.php?controller=backoffice&action=afficherBackOffice');
				exit();
			}
		}
		else{
			NotificationHandler::setNotification('Donnez un titre valide','danger');
			header('Location:index.php?controller=backoffice&action=afficherBackOffice');
			exit();
		}


	}
	/**
	 * [SupprimerPhotoAction permet de supprimer une photo  sur la page et dans la BDD suivant son ID]
	 */
	public function supprimerPhotoAction()
	{
		// On vérifie qu'on obtien bien l'ID de la photo en cliquant sur le bouton "supprimer"
		if(isset($_GET['idPhoto']))
		{
			$model = new PhotoModel;
			// On récupère toutes les infos de la photo suivant son ID
			$deletedPic = $model->getInfoPhoto($this->parameters['idPhoto']);
			foreach ($deletedPic as $pic)
			{
				// On vérifie que l'URL de la photo existe
				if(file_exists($pic->url))
				{
					// Si c'est le cas on supprime le fichier dans le dossier
					unlink($pic->url);
					// On supprime aussi la photo dans la BDD toujours grâce à son ID
					$model->deletePhoto($this->parameters['idPhoto']);
					//Redirection sur la page du back office avec message de succès
					NotificationHandler::setNotification('Photo supprimée avec succès','success');
					header('Location:index.php?controller=backoffice&action=afficherBackOffice');
					exit;
				}
				else{
					NotificationHandler::setNotification('Erreur lors de la tentative de suppression de la photo','danger');
					header('Location:index.php?controller=backoffice&action=afficherBackOffice');
					exit();
				}
			}
		}
		else{
			NotificationHandler::setNotification('Erreur lors de la tentative de suppression de la photo','danger');
			header('Location:index.php?controller=backoffice&action=afficherBackOffice');
			exit();
		}
	}
			
	
	/**
	 * ModifierPhotoAction permet de modifier les infos déjà présentes dans la BDD concernant la photo sélectionnée
	 */
	public function modifierPhotoAction()
	{
		// On vérifie qu'on a bien l'idée de la photo et que le bouton submit a été cliké à la fin du form
		if(isset($this->data['idPhoto']) && isset($this->data['modifierPhoto']))
		{
			// On vérifie que les infos dans l'input title sont valides
			if(StringHandler::checkInput($this->data['title'],TITLE_MIN,TITLE_MAX))
			{
				// On vérifie que les infos dans l'input description sont valides
				if(StringHandler::checkInput($this->data['description'],DESCRIPTION_MIN,DESCRIPTION_MAX)){
					$infoPhoto['p_title'] = htmlentities($this->data['title']);
					$infoPhoto['p_description'] = htmlentities($this->data['description']);
					$infoPhoto['a_id_fk'] = $this->data['album']; 
					$infoPhoto['u_id_fk'] = $_SESSION['portfolio']['utilisateur']['u_id'];
					$model = new PhotoModel();
					// On enregistre les informations grâce au tableau $infoPhoto qui récupère les données et à l'ID de la photo
					$photos = $model->updateThisPhoto($infoPhoto,$this->data['idPhoto']);
					NotificationHandler::setNotification('Modifications effectuées avec succès !','success');
					header('Location:index.php?controller=backoffice&action=afficherUpdateForm&idPhoto='.$this->data['idPhoto']);
					exit();
					
				}
				else{
					NotificationHandler::setNotification('Veuillez donner une nouvelle description valide','alert');
					header('Location:index.php?controller=backoffice&action=afficherUpdateForm&idPhoto='.$this->data['idPhoto']);
					exit();
				}
			}else{
				NotificationHandler::setNotification('Veuillez donner un nouveau titre valide','alert');
				header('Location:index.php?controller=backoffice&action=afficherUpdateForm&idPhoto='.$this->data['idPhoto']);
				exit();
			}
		}else{
			NotificationHandler::setNotification('Oups, il y a eu un problème. Nous ne pouvons pas faire de modifications','alert');
			header('Location:index.php?controller=backoffice&action=afficherUpdateForm&idPhoto='.$this->data['idPhoto']);
			exit();
		}
	}
}