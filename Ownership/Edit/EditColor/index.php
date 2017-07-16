<?php 

session_start();

require_once(dirname(__FILE__) . '/../../../Configuration/Config/database.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/config.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/login.php');

buildingCheck();

if(isset($_SESSION['userUrl'])) {

/*ここからイメージカラー情報の更新処理*/

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token'])) {
		checkToken();

		if(isset($_POST['imageColor'])) {

			updateMysql('buildings', 'image_color', $_POST['imageColor'], $dbh, $_SESSION['building_id']);
			$update = true;	
		}

	} else {
		setToken();
	}

/*ここまでイメージカラー情報の更新処理*/



/*ここから現在のイメージカラー情報を取得*/

	$url = [];
	$name = [];
	$code = [];
	$image = [];

	//建物名
	$buildingName = selectMysql('buildings', 'building_name', $dbh, $_SESSION['building_id']);

	//ホームページURL
	$file_name = selectMysql('buildings', 'file_name', $dbh, $_SESSION['building_id']);

	//イメージカラー
	$imageColor = selectMysql('buildings', 'image_color', $dbh, $_SESSION['building_id']);

	$imageColorsCollection = [
		'skyblue  スカイブルー  #00BFFF  skyblueImage.png', 
		'yellow  ゴールド  #ffd700  goldImage.png', 
		'red  スカーレッド  #91002C  redImage.png',
		'green  ライトグリーン  #00FCB0  lightImage.png',
		'black.red  ブラックmixレッド  rgb(28,1,19)  black&redImage.png',
		'darkgreen  ダークグリーン  rgb(27,103,107)  darkgreenImage.png',
		'gray.skyblue  グレイmixブルー  rgb(52,56,56)  gray&skyblueImage.png',
		'light.image  ライトイメージ  rgb(254,159,140)  lightImageImage.png',
		'purple  パープル  rgb(121,58,87)  purpleImage.png'
	];

	for ($i = 0; $i < count($imageColorsCollection); $i++) {
		list($url[$i], $name[$i], $code[$i], $image[$i]) = explode('  ', $imageColorsCollection[$i]);
	}

/*ここまで現在のイメージカラー情報を取得*/

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