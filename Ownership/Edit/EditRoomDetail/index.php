<?php 

session_start();

require_once(dirname(__FILE__) . '/../../../Configuration/Config/database.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/config.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/login.php');

buildingCheck();

if(isset($_SESSION['userUrl'])) {

/* ここから部屋情報TableのIDを変数に入れる */

	$roomdId_block = [];
	$roomId = selectMysql('buildings', 'room_id', $dbh, $_SESSION['building_id']);
	$roomId_block = explode(' ', $roomId);
	if(array_search($_GET['room'], $roomId_block) !== false) {
		$getRoomId = $_GET['room'];
	}

/* ここまで部屋情報TableのIDを変数に入れる */



/*ここから現在の部屋情報の更新処理*/

	//checkboxをInsertするために1つの変数に収納する関数
	function checkboxUpdate($num, $post, $partition) {
		for($i = 1; $i <= $num; $i++) {
			if(isset($_POST[$post . $i])) {
				if(empty($Set)) {
					$Update .= $_POST[$post . $i];
					$Set = True;
				} else {
					$Update .= $partition . $_POST[$post . $i];
				}
			}
		}
		return $Update;
	}


	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token'])) {

		checkToken();

		//上情報の更新
		if(isset($_POST['roomListSet'])) {

			$public = ($_POST['public'] == '公開する')? 1 : 0;
			$termsUpdate = checkboxUpdate(7, 'term', '/');
			$positionUpdate = checkboxUpdate(3, 'position', '/');
			$featureUpdate = checkboxUpdate(31, 'feature', '/');
			$receiptUpdate = checkboxUpdate(3, 'receipt', '/');
			$broadcastUpdate = checkboxUpdate(3, 'broadcast', '/');
			$securityUpdate = checkboxUpdate(7, 'security', '/');
			$privilegeUpdate = checkboxUpdate(4, 'privilege', '/');

			for($i = 1; $i <= 3; $i++) {
				if($_POST['feeMethod' . $i . '-1'] !== '') {
					if(empty($elseFee1Set)) {
						$elseFee1Update .= $_POST['feeMethod' . $i . '-1'];
						$elseFee1Set = True;
					} else {
						$elseFee1Update .= '&' . $_POST['feeMethod' . $i . '-1'];
					}
				}

				if($_POST['feeMoney' . $i . '-2'] !== '') {
					if(empty($elseFee2Set)) {
						$elseFee2Update .= $_POST['feeMoney' . $i . '-2'];
						$elseFee2Set = True;
					} else {
						$elseFee2Update .= '&' . $_POST['feeMoney' . $i . '-2'];
					}
				}
			}

			for($i = 1; $i <= 10; $i++) {
				if($_POST['roomDetail' . $i . '-1'] !== '') {
					if(empty($roomDetailSet)) {
						$roomDetailUpdate .= $_POST['roomDetail' . $i . '-1'] . '&' . $_POST['roomDetail' . $i . '-2'];
						$roomDetailSet = True;
					} else {
						$roomDetailUpdate .= '&&' . $_POST['roomDetail' . $i . '-1'] . '&' . $_POST['roomDetail' . $i . '-2'];
					}
				}
			}

			$floorUpdate = $_POST['floor1'] . '&&' . $_POST['floor2'];
			$depositUpdate = $_POST['first-fee1-1'] . '&' . $_POST['first-fee1-2'] . '&' . $_POST['first-fee1-3'];
			$shikiMoneyUpdate = $_POST['first-fee2-2'] . '&' . $_POST['first-fee2-3'];
			$keyMoneyUpdate = $_POST['first-fee3-2'] . '&' . $_POST['first-fee3-3'];

			$parkingSUpdate = $_POST['parking2'] . '&' . $_POST['parking3'] . '&' .$_POST['parking4'];

			$mysql = 'UPDATE rooms SET public = :public, current = :current, floor = :floor, area = :area, rent = :rent, month_fee = :month_fee, fee = :fee, deposit = :deposit, shiki_money = :shiki_money, key_money = :key_money, parking_condition = :parking_condition, parking_speaces = :parking_speaces, parking_fee = :parking_fee, moving_data = :moving_data, story = :story, sun = :sun, balcony = :balcony, insurance = :insurance, terms = :terms, room_position = :room_position, feature = :feature, receipt = :receipt, broadcast = :broadcast, security = :security, privilege = :privilege, room_detail = :room_detail where id = :id';
			$stmt = $dbh->prepare($mysql);
			$params = array(
				':public' => $public,
				':current' => $_POST['current'],
				':floor' => $floorUpdate,
				':area' => $_POST['area'],
				':rent' => $_POST['rent'],
				':month_fee' => $elseFee1Update,
				':fee' => $elseFee2Update,
				':deposit' => $depositUpdate,
				':shiki_money' => $shikiMoneyUpdate,
				':key_money' => $keyMoneyUpdate,
				':parking_condition' => $_POST['parking1'],
				':parking_speaces' => $parkingSUpdate,
				':parking_fee' => $_POST['parking5'],
				':moving_data' => $_POST['move-in'],
				':story' => $_POST['story'],
				':sun' => $_POST['sun'],
				':balcony' => $_POST['balcony'],
				':insurance' => $_POST['insurance'],
				':terms' => $termsUpdate,
				':room_position' => $positionUpdate,
				':feature' => $featureUpdate,
				':receipt' => $receiptUpdate,
				':broadcast' => $broadcastUpdate,
				':security' => $securityUpdate,
				':privilege' => $privilegeUpdate,
				':room_detail' => $roomDetailUpdate,
				':id' => $getRoomId
			);
			$stmt->execute($params);
		}

		//内観設備画像の文に関する情報更新
		if(isset($_POST['roomFacSet'])) {

			for($i = 0; $i < 10; $i++) {
				if(empty($facilitysSet)) {
					$facilityNamesUpdate = $_POST['facilityNames'.$i];
					$facilityTextsUpdate = $_POST['facilityTexts'.$i];
					$facilitysSet = true;
				} else {
					$facilityNamesUpdate .= '&&' . $_POST['facilityNames'.$i];
					$facilityTextsUpdate .= '&&' . $_POST['facilityTexts'.$i];
				}
			}
			updateMysql('rooms', 'previews_names', $facilityNamesUpdate, $dbh, $getRoomId);
			updateMysql('rooms', 'previews_text', $facilityTextsUpdate, $dbh, $getRoomId);


			for ($i = 0; $i < 10; $i++) {
				if (!empty($_FILES['file'.$i]['name'])) {

					$previewImages = selectMysql('rooms', 'preview_images', $dbh, $getRoomId);
					$previewImages_block = explode(' ', $previewImages);

					$file_name = new splFileInfo($_FILES['file' . $i]['name']);
					$extension = $file_name->getExtension();

					try{
						if(is_uploaded_file($_FILES['file'.$i]['tmp_name']) && ($extension == 'png' || $extension == 'jpg' || $extension == 'gif' || $extension == 'jpeg' ||  $extension == 'bmp'  || $extension == 'tiff' || $extension == 'PNG' || $extension == 'JPG' || $extension == 'GIF' || $extension == 'JPEG' || $extension == 'BMP' || $extension == 'TIFF')) {
							$storeFildName = date('Ymdhis').$_SESSION['building_id'].$i.'.jpg';
							move_uploaded_file($_FILES['file'.$i]['tmp_name'], './../../../../MyHome/Landlord/' . $_SESSION['userUrl'] . '/images/' . $storeFildName);
							$previewImages_block[$i] = $storeFildName;
							$mImgUpdate = true;
						}
					} catch(Exception $e) {
						echo 'ERROR:', $e->getMessage().PHP_EOL;
					}
				}
			}

			$imageUpdate = '';
			if (isset($mImgUpdate)) {
				foreach($previewImages_block as $block) {
					if(empty($imageSet)) {
						$imageUpdate .= $block;
						$imageSet = True;
					} else {
						$imageUpdate .= ' ' . $block;
					}
				}
				updateMysql('rooms', 'preview_images', $imageUpdate, $dbh, $getRoomId);

				$updateImage = True;
			}

		}


		if (isset($_POST['bImgSet'])) {

			if(isset($_FILES['fileB1']['name'])) {

				$file_name = new splFileInfo($_FILES['fileB1']['name']);
				$extension = $file_name->getExtension();
				try{
					if(is_uploaded_file($_FILES['fileB1']['tmp_name']) && ($extension == 'png' || $extension == 'jpg' || $extension == 'gif' || $extension == 'jpeg' ||  $extension == 'bmp'  || $extension == 'tiff' || $extension == 'PNG' || $extension == 'JPG' || $extension == 'GIF' || $extension == 'JPEG' || $extension == 'BMP' || $extension == 'TIFF')) {
						$storeFildName = date('Ymdhis').$_SESSION['building_id'].'B1'.'.jpg';
						move_uploaded_file($_FILES['fileB1']['tmp_name'], './../../../../MyHome/Landlord/' . $_SESSION['userUrl'] . '/images/' . $storeFildName);
						updateMysql('rooms', 'floor_image', $storeFildName, $dbh, $getRoomId);
						$bImgCheck = true;
					}
				} catch(Exception $e) {
					echo 'ERROR:', $e->getMessage().PHP_EOL;
				}
				if (!$bImgCheck) {
					$errors['bImgCheck'] = '間取り画像変更に失敗しました！';
				}
			}


			if(isset($_FILES['fileB2']['name'])) {

				$file_name = new splFileInfo($_FILES['fileB2']['name']);
				$extension = $file_name->getExtension();
				try{
					if(is_uploaded_file($_FILES['fileB2']['tmp_name']) && ($extension == 'png' || $extension == 'jpg' || $extension == 'gif' || $extension == 'jpeg' ||  $extension == 'bmp'  || $extension == 'tiff' || $extension == 'PNG' || $extension == 'JPG' || $extension == 'GIF' || $extension == 'JPEG' || $extension == 'BMP' || $extension == 'TIFF')) {
						$storeFildName = date('Ymdhis').$_SESSION['building_id'].'B2'.'.jpg';
						move_uploaded_file($_FILES['fileB2']['tmp_name'], './../../../../MyHome/Landlord/' . $_SESSION['userUrl'] . '/images/' . $storeFildName);
						updateMysql('rooms', 'preview_image', $storeFildName, $dbh, $getRoomId);
						$bImgCheck = true;$storeFildName

					}
				} catch(Exception $e) {
					echo 'ERROR:', $e->getMessage().PHP_EOL;
				}
				if (!$bImgCheck) {
					$errors['bImgCheck'] = '内観画像変更に失敗しました！';
				}

			}

		}

		if (isset($_POST['imgId'])) {

			$id = $_POST['imgId'];
			
			if ($id == 'first') {
				updateMysql('rooms', 'floor_image', null, $dbh, $getRoomId);
			}

			if ($id == 'second') {
				updateMysql('rooms', 'preview_image', null, $dbh, $getRoomId);
			}

			if ($id < 10) {

				$previewImages = selectMysql('rooms', 'preview_images', $dbh, $getRoomId);
				$previewImages_block = (!empty($previewImages)) ? explode(' ', $previewImages):'';

				unset($previewImages_block[$id]);

				foreach($previewImages_block as $image) {
					if(empty($imageSet)) {
						$imageUpdate .= $image;
						$imageSet = True;
					} else {
						$imageUpdate .= ' ' . $image;
					}
				}

				updateMysql('rooms', 'preview_images', $imageUpdate, $dbh, $getRoomId);
			}

			$deleteImage = true;
		
		}


	} else {
		setToken();
	}

