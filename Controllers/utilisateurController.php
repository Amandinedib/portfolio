<?php
/**
 * Class utilisateurController s'occupe de gérer l'affichage du form de connexion ainsi que la connexion au back-office par l'admin
 */
class UtilisateurController extends CoreController{

	/**
	 * [afficherConnexionAction affiche la page de connexion]
	 * @param  array|null $erreur [tableau d'ereur]
	 */
	public function afficherConnexionAction(array $erreur = null)
	{
		$titre = "Connexion au back-office";
		$header = $this->getHeader();
		ob_start();
		require(VIEWS. 'Utilisateur/utilisateurConnexionView.php');
		$contenu = ob_get_clean();
		$footer = $this->getFooter();
		require(COMMON);
	}

	/**
	 * [connexionAction gère la connexion au back-office en vérifiant les informations données dans les input, en hachant le mot de passe et en comparant les informations de la BDD. S'il y a une erreur pendant l'une des étapes, le tableau erreur sera renvoyé avec une notification d'erreur pour l'usager]
	 */
	public function connexionAction()
	{
		
		if(StringHandler::isEmpty($this->data['pseudo']) && StringHandler::isEmpty($this->data['password']))
			{
			$dataVerifiee = array();
			foreach ($this->data as $key => $value) 
			{
				if($key == 'password')
				{
					$dataVerifiee[$key] = password_hash(htmlentities($value),PASSWORD_DEFAULT);
				}
				else
				{
					$dataVerifiee[$key] = htmlentities($value);
				}
			}
			$dataVerifiee['pseudo'] = htmlentities($this->data['pseudo']);
			$dataVerifiee['password'] = htmlentities($this->data['password']);
			$model = new utilisateurModel();
			$erreur = $model->verifierUtilisateur($dataVerifiee);
			// Pas d'erreurs  = tableau vide = connexion réussie
			if(empty($erreur))
			{
				// On enregistre les informations vérifiées venant de la BDD de l'utilisateur en session
							
				$_SESSION['portfolio']['utilisateur'] = $model->getUtilisateur(htmlentities($this->data['pseudo']));
				$_SESSION['portfolio']['test'] = 'Ceci est un test';
				header('Location:index.php');
				exit();
			}
			//Si le pseudo et mdp ne correspondent pas, une alerte erreur apparait sur la page de connexion
			else
			{
				NotificationHandler::setNotification('Erreur : veuillez remplir correctement les champs','danger');
				header('Location:index.php?controller=utilisateur&action=AfficherConnexion');
				exit();
			}
		}
		//S'il y a des erreurs, une alerte erreur apparait sur la page de connexion
		else
		{
			NotificationHandler::setNotification('Erreur : veuillez remplir correctement les champs','danger');
			header('Location:index.php?controller=utilisateur&action=AfficherConnexion');
			exit();
		}
	}

	/**
	 * showForgottenPwdFormAction permet d'afficher la page contenant le formulaire, afin d'envoyer un mot de passe provisoire par mail
	 * 
	 */
	public function showForgottenPwdFormAction()
	{
		$titre = "Mot de passe oublié";
		$header = $this->getHeader();
		ob_start();
		require(VIEWS. 'Utilisateur/utilisateurPwdFormView.php');
		$contenu = ob_get_clean();
		$footer = $this->getFooter();
		require(COMMON);	
	}

