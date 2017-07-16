<?php 

session_start();

require_once(dirname(__FILE__) . '/../../Configuration/Config/database.php');
require_once(dirname(__FILE__) . '/../../Configuration/Config/config.php');
require_once(dirname(__FILE__) . '/../../Configuration/Config/login.php');

if(isset($_SESSION['userUrl'])) {

/* ここから本ページで使用する配列一覧 */

	$perTitle = [];
	$hadBuilding = [];

/* ここまで本ページで使用する配列一覧 */



	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token'])) {
		checkToken();

		if(preg_match('/^[a-zA-Z0-9]+$/', $_POST['url']) && isset($_POST['buildingsName'])) {

			//同じURLがすでにあるかのチェック
			$urlCheck = True; 
			$hasDirs = scandir('../../../MyHome/Landlord/' . $_SESSION['userUrl'] . '/');
			foreach($hasDirs as $dir) {
				if($dir == $_POST['url']) {
					$urlCheck = False; 
				}
			}

			//物件登録
			if($urlCheck) {
				$mysql = 'INSERT INTO buildings(building_name, file_name, user) VALUES (:building_name, :file_name, :user)';
				$stmt = $dbh->prepare($mysql);
				$params = array(
					':building_name' => $_POST['buildingsName'],
					':file_name' => $_POST['url'],
					':user' => $_SESSION['userUrl']
				);
				$stmt->execute($params);

				//FILE生成
				$mkFile = '../../../MyHome/Landlord/' . $_SESSION['userUrl'] . '/' . $_POST['url'] . '/';
				umask(0);
				$mkdirs = ['', 'building', 'campaign', 'contact', 'location', 'other', 'top', 'room', 'roomlist'];
				foreach($mkdirs as $mkdir) { 
					mkdir($mkFile . $mkdir, 0777);
					umask(0);
				}
		
				foreach($mkdirs as $mkdir) {
					$copyFile = '../../../MyHome/model/' . $mkdir . '/index.php';
					$mkFile = '../../../MyHome/Landlord/' . $_SESSION['userUrl'] . '/' . $_POST['url'] . '/' . $mkdir . '/index.php';
					copy($copyFile, $mkFile);
					umask(0);
				}

				$mysql = 'select id from empty_room where building = \'' . $_POST['url'] . '\'';
				$stmt = $dbh->prepare($mysql);
				$stmt->execute();
				$result = $stmt->fetchAll();
				updateMysql('buildings', 'file_name', $_POST['url'], $dbh, $result[0][0]);

				$reg_ok = True;
			}

		} else {

			$urlFomat = True;

		}

	} else {
	
		setToken();

	}

	$perTitle = [];
	$hadBuilding = [];

	$mysql = 'select id from buildings where user = \'' . $_SESSION['userUrl'] . '\'';
	$stmt = $dbh->prepare($mysql);
	$stmt->execute();
	$result = $stmt->fetchAll();

	$buildingNum = count($result);

	for($i = 0; $i < $buildingNum; $i++) {
		array_push($hadBuilding, $result[$i]['id']);
		array_push($perTitle, selectMysql('buildings', 'building_name', $dbh, $result[$i]['id']));
	}

}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Wonder Homes管理者</title>
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

		<?php include(dirname(__FILE__) . '/registration.php'); ?>
		
		</div>

	<?php endif; ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="//jpostal-1006.appspot.com/jquery.jpostal.js"></script>
	<script type="text/javascript" src="./../../Configuration/Function/script.js"></script>
</body>
</html>