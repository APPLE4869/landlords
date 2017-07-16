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
			$stmt = $dbh->prepare("SELECT email FROM users WHERE token=(:token) AND modified > now() - interval 24 hour");
			$stmt->bindValue(':token', $urltoken, PDO::PARAM_STR);
			$stmt->execute();

			$row_count = $stmt->rowCount();

			if($row_count == 1){
				$mail_array = $stmt->fetch();
				$mail = $mail_array['email'];
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

		if(mb_strlen($_POST['password']) >= 6 && $_POST['password'] == $_POST['conf-password']) {

			$confirm = True;

		} else {

			if(mb_strlen($_POST['password']) < 6 && !empty($_POST['password'])) {
				$errors['passwordMiss'] = '6文字以上のパスワードを入力してください';
			} elseif(empty($_POST['password'])) {
				$errors['passwordMiss'] = 'パスワードを入力してください';
			}
			if(empty($_POST['conf-password'])) {
				$errors['confPasswordMiss'] = '確認用パスワードを入力してください';
			}
			if($_POST['password'] !== $_POST['conf-password']) {
				$errors['passwordNotMatch'] = 'パスワードが一致しません';
			}
		}

	}


	if(isset($_POST['regCheck']) && isset($_POST['regPassword'])) {

		$mail = $_SESSION['mail'];

		try{

			//例外処理を投げる（スロー）ようにする
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
			//トランザクション開始
			$dbh->beginTransaction();

			$password = password_hash($_POST['regPassword'], PASSWORD_DEFAULT);
			$key = md5(uniqid(rand(), true));

			$mysql = 'UPDATE users SET password=:password WHERE email=:email';
			$stmt = $dbh->prepare($mysql);
			$params = array(
				':password' => $password . $key,
				':email' => $mail
			);
			$stmt->execute($params);

			$mysql = 'UPDATE users SET token=null WHERE email=:email';
			$stmt = $dbh->prepare($mysql);
			$stmt->bindValue(':email', $mail, PDO::PARAM_STR);
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
	<?php include_once(dirname(__FILE__) . "/../Configuration/Config/analyticstracking.php") ?>
</head>
<body>

		<!-- ここからLogin -->

		<div id="login" class="login">
			<?php if(isset($regSuccess)): ?>
				<div class="toLogin">
					<h2>Wonder Homes</h2>
					<h4>パスワードを再設定しました。</br>早速ログインしてみましょう！</h4>
					<a href="/Landlords/Ownership/Top/">ログイン画面へ</a>
				</div>
			<?php else: ?>
				<div class="toLogin">
					<h2>Wonder Homes</h2>
					<h3>新しく登録されたいパスワードを</br>入力してください</h3>
					<h3><?= $errors['error']; ?></h3>
				</div>

				<div id="login-form">
					<form action="" method="post">

						<p>希望パスワードを入力してください。</br>(6文字以上)</br>(ログイン時に必要)</p>
						<h6><?= $errors['passwordMiss']; ?></h6>
						<input type="password" name="password" value="<?= h($_POST['password']); ?>">

						<p>パスワード(確認用)</p>
						<h6><?= $errors['passwordNotMatch']; ?></h6>
						<h6><?= $errors['confPasswordMiss']; ?></h6>
						<input type="password" name="conf-password" value="<?= h($_POST['conf-password']); ?>">

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

						<p>再設定パスワード</p>
						<h3><?= h($_POST['password']); ?></h3>
						<input type="hidden" name="regPassword" value="<?= h($_POST['password']); ?>">

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