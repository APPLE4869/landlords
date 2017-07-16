<?php 

session_start();

require_once(dirname(__FILE__) . '/../../../Configuration/Config/database.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/config.php');
require_once(dirname(__FILE__) . '/../../../Configuration/Config/login.php');

buildingCheck();

if(isset($_SESSION['userUrl'])) {

	$noticesId_block = [];
	$titles_block = [];
	$texts_block = [];
	$createds_block = [];

/*ここからトップページ情報の更新処理*/

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token'])) {
		checkToken();

		//お知らせ編集・削除
		if(isset($_POST['noticeSet'])) {

			//逆順のお知らせ情報IDを取得
			$noticesId = selectMysql('buildings', 'notices', $dbh, $_SESSION['building_id']);
			$noticesId_block = explode(' ', $noticesId);
			$noticesId_block = array_reverse($noticesId_block);

			//IDからそれぞれのお知らせ情報を取得
			foreach($noticesId_block as $id) {
				$mysql = sql('notices', $id);
				$stmt = $dbh->prepare($mysql);
				$stmt->execute();
				$result = $stmt->fetch();
				array_push($titles_block, $result['title']);
				array_push($texts_block, $result['text']);
				array_push($createds_block, $result['created']);
			}


			for($i = 0; $i < count($noticesId_block); $i++) {
				if($_POST['created'.$i] && $_POST['title'.$i] && $_POST['text'.$i]) { 
					if(empty($_POST['noticeDelete'.$i])) {
						updateMysql('notices', 'title', $_POST['title'.$i], $dbh, $noticesId_block[$i]);
						updateMysql('notices', 'text', $_POST['text'.$i], $dbh, $noticesId_block[$i]);
						updateMysql('notices', 'created', $_POST['created'.$i], $dbh, $noticesId_block[$i]);

					} elseif($_POST['noticeDelete'.$i] == 'check') {

						//お知らせ情報を削除
						$mysql = 'delete from notices where id = ' . $noticesId_block[$i];
						$stmt = $dbh->prepare($mysql);
						$stmt->execute();
						
						//お知らせ情報IDの配列から削除した情報のIDを削除
						unset($noticesId_block[$i]);
						$noticesId_block = array_reverse($noticesId_block);

						foreach($noticesId_block as $id) {
							if(empty($noticesDeleCheck)) {
								$noticeIdUpdate .= $id;
								$noticesDeleCheck = True;
							} else {
								$noticeIdUpdate .= ' ' . $id;
							}
							$deleted = True;
						}
						updateMysql('buildings', 'notices', $noticeIdUpdate, $dbh, $_SESSION['building_id']);
					}
				}
			}
			
			$update = True;
		
		}

		if ($_POST['public-notice-num']) {
			$publicNoticeNum = $_POST['public-notice-num'];
			updateMysql('buildings', 'noticeNum', $publicNoticeNum, $dbh, $_SESSION['building_id']);
			$success['noticeNum'] = '公開お知らせ数を更新しました！';
		}

		//お知らせ追加
		if(isset($_POST['newCreated']) && isset($_POST['newTitle']) && isset($_POST['newText'])) {

			//notices table に追加
			$mysql = 'INSERT INTO notices(title, text, created, user) VALUES (:newTitle, :newText, :newCreated, :user)';
			$stmt = $dbh->prepare($mysql);
			$params = array(
				':newTitle' => $_POST['newTitle'],
				':newText' => $_POST['newText'],
				':newCreated' => $_POST['newCreated'],
				':user' => $_SESSION['userUrl']
			);
			$stmt->execute($params);


			//追加したnoticesのid番号取得
			$mysql = 'select * from notices where title = :title and text = :text and created = :created and user = :url order by id desc';
			$stmt = $dbh->prepare($mysql);
			$params = array(
				':title' => $_POST['newTitle'],
				':text' => $_POST['newText'],
				':created' => $_POST['newCreated'],
				':url' => $_SESSION['userUrl']
			);
			$stmt->execute($params);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			//現在登録中のお知らせのIDを取得(配列化)
			$noticesId = selectMysql('buildings', 'notices', $dbh, $_SESSION['building_id']);
			if(!empty($noticesId)) {
				$noticesId_block = explode(' ', $noticesId);
			}

			//全お知らせ情報を配列化
			array_push($noticesId_block, $result['id']);

			//お知らせ情報を配列 → 文字列
			foreach($noticesId_block as $block) {
				if(empty($noticesCheck)) {
					$noticesIdUpdate .= $block;
					$noticesCheck = True;
				} else {
					$noticesIdUpdate .= ' ' . $block;
				}
			}

			//buildingsのお知らせ情報を更新
			updateMysql('buildings', 'notices', $noticesIdUpdate, $dbh, $_SESSION['building_id']);

			$newCreated = True;
		}

	} else {
		setToken();
	}

/*ここまでトップページ情報の更新処理*/



/*ここから現在のトップページ情報を取得*/

	$noticesId_block = [];
	$titles_block = [];
	$texts_block = [];
	$createds_block = [];

	//建物名
	$buildingName = selectMysql('buildings', 'building_name', $dbh, $_SESSION['building_id']);

	//ホームページURL
	$file_name = selectMysql('buildings', 'file_name', $dbh, $_SESSION['building_id']);

	//公開お知らせコラム数
	$public_notice_num = selectMysql('buildings', 'noticeNum', $dbh, $_SESSION['building_id']);
	$public_notice_check[$public_notice_num] = 'selected';

	//お知らせ
	$noticesId = selectMysql('buildings', 'notices', $dbh, $_SESSION['building_id']);
	$noticesId_block = explode(' ', $noticesId);
	$noticesId_block = array_reverse($noticesId_block);

	$noticesSitation = (!empty($noticesId)) ? 'true':'' ;

	foreach($noticesId_block as $id) {
		$mysql = sql('notices', $id);
		$stmt = $dbh->prepare($mysql);
		$stmt->execute();
		$result = $stmt->fetch();
		array_push($titles_block, $result['title']);
		array_push($texts_block, $result['text']);
		array_push($createds_block, $result['created']);
	}

/*ここまで現在のトップページ情報を取得*/

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