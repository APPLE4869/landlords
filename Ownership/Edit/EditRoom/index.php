<?php 

session_start();

require_once(dirname(__FILE__) . '/../../../Configuration/Config/database.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/config.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/login.php');

buildingCheck();

if(isset($_SESSION['userUrl'])) {

/*ここから部屋情報の更新処理*/

	$roomNum = [];
	$roomPublic = [];
	$roomRent = [];
	$roomFee = [];
	$roomFloor = [];
	$roomFloor1 = [];
	$roomFloor2 = [];
	$roomArea = [];
	$roomCurrent = [];
	$roomId_block= [];

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token'])) {
		checkToken();


		//お部屋の追加
		if(isset($_POST['roomNum']) && isset($_POST['roomNumAfter'])) {

			$roomId = selectMysql('buildings', 'room_id', $dbh, $_SESSION['building_id']);
			$file_name = selectMysql('buildings', 'file_name', $dbh, $_SESSION['building_id']);
			if(!empty($roomId)) {
				$roomId_block = explode(' ', $roomId);
			}

			//table'rooms'に部屋情報を追加
			$connect = $_SESSION['userUrl'] . '&&' . $file_name;
			$newRoomNum = $_POST['roomNum'] . $_POST['roomNumAfter'];

			$mysql = 'INSERT INTO rooms(connect, number) VALUES (:newConnect, :newNumber)';
			$stmt = $dbh->prepare($mysql);
			$params = array(
				':newConnect' => $connect,
				':newNumber' => $newRoomNum
			);

			$stmt->execute($params);


			$mysql = 'select * from rooms where connect = \'' . $connect . '\' and number = \'' . $newRoomNum . '\' order by id desc';
			$stmt = $dbh->prepare($mysql);
			$stmt->execute();
			$result = $stmt->fetch();

			array_push($roomId_block, $result['id']);

			$roomIdUpdate = "";
			foreach($roomId_block as $block) {
				if(empty($roomCheck)) {
					$roomIdUpdate .= $block;
					$roomCheck = True;
				} else {
					$roomIdUpdate .= ' ' . $block;
				}
			}

			updateMysql('buildings', 'room_id', $roomIdUpdate, $dbh, $_SESSION['building_id']);

			$roomId = selectMysql('buildings', 'room_id', $dbh, $_SESSION['building_id']);
			$roomId_block = explode(' ', $roomId);

			$addUpdateRoom = True;
		}



		//お部屋の削除
		if(isset($_POST['deleteRoom'])) {

			$roomId = selectMysql('buildings', 'room_id', $dbh, $_SESSION['building_id']);
			$roomId_block = explode(' ', $roomId);

			$j = 0;
			foreach($roomId_block as $id) {
				if($_POST['roomDelete'.$j] == 'check') {
					$mysql = 'delete from rooms where id = ' . $roomId_block[$j];
					$stmt = $dbh->prepare($mysql);
					$stmt->execute();
					unset($roomId_block[$j]);
				}
				$j++;
			}

			foreach($roomId_block as $id) {
				if(empty($roomsDeleCheck)) {
					$roomIdUpdate .= $id;
					$roomsDeleCheck = True;
				} else {
					$roomIdUpdate .= ' ' . $id;
				}
			}

			updateMysql('buildings', 'room_id', $roomIdUpdate, $dbh, $_SESSION['building_id']);

			$deleteUpdateRoom = True;
		}

	} else {
		setToken();
	}

/*ここまで部屋情報の更新処理*/



/*ここから現在の部屋情報を取得*/

	//建物名
	$buildingName = selectMysql('buildings', 'building_name', $dbh, $_SESSION['building_id']);

	//ホームページURL
	$file_name = selectMysql('buildings', 'file_name', $dbh, $_SESSION['building_id']);


	//部屋情報
	$roomId = selectMysql('buildings', 'room_id', $dbh, $_SESSION['building_id']);
	if(!empty($roomId)) {
		$roomId_block = explode(' ', $roomId);
		foreach($roomId_block as $id) {
			array_push($roomNum, selectMysql('rooms', 'number', $dbh, $id));
			array_push($roomPublic, selectMysql('rooms', 'public', $dbh, $id));
			array_push($roomRent, selectMysql('rooms', 'rent', $dbh, $id));
			$feeData = selectMysql('rooms', 'fee', $dbh, $id);
			$fees = [];
			$feeValue = 0;
			$feeDatas = explode('&', $feeData);
			foreach($feeDatas as $fee) {
				$feeValue += $fee;
			}
			array_push($roomFee, $feeValue);
			array_push($roomFloor, selectMysql('rooms', 'floor', $dbh, $id));
			array_push($roomArea, selectMysql('rooms', 'area', $dbh, $id));
			array_push($roomCurrent, selectMysql('rooms', 'current', $dbh, $id));
		}

		for($i = 0; $i < count($roomFloor); $i++) {
			list($roomFloor1[$i], $roomFloor2[$i]) = explode('&&', $roomFloor[$i]);
		}
	}

/*ここまで現在の部屋情報を取得*/

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
	<link rel="stylesheet" href="./../../../Configuration/Function/style.css">
	<link rel="stylesheet" href="./../../../Configuration/Function/edit.style.css">
	<?php include_once(dirname(__FILE__) . "/../../../Configuration/Config/analyticstracking.php") ?>
</head>
<body>

	<?php if(empty($_SESSION['userUrl'])): ?>

		<?php include(dirname(__FILE__) . '/../../../Configuration/Frames/login.php'); ?>

	<?php elseif(isset($_SESSION['userUrl'])): ?>

		<div class="wrapper">

		<?php include(dirname(__FILE__) . '/../../../Configuration/Frames/header.php'); ?>

		<?php include(dirname(__FILE__) . '/edit.php'); ?>
		
		</div>

	<?php endif; ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="./../../../Configuration/Function/script.js"></script>
</body>
</html>