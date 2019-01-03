<?php

class VideoRepository {

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
    			return $this->json_response(500,$e->getMessage());
			}
	}

	public function save(Video $video) {
		try {
			if (empty($video->getVideoId())) {
					$query = $this->db->prepare('INSERT INTO video (title,description,thumbnail,publication) value (:title,:description,:thumbnail,:publication)');
					echo 'insert';
				} else {
					$query = $this->db->prepare('update video SET title = :title, 
					description = :description,thumbnail = :thumbnail','publication = :publication');	
					echo 'update';
				} 

				$query->bindParam(':title',$video->getTitle());
				$query->bindParam(':description',$video->getDescription());
				$query->bindParam(':thumbnail',$video->getThumbnail());
				$query->bindParam(':publication',$video->getPublication());
				$query->execute();

				return $this->json_response('ok',200);

			} catch (Exception $e) { 
				return $this->json_response(500,$e->getMessage());
		} 
	}


	public function delete ($videoId ) {
		try {
			$query = $this->db->prepare('DELETE FROM video WHERE id = :videoid');
			$query->bindParam(':videoid',$videoId);
			$query->execute();
			return $this->json_response('ok',200);

		} catch (Exception $e) {
			return $this->json_response(500,$e->getMessage());
		}
	}

	public function softDelete($videoId) {
		try {
			$query = $this->db->prepare('UPDATE video SET archive = 1 WHERE videoid = :videoId');
			$query->bindParam(':videoid',$videoId);

			return $this->json_response('ok',200);

		} catch (Exception $e) {
			return $this->json_response(500,$e->getMessage());
		}
	}

	function json_response($message = null, $code = 200)
	{
		// clear the old headers
		header_remove();
		// set the actual code
		http_response_code($code);
		// set the header to make sure cache is forced
		header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
		// treat this as json
		header('Content-Type: application/json');
		$status = array(
			200 => '200 OK',
			400 => '400 Bad Request',
			422 => 'Unprocessable Entity',
			500 => '500 Internal Server Error'
			);
		// ok, validation error, or failure
		header('Status: '.$status[$code]);
		// return the encoded json
		return json_encode(array(
			'status' => $code < 300, // success or not?
			'message' => $message
			));
	}
}
