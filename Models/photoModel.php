<?php
/**
 * Class photoModel permet de faire des requêtes à la BDD pour récuperer infos en lien avec la table photo
 */
class PhotoModel extends CoreModel
{
	/**
	 getMyPhotos récupère les informations dans la BDD de la table pho
	 * @returarrInstance de pho
	 */
	public function getMyPhotos(){
		$mesPhotos = array();
		$sql ='SELECT * FROM photo ORDER BY p_id';
		$datas = $this->MakeSelect($sql);
		foreach ($datas as $data) {
			$mesPhotos[] = new Photo($data);
		}
		return $mesPhotos;
	}

	/**
	 *getAllAlbums récupère les informations dans la BDD de la table phot
	 * @returnarraInstance d'albu
	 */
	public function getAllAlbums(){
		$albums = array();
		$sql = 'SELECT * FROM album ORDER BY a_id';
		$datas = $this->MakeSelect($sql);
		foreach ($datas as $data) {
			$albums[] = new Album($data);
		}
		return $albums;
	}

	/**
	 *InsertPhotoFromUpload enregistre la photo uploadé et les informations qui vont avec dans la table phot
	 * @param array $infoPhoto contient les données a enregistré dans la BD
	 * @return bool true si l'enregistrement se fait, sinon false
	 */
	public function insertPhotoFromUpload(array $infoPhoto){
		try{
			$sql = 'INSERT INTO photo (p_description, p_title, p_url, a_id_fk, u_id_fk) VALUES (:p_description, :p_title, :p_url, :a_id_fk, :u_id_fk)';

			$params = array(
				'p_description' => $infoPhoto['p_description'],
				'p_title' => $infoPhoto['p_title'],
				'p_url' => $infoPhoto['p_url'],
				'a_id_fk' => $infoPhoto['a_id_fk'],
				'u_id_fk' => $infoPhoto['u_id_fk']
				
			);
			$this->makeStatement($sql, $params);
				return true;

			}
			catch(Exception $e){
				return false;
			}

	}

	/**
	 * getInfoPhoto récupère les informations d'une photo dans la BDD suivant son ID et on l'instancie 
	 * @param  string $idPhoto ID de la photo
	 * @return array          Instance de photo
	 */
	public function getInfoPhoto($idPhoto){

		$photos = array();
		$sql = 'SELECT * FROM photo WHERE p_id = '.$idPhoto;
		$datas = $this->MakeSelect($sql);
		foreach ($datas as $data) {
			$photos[] = new Photo($data);
		}
		return $photos;
	}

	/**
	 * DeletePhoto permet de supprimer une photo dans la BDD avec ses informations correspondantes
	 * @param string $idPhoto ID de la photo
	 * @return  booltrue si la suppression s'est faite, sinon false
	 */
	public function deletePhoto($idPhoto)
	{
		try
		{
			$sql = 'DELETE FROM photo WHERE p_id = '.$idPhoto;
			$params = array(
				'id' => $idPhoto
			);
			$this->makeStatement($sql,$params);
			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
		
	}

	/**
	 * UpdateThisPhoto permet de mettre à jour les informations d'une photo
	 * @param array  $infoPhoto tableau envoyant les informations à enregistrer
	 * @param bool 	$idPhoto   ID de la photo
	 */
	public function updateThisPhoto(array $infoPhoto, $idPhoto)
	{
		try{
			$sql = 'UPDATE photo SET p_description = :p_description, p_title = :p_title, a_id_fk = :a_id_fk WHERE p_id = '.$idPhoto;
			$params = array(
				'p_description' => $infoPhoto['p_description'],
				'p_title' => $infoPhoto['p_title'],
				'a_id_fk' => $infoPhoto['a_id_fk']
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
	 * getNameAlbumByIdPhoto récupère les informations de la table photo et de la table album suivant l'ID de la photo
	 * @param  string $idPhoto ID de la photo
	 * @return array Instance de photo
	 */
	public function getNameAlbumByIdPhoto($idPhoto)
	{
		$infoPhoto = array();
		$sql = 'SELECT * FROM photo INNER JOIN album ON a_id_fk = album.a_id WHERE p_id = '. $idPhoto;
		$results = $this->makeSelect($sql);
		foreach ($results as $result) 
		{
			$infoPhoto[] = new Photo($result);
		}
		return $infoPhoto;

	}
}