<?php 

session_start();

require_once(dirname(__FILE__) . '/../../Configuration/Config/database.php');
require_once(dirname(__FILE__) . '/../../Configuration/Config/config.php');
require_once(dirname(__FILE__) . '/../../Configuration/Config/login.php');

if(isset($_SESSION['userUrl'])) {

/* ここから本ページで使用する配列一覧 */

	$hadBuilding = [];
	$perTitle = [];
	$perPetName = [];
	$perImage = [];
	$perAddress = [];
	$roomId_block = [];
	$perUnits = [];
	$public = [];
	$publicClass = [];

/* ここまで本ページで使用する配列一覧 */


/*ここから物件削除処理*/

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token']) && $_POST['buildingDelete']) {
		checkToken();

		//ディレクトリ削除関数
		function remove_directory($dir) {
		if ($handle = opendir("$dir")) {
			while (false !== ($item = readdir($handle))) {
				if ($item != "." && $item != "..") {
					if (is_dir("$dir/$item")) {
						remove_directory("$dir/$item");
					} else {
						unlink("$dir/$item");
					}
				}
			}
			closedir($handle);
			rmdir($dir);
			}
		}

		$delId = $_POST['buildingDelete'];

		$mysql_S = 'SELECT file_name FROM buildings WHERE id = :id';
		$stmt = $dbh->prepare($mysql_S);
		$stmt->bindValue(':id', $delId, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch();

		remove_directory("./../../../MyHome/Landlord/" . $_SESSION['userUrl'] . "/" . $result['file_name'] . "/");

		$mysql_D = 'DELETE FROM buildings WHERE id = :id';
		$stmt = $dbh->prepare($mysql_D);
		$stmt->bindValue(':id', $delId, PDO::PARAM_STR);
		$stmt->execute();

	} else {
		setToken();
	}
	
/*ここから物件削除処理*/



/*ここからログイン成功時のアカウント情報取得*/

	$mysql = 'select * from users where url = \'' . $_SESSION['userUrl'] . '\'';
	$stmt = $dbh->prepare($mysql);
	$stmt->execute();
	$result = $stmt->fetch();

	$group = $result['groups'];



	$mysql = 'select * from buildings where user = \'' . $_SESSION['userUrl'] . '\'';
	$stmt = $dbh->prepare($mysql);
	$stmt->execute();
	$result = $stmt->fetchAll();

	$buildingNum = count($result);

	if($group == '無料会員') {
		$buildingRegLock = ($buildingNum >= 2) ? 'true':'';
		$buildingNum = ($buildingNum > 2) ? 2 : $buildingNum;
	}

	for($i = 0; $i < $buildingNum; $i++) {

		array_push($hadBuilding, $result[$i]['id']);
		array_push($perTitle, selectMysql('buildings', 'building_name', $dbh, $result[$i]['id']));
		array_push($perPetName, selectMysql('buildings', 'pet_name', $dbh, $result[$i]['id']));

		$images = selectMysql('buildings', 'top_images', $dbh, $result[$i]['id']);
		$perImage[$i] = explode(' ', $images);

		$pref = selectMysql('buildings', 'pref', $dbh, $result[$i]['id']);
		$addr1 = selectMysql('buildings', 'addr1', $dbh, $result[$i]['id']);
		$addr2 = selectMysql('buildings', 'addr2', $dbh, $result[$i]['id']);
		$address = $pref . $addr1 . $addr2;
		array_push($perAddress, $address);
		
		$roomId = selectMysql('buildings', 'room_id', $dbh, $result[$i]['id']);
		$roomId_block = explode(' ', $roomId);
		$allUnits = count($roomId_block);
		$inUnits = 0;
		foreach($roomId_block as $block) {
			if(selectMysql('rooms', 'current', $dbh, $block) == '入居中') {
				$inUnits += 1;
			}
		}
		$units = $inUnits . '/' . $allUnits;
		array_push($perUnits, $units);

		$publicNum = selectMysql('buildings', 'page_public', $dbh, $result[$i]['id']);
		$public[$i] = ($publicNum == 0) ? '公開中': '非公開';
		$publicClass[$i] = ($publicNum == 0)?'Overview-public':'Overview-local';
	}

/*ここまでログイン成功時のアカウント情報取得*/

}

/*ここまでログイン成功時のアカウント情報取得*/

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

		<?php include(dirname(__FILE__) . '/top.php'); ?>
		
		</div>

	<?php endif; ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="./../../Configuration/Function/script.js"></script>
</body>
</html>