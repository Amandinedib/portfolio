<?php

class Album{

	/**
	* identifiant de l'album
	* @var [null|int]
	*/
	public $albumId;

	/**
	 * Nom de l'album
	 * @var [string]
	 */
	public $albumNom;

	/*
	*Instancie un album
	* @param array $data tableau ayant les informations nécessaires pour instancier un albumg
	*/
	public function __construct(array $data){
		$this->albumId = $data['a_id'];
		$this->albumNom = $data['a_nom'];
	}

    /**
     * @return mixed
     */
    public function getAlbumId()
    {
        return $this->albumId;
    }

    /**
     * @param mixed $albumId
     *
     * @return self
     */
    public function setAlbumId($albumId)
    {
        $this->albumId = $albumId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAlbumNom()
    {
        return $this->albumNom;
    }

    /**
     * @param mixed $albumNom
     *
     * @return self
     */
    public function setAlbumNom($albumNom)
    {
        $this->albumNom = $albumNom;

        return $this;
    }
}