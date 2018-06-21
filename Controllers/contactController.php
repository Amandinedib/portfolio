<?php
/**
 * Class contactController permet d'afficher le formulaires de contact
 */
class ContactController extends CoreController
{

	/**
	 * [afficherContactAction affiche la page Contact où se trouve un formulaire de contact]
	 */
	public function afficherContactAction()
	{
		// Le titre de la page d'accueil
		$titre = "Contact";
		//Le header commun
		$header = $this->getHeader();
		//Le contenu de la vue
		ob_start();
		require(VIEWS.'Contact/contactView.php');
		$contenu = ob_get_clean();
		//Le footer  commun
		$footer = $this->getFooter();
		require(COMMON);

	}

	public function envoiMailAction()
	{
		if($this->data){
			$spam = htmlentities($this->data['sujetMessage']);
			$nom = htmlentities($this->data['nom']);
			$prenom = htmlentities($this->data['prenom']);
			$mail = htmlentities($this->data['mail']);
			$message = htmlentities($this->data['message']);
			
			if(!empty($spam) && !($spam == '4' || strtolower($spam) == 'quatre'))
			{	
				NotificationHandler::setNotification('Erreur SPAM' , 'danger');
				header('Location:index.php?controller=contact&action=afficherContact');
				exit();
			}
			else
			{
				if(StringHandler::checkInput($nom,NAME_MIN,NAME_MAX))
				{
					if(StringHandler::checkInput($prenom,NAME_MIN,NAME_MAX))
					{
						if(filter_var($mail, FILTER_VALIDATE_EMAIL))
						{
							if(StringHandler::checkMessage($message)){
								$ip           = $_SERVER["REMOTE_ADDR"];
							    $hostname     = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
							    $destinataire = "amandine.dib@live.fr";
							    $objet        = "Message de " . $prenom." ".$nom;
							    $contenu      = "Nom de l'expéditeur : " . $nom . "\r\n";
							    $contenu     .= $message . "\r\n\n";
							    $contenu     .= "Adresse IP de l'expéditeur : " . $ip . "\r\n";
							    $contenu     .= "DLSAM : " . $hostname;

							    $headers  = "CC: " . $mail . " \r\n";
							    $headers .= "Content-Type: text/plain; charset=\"ISO-8859-1\"; DelSp=\"Yes\"; format=flowed /r/n";
							    $headers .= "Content-Disposition: inline \r\n";
							    $headers .= "Content-Transfer-Encoding: 7bit \r\n";
							    $headers .= "MIME-Version: 1.0";

							    mail($destinataire, $objet, utf8_decode($contenu), 'From: amandine@exemple.com');
							    NotificationHandler::setNotification('Message envoyé' , 'success');
							    header('Location:index.php?controller=contact&action=afficherContact');
							    exit();
							    
							}
							else
							{
								NotificationHandler::setNotification('Erreur message' , 'danger');
							    header('Location:index.php?controller=contact&action=afficherContact');
							    exit();
							}
						}
						else
							{
								NotficiationHandler::setNotification('Erreur mail' , 'danger');
							    header('Location:index.php?controller=contact&action=afficherContact');
							    exit();
							}
					}
					else
							{
								NotificationHandler::setNotification('Erreur prenom' , 'danger');
							    header('Location:index.php?controller=contact&action=afficherContact');
							    exit();
							}
				}
				else
				{
					NotificationHandler::setNotification('Erreur nom' , 'danger');
					header('Location:index.php?controller=contact&action=afficherContact');
					exit();
				}
			}	
		}
		else{
				NotificationHandler::setNotification('Erreur envoi impossible' , 'danger');
				header('Location:index.php?controller=contact&action=afficherContact');
				exit();
		}
	}	
}

