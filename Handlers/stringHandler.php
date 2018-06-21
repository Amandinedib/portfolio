<?php
/**
 * class StringHandler vérifie les string 
 */
class StringHandler
{
	/**
	 * Verifie si un string est composé uniquement de caracteres alphanumeriques, avec des tirets
	 * @param  [string]  $string 
	 * @param  [int]  $min    taille minimale autorise du string
	 * @param  [int]  $max    taille maximale autorise du string
	 * @return boolean         
	 */
	public static function checkInput($string, $min, $max)
	{
		// On vérifie si le string n'est pas vide
	 	if(!empty($string))
	 	{
	 		// On vérifie s'il y a des lettres,des majuscules, des chiffres et/ou des tirets
	 		if(preg_match('#^[0-9A-Za-zÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ *":,.!-().?";\']+$#', $string))
	 			{
	 			// On vérifie la taille
	 			if(StringHandler::verifierTaille($string, $min, $max))
	 			{
	 				// S'il n'y a pas de problème on retourne true
	 				return true;
	 			}
	 			return false;
	 		}
	 		else{
	 			return false;
	 		}
	 	}
	 	else{
	 		return false;
	 	}
	}

	/**
	 * Verifie si un string est composé uniquement de caracteres alphanumeriques, avec des tirets
	 * @param  string  $string 
	 * @return boolean         
	 */
	public static function checkMessage($string)
	{	
		// On vérifie que ce ne soit pas vide
		if(!empty($string))
		{
			// On vérifie s'il y a des caractères autorisés
			if(preg_match('#^[0-9A-Za-zÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ *":,.!-().?";\']+$#', $string))
				{
					// Si tout est ok on retourne true
					return true;
				}
				return false;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Verifie si un string est compris entre une borne min et une borne max
	 * @param  [string]  $string [description]
	 * @param  [int]  $min    taille minimale autorise du string
	 * @param  [int]  $max    taille maximale autorise du string
	 * @return boolean         
	 */
	public static function verifierTaille($string,$min,$max)
	{
		// On vérifie si la taille du string est inférieur à la limite min
		if(strlen($string)<$min)
		{
			// Si c'est le cas on renvoie false
			return false;
		}
		// On vérifie si la taille du string est supérieur à la limite max
		if(strlen($string)>$max)
		{
			// Si c'est le cas, on renvoie false
			return false;
		}
		// Sinon on renvoie true
		return true;
	}

	/**
	 * [isEmpty vérifie que les champs pseudo et mot de passe du form de connexion soit bien remplis
	 * @param  string $string la chaine de caractère dans l'input
	 * @return boolean  return true si champ non vide, sinon false
	 */
	 public static function isEmpty($string)
	 {
	 	if (!empty($string))
	 	{
	 		return true;
	 	}
	 	else
	 	{
	 		return false;
	 	}
	 }

	 /**
	  * [isPassword vérifie que le mdp ne soit pas vide et soit fait au moins de 8 caractères, 1 chiffre, une majuscule, une minuscule
	  * @param  [type]  $password [description]
	  * @return boolean           [description]
	  */
	 public static function isPassword($password)
	 {
	 	if(!empty($password))
	 	{
	 		if(preg_match('#^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$#', $password))
	 		{
	 			return true;
	 		}
	 		else
	 		{
	 			return false;
	 		}
	 	}
	 	else
	 	{
	 		return false;
	 	}
	 }

}