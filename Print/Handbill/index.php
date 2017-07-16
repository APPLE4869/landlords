<?php 

session_start();

require_once(dirname(__FILE__) . '/../../Configuration/Config/database.php');
require_once(dirname(__FILE__) . '/../../Configuration/Config/config.php');
require_once(dirname(__FILE__) . '/../../Configuration/Config/login.php');
require_once(dirname(__FILE__) . '/data.php');

include(dirname(__FILE__) . '/controller.php');

if(isset($_SESSION['userUrl'])) {

	include(dirname(__FILE__) . '/controller.php');

} else {
	header('location: http://groups.sub.jp/Landlords/Ownership/Top/');
	exit();
}

/*
$facilityImagesJS = json_encode($facilityImages_block, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
*/
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
	<?php include(dirname(__FILE__) . '/../design/' . $designs[$frameNum]); ?>
	<link rel="stylesheet" href="./../../Configuration/Function/style.css">
	<link rel="stylesheet" href="./../../Configuration/Function/print.style.css">
	<?php include_once(dirname(__FILE__) . "/../../Configuration/Config/analyticstracking.php") ?>
</head>
<body>

	<?php if(empty($_SESSION['userUrl'])): ?>

		<?php include(dirname(__FILE__) . '/../../Configuration/Frames/login.php'); ?>

	<?php elseif(isset($_SESSION['userUrl'])): ?>

		<div class="wrapper">

		<?php include(dirname(__FILE__) . '/../../Configuration/Frames/header.php'); ?>

		<?php include(dirname(__FILE__) . '/edit.php'); ?>
		
		</div>

	<?php endif; ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script>
		var userUrl = <?= $userUrl ?>;
	</script>
	<script type="text/javascript" src="./../../Configuration/Function/script.js"></script>
	<script type="text/javascript" src="./../../Configuration/Function/print.script.js"></script>
</body>
</html>