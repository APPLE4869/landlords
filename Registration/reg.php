<?php 

session_start();

require_once(dirname(__FILE__) . '/../Configuration/Config/database.php');
require_once(dirname(__FILE__) . '/../Configuration/Config/config.php');

header('X-FRAME-OPTIONS: SAMEORIGIN');

$errors = [];

if(empty($_GET)) {
	header('Location: index.php');
	exit();
} else {

	$urltoken = isset($_GET['urltoken']) ? $_GET['urltoken'] : NULL;

	if($urltoken == '') {
		$errors['urltoken'] = 'もう一度登録をやりなおして下さい。';
	} elseif(!isset($_SESSION['mail'])) {

		try{
			//例外処理を投げる（スロー）ようにする
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			//flagが0の未登録者・仮登録日から24時間以内
			$stmt = $dbh->prepare("SELECT mail FROM pre_member WHERE urltoken=(:urltoken) AND flag =0 AND date > now() - interval 24 hour");
			$stmt->bindValue(':urltoken', $urltoken, PDO::PARAM_STR);
			$stmt->execute();

			$row_count = $stmt->rowCount();

			if( $row_count ==1){
				$mail_array = $stmt->fetch();
				$mail = $mail_array['mail'];
				$_SESSION['mail'] = $mail;
			}else{
				$errors['urltoken_timeover'] = "このURLはご利用できません。有効期限が過ぎた等の問題があります。もう一度登録をやりなおして下さい。";
			}
			
		}catch (PDOException $e){
			print('Error:'.$e->getMessage());
			die();
		}
	}
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token']) && isset($_SESSION['mail'])) {
	checkToken();

	if(isset($_POST['confCheck'])) {

		if(!empty($_POST['userName']) && mb_strlen($_POST['url']) >= 4 && mb_strlen($_POST['url']) <= 13 && !empty($_POST['phone']) && preg_match("/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/", $_POST['phone']) && preg_match('/^[a-zA-Z0-9]+$/', $_POST['url']) && mb_strlen($_POST['password']) >= 6 && $_POST['password'] == $_POST['conf-password']) {

			$mysql = 'select * from users';
			foreach($dbh->query($mysql) as $row) {
				if($_POST['userName'] == $row['user']) {
					$errors['userNameSMiss'] = 'すでに使用されているユーザーネームです';
				}
				if($_POST['url'] == $row['url']) {
					$errors['urlMiss'] = 'すでに使用されているURLです';
				}
			}

			if(empty($urlMiss)) {
				$confirm = True;
			}

		} else {
			if(empty($_POST['userName'])) {
				$errors['userNameMiss'] = 'ユーザーネームを入力してください';
			}
			if(mb_strlen($_POST['password']) < 6 && !empty($_POST['password'])) {
				$errors['passwordMiss'] = '6文字以上のパスワードを入力してください';
			} elseif(empty($_POST['password'])) {
				$errors['passwordMiss'] = 'パスワードを入力してください';
			}
			if(empty($_POST['conf-password'])) {
				$errors['confPasswordMiss'] = '確認用パスワードを入力してください';
			}
			if(!preg_match('/^[a-zA-Z0-9]+$/', $_POST['url'])) {
				$errors['urlFormatMiss'] = 'URLは英数字のみでお願いします';
			}
			if(mb_strlen($_POST['url']) < 4 || mb_strlen($_POST['url']) > 13) {
				$errors['urlLengthMiss'] = '4文字以上13文字以内で入力してください';
			}
			if($_POST['password'] !== $_POST['conf-password']) {
				$errors['passwordNotMatch'] = 'パスワードが一致しません';
			}
			if(empty($_POST['phone'])) {
				$errors['phoneNotSet'] = '電話番号を入力してください';
			} elseif(!preg_match("/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/", $_POST['phone'])) {
				$errors['phoneForm'] = "電話番号の形式が正しくありません。";
			}
		}

	}

	if(isset($_POST['regCheck']) && isset($_SESSION['mail'])) {

		$mail = $_SESSION['mail'];

		$mkFile = '../../MyHome/Landlord/' . $_POST['regUrl'] . '/';
		$mkImages = '../../MyHome/Landlord/' . $_POST['regUrl'] . '/images/';
		umask(0);
		mkdir($mkFile, 0777);
		umask(0);


		if(mkdir($mkImages, 0777)) {

			try{
				//例外処理を投げる（スロー）ようにする
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
				//トランザクション開始
				$dbh->beginTransaction();

				$password = password_hash($_POST['regPassword'], PASSWORD_DEFAULT);
				$key = md5(uniqid(rand(), true));

				$mysql = 'INSERT INTO users(user, password, url, email, phone) VALUES (:user, :password, :url, :email, :phone)';
				$stmt = $dbh->prepare($mysql);
				$params = array(
					':user' => $_POST['regUserName'],
					':password' => $password . $key,
					':url' => $_POST['regUrl'],
					':email' => $mail,
					':phone' => $_POST['regPhone']
				);
				$stmt->execute($params);

				$mysql = 'UPDATE pre_member SET flag=1 WHERE mail=(:mail) AND urltoken=(:urltoken)';
				$stmt = $dbh->prepare($mysql);
				$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
				$stmt->bindValue(':urltoken', $urltoken, PDO::PARAM_STR);
				$stmt->execute();

				$dbh->commit();

				$regSuccess = True;

			} catch (PDOException $e) {
				$dbh->rollBack();
				$errors['error'] = 'もう一度やりなおして下さい。';
				print('Error:' . $e->getMessage());
			}

		} else {
			$error = True;
		}
		
	}

	//データベース接続切断
	$dbh = null;

} else {
	setToken();
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
	<link rel="stylesheet" href="./../Configuration/Function/edit.style.css">
	<?php include_once(dirname(__FILE__) . "/../../Configuration/Config/analyticstracking.php") ?>
</head>
<body>

		<!-- ここからLogin -->

		<div id="login" class="login">
			<?php if(isset($regSuccess)): ?>
				<div class="toLogin">
					<h2>Wonder Homes</h2>
					<h4>無事会員登録は完了しました。</br>早速ログインしてみましょう！</h4>
					<a href="/Landlords/Ownership/Top/">ログイン画面へ</a>
				</div>
			<?php else: ?>
				<div class="toLogin">
					<h2>Wonder Homes</h2>
					<h3>こちらは会員登録画面になります。</br>以下の3つの欄を埋めた後、確認画面に進んでください。</h3>
					<?php if(isset($error)): ?>
						<h3 style="color: #ff0000;">何らかのエラーが発生しました。</br>お手数ですが、再度登録をお願いします。</h3>
					<?php endif; ?>
				</div>

				<div id="login-form">
					<form action="" method="post">

						<p>希望ユーザーネームを</br>入力してください。</br>(ログイン時に必要)</p>
						<h6><?= $errors['userNameSMiss']; ?></h6>
						<h6><?= $errors['userNameMiss']; ?></h6>
						<input type="text" name="userName" value="<?= h($_POST['userName']); ?>">

						<p>希望パスワードを入力してください。</br>(6文字以上)</br>(ログイン時に必要)</p>
						<h6><?= $errors['passwordMiss']; ?></h6>
						<input type="password" name="password" value="<?= h($_POST['password']); ?>">

						<p>パスワード(確認用)</p>
						<h6><?= $errors['passwordNotMatch']; ?></h6>
						<h6><?= $errors['confPasswordMiss']; ?></h6>
						<input type="password" name="conf-password" value="<?= h($_POST['conf-password']); ?>">

						<p>電話番号</br>(ハイフンを含めてください)</p>
						<h6><?= $errors['phoneNotSet']; ?></h6>
						<h6><?= $errors['phoneForm']; ?></h6>
						<input type="text" name="phone" value="<?= h($_POST['phone']); ?>">

						<p>希望URLを入力してください</br>(4文字以上13文字以内で英数字のみ)</p>
						<h6><?= $errors['urlMiss']; ?></h6>
						<h6><?= $errors['urlFormatMiss']; ?></h6>
						<h6><?= $errors['urlLengthMiss']; ?></h6>
						<input type="text" name="url" value="<?= h($_POST['url']); ?>">

						<button type="submit">確認画面</button>
						<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
						<input type="hidden" name="confCheck" value="true">
					</form>
				</div> 
				<div class="new-apply">
					<a href="/Landlords/Ownership/Edit/EditTop/" class="icon-a right-angle">ログイン画面へ</a>
				</div>
			<?php endif; ?>
		</div>

		<!-- ここまでLogin -->

		<?php if(isset($confirm)): ?>
			<div id="regConfirm-overlay" class="regConfirm-overlay">
				<div class="regConfirm-modal">
					<h2>Wonder Homes</h2>
					<form action="" method="post">
						<i class="fa fa-times" aria-hidden="true"></i>

						<p>登録メールアドレス</p>
						<h3><?= h($_SESSION['mail']); ?></h3>

						<p>希望ユーザーネーム</br>(ログイン時に必要)</p>
						<h3><?= h($_POST['userName']); ?></h3>
						<input type="hidden" name="regUserName" value="<?= h($_POST['userName']); ?>">

						<p>希望パスワード</br>(ログイン時に必要)</p>
						<h3><?= h($_POST['password']); ?></h3>
						<input type="hidden" name="regPassword" value="<?= h($_POST['password']); ?>">

						<p>電話番号(数字のみ)</p>
						<h3><?= h($_POST['phone']); ?></h3>
						<input type="hidden" name="regPhone" value="<?= h($_POST['phone']); ?>">

						<p>希望URL</p>
						<h3><?= h($_POST['url']); ?></h3>
						<input type="hidden" name="regUrl" value="<?= h($_POST['url']); ?>">

						<button type="submit">登録する</button>
						<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
						<input type="hidden" name="regCheck" value="true">
					</form>
				</div>
			</div>
		<?php endif; ?>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="./../Configuration/Function/script.js"></script>
</body>
</html>