<?php 

session_start();

require_once(dirname(__FILE__) . '/../../Configuration/Config/database.php');
require_once(dirname(__FILE__) . '/../../Configuration/Config/config.php');
require_once(dirname(__FILE__) . '/../../Configuration/Config/login.php');

buildingCheck();

if(isset($_SESSION['userUrl'])) {

/* ここから物件の建物情報TableのIDをSESSIONに入れる */

	$getUrlName = selectMysql('buildings', 'user', $dbh, $_GET['id']);

	if(isset($_GET['id']) && ($getUrlName == $_SESSION['userUrl'])) {
		$_SESSION['building_id'] = $_GET['id'];
	}

/* ここまで物件の建物情報TableのIDをSESSIONに入れる */



/*ここから物件概要に関する情報を取得*/

	//建物名
	$buildingName = selectMysql('buildings', 'building_name', $dbh, $_SESSION['building_id']);

	//ホームページURL
	$file_name = selectMysql('buildings', 'file_name', $dbh, $_SESSION['building_id']);

	//建物愛称
	$petName = selectMysql('buildings', 'pet_name', $dbh, $_SESSION['building_id']);

	//建物写真
	$images = selectMysql('buildings', 'top_images', $dbh, $_SESSION['building_id']);
	$image_block = explode(' ', $images);

	//構造
	$construct = selectMysql('buildings', 'building_construct', $dbh, $_SESSION['building_id']);

	//種目
	$speaces = selectMysql('buildings', 'building_speaces', $dbh, $_SESSION['building_id']);

	//築年月
	$old = selectMysql('buildings', 'old', $dbh, $_SESSION['building_id']);
	list($oldYear, $oldMonth) = explode('&', $old);
	$oldBuilding = date('Y') - $oldYear;
	$oldBuilding = (date('m') < $oldMonth) ? $oldBuilding - 1: $oldBuilding;
	$oldDisplay = $oldYear . '年' . $oldMonth . '月築(築' . $oldBuilding . '年)';//築年月[表示]

	//住所
	$pref = selectMysql('buildings', 'prefectures', $dbh, $_SESSION['building_id']);
	$addr1 = selectMysql('buildings', 'addr1', $dbh, $_SESSION['building_id']);
	$addr2 = selectMysql('buildings', 'addr2', $dbh, $_SESSION['building_id']);
	$address = $pref . $addr1 . $addr2;

	//取得年月日
	$getDay = selectMysql('buildings', 'get_day', $dbh, $_SESSION['building_id']);

	//取得金額
	$getMoney = selectMysql('buildings', 'get_money', $dbh, $_SESSION['building_id']);
	
	//総戸数 & 入居数
	$roomId = selectMysql('buildings', 'room_id', $dbh, $_SESSION['building_id']);
	$roomId_block = explode(' ', $roomId);
	$allUnits = count($roomId_block);
	$inUnits = 0;
	foreach($roomId_block as $block) {
		if(selectMysql('rooms', 'current', $dbh, $block) == '入居中') {
			$inUnits += 1;
		}
	}
	$unitsData = ((int)$allUnits / (int)$inUnits) * 100;

	//駐車場
	$parkingSituation = selectMysql('buildings', 'parking_situation', $dbh, $_SESSION['building_id']);
	$parkingNum = selectMysql('buildings', 'parking_num', $dbh, $_SESSION['building_id']);
	$parking = $parkingNum . '台(' . $parkingSituation . ')';

	//設備
	$facility = selectMysql('buildings', 'facility', $dbh, $_SESSION['building_id']);

	//ホームページ公開状況
	$publicNum = selectMysql('buildings', 'page_public', $dbh, $_SESSION['building_id']);
	$public = ($publicNum == 0) ? '公開中' : '非公開' ;


	//料金表
	$roomsId = selectMysql('buildings', 'room_id', $dbh, $_SESSION['building_id']);
	$roomsId_block = [];
	$roomsId_block = explode(' ', $roomsId);

	$totalRent = 0;
	$totalFee = 0;
	$totalRentIn = 0;
	$totalFeeIn = 0;

	foreach($roomsId_block as $id) {
		$rent = selectMysql('rooms', 'rent', $dbh, $id);
		$fee = selectMysql('rooms', 'fee', $dbh, $id);
		$publicCondition = selectMysql('rooms', 'current', $dbh, $id);

		$totalRent += $rent / 10000;
		$totalFee += $fee / 10000;

		if($publicCondition == '入居中' || $publicCondition == '退去予定') {
			$totalRentIn += $rent / 10000;
			$totalFeeIn += $fee / 10000;
		}
	}

	$monthFee = $totalRent + $totalFee;
	$yearFee = $monthFee * 12;

	$monthFeeIn = $totalRentIn + $totalFeeIn;
	$yearFeeIn = $monthFeeIn * 12;

/*ここまで物件概要に関する情報を取得*/


}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Wonder Homes管理者ページ</title>
	<meta name="Keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./../../Configuration/Function/style.css">
	<link rel="stylesheet" href="./../../Configuration/Function/edit.style.css">
	<?php include_once(dirname(__FILE__) . "/../../Configuration/Config/analyticstracking.php") ?>
</head>
<body>

	<?php if(empty($_SESSION['userUrl'])): ?>

		<?php include(dirname(__FILE__) . '/../../Configuration/Frames/login.php'); ?>

	<?php elseif(isset($_SESSION['userUrl'])): ?>

		<div class="wrapper">

		<?php include(dirname(__FILE__) . '/../../Configuration/Frames/header.php'); ?>

		<?php include(dirname(__FILE__) . '/edit.php'); ?>
		
		</div>

	<?php endif; ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="./../../Configuration/Function/script.js"></script>
</body>
</html>