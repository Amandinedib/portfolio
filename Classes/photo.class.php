<?php
/**
 * Class Photo
 */
Class Photo{

	/**
	* identifiant de la photo
	* @var [null|int]
	*/
	 public $id;

	 /**
	 * Description de la photo
	 * @var [longtext]
	 */
	 public $description;

	 /**
	 * Titre de la photo
	 * @var [string]
	 */
	 public $title;

	 /**
	 * URL de la photo
	 * @var [varchar]
	 */
	 public $url;

    /**
     * id de l'album de la photo
     * @var [varchar]
     */
     public $albumId;

    /**
     * id de l'admin ayant ajouté la photo
     * @var [varchar]
     */
     public $utilisateurId;
	/*
	*Instancie une photo
	* @param array $data tableau ayant les informations nécessaires pour instancier une photo
	*/
	 public function __construct(array $data){
	 	$this->id = $data['p_id'];
	 	$this->description = $data['p_description'];
	 	$this->title = $data['p_title'];
	 	$this->url = $data['p_url'];
        $this->albumId = $data['a_id_fk'];
        $this->utilisateurId = $data['u_id_fk'];
	 }
    /**
     * @return [null|int]
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param [null|int] $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return [longtext]
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param [longtext] $description
     *
     * @return self
     */
    public function setDescription( $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return [string]
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param [string] $title
     *
     * @return self
     */
    public function setTitle( $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return [varchar]
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param [varchar] $url
     *
     * @return self
     */
    public function setUrl( $url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return [varchar]
     */
    public function getAlbumId()
    {
        return $this->albumId;
    }

    /**
     * @param [varchar] $albumId
     *
     * @return self
     */
    public function setAlbumId($albumId)
    {
        $this->albumId = $albumId;

        return $this;
    }

    /**
     * @return [varchar]
     */
    public function getUtilisateurId()
    {
        return $this->utilisateurId;
    }

    /**
     * @param [varchar] $utilisateurId
     *
     * @return self
     */
    public function setUtilisateurId($utilisateurId)
    {
        $this->utilisateurId = $utilisateurId;

        return $this;
    }
}