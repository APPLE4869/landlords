<?php

session_start();

require_once(dirname(__FILE__) . '/../../../Configuration/Config/database.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/config.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/login.php');

buildingCheck();

if(isset($_SESSION['userUrl'])) {

	$lNum = h($_GET['id']);

/*ここから周辺情報の更新処理*/

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token'])) {
		checkToken();

		//現在の周辺施設情報を取得
		$locationsData = selectMysql('buildings', 'location' . $lNum, $dbh, $_SESSION['building_id']);
		if (isset($locationsData)) {
			list($image, $title, $time, $address, $explain, $lat, $lng, $icon) = explode('{&}', $locationsData);
		}

		if (!empty($_FILES['file']['name'])) {
			$file_name = new splFileInfo($_FILES['file']['name']);
			$extension = $file_name->getExtension();
			try{
				if(is_uploaded_file($_FILES['file']['tmp_name']) && ($extension == 'png' || $extension == 'jpg' || $extension == 'gif' || $extension == 'jpeg' ||  $extension == 'bmp'  || $extension == 'tiff' || $extension == 'PNG' || $extension == 'JPG' || $extension == 'GIF' || $extension == 'JPEG' || $extension == 'BMP' || $extension == 'TIFF')) {
					$storeFildName = date('Ymdhis').$_SESSION['building_id'].'.jpg';
					move_uploaded_file($_FILES['file']['tmp_name'], './../../../../MyHome/Landlord/' . $_SESSION['userUrl'] . '/images/' . $storeFildName);
					$image = $storeFildName;
					$imgCheck = true;

				}
			} catch(Exception $e) {
				echo 'ERROR:', $e->getMessage().PHP_EOL;
			}
			if (!$imgCheck) {
				$errors['topImage'] = '画像変更に失敗しました！';
			}
		}

		//写真以外の情報更新
	   if(isset($_POST['title']) && isset($_POST['time']) && isset($_POST['explain']) && isset($_POST['pref']) && isset($_POST['addr1']) && isset($_POST['addr2']) && isset($_POST['lat']) && isset($_POST['lng']) && isset($_POST['locationDetail-icon'])) {
	   		$address = $_POST['pref'] . '/' . $_POST['addr1'] . '/' . $_POST['addr2'];
			$locationDUpdate = $image . '{&}' . $_POST['title'] . '{&}' . $_POST['time'] . '{&}' . $address . '{&}' . $_POST['explain'] . '{&}' . $_POST['lat'] . '{&}' . $_POST['lng'] . '{&}' . $_POST['locationDetail-icon'];
			updateMysql('buildings', 'location' . $lNum, $locationDUpdate, $dbh, $_SESSION['building_id']);
		}

		if (!empty($_POST['imgId'])) {
			$image = '';
			$locationDUpdate = $image . '{&}' . $title . '{&}' . $time . '{&}' . $address . '{&}' . $explain . '{&}' . $lat . '{&}' . $lng . '{&}' . $icon;
			updateMysql('buildings', 'location' . $lNum, $locationDUpdate, $dbh, $_SESSION['building_id']);

			$deleteImage = true;
		}


	} else {
		setToken();
	}

/*ここまで周辺情報の更新処理*/



/*ここから現在の周辺情報を取得*/

	//建物名
	$buildingName = selectMysql('buildings', 'building_name', $dbh, $_SESSION['building_id']);

	//ホームページURL
	$file_name = selectMysql('buildings', 'file_name', $dbh, $_SESSION['building_id']);

	//現在の周辺施設情報を取得
	$locationsData = selectMysql('buildings', 'location' . $lNum, $dbh, $_SESSION['building_id']);
	if (!empty($locationsData)) {
		list($image, $title, $time, $address, $explain, $lat, $lng, $icon) = explode('{&}', $locationsData);
		list($pref, $addr1, $addr2) = explode('/', $address);
	}

	$icons = [
		'映画館', 'タクシー', 'バス停', '駐輪場', 'バック', 'トイレ', 'カフェ', 'カクテル', '飛行機', '駅', '病院', 'タバコ', '駐車場', 'ゴルフ', 'ガソリンスタンド', 'ファミレス', '花', '葉', 'コアラ', 'イノシシ', '図書館', '博物館', '老人ホーム', '星', 'ハート', 'ピン(赤)', 'ピン(青)', 'ピン(緑)', 'ピン(紫)', 'ピン(黄)'
	];

}

if (isset($image)) {
	$imageJS = json_encode($image, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
}
$userUrl = json_encode($_SESSION['userUrl'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);


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
	<script>
		var imageJS = <?= $imageJS; ?>;
		var userUrl = <?= $userUrl; ?>;
	</script>
	<script type="text/javascript" src="./../../../Configuration/Function/picture.script.js"></script>
	<script type="text/javascript" src="./../../../Configuration/Function/script.js"></script>
	<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
	<script src="http://maps.google.com/maps/api/js?" type="text/javascript" charset="utf-8"></script>
	<script src="./../../../Configuration/Function/maping.js"></script>
</body>
</html>