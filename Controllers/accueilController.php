<?php
/**
 * Class accueilController gère l'affichage de la page accueil
 */
class AccueilController extends CoreController
{
	/**
	 * afficherAccueilAction affiche la page d'accueil du site + les layout 
	 * (header, main et footer + titre de la page)
	 */
	public function afficherAccueilAction()
	{
		// Le titre de la page d'accueil
		$titre = "Accueil Portofolio";
		//Le header commun
		$header = $this->getHeader();
		$model = new photoModel();
		 // Recupère les infos des photos dans la BDD via le model correspondant
		$mesphotos = $model->getMyPhotos();
		//Le contenu de la vue
		ob_start();
		require(VIEWS.'Accueil/accueilView.php');
		$contenu = ob_get_clean();
		//Le footer  commun
		$footer = $this->getFooter();
		require(COMMON);
	}
	/**
	 * [deconnexionAction permet la déconnexion de l'administrateur en détruisant la session utilisateur]
	 * @return
	 */
	public function deconnexionAction()
	{
		if(isset($_SESSION['portfolio']))
		{
		$_SESSION = array();
		session_destroy();
		header('Location:.');
		exit;
		}else{
			header('Location:http://localhost/portfolio/index.php?controller=utilisateur&action=AfficherConnexion');
			exit();
		}

	}

}