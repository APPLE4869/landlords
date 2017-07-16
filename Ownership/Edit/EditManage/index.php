<?php 

session_start();

require_once(dirname(__FILE__) . '/../../../Configuration/Config/database.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/config.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/login.php');

buildingCheck();

if(isset($_SESSION['userUrl'])) {


/* ここから物件の建物情報TableのIDをSESSIONに入れる */

	if (isset($_GET['id'])) {
		$getUserName = selectMysql('buildings', 'user', $dbh, h($_GET['id']));
	}

	if(isset($_GET['id']) && ($getUserName == $_SESSION['userUrl'])) {
		$_SESSION['building_id'] = h($_GET['id']);
	}

/* ここまで物件の建物情報TableのIDをSESSIONに入れる */



/*ここから現在のページの情報更新*/

	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		if(isset($_POST['publicChange'])) {

			if($_POST['type'] == 'page') {
				updateMysql('buildings', 'page_public', $_POST['publicChange'], $dbh, $_SESSION['building_id']);
			}

			if($_POST['type'] == 'campaign') {
				updateMysql('buildings', 'campaign_public', $_POST['publicChange'], $dbh, $_SESSION['building_id']);
			}

			if($_POST['type'] == 'location') {
				updateMysql('buildings', 'location_public', $_POST['publicChange'], $dbh, $_SESSION['building_id']);
			}
		}
	
	}

/*ここまで現在のページの情報更新*/



/*ここから取得したIDの情報を取得*/

	//建物名
	$buildingName = selectMysql('buildings', 'building_name', $dbh, $_SESSION['building_id']);

	//ホームページURL
	$file_name = selectMysql('buildings', 'file_name', $dbh, $_SESSION['building_id']);

	//ホームページ公開状況
	$pagePublic = selectMysql('buildings', 'page_public', $dbh, $_SESSION['building_id']);
	$pagePublicName = ($pagePublic == 0)? '公開':'非公開';
	$publicClass = ($pagePublic == 0)?'icon-blue eye-icon':'icon-red nonEye-icon';

	//キャンペーン公開状況
	$campaignPublic = selectMysql('buildings', 'campaign_public', $dbh, $_SESSION['building_id']);
	$campaignPublicName = ($campaignPublic == 0)? '表示中':'非表示';
	$campaignPublicClass = ($campaignPublic == 0)?'icon-blue eye-icon':'icon-red nonEye-icon';
	
	//周辺情報公開状況
	$locationPublic = selectMysql('buildings', 'location_public', $dbh, $_SESSION['building_id']);
	$locationPublicName = ($locationPublic == 0)? '表示中':'非表示';
	$locationPublicClass = ($locationPublic == 0)?'icon-blue eye-icon':'icon-red nonEye-icon';

/*ここまで取得したIDの情報を取得*/

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