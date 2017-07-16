<?php 

session_start();

require_once(dirname(__FILE__) . '/../../../Configuration/Config/database.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/config.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/login.php');

buildingCheck();

if(isset($_SESSION['userUrl'])) {

/*ここから建物情報の更新処理*/

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token'])) {
		checkToken();

		if(isset($_FILES['file0']['name'])) {

			$file_name = new splFileInfo($_FILES['file0']['name']);
			$extension = $file_name->getExtension();
			try{
				if(is_uploaded_file($_FILES['file0']['tmp_name']) && ($extension == 'png' || $extension == 'jpg' || $extension == 'gif' || $extension == 'jpeg' ||  $extension == 'bmp'  || $extension == 'tiff' || $extension == 'PNG' || $extension == 'JPG' || $extension == 'GIF' || $extension == 'JPEG' || $extension == 'BMP' || $extension == 'TIFF')) {
					move_uploaded_file($_FILES['file0']['tmp_name'], './../../../../MyHome/Landlord/' . $_SESSION['userUrl'] . '/images/' . $_FILES['file0']['name']);
					updateMysql('buildings', 'appearance1', $_FILES['file0']['name'], $dbh, $_SESSION['building_id']);
					$imageUpdate = true;

				}
			} catch(Exception $e) {
				echo 'ERROR:', $e->getMessage().PHP_EOL;
			}
			if (!$imageUpdate) {
				$errors['topImage'] = '画像変更に失敗しました！';
			}

		}

		if(isset($_FILES['file1']['name'])) {

			$file_name = new splFileInfo($_FILES['file1']['name']);
			$extension = $file_name->getExtension();
			try{
				if(is_uploaded_file($_FILES['file1']['tmp_name']) && ($extension == 'png' || $extension == 'jpg' || $extension == 'gif' || $extension == 'jpeg' ||  $extension == 'bmp'  || $extension == 'tiff' || $extension == 'PNG' || $extension == 'JPG' || $extension == 'GIF' || $extension == 'JPEG' || $extension == 'BMP' || $extension == 'TIFF')) {
					move_uploaded_file($_FILES['file1']['tmp_name'], './../../../../MyHome/Landlord/' . $_SESSION['userUrl'] . '/images/' . $_FILES['file1']['name']);
					updateMysql('buildings', 'appearance2', $_FILES['file1']['name'], $dbh, $_SESSION['building_id']);
					$imageUpdate = true;

				}
			} catch(Exception $e) {
				echo 'ERROR:', $e->getMessage().PHP_EOL;
			}
			if (!$imageUpdate) {
				$errors['topImage'] = '画像変更に失敗しました！';
			}
			
		}

		if(isset($_POST['facilitysSet'])) {
			
			$facilityTexts = selectMysql('buildings', 'facility_texts', $dbh, $_SESSION['building_id']);
			$facilityTexts_block = explode('&&', $facilityTexts);

			$facilityExplains = selectMysql('buildings', 'facility_explain', $dbh, $_SESSION['building_id']);
			$facilityExplains_block = explode('&&', $facilityExplains);

			for($i = 0; $i < 12; $i++) {
				$facilityTexts_block[$i] = $_POST['facilityTexts'.$i];
				$facilityExplains_block[$i] = $_POST['facilityExplains'.$i];
			}
			foreach($facilityTexts_block as $block) {
				if(empty($facilityTextsSet)) {
					$facilityTextsUpdate .= $block;
					$facilityTextsSet = True;
				} else {
					$facilityTextsUpdate .= '&&' . $block;
				}
			}
			foreach($facilityExplains_block as $block) {
				if(empty($facilityExplainsSet)) {
					$facilityExplainsUpdate .= $block;
					$facilityExplainsSet = True;
				} else {
					$facilityExplainsUpdate .= '&&' . $block;
				}
			}

			updateMysql('buildings', 'facility_texts', $facilityTextsUpdate, $dbh, $_SESSION['building_id']);
			updateMysql('buildings', 'facility_explain', $facilityExplainsUpdate, $dbh, $_SESSION['building_id']);

			$updateText = True;

			for ($i = 2; $i < 14; $i++) {
				if (!empty($_FILES['file'.$i]['name'])) {

					$facilityImages = selectMysql('buildings', 'facility_images', $dbh, $_SESSION['building_id']);
					$facilityImages_block = explode(' ', $facilityImages);

					$file_name = new splFileInfo($_FILES['file' . $i]['name']);
					$extension = $file_name->getExtension();
					
					try{
						if(is_uploaded_file($_FILES['file'.$i]['tmp_name']) && ($extension == 'png' || $extension == 'jpg' || $extension == 'gif' || $extension == 'jpeg' ||  $extension == 'bmp'  || $extension == 'tiff' || $extension == 'PNG' || $extension == 'JPG' || $extension == 'GIF' || $extension == 'JPEG' || $extension == 'BMP' || $extension == 'TIFF')) {
							move_uploaded_file($_FILES['file'.$i]['tmp_name'], './../../../../MyHome/Landlord/' . $_SESSION['userUrl'] . '/images/' . $_FILES['file'.$i]['name']);
							$facilityImages_block[$i - 2] = $_FILES['file'.$i]['name'];
							$fcImgUpdate = true;
						}
					} catch(Exception $e) {
						echo 'ERROR:', $e->getMessage().PHP_EOL;
					}
				}
			}

			if (isset($fcImgUpdate)) {
				foreach($facilityImages_block as $block) {
					if(empty($imageSet)) {
						$imageUpdate .= $block;
						$imageSet = True;
					} else {
						$imageUpdate .= ' ' . $block;
					}
				}
				updateMysql('buildings', 'facility_images', $imageUpdate, $dbh, $_SESSION['building_id']);

				$updateImage = True;
			}
		}

		if (isset($_POST['imgId'])) {

			$imgId = $_POST['imgId'];

			if ($imgId == 'first') {
				updateMysql('buildings', 'appearance1', null, $dbh, $_SESSION['building_id']);
			}

			if ($imgId == 'second') {
				updateMysql('buildings', 'appearance2', null, $dbh, $_SESSION['building_id']);
			}

			if ($imgId < 13) {
				$facilityImages = selectMysql('buildings', 'facility_images', $dbh, $_SESSION['building_id']);
				$facilityImages_block = explode(' ', $facilityImages);
				unset($facilityImages_block[$imgId]);
				foreach($facilityImages_block as $image) {
					if(empty($imageSet)) {
						$imageUpdate .= $image;
						$imageSet = True;
					} else {
						$imageUpdate .= ' ' . $image;
					}
				}
				updateMysql('buildings', 'facility_images', $imageUpdate, $dbh, $_SESSION['building_id']);
			}

			$deleteImage = True;
		}


	} else {
		setToken();
	}

