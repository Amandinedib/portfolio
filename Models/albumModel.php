<?php
/**
 * Class albumModel permet de faire des requêtes à la BDD pour récuperer infos en lien avec la table album
 */
class AlbumModel extends CoreModel
{
	/**
	 * ajoutAlbum on enregistre un album dans la BDD
	 * @return bool true si l'enregistrement est effectué, sinon false
	 */
	public function ajoutAlbum()
	{
		try
		{
			$sql = 'INSERT INTO album (a_nom) VALUES (:a_nom)';
			$params = array(
				'a_nom' => $_POST['nouvelAlbum']
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
	 * getAllInfos A partir de l'ID de l'album on récupère les informations de la table album et de la table photo suivant l'ID de l'album et la clé étrangère correspondante dans la table photo et on l'instancie
	 * @param  string $idAlbum ID de l'album à comparer aux infos de la BDD
	 * @return array  Instance d'album
	 */
	public function getAllInfos($idAlbum){
		$sql = 'SELECT * FROM album INNER JOIN photo ON a_id = photo.a_id_fk WHERE a_id =' . $idAlbum;
		$results = $this->makeSelect($sql);
		if(empty($results)){
			return NULL;
		}
		$InfosPhotos = array();
		foreach ($results as $key => $value) {
			$InfosPhotos[] = new Album($value);
		}
		return $InfosPhotos;
	}
		/**
		 * getInfoAlbum récupère les infos d'un album suivant son ID dans la BDD et on l'instancie
		 * @param  string $idAlbum ID de l'album
		 * @return array  Instance d'album
		 */
		public function getInfoAlbum($idAlbum){

		$albums = array();
		$sql = 'SELECT * FROM album WHERE a_id = '.$idAlbum;
		$datas = $this->MakeSelect($sql);
		foreach ($datas as $data) {
			$albums[] = new Album($data);
		}
		return $albums;
	}

	/**
	 * DeleteAlbum supprime l'album correspondant dans la BDD suivant l'ID 
	 * @param string $idAlbum ID de l'album
	 * @return  bool true si la suppression a fonctionné, autrement false
	 */
	public function deleteAlbum($idAlbum)
	{	
		try
		{
			$sql = 'DELETE FROM album WHERE a_id = '.$idAlbum;
			$params = array(
				'id' => $idAlbum
			);
			$this->makeStatement($sql,$params);
			return true;
		}
		catch(Exception $e)
		{
			echo $e;
				return false;
		}
		
	}
}