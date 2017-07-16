<?php 

session_start();

require_once(dirname(__FILE__) . '/../../../Configuration/Config/database.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/config.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/login.php');



if(isset($_SESSION['userUrl'])) {

/*ここから画像アップロード処理*/

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token'])) {
		checkToken();
		
		$imgNum = count($_FILES['file']['name']);
		$uploadSucNum = 0;

		if(isset($_FILES) && $imgNum <= 20) {
			for($i = 0; $i < $imgNum; $i++) {
				$file_name = new splFileInfo($_FILES['file']['name'][$i]);
				$extension = $file_name->getExtension();
				try{
					if(is_uploaded_file($_FILES['file']['tmp_name'][$i]) && ($extension == 'png' || $extension == 'jpg' || $extension == 'gif' || $extension == 'jpeg' ||  $extension == 'bmp'  || $extension == 'tiff' || $extension == 'PNG' || $extension == 'JPG' || $extension == 'GIF' || $extension == 'JPEG' || $extension == 'BMP' || $extension == 'TIFF')) {
						if(move_uploaded_file($_FILES['file']['tmp_name'][$i], './../../../../MyHome/Landlord/' . $_SESSION['userUrl'] . '/images/' . $_FILES['file']['name'][$i])) {
							$uploadSucNum += 1;
						}
					}
				} catch(Exception $e) {
					echo 'ERROR:', $e->getMessage().PHP_EOL;
				}
			}

			$errorMsgs = [
				'アップロードに成功しました！', 'アップロードに失敗しました', '20枚のアップロードに成功しました！', 'すべてのアップロードに成功しました！', 'つの画像のアップロードに失敗しました', 'エラーが発生しました'
			];

			//エラーメッセージ
			if($imgNum == 1) {
				if($uploadSucNum == 1) {
					$errorMsg = $errorMsgs[0];
					$errorMsgColor = 'upload-result-suc';
				} else {
					$errorMsg = $errorMsgs[1];
					$errorMsgColor = 'upload-result-fal';
				}
			} elseif($imgNum > 1) {
				if($uploadSucNum === 20) {
					$errorMsg = $errorMsgs[2];
					$errorMsgColor = 'upload-result-suc';
				} elseif($uploadSucNum === $imgNum) {
					$errorMsg = $errorMsgs[3];
					$errorMsgColor = 'upload-result-suc';
				} else {
					$missImg = $imgNum - $uploadSucNum;
					$errorMsg = $missImg . $errorMsgs[4];
					$errorMsgColor = 'upload-result-fal';
				}
			} else {
				$errorMsg = $errorMsgs[5];
				$errorMsgColor = 'upload-result-fal';
			}
		} elseif(isset($_FILES)) {
			$errorMsg = 'アップロードは最大20ファイルまでです';
			$errorMsgColor = 'upload-result-fal';
		}



		if($_POST['deleteImg']) {
			if(unlink('./../../../../MyHome/Landlord/' . $_SESSION['userUrl'] . '/images/' . $_POST['deleteImg'])) {
				$errorMsg = '画像を削除しました！';
				$errorMsgColor = 'upload-result-suc';
			} else {
				$errorMsg = '画像削除に失敗しました';
				$errorMsgColor = 'upload-result-fal';
			}
		}

	} else {
		setToken();
	}
	
/*ここから画像アップロード処理*/



/*ここから現在のページ情報を取得*/

	//建物名
	$buildingName = selectMysql('buildings', 'building_name', $dbh, $_SESSION['building_id']);

	//ホームページURL
	$file_name = selectMysql('buildings', 'file_name', $dbh, $_SESSION['building_id']);


	//保存画像データ
	$dir = './../../../../MyHome/Landlord/' . $_SESSION['userUrl'] . '/images/';
	$dh = opendir($dir);

	$imageFiles = [];
	while($file_path = readdir($dh)) {
		if($file_path != '.' && $file_path != '..') {
			array_push($imageFiles, $file_path);
		}
	}
	closedir($dh);

/*ここまで現在のページ情報を取得*/

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
		var userUrl = <?= json_encode($_SESSION['userUrl'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>

		var imgs = <?= json_encode($imageFiles, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>
	</script>
	<script type="text/javascript" src="./../../../Configuration/Function/script.js"></script>
</body>
</html>