<?php

/**
 * Class Utilisateur
 */
class Utilisateur{

	/**
	* identifiant de l'utilisateur
	* @var [null|int]
	*/
	private $id;

	/**
	* nrenom de l'utilisateur
	* @var [string]
	*/
	private $prenom;

	/**
	 * nom de l'utilisateur
	 * @var [string]
	 */
	private $nom;

	/**
	 * pseudo de l'utilisateur
	 * @var [string]
	 */
	private $pseudo;

	/**
	 * mot de passe de l'utilisateur
	 * @var [string]
	 */
	private $password;

	/**
	 * mail de l'utilisateur
	 * @var [string]
	 */
	private $mail;


	/*
	*Instancie un utilisateur
	* @param array $data tableau ayant les informations nécessaires pour instancier un utilisateur
	*/
	public function __construct(array $data){
		$this->id = $data['u_id'];
		$this->prenom = $data['u_prenom'];
		$this->nom = $data['u_nom'];
		$this->pseudo = $data['u_pseudo'];
		$this->password = $data['u_password'];
		$this->mail = $data['u_mail'];
	}


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int 
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string 
     *
     * @return self
     */
    public function setPrenom([string] $prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param [string] $nom
     *
     * @return self
     */
    public function setNom([string] $nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     *
     * @return self
     */
    public function setPseudo([string] $pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return self
     */
    public function setPassword([string] $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     *
     * @return self
     */
    public function setMail([string] $mail)
    {
        $this->mail = $mail;

        return $this;
    }
}