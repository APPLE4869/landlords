<?php 

session_start();

require_once(dirname(__FILE__) . '/../../../Configuration/Config/database.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/config.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/login.php');

buildingCheck();

if(isset($_SESSION['userUrl'])) {

/*ここから周辺情報の更新処理*/

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token'])) {
		checkToken();

	   if(isset($_POST['description'])) {
			updateMysql('buildings', 'location_explain', $_POST['description'], $dbh, $_SESSION['building_id']);

			$update = True;
		}

		if(isset($_POST['locationDelete'])) {
			updateMysql('buildings', 'location'.$_POST['locationDelete'], NULL, $dbh, $_SESSION['building_id']);
			$delete = True;
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

	//周辺情報説明
	$locationExplain = selectMysql('buildings', 'location_explain', $dbh, $_SESSION['building_id']);
	

	//周辺施設情報
	for($i = 1; $i <= 15; $i++) {
		$j = $i - 1;
		$locations[$j] = selectMysql('buildings', 'location' . $i, $dbh, $_SESSION['building_id']);
		if (isset($locations[$j])) {
			list($images_block[$j], $titles_block[$j], $times_block[$j], $address_block[$j], $explain_block[$j], $lat_block[$j], $lng_block[$j], $icon_block[$j]) = explode('{&}', $locations[$j]);
		}
		if (isset($address_block[$j])) {
			list($pref, $addr1, $addr2) = explode('/', $address_block[$j]);
			$address_block[$j] = $pref . $addr1 . $addr2;
		}
	}

	$icon = [
		'mapicons01-031.png','mapicons01-032.png','mapicons01-033.png','mapicons01-034.png','mapicons01-035.png','mapicons01-036.png','mapicons01-037.png','mapicons01-038.png','mapicons01-039.png','mapicons01-040.png','mapicons01-041.png','mapicons01-042.png','mapicons01-043.png','mapicons01-044.png','mapicons01-045.png','mapicons01-046.png','mapicons01-047.png','mapicons01-048.png','mapicons01-049.png','mapicons01-050.png','mapicons01-051.png','mapicons01-052.png','mapicons01-056.png','mapicons01-058.png','mapicons01-059.png','mapicons01-060.png','mapicons01-062.png','mapicons01-063.png','mapicons01-066.png','mapicons01-067.png','mapicons01-069.png'
	];

	if (isset($icon_block)) {
		for($i = 0; $i < count($icon_block); $i++) {
			if($icon_block[$i] !== '') {
				$num = (int)$icon_block[$i];
				$locationIcons[$i] = $icon[$num];
			} else {
				$locationIcons[$i] = '';
			}
		}
	}


	//保存画像データ
	$dir = './../../../../MyHome/Landlord/' . $_SESSION['userUrl'] . '/images/';
	$dh = opendir($dir);

	$imageFiles = [];
	while($file_path = readdir($dh)) {
		if($file_path != '.' && $file_path != '..') {
			array_push($imageFiles, $file_path);
		}
	}
	closedir($dh);

/*ここまで現在の周辺情報を取得*/

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
	<script type="text/javascript" src="./../../../Configuration/Function/picture.script.js"></script>
	<script type="text/javascript" src="./../../../Configuration/Function/script.js"></script>
</body>
</html>