<?php

	if ($_SERVER['HTTP_HOST'] == "localhost") {
		define('DB_HOST', 'localhost');
		define('DB_NAME', 'fudousan');
		define('DB_USER', 'dbuser');
		define('DB_PASSWORD', 'shokei');
	} else {
		define('DB_HOST', 'mysql120.phy.lolipop.lan');
		define('DB_NAME', 'LAA0782807-fudousan');
		define('DB_USER', 'LAA0782807');
		define('DB_PASSWORD', 'shokei4869');
	}

	try {
		$dbh = new PDO('mysql:host=' . DB_HOST . ';charset=utf8;dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $e) {
		echo $e->getmessage();
		exit;
	}