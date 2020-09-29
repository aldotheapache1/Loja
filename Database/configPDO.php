<?php

	define('DB_DRIVER', 'mysql');
	define('DB_HOSTNAME', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'Loja');
	
	function DBConnect(){
		try {
			$pdo = new PDO(DB_DRIVER.':host='.DB_HOSTNAME.';dbname='.DB_DATABASE, DB_USERNAME, DB_PASSWORD);
			if ($pdo) {
				return $pdo;
			}
		} catch (PDOException $exc) {
			echo "Problemas na conexão!";
			echo $exc->getMessage();
		}
	}
?>
	