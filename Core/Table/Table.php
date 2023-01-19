<?php
	namespace Core\Table;

	
	/**
	 * Class Table
	 * 		 pour les tables de la base de donnee
	 */
	class Table{

		/**
		 * @param string table 	: Nom de la Table
		 * @param string db 	: la connexion a la base de donnee
		 * 
		 */
		
		protected $table;
		protected $db;
		

		/**
		 * @method __construct
		 *	
		 */


		public function __construct($db){

			$this->db = $db;
			if (is_null($this->table)) {
				$parts = explode('\\', get_class($this));
				$class_name = end($parts);
				$this->table = strtolower(str_replace("Table", "", $class_name)); 	
			}
		}

		/**
		 * @method all 		:	recupere tout (*)
		 * @return Object 	:	retoune le resultat
		 */
		
		public function all(){
			return $this->query("SELECT * FROM ".$this->table);
		}

		/**
		 * @method find
		 * @param int 		:	id l'id de l'article
		 * @return Object 	:	retoune le resultat
		 */

		public function find(int $id = 0){
			$_id = 'id'.ucfirst($this->table);
			return $this->query("SELECT * FROM {$this->table} WHERE {$_id} = ?", array($id), true);
		}

		/**
		 * @method create
		 * @param Array 	:	fields les nouveaux elements
		 * @return boolean
		 */

		public function create(array $fields){
			foreach ($fields as $key => $value) {
				$query_parts[] = "$key = ?";
				$attributes[] = $value;
			}
			$query_part = implode(", ", $query_parts);

			return $this->query("INSERT INTO {$this->table} SET {$query_part}", $attributes, true);
		}

		/**
		 * @method update
		 * @param int 		:	id l'id de l'element
		 * @param Array 	:	fields les nouveaux elements
		 * @return boolean
		 */

		public function update(int $id = 0, array $fields){
			foreach ($fields as $key => $value) {
				$query_parts[] = "$key = ?";
				$attributes[] = $value;
			}
			$attributes[] = $id;
			$query_part = implode(", ", $query_parts);
			$_id = 'id'.ucfirst($this->table);

			return $this->query("UPDATE {$this->table} SET {$query_part} WHERE {$_id} = ?", $attributes, true);
		}

		/**
		 * @method delete
		 * @param int
		 * @return boolean
		 */

		public function delete(int $id) : bool{
			$_id = 'id'.ucfirst($this->table);
			return $this->query("DELETE FROM {$this->table} WHERE {$_id} = ? ", [$id], true);
		}

		/**
		 * @method query
		 * @param string 	:	statement la requette
		 * @param array 	:	attributes les parametres
		 * @param boolean 	:	one tout les enregistrement ou non
		 * @return Object 	:	retoune le resultat
		 */


		public function query(string $statement, $attributes = null, bool $one = false){
			if (!is_null($attributes)) {
				return $this->db->prepare(
					$statement, 
					$attributes, 
					str_replace("Table", "Entity", get_class($this)), 
					$one
				);
			}else{
				return $this->db->query(
					$statement, 
					str_replace("Table", "Entity", get_class($this)), 
					$one
				);
			}
		}

		/**
		 * @method lists
		 * @param key 		
		 * @param value 	
		 * @return Array
		 */

		public function lists(string $key, string $value) : Array{
			$records = $this->all();
			foreach ($records as $values) {
				$return [$values->$key] = $values->$value;
			}
			return $return;
		}
		
		/**
		 * @method __destruct
		 *	
		 */

		public function __destruct(){
			$this->table = null;
		}
	}