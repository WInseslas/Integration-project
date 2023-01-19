<?php

	namespace Core\Database;
	use \PDO;

	/**
	 * Class MySQLDatabase
	 * 		 pour la connexion a la base de donne
	 */
	class MySQLDatabase extends Database{


		/**
		 * @method __construct
		 *	
		 */


		public function __construct($db_host="", $db_name="", $db_user="", $db_pass=""){
			$this->db_host = $db_host;
			$this->db_name = $db_name;
			$this->db_user = $db_user;
			$this->db_pass = $db_pass;
		}


		/**
		 * @method connect 	:	Instancie la connexion avec la base de donnee
		 * @return PDO	 	:	Retoune un objet PDO
		 *	
		 */

		private function connect() : PDO{
			if ($this->pdo == null) {
				$pdo = new PDO("mysql:host=$this->db_host;dbname=$this->db_name;charset=utf8", $this->db_user, $this->db_pass);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->pdo = $pdo;
			}
			return $this->pdo;
		}

		/**
		 * @method query 	:	Effectue une requete
		 * @param string 	:	statement la requette
		 * @param string 	:	class_name le nom de la class
		 * @param boolean 	:	one tout les enregistrement ou non
		 * @return string 	:	retoune le resultat de la requette
		 *	
		 */


		public function query($statement, $class_name = null, $one = false){
			$req = $this->connect()->query($statement);
			if (
				strpos($statement, "UPDATE") === 0 ||
				strpos($statement, "INSERT") === 0 ||
				strpos($statement, "DELETE") === 0 
				) {
				return $req;
			}

			if (is_null($class_name)) {
				$req->setFetchMode(PDO::FETCH_OBJ);
			}else{
				$req->setFetchMode(PDO::FETCH_CLASS, $class_name);
			}

			if ($one) {
				$datas = $req->fetch();
			}else{
				$datas = $req->fetchAll();
			}
			return $datas;	
		}

		/**
		 * @method prepare
		 * @param string 	:	statements la requette
		 * @param Array 	:	attributes de la requette
		 * @param string 	:	class_name le nom de la class
		 * @param boolean 	:	one tout les enregistrement ou non
		 * @return string 	:	data le resultat de la selection
		 */


		public function prepare($statements, $attributes, $class_name = null, $one = false){
			$result = $this->connect()->prepare($statements);
			$results = $result->execute($attributes);

			if (
				strpos($statements, "UPDATE") === 0 ||
				strpos($statements, "INSERT") === 0 ||
				strpos($statements, "DELETE") === 0 
				) {
				return $results;
			}

			if (is_null($class_name)) {
				$result->setFetchMode(PDO::FETCH_OBJ);
			}else{
				$result->setFetchMode(PDO::FETCH_CLASS, $class_name);
			}
			if ($one) {
				return $data = $result->fetch();
			}else{
				return $data = $result->fetchAll();
			}
		}

		/**
		 * @method lastInsertId
		 * @return int 
		 */


		public function lastInsertId() : int{
			return $this->connect()->lastInsertId();
		}

		/**
		 * @method __destruct
		 *	
		 */

		public function __destruct(){
			$this->db_host = null;
			$this->db_name = null;
			$this->db_user = null;
			$this->db_pass = null;

		}
	}