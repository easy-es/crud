<?php

class VideoRepository implements SplObserver {

	private $db = null;

	public function __construct() {
	 	$this->db = Connexion::getInstance();
       	$this->db->setAttribute(
        	PDO::ATTR_ERRMODE, 
        	PDO::ERRMODE_EXCEPTION
    	);
	}

	public function findAll() {
		$query = $this->db->prepare('SELECT * FROM video');
		$query->execute();
		//$query->setFetchMode(PDO::FETCH_CLASS,'Video')
		return $query->fetchAll();
	}

	public function find($id) {
		try{	
			$query = $this->db->prepare('SELECT * FROM video WHERE id = :id');
			$query->bindParam(':id', $id);
			$query->execute();
			return $query->fetch();
		}  catch (PDOException $e) {
    			echo 'erreur ' . $e->getMessage();
			}
	}

	public function update(SplSubject $obj) {
		echo 'fail : '.$obj->error();
	}
	
}