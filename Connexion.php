<?php
class Connexion {
	private static $instance ;
	private $db;
	const SQL_USER = 'root';
	const SQL_PWD = '';
	const SQL_DBNAME = 'lahairstyle';
	const SQL_HOST = 'localhost';

	private function __construct() {
		$this->db = new PDO('mysql:dbname='.self::SQL_DBNAME.';host='.self::SQL_HOST,self::SQL_USER ,self::SQL_PWD);  
	}

	public static function getInstance() {
		if(is_null(self::$instance)) {
			$instance = new Connexion();
		} 

		return $instance->db;
	}  
}