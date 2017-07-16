<?php 

session_start();

require_once(dirname(__FILE__) . '/../../../Configuration/Config/database.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/config.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/login.php');

buildingCheck();

if(isset($_SESSION['userUrl'])) {

/*ここからキャンペーン情報の更新処理*/

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token'])) {
		checkToken();

		if(isset($_POST['description'])) {
			$description = str_replace('
', '{NewLine}', $_POST['description']);

			updateMysql('buildings', 'campaign_texts', $description, $dbh, $_SESSION['building_id']);
			$updateText = True;
		}

		if (!empty($_FILES['file']['name'])) {
			$file_name = new splFileInfo($_FILES['file']['name']);
			$extension = $file_name->getExtension();
			try{
				if(is_uploaded_file($_FILES['file']['tmp_name']) && ($extension == 'png' || $extension == 'jpg' || $extension == 'gif' || $extension == 'jpeg' ||  $extension == 'bmp'  || $extension == 'tiff' || $extension == 'PNG' || $extension == 'JPG' || $extension == 'GIF' || $extension == 'JPEG' || $extension == 'BMP' || $extension == 'TIFF')) {
					move_uploaded_file($_FILES['file']['tmp_name'], './../../../../MyHome/Landlord/' . $_SESSION['userUrl'] . '/images/' . $_FILES['file']['name']);
					updateMysql('buildings', 'campaign_image', $_FILES['file']['name'], $dbh, $_SESSION['building_id']);
					$updateImage = True;

				}
			} catch(Exception $e) {
				echo 'ERROR:', $e->getMessage().PHP_EOL;
			}
			if (!$topImgCheck) {
				$errors['topImage'] = '画像変更に失敗しました！';
			}
		}

		if (isset($_POST['imgId'])) {
			updateMysql('buildings', 'campaign_image', null, $dbh, $_SESSION['building_id']);
			$deleteImage = True;
		}

	} else {
		setToken();
	}

/*ここからキャンペーン情報の更新処理*/



/*ここから現在のキャンペーン情報を取得*/

	//建物名
	$buildingName = selectMysql('buildings', 'building_name', $dbh, $_SESSION['building_id']);

	//ホームページURL
	$file_name = selectMysql('buildings', 'file_name', $dbh, $_SESSION['building_id']);

	//キャンペーン文章
	$comment = selectMysql('buildings', 'campaign_texts', $dbh, $_SESSION['building_id']);
	$comment = str_replace('{NewLine}', '
', $comment);


	//キャンペーンイメージ画像
	$image = selectMysql('buildings', 'campaign_image', $dbh, $_SESSION['building_id']);

/*ここから現在のキャンペーン情報を取得*/


$imageJS = json_encode($image, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
$userUrl = json_encode($_SESSION['userUrl'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);


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
	<script>
		var imageJS = <?= $imageJS ?>;
		var userUrl = <?= $userUrl ?>;
	</script>
	<script type="text/javascript" src="./../../../Configuration/Function/picture.script.js"></script>
	<script type="text/javascript" src="./../../../Configuration/Function/script.js"></script>
</body>
</html>