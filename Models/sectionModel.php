<?php
/**
 * Class sectionModel permet de faire des requêtes à la BDD pour récuperer infos en lien avec la table section
 */
class SectionModel extends CoreModel
{
	/**
	 * insertSection permet de modifier une section dans la BDD
	 * @param  string $title titre de la section
	 * @param  string $main  main de la section
	 * @return bool]      true si la modification a été faite, sinon false
	 */
	public function insertSection($title, $main)
	{
		try{
			$sql = 'UPDATE section SET s_title = :s_title, s_main = :s_main';
			$params = array(
				's_title' => $title,
				's_main' => $main
			);
			$this->makeStatement($sql, $params);
			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	/**
	 * getTheSection récupère les informations de section dans la BDD
	 * @return array instance de section
	 */
	public function getTheSection()
	{
		$sections = array();
		$sql = 'SELECT * FROM section';
		$datas = $this->makeSelect($sql);
		foreach ($datas as $data) {
			$sections[] = new Section($data);

		}
		return $sections;
	}
}