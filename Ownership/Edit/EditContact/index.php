<?php 

session_start();

require_once(dirname(__FILE__) . '/../../../Configuration/Config/database.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/config.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/login.php');

buildingCheck();

if(isset($_SESSION['userUrl'])) {

	$mysql = 'SELECT * FROM users WHERE url = \'' . $_SESSION['userUrl'] . '\'';
	$stmt = $dbh->prepare($mysql);
	$stmt->execute();
	$result = $stmt->fetch();

/*ここからお問い合わせ情報の更新処理*/

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token'])) {
		checkToken();

		$messageUpdate1 = str_replace('
', '{@}', $_POST['message1']);

		$messageUpdate2 = str_replace('
', '{@}', $_POST['message2']);

		updateMysql('buildings', 'contact_name', $_POST['name'], $dbh, $_SESSION['building_id']);
		updateMysql('buildings', 'contact_message1', $messageUpdate1, $dbh, $_SESSION['building_id']);
		updateMysql('buildings', 'contact_message2', $messageUpdate2, $dbh, $_SESSION['building_id']);
		
		$update = True;

	} else {
		setToken();
	}

/*ここまでお問い合わせ情報の更新処理*/

/*ここから現在のお問い合わせ情報を取得*/

	//建物名
	$buildingName = selectMysql('buildings', 'building_name', $dbh, $_SESSION['building_id']);

	//ホームページURL
	$file_name = selectMysql('buildings', 'file_name', $dbh, $_SESSION['building_id']);

	//お問い合わせ受け取り時の名前
	$name = selectMysql('buildings', 'contact_name', $dbh, $_SESSION['building_id']);

	//電話番号
	$phone = selectMysql('users', 'phone', $dbh, $result['id']);

	//メールアドレス(ログイン時のアドレスと同様)
	$mail = selectMysql('users', 'email', $dbh, $result['id']);

	//コメント1
	$message1 = selectMysql('buildings', 'contact_message1', $dbh, $_SESSION['building_id']);
	$message1 = str_replace('{@}', '
', h($message1)); //お問い合わせメッセージ1[表示]

	//コメント2
	$message2 = selectMysql('buildings', 'contact_message2', $dbh, $_SESSION['building_id']);
	$message2 = str_replace('{@}', '
', h($message2)); //お問い合わせメッセージ2[表示]

/*ここまで現在のお問い合わせ情報を取得*/

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