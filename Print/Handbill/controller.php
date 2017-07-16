<?php


$frameNum = (isset($_GET['frame'])) ? $_GET['frame'] : 0;



$selected = [];
$num = 0;

//REQUEST??
if ($_SERVER['REQUEST_METHOD'] && isset($_POST['token'])) {
	checkToken();

	if (isset($_POST['buildingNum'])) {
		$num = $_POST['buildingNum'];
	}

	$selected[$num] = 'selected';
		
} else {
	setToken();
}


