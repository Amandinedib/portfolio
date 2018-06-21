<?php
/**
 * Class CoreController contient les tableaux récupérant les informations en GET et POST et les initialise
 */
class CoreController
{

	/*
	** array contenant les paramètres récupérés en GET sous la forme d'un tableau associatif
	*/
	protected $parameters;
	/*
	** array contenant les données récupérées en POST sous la forme d'un tableau associatif
	*/
	protected $data;

	/*
	** @params
	** @action initialise les attributs sous la forme de tableaux vides
	*/
	public function __construct()
	{
		$this->parameters = array();
		$this->data = array();
	}

	/*
	** @params array
	** @action enregistre les paramètres en GET
	*/
	public function setParameters(array $parameters)
	{
		$this->parameters = $parameters;
	}

	/*
	** @params array
	** @ction enregistre les données en POST
	*/
	public function setData(array $data)
	{
		$this->data = $data;
	}

	/**
	 * getHeader permet d'afficher le header des pages du site
	 * @return  $header contenu du tampon
	 */
	protected function getHeader()
	{
		ob_start();
		require(LAYOUT.'headerLayout.php');
		$header = ob_get_clean();
		return $header;
	}

	/**
	 * getFooter permet d'afficher le header des pages du site
	 * @return $footer contenu du tampon
	 */
	protected function getFooter()
	{
		ob_start();
		require(LAYOUT.'footerLayout.php');
		$footer = ob_get_clean();
		return $footer;
		
	}


}