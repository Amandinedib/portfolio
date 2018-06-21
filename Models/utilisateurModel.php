<?php
/**
 * Class utilisateurModel permet de faire des requêtes à la BDD pour récuperer infos en lien avec la table utilisateur
 */
class UtilisateurModel extends CoreModel{

	/**
	 * Verification du pseudo dans la BDD
	 * @param $pseudo  string Pseudo a comparer aux données de la BDD
	 * @return bool Si le mail existe en BDD on retourne false, si ce n'est pas le cas on retourne true
	 */
	public function verifierPseudo($pseudo)
	{
		try
		{
			$erreur = array();
			$sql = 'SELECT utilisateur.* FROM utilisateur WHERE u_pseudo = "'. $pseudo .'"';
			$resultat = $this->makeSelect($sql);
			if(empty($resultat)){
				$erreur = 'ok';
			}
			else
			{
				$erreur = 'nope';
			}
		}
		catch(Exception $e)
		{
			$erreur = 'nope';
		}
	}
	/**
	 * verifierUtilisateur compare les infos obtenues à ceux de la BDD concernant l'utilisateur
	 * @param  array  $data tableau des informations obtenues dans la formulaire
	 * @return array  tableau d'erreur
	 */
	public function verifierUtilisateur(array $data)
	{
		try
		{
			$erreur = array();
			if(!$this->verifierPseudo($data['pseudo']))
			{
				$sql = 'SELECT u_password FROM utilisateur WHERE u_pseudo = "' . $data['pseudo'] . '"';
				$resultat = $this->makeSelect($sql);
				// Comparaison entre le mdp donnée par l'utilisateur et celui de la BDD
				if(password_verify($data['password'],$resultat[0]['u_password']))
				{
					if(password_needs_rehash($resultat[0]['u_password'],PASSWORD_DEFAULT))
					{
						$this->rehashPassword($data);
					}
				}
				else
				{
					$erreur['password'] = 'Erreur';
				}
			}
			else
			{
				$erreur['pseudo'] = 'Erreur';
			}
			return $erreur;
		}
		catch(Exception $e){

		}
	}
	/**
	 * getUtilisateur si le pseudo est valide alors on compare avec l'info utilisateur de la BDD
	 * @param  string $pseudo pseudo entré dans l'input
	 * @return string information de l'utilisateur
	 */
	public function getUtilisateur($pseudo)
	{
		if($this->verifierPseudo(htmlentities($this->data['pseudo'])));
		{
			$sql = 'SELECT * FROM utilisateur WHERE u_pseudo = "' . $pseudo . '"';
			$resultat = $this->makeSelect($sql);
			return $resultat[0];
		}
	}
	/**
	 * [getUtilisateurByMail permet de récupérer les infos de l'utilisateur grâce à son email
	 * @param  [type] $mail [description]
	 * @return [type]       [description]
	 */
	public function getUtilisateurByMail($mail)
	{
		if($this->verifierMail(htmlentities($mail)))
		{
			$sql = 'SELECT * FROM utilisateur WHERE u_mail = "' . $mail . '"';
			$resultat = $this->makeSelect($sql);
			return $resultat[0];
		}
	}

	public function getUtilisateurbyTemporaryPwd($temporaryPassword)
	{
			$sql = 'SELECT * FROM utilisateur WHERE u_tempPwd = "'. $temporaryPassword .'"';
			$resultat = $this->makeSelect($sql);
			return $resultat[0];
		
	}
	/**
	 * [rehashPassword hache de nouveau le mot de passe pour plus de sécurité et on enregistre la modification dans la table utilisateur
	 * @param  array  $data tableau contenant les informations données dans le form
	 */
	private function rehashPassword(array $data)
	{
		$pseudo = htmlentities($data['pseudo']);
		$hashedPassword = password_hash($data['password'],PASSWORD_DEFAULT);
		$sql = 'UPDATE utilisateur SET u_password = :password WHERE u_pseudo = :pseudo';
		$params = array('password'=> $hashedPassword,'pseudo'=>$pseudo);
		$this->makeStatement($sql,$params);
	}

	/**
	 * [hashTemporaryPassword crée un mot de passe temporaire
	 * @param  [type] $mail              [description]
	 * @param  [type] $today             [description]
	 * @param  [type] $temporaryPassword [description]
	 * 
	 */
	public function hashTemporaryPassword($mail,$temporaryPassword)
	{
		try{
		$sql = 'UPDATE utilisateur SET u_tempPwd = :tempPwd WHERE u_mail = :mail';
		$params = array('tempPwd' => $temporaryPassword, 'mail' => $mail);
		var_dump($params);
		$this->makeStatement($sql,$params);
		}
		catch(Exception $e){

		 echo $e;
		}
	}

	/**
	 * Verification du mail dans la BDD
	 * @param $mail  string Mail a comparer aux données de la BDD
	 * @return bool Si le mail existe en BDD on retourne false, si ce n'est pas le cas on retourne true
	 */
	public function verifierMail($mail)
	{
		try
		{
			$sql = 'SELECT utilisateur.* FROM utilisateur WHERE u_mail = "'. $mail .'"';
			$resultat = $this->makeSelect($sql);
			if(empty($resultat)){
				return true;
			}
			else
			{
				return false;
			}
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	/**
	 * [verifierTemporaryPassword verifie que le mot de passe temporaire donné par l'utilisateur correspond à celui en bdd
	 * @param  [type] $temporaryPassword [description]
	 * @return [type]                    [description]
	 */
	public function verifierTemporaryPassword($temporaryPassword)
	{
		try{
			$erreur = array();
			$sql = 'SELECT utilisateur.* FROM utilisateur WHERE u_tempPwd = "'. $temporaryPassword .'"';
			$resultat = $this->makeSelect($sql);
			if(empty($resultat))
			{
				return true;
			}
			else
			{
				$erreur['tmpPwd'] = 'erreur';
				return false;
			}
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	/**
	 * [eraseTemporaryPassword permet de supprimer le mdp provisoire dans la bdd
	 * @param  [type] $temporaryPassword [description]
	 * @return [type]                    [description]
	 */
	public function eraseTemporaryPassword($temporaryPassword)
	{
		try{
			$sql = 'DELETE u_tempPwd WHERE u_tempPwd ="'.$temporaryPassword.'"';
			$params = array(
				'u_tempPwd' => $temporaryPassword
			);
			$this->makeStatement($sql,$params);
			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	public function updatePassword($newPassword, $idUtilisateur)
	{
		try{
			$sql = 'UPDATE utilisateur SET u_password = :newPassword WHERE u_id ="'.$idUtilisateur.'"';
			$params = array(
				'u_password' => $newPassword
			);

			$this->makeStatement($sql, $params);


			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	
}