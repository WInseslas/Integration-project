<?php

	namespace Core\Database;

	/**
	 * Class Database
	 * 		 pour la connexion a la base de donne
	 */
	abstract class Database{

		/**
		 * @param string db_host 	: Nom d'hote
		 * @param string db_name 	: Nom de la base de donne
		 * @param string db_user	: Nom d'utilisateur
		 * @param string db_pass 	: le mot de passe
		 * @param string pdo 		: Variable de connexion
		 * 
		 */
		
		protected $db_host;
		protected $db_name;
		protected $db_user;
		protected $db_pass;
		protected $pdo;
		
	}