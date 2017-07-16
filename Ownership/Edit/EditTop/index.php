<?php 

session_start();

require_once(dirname(__FILE__) . '/../../../Configuration/Config/database.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/config.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/login.php');

buildingCheck();

if(isset($_SESSION['userUrl'])) {

/*ここからトップページ情報の更新処理*/

	if(isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['token'])) {

		//建物説明更新AREA
		if(isset($_POST['header-text'])) {
			updateMysql('buildings', 'header_text', h($_POST['header-text']), $dbh, $_SESSION['building_id']);
			$updateText = True;
		}

		//大家さんの自己紹介更新AREA
		if(isset($_POST['myInfo'])) {
			updateMysql('buildings', 'myInfo', h($_POST['myInfo']), $dbh, $_SESSION['building_id']);
			updateMysql('buildings', 'blog_url', $_POST['blogUrl'], $dbh, $_SESSION['building_id']);
			$updateMyInfo = True;
		}

		//Youtube動画更新AREA
		if(isset($_POST['youtube'])) {
			updateMysql('buildings', 'youtube', $_POST['youtube'], $dbh, $_SESSION['building_id']);
			$updateYoutube = True;
		}

		if (isset($_POST['miImage'])) {

			if (!empty($_FILES['file6']['name'])) {
				$file_name = new splFileInfo($_FILES['file6']['name']);
				$extension = $file_name->getExtension();
				try{
					if(is_uploaded_file($_FILES['file6']['tmp_name']) && ($extension == 'png' || $extension == 'jpg' || $extension == 'gif' || $extension == 'jpeg' ||  $extension == 'bmp'  || $extension == 'tiff' || $extension == 'PNG' || $extension == 'JPG' || $extension == 'GIF' || $extension == 'JPEG' || $extension == 'BMP' || $extension == 'TIFF')) {
						move_uploaded_file($_FILES['file6']['tmp_name'], './../../../../MyHome/Landlord/' . $_SESSION['userUrl'] . '/images/' . $_FILES['file6']['name']);
						updateMysql('buildings', 'myinfo_image', $_FILES['file6']['name'], $dbh, $_SESSION['building_id']);
						$topImgCheck = true;

					}
				} catch(Exception $e) {
					echo 'ERROR:', $e->getMessage().PHP_EOL;
				}
				if (!$topImgCheck) {
					$errors['topImage'] = '画像変更に失敗しました！';
				}
			}

		}

		if(isset($_POST['topImages'])) {
			$images = selectMysql('buildings', 'top_images', $dbh, $_SESSION['building_id']);
			$images_block = explode(' ', $images);
			for ($i = 0; $i < 6; $i++) {
				if(!empty($_FILES['file' . $i]['name'])) {
					$file_name = new splFileInfo($_FILES['file' . $i]['name']);
					$extension = $file_name->getExtension();
					try{
						if(is_uploaded_file($_FILES['file' . $i]['tmp_name']) && ($extension == 'png' || $extension == 'jpg' || $extension == 'gif' || $extension == 'jpeg' ||  $extension == 'bmp'  || $extension == 'tiff' || $extension == 'PNG' || $extension == 'JPG' || $extension == 'GIF' || $extension == 'JPEG' || $extension == 'BMP' || $extension == 'TIFF')) {
							move_uploaded_file($_FILES['file' . $i]['tmp_name'], './../../../../MyHome/Landlord/' . $_SESSION['userUrl'] . '/images/' . $_FILES['file' . $i]['name']);
							$images_block[$i] = $_FILES['file' . $i]['name'];
							$topImgCheck = true;
						}
					} catch(Exception $e) {
						echo 'ERROR:', $e->getMessage().PHP_EOL;
					}
				}
			}
			if (isset($topImgCheck)) {
				foreach($images_block as $image) {
					if(empty($imageSet)) {
						$imageUpdate .= $image;
						$imageSet = True;
					} else {
						$imageUpdate .= ' ' . $image;
					}
				}
				updateMysql('buildings', 'top_images', $imageUpdate, $dbh, $_SESSION['building_id']);
				$updateImage = True;
			}

			if (!isset($updateImage)) {
				$errors['topImage'] = '画像変更に失敗しました！';
			}
		}

		if (isset($_POST['imgId'])) {

			$imgId = $_POST['imgId'];

			if ($imgId < 6) {
				$images = selectMysql('buildings', 'top_images', $dbh, $_SESSION['building_id']);
				$images_block = explode(' ', $images);
				unset($images_block[$imgId]);
				foreach($images_block as $image) {
					if(empty($imageSet)) {
						$imageUpdate .= $image;
						$imageSet = True;
					} else {
						$imageUpdate .= ' ' . $image;
					}
				}
				updateMysql('buildings', 'top_images', $imageUpdate, $dbh, $_SESSION['building_id']);
				$deleteImage = True;
			}

			if ($imgId == 6) {
				updateMysql('buildings', 'myinfo_image', null, $dbh, $_SESSION['building_id']);
				$deleteImage = True;
			}
		}

	} else {
		setToken();
	}

/*ここまでトップページ情報の更新処理*/



/*ここから現在のトップページ情報を取得*/

	$images_block = [];

	$mysql = 'select * from buildings where id = :id';
	$stmt = $dbh->prepare($mysql);
	$stmt->bindValue(':id', $_SESSION['building_id'], PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetch();
	$buildingName = $result['building_name']; //建物名
	$file_name = $result['file_name']; //ホームページURL
	$images = $result['top_images'];
	$images_block = explode(' ', $images); //スライド写真
	$text = $result['header_text']; //建物イメージ説明
	$myInfo = $result['myInfo']; //大家さんの自己紹介
	$images_block[6] = $result['myinfo_image']; //大家さん写真
	$blogUrl = $result['blog_url']; //誘導ブログURL
	$youtube = $result['youtube']; //Youtube動画
	$notices = $result['notices']; //お知らせ


/*ここまで現在のトップページ情報を取得*/

}

$imagesJS = json_encode($images_block, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
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
		var imagesJS = <?= $imagesJS; ?>;
		var userUrl = <?= $userUrl; ?>;

	$(function () {
		'use strict';

		for (var i = 0; i < 6; i++) {
			if (imagesJS[i]) {
				$('.top-image-column-inner').eq(i).css('background-image', 'url("./../../../../MyHome/Landlord/' + userUrl + '/images/' + imagesJS[i] + '")');
			} else {
				$('.top-image-column-inner').eq(i).css('background-image', 'url("../../../Configuration/images/sample.gif")');
			}
		}

	});

	</script>
	<script type="text/javascript" src="./../../../Configuration/Function/picture.script.js"></script>
	<script type="text/javascript" src="./../../../Configuration/Function/script.js"></script>
</body>
</html>