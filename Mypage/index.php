<?php 

session_start();

require_once(dirname(__FILE__) . '/../Configuration/Config/database.php');
require_once(dirname(__FILE__) . '/../Configuration/Config/config.php');
require_once(dirname(__FILE__) . '/../Configuration/Config/login.php');

if(isset($_SESSION['userUrl'])) {

	session_destroy();

	header('Location: http://groups.sub.jp/Landlords/Ownership/Top/');
	exit;

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token'])) {

		checkToken();

		if(isset($_POST['logout'])) {
			$conf = true;
		}

		if(isset($_POST['conf'])) {
			session_destroy();

			header('Location: http://groups.sub.jp/Landlords/Ownership/Top/');
			exit;
		}

	} else {
		setToken();
	}

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
	<link rel="stylesheet" href="./../Configuration/Function/style.css">
	<link rel="stylesheet" href="./../Configuration/Function/edit.style.css">
</head>
<body>

	<?php if(empty($_SESSION['userUrl'])): ?>

		<?php include(dirname(__FILE__) . '/../Configuration/Frames/login.php'); ?>

	<?php elseif(isset($_SESSION['userUrl'])): ?>

		<div class="wrapper">

		<?php include(dirname(__FILE__) . '/../Configuration/Frames/header.php'); ?>

		<?php include(dirname(__FILE__) . '/content.php'); ?>
		
		</div>

	<?php endif; ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="./../Configuration/Function/script.js"></script>
</body>
</html>