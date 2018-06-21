<?php
/**
 * Class sectionController gère les méthodes à appeler concernant la section "A Propos"  suivant l'action entre le modèle et la view
 */
class SectionController extends CoreController{

	
	/**
	 * [afficherSectionBOAction affiche la view du back-office pour section]
	 */
	public function afficherSectionBOAction()
	{
		// Le titre de la page A Propos
		$titre = "Back Office : A Propos";
		//Le header commun
		$header = $this->getHeader();
		$modele = new sectionModel();
		// Permet d'afficher les infos précèdemment entrées dans les inputs en selectionnant ces dernieres dans la BDD
		$sections = $modele->getTheSection();
		// Le contenu de la vue
		ob_start();
		require(VIEWS.'BackOffice/backOfficeSectionView.php');
		$contenu = ob_get_clean();
		// Le footer commun
		$footer = $this->getFooter();
		require(COMMON);
	}

	/**
	 * [CreerAProposAction permet la modification des informations, leur contrôle et l'update dans la BDD]
	 */
	public function creerAProposAction()
	{
		// Si le bouton submit est pressé
		if(isset($_POST['validerAPropos'])){
			// On vérifie les informations qui sont dans les inputs
			if(StringHandler::CheckInput($this->data['title'] && $this->data['main'], TITLE_MIN, TITLE_MAX, MAIN_MIN, MAIN_MAX)){
					$title = $this->data['title'];
					$main = $this->data['main'];
					$userID = $_SESSION['portfolio']['utilisateur']['u_id'];
					$model = new sectionModel();
					// Et si tout est ok, on enregistre le titre et le main dans la BDD
					$sections = $model->insertSection($title,$main);
					NotificationHandler::setNotification('Section enregistrée','success');
					header('Location:index.php?controller=section&action=afficherSectionBO');
					exit();
			}
			else{
				NotificationHandler::setNotification('Il y a un problème','danger');
				header('Location:index.php?controller=section&action=afficherSectionBO');
				exit();
			}
		}


			
	}
	/**
	 * [afficherSectionPublicAction affiche la section dans la page A Propos où les visiteurs peuvent en prendre connaissances]
	 */
	public function afficherSectionPublicAction()
	{
		// Le titre de la page A Propos
		$titre = "A Propos";
		//Le header commun
		$header = $this->getHeader();
		$modele = new sectionModel();
		// On récupère les informations de la section qui va s'afficher sur la page
		$sections = $modele->getTheSection();
		// Le contenu de la vue
		ob_start();
		require(VIEWS.'Section/sectionView.php');
		$contenu = ob_get_clean();
		// Le footer commun
		$footer = $this->getFooter();
		require(COMMON);
	}
}

