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

		//建物名
		if(isset($_POST['name'])) {
			updateMysql('buildings', 'building_name', $_POST['name'], $dbh, $_SESSION['building_id']);	
		}

		//建物愛称
		if(isset($_POST['nickname'])) {
			updateMysql('buildings', 'pet_name', $_POST['nickname'], $dbh, $_SESSION['building_id']);
		}

		//取得年月
		if(isset($_POST['getDay'])) {
			updateMysql('buildings', 'get_day', $_POST['getDay'], $dbh, $_SESSION['building_id']);
		}

		//取得価格
		if(isset($_POST['getValue'])) {
			updateMysql('buildings', 'get_money', $_POST['getValue'], $dbh, $_SESSION['building_id']);
		}

		//取得価格
		if(isset($_POST['yield'])) {
			updateMysql('buildings', 'get_yeild', $_POST['yield'], $dbh, $_SESSION['building_id']);
		}

		//取得価格
		if(isset($_POST['moneyPublic'])) {
			updateMysql('buildings', 'get_money_public', $_POST['moneyPublic'], $dbh, $_SESSION['building_id']);
		}

		//種目
		if(isset($_POST['type'])) {
			updateMysql('buildings', 'building_speaces', $_POST['type'], $dbh, $_SESSION['building_id']);
		}

		//建物構造
		if(isset($_POST['construct'])) {
			updateMysql('buildings', 'building_construct', $_POST['construct'], $dbh, $_SESSION['building_id']);		
		}

		//築年月
		if(isset($_POST['year']) && isset($_POST['month'])) {
			$old = $_POST['year'] . '&' . $_POST['month'];
			updateMysql('buildings', 'old', $old, $dbh, $_SESSION['building_id']);		
		}

		//階層
		if(isset($_POST['story'])) {
			updateMysql('buildings', 'building_story', $_POST['story'], $dbh, $_SESSION['building_id']);	
		}

		//階層(地下)
		if(isset($_POST['underground'])) {
			updateMysql('buildings', 'building_underground', $_POST['underground'], $dbh, $_SESSION['building_id']);	
		}

		//駐車場(台数)
		if(isset($_POST['parking-num'])) {
			updateMysql('buildings', 'parking_num', $_POST['parking-num'], $dbh, $_SESSION['building_id']);
		}

		//駐車場(状況)
		if(isset($_POST['parking-situation'])) {
			updateMysql('buildings', 'parking_situation', $_POST['parking-situation'], $dbh, $_SESSION['building_id']);
		}

		//交通1
		if(($_POST['traffic1'] == '電車' && $_POST['lineName1'] !== '' && $_POST['s1'] !== '') || ($_POST['traffic1'] == 'バス' && $_POST['busInc1'] !== '' && $_POST['busStop1'] !== '')) {

			$trainWalk1 = '';
			$trainBus1 = '';

			if($_POST['traffic1'] == '電車') {

				if($_POST['trainWalk1'] !== '') {
					$trainWalk1 = '徒歩' . $_POST['trainWalk1'] . '分';
				}

				if($_POST['trainBus1'] !== '') {
					$trainBus1 = 'バス乗車' . $_POST['trainBus1'] . '分';
				}

				$updateTraffic1 = '電車&' . $_POST['lineName1'] . ' ' . $_POST['s1'] . ' ' . $trainBus1 . ' ' . $trainWalk1; 

			} elseif($_POST['traffic1'] == 'バス') {
				$updateTraffic1 = 'バス&' . $_POST['busInc1'] . ' ' . $_POST['busStop1'] . ' 徒歩' . $_POST['busWalk1'] . '分';
			}

			updateMysql('buildings', 'traffic1', $updateTraffic1, $dbh, $_SESSION['building_id']);
		}

		//交通2
		if(($_POST['traffic2'] == '電車' && $_POST['lineName2'] !== '' && $_POST['s3'] !== '') || ($_POST['traffic2'] == 'バス' && $_POST['busInc2'] !== '' && $_POST['busStop2'] !== '')) {

			$trainWalk2 = '';
			$trainBus2 = '';

			if($_POST['traffic2'] == '電車') {

				if($_POST['trainWalk2'] !== '') {
					$trainWalk2 = '徒歩' . $_POST['trainWalk2'] . '分';
				}

				if($_POST['trainBus2'] !== '') {
					$trainBus2 = 'バス乗車' . $_POST['trainBus2'] . '分';
				}

				$updateTraffic2 = '電車&' . $_POST['lineName2'] . ' ' . $_POST['s3'] . ' ' . $trainBus2 . ' ' . $trainWalk2; 

			} elseif($_POST['traffic2'] == 'バス') {
				$updateTraffic2 = 'バス&' . $_POST['busInc2'] . ' ' . $_POST['busStop2'] . ' 徒歩' . $_POST['busWalk2'] . '分';
			}

			updateMysql('buildings', 'traffic2', $updateTraffic2, $dbh, $_SESSION['building_id']);
		}

		//交通3
		if(($_POST['traffic3'] == '電車' && $_POST['lineName3'] !== '' && $_POST['s5'] !== '') || ($_POST['traffic3'] == 'バス' && $_POST['busInc3'] !== '' && $_POST['busStop3'] !== '')) {

			$trainWalk3 = '';
			$trainBus3 = '';

			if($_POST['traffic3'] == '電車') {

				if($_POST['trainWalk3'] !== '') {
					$trainWalk3 = '徒歩' . $_POST['trainWalk3'] . '分';
				}

				if($_POST['trainBus3'] !== '') {
					$trainBus3 = 'バス乗車' . $_POST['trainBus3'] . '分';
				}

				$updateTraffic3 = '電車&' . $_POST['lineName3'] . ' ' . $_POST['s5'] . ' ' . $trainBus3 . ' ' . $trainWalk3; 

			} elseif($_POST['traffic3'] == 'バス') {
				$updateTraffic3 = 'バス&' . $_POST['busInc3'] . ' ' . $_POST['busStop3'] . ' 徒歩' . $_POST['busWalk3'] . '分';
			}

			updateMysql('buildings', 'traffic3', $updateTraffic3, $dbh, $_SESSION['building_id']);
		}


		//住所
		if(isset($_POST['zip1']) && isset($_POST['zip2']) && isset($_POST['pref']) && isset($_POST['addr1']) && isset($_POST['addr2'])) {

			updateMysql('buildings', 'zip1', $_POST['zip1'], $dbh, $_SESSION['building_id']);
			updateMysql('buildings', 'zip2', $_POST['zip2'], $dbh, $_SESSION['building_id']);
			updateMysql('buildings', 'pref', $_POST['pref'], $dbh, $_SESSION['building_id']);
			updateMysql('buildings', 'addr1', $_POST['addr1'], $dbh, $_SESSION['building_id']);
			updateMysql('buildings', 'addr2', $_POST['addr2'], $dbh, $_SESSION['building_id']);
			
			updateMysql('buildings', 'address_lat', $_POST['lat'], $dbh, $_SESSION['building_id']);
			updateMysql('buildings', 'address_lng', $_POST['lng'], $dbh, $_SESSION['building_id']);
			
		}

		for($i = 1; $i <= 24; $i++) {
			if(isset($_POST['facility' . $i])) {
				if(empty($facilitySet)) {
					$facilityUpdate .= $_POST['facility' . $i];
					$facilitySet = True;
				} else {
					$facilityUpdate .= '/' . $_POST['facility' . $i];
				}
			}
		}
		updateMysql('buildings', 'facility', $facilityUpdate, $dbh, $_SESSION['building_id']);
		$update = True;
		

	} else {
		setToken();
	}

