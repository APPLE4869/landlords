<?php


function h($s) {
	return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

function setToken() {
	$token = sha1(uniqid(mt_rand() ,true));
	$_SESSION['token'] = $token;
}

function checkToken() {
	if(empty($_SESSION['token']) || $_SESSION['token'] != $_POST['token']) {
		echo 'ERROR';
		exit;
	}
}

function sql($table, $id) {
	$mysql = 'select * from ' . $table . ' where id = ' . $id;
	return $mysql;
}

function updateMysql($table, $column, $post, $dbh, $id) {
	$mysql = 'UPDATE ' . $table . ' SET ' . $column . ' = :column where id = ' . $id;
	$stmt = $dbh->prepare($mysql);
	$params = array(':column' => $post);
	$stmt->execute($params);
}

function selectMysql($table, $column, $dbh, $id) {
	$mysql = sql($table, $id);
	$stmt = $dbh->prepare($mysql);
	$stmt->execute();
	$result = $stmt->fetch();
	$result = $result[$column];
	return $result;
}

function insertMysql($table, $column, $post, $dbh) {
	$mysql = 'INSERT INTO ' . $table . '(' . $column . ') VALUES (:column)';
	$stmt = $dbh->prepare($mysql);
	$params = array(':column' => $post);
	$stmt->execute($params);
}

function buildingCheck() {
	if (!isset($_SESSION['building_id']) && !isset($_GET['id'])) {
		error_reporting(E_ALL);
ini_set('display_errors', 1);
		header('Location: http://groups.sub.jp/Landlords/Ownership/Top/');
		exit();
	}
}