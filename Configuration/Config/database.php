<?php
	
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'fudousan');
	define('DB_USER', 'dbuser');
	define('DB_PASSWORD', 'shokei');

	try {
		$dbh = new PDO('mysql:host=' . DB_HOST . ';charset=utf8;dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $e) {
		echo $e->getmessage();
		exit;
	}