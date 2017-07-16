<?php 

session_start();

//require_once(dirname(__FILE__) . '/../Configuration/Config/database.php');
require_once(dirname(__FILE__) . '/../Configuration/Config/config.php');
require_once(dirname(__FILE__) . '/Controller/controller.php');
require_once(dirname(__FILE__) . '/Model/model.php');


if(isset($_SESSION['userUrl'])) {

	

} else {
	//header('location: http://groups.sub.jp/Landlords/Ownership/Top/');
	//exit();
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
	<link rel="stylesheet" href="./../Configuration/Function/style.css">
	<link rel="stylesheet" href="./../Configuration/Function/pmaker.style.css">
	<?php include_once(dirname(__FILE__) . "/../Configuration/Config/analyticstracking.php") ?>
</head>
<body>

		<div class="wrapper">

		<?php include(dirname(__FILE__) . '/../Configuration/Frames/header.php'); ?>

		<?php include(dirname(__FILE__) . '/View/view.php'); ?>
		
		</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="./../Configuration/Function/pmaker.script.js"></script>
</body>
</html>