/*ここまで建物情報の更新処理*/



/*ここから現在の建物情報を取得*/

	//建物名
	$buildingName = selectMysql('buildings', 'building_name', $dbh, $_SESSION['building_id']);

	//ホームページURL
	$file_name = selectMysql('buildings', 'file_name', $dbh, $_SESSION['building_id']);

	//建物愛称
	$petName = selectMysql('buildings', 'pet_name', $dbh, $_SESSION['building_id']);

	//取得年月
	$getDay = selectMysql('buildings', 'get_day', $dbh, $_SESSION['building_id']);

	//取得価格
	$getMoney = selectMysql('buildings', 'get_money', $dbh, $_SESSION['building_id']);

	//取得時利回り
	$getYeild = selectMysql('buildings', 'get_yeild', $dbh, $_SESSION['building_id']);

	//取得公開情報
	$getMoneyPublic = selectMysql('buildings', 'get_money_public', $dbh, $_SESSION['building_id']);
	$gMPublicSelect[0] = ($getMoneyPublic == 0) ? 'selected': '';
	$gMPublicSelect[1] = ($getMoneyPublic == 1) ? 'selected': '';

	//種目
	$speaces = selectMysql('buildings', 'building_speaces', $dbh, $_SESSION['building_id']);

	//建物構造
	$construct = selectMysql('buildings', 'building_construct', $dbh, $_SESSION['building_id']);

	//築年月
	$old = selectMysql('buildings', 'old', $dbh, $_SESSION['building_id']);
	if (isset($old)) {
		list($oldYear, $oldMonth) = explode('&', $old);
	}

	//階層
	$story = selectMysql('buildings', 'building_story', $dbh, $_SESSION['building_id']);

	//階層(地下)
	$underground = selectMysql('buildings', 'building_underground', $dbh, $_SESSION['building_id']);

	//駐車場
	$parkingSituation = selectMysql('buildings', 'parking_situation', $dbh, $_SESSION['building_id']);
	$parkingNum = selectMysql('buildings', 'parking_num', $dbh, $_SESSION['building_id']);

	//住所
	$zip1 = selectMysql('buildings', 'zip1', $dbh, $_SESSION['building_id']);
	$zip2 = selectMysql('buildings', 'zip2', $dbh, $_SESSION['building_id']);
	$pref = selectMysql('buildings', 'pref', $dbh, $_SESSION['building_id']);
	$addr1 = selectMysql('buildings', 'addr1', $dbh, $_SESSION['building_id']);
	$addr2 = selectMysql('buildings', 'addr2', $dbh, $_SESSION['building_id']);

	//Google Maps
	$lat = selectMysql('buildings', 'address_lat', $dbh, $_SESSION['building_id']);
	$lng = selectMysql('buildings', 'address_lng', $dbh, $_SESSION['building_id']);

	//交通
	$traffic1 = selectMysql('buildings', 'traffic1', $dbh, $_SESSION['building_id']);
	$traffic2 = selectMysql('buildings', 'traffic2', $dbh, $_SESSION['building_id']);
	$traffic3 = selectMysql('buildings', 'traffic3', $dbh, $_SESSION['building_id']);
	if (isset($traffic1)) {
		list($trafficSpe1, $trafficCon1) = explode('&', $traffic1);
		$trafficSpeT1 = ($trafficSpe1 == '電車') ? 'checked': '';
		$trafficSpeB1 = ($trafficSpe1 == 'バス') ? 'checked': '';
	}
	if (isset($traffic2)) {
		list($trafficSpe2, $trafficCon2) = explode('&', $traffic2);
		$trafficSpeT2 = ($trafficSpe2 == '電車') ? 'checked': '';
		$trafficSpeB2 = ($trafficSpe2 == 'バス') ? 'checked': '';
	}
	if (isset($traffic3)) {
		list($trafficSpe3, $trafficCon3) = explode('&', $traffic3);
		$trafficSpeT3 = ($trafficSpe3 == '電車') ? 'checked': '';
		$trafficSpeB3 = ($trafficSpe3 == 'バス') ? 'checked': '';
	}

	//建築設備
	$facility = selectMysql('buildings', 'facility', $dbh, $_SESSION['building_id']);
	$facility_block = explode('/', $facility);

/*ここまで現在の建物情報を取得*/

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
	<script type="text/javascript" src="./../../../Configuration/Function/train.data.js"></script>
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
	<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
	<script src="http://maps.google.com/maps/api/js?" type="text/javascript" charset="utf-8"></script>
	<script src="./../../../Configuration/Function/maping.js"></script>
</body>
</html>