<?php
class DB{
	private $host     = 'localhost';
	private $username = 'root';
	private $password = 'kaichour';
	private $database = 'es_db';
	
	// private $host     = 'db5005873771.hosting-data.io';
	// private $username = 'dbu1032471';
	// private $password = 'jEug9nYoZ6r06hoHjfZM';
	// private $database = 'dbs4925557';
	
	private $db;
	
	public function __construct($host = null, $username = null, $password = null, $database = null){
		if($host != null){
			$this->host     = $host;
			$this->username = $username;
			$this->password = $password;
			$this->database = $database;
		}
		try{
			$this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, $this->password, 
			array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
				PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
			));
		} catch(PDOException $e){
			die('Impossible de se connecter à la base de données : ['.$e->getMessage().']');
		}
	}
	
	public function query($sql, $data = array()){
		$req=$this->db->prepare($sql);
		$req->execute($data);
		return $req->fetchAll(PDO::FETCH_OBJ);
	}
	
	public function insertOrUpdate($sql){
		try {
			$this->db->exec($sql);
		} catch(PDOException $e) {
			die("Impossible d'executer la requête suivante : ".$sql." : [".$e->getMessage()."]");
		}
	}
	
}


