	/**
	 * sendMailPwdAction permet d'envoyer un mot de passe provisoire à l'utilisateur s'il a oublié le sien
	 * @return [type] [description]
	 */
	public function sendMailPwdAction()
	{
		if(StringHandler::isEmpty($this->data['mail']))
			{
				if(filter_var($this->data['mail'], FILTER_VALIDATE_EMAIL))
				{
					$mail = $this->data['mail'];
					$model = new UtilisateurModel();
					$erreur = $model->verifierMail($mail);
					if(empty($erreur))
					{
						$model->getUtilisateurByMail(htmlentities($mail));
						$temporaryHashedPwd =substr(md5(uniqid(rand(),1)),3,10);
						// var_dump($model->hashTemporaryPassword($mail,$temporaryHashedPwd));
						$model->hashTemporaryPassword($mail,$temporaryHashedPwd);
							// echo $temporaryHashedPwd;
						$hostname     = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
					    $destinataire = "amandine.dib@live.fr";
					    $objet        = "Mot de passe provisoire";
					    $contenu     = "Votre mot de passe provisoire est : " .$temporaryHashedPwd . "\r\n\n";

					    $headers  = "CC: " . $mail . " \r\n";
					    $headers .= "Content-Type: text/plain; charset=\"ISO-8859-1\"; DelSp=\"Yes\"; format=flowed /r/n";
					    $headers .= "Content-Disposition: inline \r\n";
					    $headers .= "Content-Transfer-Encoding: 7bit \r\n";
					    $headers .= "MIME-Version: 1.0";

						mail($destinataire, $objet, utf8_decode($contenu), 'From: amandine@exemple.com');
						NotificationHandler::setNotification('E-mail envoyé avec votre mot de passe provisoire','success');
						header('Location:index.php?controller=utilisateur&action=showTemporaryPassword');
						exit();
					
						
						// envoi email, récupérer le mot de passe temporaire, le comparer au mdp temporaire en bdd. Si c'est bon, alors l'utilisateur peut changer son mot de passe.
					}
					else{
						NotificationHandler::setNotification('Erreur : mail inconnu','danger');
						header('Location:index.php?controller=utilisateur&action=showForgottenPwdForm');
						exit();
					}
				}
			}

	}
	/**
	 * [showTemporaryPasswordAction permet d'afficher la page permettant de donner le mot de passe provisoire reçu par mail et de modifier son mot de passe.
	 */
	public function showTemporaryPasswordAction()
	{
		$titre = "Modification de mot de passe oublié";
		$header = $this->getHeader();
		$model = new UtilisateurModel();
		ob_start();
		require(VIEWS. 'Utilisateur/utilisateurFormChangePasswordView.php');
		$contenu = ob_get_clean();
		$footer = $this->getFooter();
		require(COMMON);
	}
	/**
	 * [checkAndModifyPwdAction permet de vérifier que le mdp provisoire donné par le visiteur correspond au mot de passe provisoire de la bdd puis si tout est ok, verifier que les 2 nouveaux mots de passes sont identiques pour les enregistrer en bdd
	 * @return [type] [description]
	 */
	public function checkAndModifyPwdAction()
	{
		if(StringHandler::isEmpty($this->data['temporaryPwd']))
			{
				if(StringHandler::isPassword($this->data['newPwd']))
					{
						if(StringHandler::isPassword($this->data['confirmedPwd']))
							{
								if($this->data['newPwd'] == $this->data['confirmedPwd']){
									foreach ($this->data as $key => $value) {
						                //On hash le mot de passe pour plus de securite
						                if($key == 'confirmedPwd'){
						                    $dataVerifiee[$key] = password_hash(htmlentities($value),PASSWORD_DEFAULT);
						                }
						                else{
						                    //On fait un htmlentities pour nettoyer le contenu qui ne pourra plus etre interprete comme du html
						                    $dataVerifiee[$key]=htmlentities($value);
						                }
						            }
									$model = new UtilisateurModel();
									// On vérifie que le mdp temporaire donné par l'utilisateur corresponde à celui de la bdd
									$erreur = $model->verifierTemporaryPassword($dataVerifiee['temporaryPwd']);
									if(empty($erreur))
									{
										echo "<br />Le mot de passe temporaire est ok<br />";
										// On récupère les infos de l'utilisateur
										$user = $model->getUtilisateurbyTemporaryPwd($dataVerifiee['temporaryPwd']);
										var_dump($user['u_mail']);
										echo 'hey';
										// Récuperer les infos de l'utilisateur concerné, modifier son mot de passe, supprimer le mot de passe temporaire
										if($model->updatePassword($dataVerifiee['confirmedPwd'],$user['u_mail'])){
											echo "mdp update";
											if($model->eraseTemporaryPassword($dataVerifiee['temporaryPwd']))
											{
												echo "temporary mdp deleted";
											}
										}
									}
								}
								
							}
					}
			}
	}

	public function afficherUtilisateurBOAction()
	{
		$titre = "Espace compte utilisateur";
		$header = $this->getHeader();
		$model = new UtilisateurModel();
		ob_start();
		require(VIEWS. 'Utilisateur/espaceUtilisateurView.php');
		$contenu = ob_get_clean();
		$footer = $this->getFooter();
		require(COMMON);
	}
}

