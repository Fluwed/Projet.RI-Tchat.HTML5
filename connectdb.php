<?php
    /*
	 * Identifiants de connexion à la base
	 */
	define("DB_HOST", 'localhost');
	define("DB_USER", "lamp");
	define("DB_PASS", "lamp");
	define("DB_NAME", "tchat_tse");
    
    /*
	 * Connexion à la base en PDO
	 */
	function connect_to_database(){
		try {
			$pdo = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME."; charset=utf8", DB_USER, DB_PASS);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$result = $pdo;
		}
		catch(PDOException $Exception) {
			echo $Exception->getMessage();
			$result = false;
		}
		return $result;
	}
?>