/*ここまで建物情報の更新処理*/



/*ここから現在の建物情報の取得*/

	//建物名
	$buildingName = selectMysql('buildings', 'building_name', $dbh, $_SESSION['building_id']);

	//ホームページURL
	$file_name = selectMysql('buildings', 'file_name', $dbh, $_SESSION['building_id']);

	//外観写真1
	$appearance1 = selectMysql('buildings', 'appearance1', $dbh, $_SESSION['building_id']);

	//外観写真2
	$appearance2 = selectMysql('buildings', 'appearance2', $dbh, $_SESSION['building_id']);

	//物件設備写真
	$facilityImages = selectMysql('buildings', 'facility_images', $dbh, $_SESSION['building_id']);
	$facilityImages_block = explode(' ', $facilityImages);

	//物件設備名称
	$facilityTexts = selectMysql('buildings', 'facility_texts', $dbh, $_SESSION['building_id']);
	$facilityTexts_block = explode('&&', $facilityTexts);

	//物件設備説明
	$facilityExplains = selectMysql('buildings', 'facility_explain', $dbh, $_SESSION['building_id']);
	$facilityExplains_block = explode('&&', $facilityExplains);

/*ここまで現在の建物情報の取得*/

}

$appearance1JS = json_encode($appearance1, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
$appearance2JS = json_encode($appearance2, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
$facilityImagesJS = json_encode($facilityImages_block, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
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
	<script>
		var appearance1JS = <?= $appearance1JS ; ?>;
		var appearance2JS = <?= $appearance2JS ; ?>;
		var imagesJS = <?= $facilityImagesJS ; ?>;
		var userUrl = <?= $userUrl ; ?>;

	</script>
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