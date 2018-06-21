<?php
/**
 * Classe Session permettant de gérer les sessions et plus particulièrement 
 * l'affichage de notifications
 */
Class notificationHandler
{
	/**
	 * setFlash permet de stocker dans un tableau le message et le type d'alerte
	 * @param string $message Personnalise le message suivant la situation
	 * @param string $type    Personnalise le type d'affichage de la div contenant le message
	 */
	public static function setNotification($message, $type = 'alert')
	{
		//Dans la variable flash on stocke le message et le type dans un tableau
		$_SESSION['flash'] = array(
			'message' => $message,
			'type'=> $type
		);
	}

	/**
	 * flash permet d'afficher automatiquement la div d'alerte 
	 * avec le message prévu et la couleur d'alerte définie dans le contrôleur
	 *
	 */
	public static function showNotification()
	{
		 // Si la variable est défnie
		if(isset($_SESSION['flash']))
		{
			// On affiche le message dans une div
			?>
			<!-- La variable permettant de connaitre le type de notification -->
			<div id="alert" class="alert alert-<?php echo $_SESSION['flash']['type'];?>">
				<a class="close">x</a>
				<span><?php echo $_SESSION['flash']['message']; ?></span>
			</div>
			<?php
			//Puis la variable est supprimée
			unset($_SESSION['flash']);

		}
	}
}