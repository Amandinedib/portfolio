<?php

/**
 * Classe Section 
 */
class Section{

	/**
     * $id identifiant de la Section
     * @var [type] int
     */
	private $id;

	/**
     * $title Titre de la section
     * @var [type] string
     */
	private $title;

	/**
     * $main Main de la section
     * @var [type] string
     */
	private $main;

	public function __construct(array $data){
		$this->id = $data['s_id'];
		$this->title = $data['s_title'];
		$this->main = $data['s_main'];
	}



    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * @param mixed $main
     *
     * @return self
     */
    public function setMain($main)
    {
        $this->main = $main;

        return $this;
    }
}