/*ここまで現在の部屋情報の更新処理*/



/*ここから現在の部屋情報を取得*/

	//初期でどのcheckboxにチェックを入れるか、配列に挿入するための関数
	function checkboxSet($blocks, $checks) {
		foreach($blocks as $block) {
			for($i = 0; $i < count($checks); $i++) {
				if($block == $checks[$i]) {
					$checkSet[$i] = 'checked';
				}
			}
		}
		return $checkSet;
	}

	//建物名
	$buildingName = selectMysql('buildings', 'building_name', $dbh, $_SESSION['building_id']);

	//ホームページURL
	$file_name = selectMysql('buildings', 'file_name', $dbh, $_SESSION['building_id']);

	$mysql = 'select * from rooms where id = ' . $getRoomId;
	$stmt = $dbh->prepare($mysql);
	$stmt->execute();
	$result = $stmt->fetch();

	//部屋番号
	$num = $result['number'];

	//公開状況(INT型)
	$public = $result['public'];

	//現況
	$current = $result['current'];

	//間取り
	$floors = $result['floor'];
	list($floor1, $floor2) = explode('&&', $floors);

	//専有面積
	$area = $result['area'];

	//賃料
	$rent = $result['rent'];
	
	//その他月額費用
	$monthFee = $result['month_fee'];
	$fee = $result['fee'];
	$elseFee = $result['else_fee'];
	$monthFee_block = explode('&', $monthFee);
	$fee_block = explode('&', $fee);
	for($i = 0; $i < count($monthFee_block); $i++) {
		$administrative[$i] = ($monthFee_block[$i] == '管理費') ? 'selected' : '';
		$commonService[$i] = ($monthFee_block[$i] == '共益費') ? 'selected' : '';
		$townCouncil[$i] = ($monthFee_block[$i] == '町会費') ? 'selected' : '';
		$internet[$i] = ($monthFee_block[$i] == 'インターネット代') ? 'selected' : '';
	}

	//初期費用
	$firstFee = $result['first_fee'];

	//敷金・礼金
	$deposit = $result['deposit'];
	$shikiMoney = $result['shiki_money'];
	$keyMoney = $result['key_money'];
	list($depositName, $depositValue, $depositFeild) = explode('&', $deposit);
	$depositName_select[0] = ($depositName == 0) ? 'selected':'' ;
	$depositName_select[1] = ($depositName == 1) ? 'selected':'' ;
	$depositFeild_select[0] = ($depositFeild == 'カ月') ? 'selected':'' ;
	$depositFeild_select[1] = ($depositFeild == '円') ? 'selected':'' ;
	list($shikiMoneyValue, $shikiMoneyFeild) = explode('&', $shikiMoney);
	$$shikiMoneyFeild_select[0] = ($$shikiMoneyFeild == 'カ月') ? 'selected':'' ;
	$$shikiMoneyFeild_select[1] = ($$shikiMoneyFeild == '円') ? 'selected':'' ;
	list($keyMoneyValue, $keyMoneyFeild) = explode('&', $keyMoney);
	$keyMoneyFeild_select[0] = ($keyMoneyFeild == 'カ月') ? 'selected':'' ;
	$keyMoneyFeild_select[1] = ($keyMoneyFeild == '円') ? 'selected':'' ;

	//駐車場
	$parkingCondition = $result['parking_condition'];
	$parkingFee = $result['parking_fee'];
	$parkingSpeaces = $result['parking_speaces'];
	list($parkingS[0], $parkingS[1], $parkingS[2]) = explode('&', $parkingSpeaces);
	$parkingS1[0] = ($parkingS[0] == '敷地内')? 'selected':'';
	$parkingS1[1] = ($parkingS[0] == '近隣')? 'selected':'';
	$parkingS2[0] = ($parkingS[1] == '屋内')? 'selected':'';
	$parkingS2[1] = ($parkingS[1] == '屋外')? 'selected':'';
	$parkingS3[0] = ($parkingS[2] == '平面')? 'selected':'';
	$parkingS3[1] = ($parkingS[2] == '機械式')? 'selected':'';
	$parkingS3[2] = ($parkingS[2] == '立体')? 'selected':'';

	//入居時期
	$movingData = $result['moving_data'];

	//部屋詳細
	$roomDetails = $result['room_detail'];
	$roomDetail_block = explode('&&', $roomDetails);
	for($i = 0; $i < count($roomDetail_block); $i++) {
		list($roomDetailForm[$i], $roomDetailArea[$i]) = explode('&', $roomDetail_block[$i]);
		$you[$i] = ($roomDetailForm[$i] == '洋') ? 'selected' : '' ;
		$wa[$i] = ($roomDetailForm[$i] == '和') ? 'selected' : '' ;
		$L[$i] = ($roomDetailForm[$i] == 'L') ? 'selected' : '' ;
		$D[$i] = ($roomDetailForm[$i] == 'D') ? 'selected' : '' ;
		$K[$i] = ($roomDetailForm[$i] == 'K') ? 'selected' : '' ;
		$DK[$i] = ($roomDetailForm[$i] == 'DK') ? 'selected' : '' ;
		$LDK[$i] = ($roomDetailForm[$i] == 'LDK') ? 'selected' : '' ;
		$LOFT[$i] = ($roomDetailForm[$i] == 'LOFT') ? 'selected' : '' ;
	}

	//所在階
	$story = $result['story'];

	//主要採光面
	$sun = $result['sun'];
	$sunData = ['北', '北東', '東', '南東', '南', '南西', '西', '北西'];
	for($i = 0; $i < count($sunData); $i++) {
		$sunChecks[$i] = ($sun == $sunData[$i])? 'selected':'' ;
	}

	//バルコニー面積
	$balcony = $result['balcony'];

	//住宅保険
	$insurance = $result['insurance'];

	//入居条件
	$terms = $result['terms'];
	$terms_block = explode('/', $terms);
	$terms = [
		'楽器相談可', '事務所可', '2人入居可', 'ペット相談可', '保証人不要', 'バリアフリー', '外国人可'
	];
	$termsCheck = checkboxSet($terms_block, $terms);

	//部屋位置
	$position = $result['room_position'];
	$position_block = explode('/', $position);
	$positions = [
		'最上階', '角部屋', '2階以上'
	];
	$positionCheck = checkboxSet($position_block, $positions);

	//特徴/設備品
	$feature = $result['feature'];
	$feature_block = explode('/', $feature);
	$features = [
		'家具・家電付', 'デザイナーズ', 'ガスコンロ', 'ＩＨクッキングヒーター', 'コンロ２口', 'コンロ３口以上', 'カウンターキッチン', 'システムキッチン', '専用バス', '専用トイレ', 'バス・トイレ別', '給湯', '追い焚き機能', '独立洗面台', 'シャンプードレッサー', '洗浄便座', '暖房便座', '室内物干し', 'フローリング', '専用庭', '出窓', '浴室乾燥機', 'バルコニー', 'ロフト', '室内洗濯機置場', 'エアコン', '床暖房', '浴室テレビ', 'ペアガラス', 'オールフローリング', '可動間仕切り'
	];
	$featureCheck = checkboxSet($feature_block, $features);

	//収納
	$receipt = $result['receipt'];
	$receipt_block = explode('/', $receipt);
	$receipts = [
		'床下収納', 'ウォークインクローゼット', 'シューズボックス'
	];
	$receiptCheck = checkboxSet($receipt_block, $receipts);

	//放送・通信
	$broadcast = $result['broadcast'];
	$broadcast_block = explode('/', $broadcast);
	$broadcasts = [
		'有線放送', '光ファイバー完備', 'インターネット無料'
	];
	$broadcastCheck = checkboxSet($broadcast_block, $broadcasts);

	//セキュリティ
	$security = $result['security'];
	$security_block = explode('/', $security);
	$securitys = [
		'監視カメラ', 'モニター付インターホン', '暗証番号・リモコン錠', 'テンプルキー', '玄関ダブルロック', '防犯フィルム', '防犯ガラス'
	];
	$securityCheck = checkboxSet($security_block, $securitys);

	//特典
	$privilege = $result['privilege'];
	$privilege_block = explode('/', $privilege);
	$privileges = [
		'フリーレントあり', '仲介手数料なし', '敷金礼金なし', 'キャンペーン中'
	];
	$privilegeCheck = checkboxSet($privilege_block, $privileges);

	//間取り画像
	$floorImage = $result['floor_image'];

	//内観画像
	$previewImage = $result['preview_image'];

	//その他内観・設備画
	$previewImages = $result['preview_images'];
	$previewsNames = $result['previews_names'];
	$previewsTexts = $result['previews_text'];
	$previewImages_block = (!empty($previewImages)) ? explode(' ', $previewImages):'';
	$previewsNames_block = explode('&&', $previewsNames);
	$previewsTexts_block = explode('&&', $previewsTexts);

/*ここまで現在の部屋情報を取得*/


$floorImageJS = json_encode($floorImage, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
$previewImageJS = json_encode($previewImage, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
$previewImagesJS = json_encode($previewImages_block, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
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
		var bImg1JS = <?= $floorImageJS ?>;
		var bImg2JS = <?= $previewImageJS ?>;
		var imagesJS = <?= $previewImagesJS ?>;
		var userUrl = <?= $userUrl ?>;
	</script>
	<script type="text/javascript" src="./../../../Configuration/Function/picture.script.js"></script>
	<script type="text/javascript" src="./../../../Configuration/Function/script.js"></script>
</body>
</html>