<?php

	session_start();

	require_once(dirname(__FILE__) . '/../Configuration/Config/database.php');
	require_once(dirname(__FILE__) . '/../Configuration/Config/config.php');

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token']) && isset($_POST['phone']) && isset($_POST['mail'])) {
		checkToken();

		header('X-FRAME-OPTIONS: SAMEORIGIN');

		$phone = $_POST['phone'];
		$mail = $_POST['mail'];
		$errors = [];

		if($_POST['mail'] == '') {
			$errors['mailNotSet'] = 'メールアドレスを入力してください';
		} elseif(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)){
			$errors['mailForm'] = "メールアドレスの形式が正しくありません。";
		}

		if($_POST['phone'] == '') {
			$errors['phoneNotSet'] = '電話番号を入力してください';
		} elseif(!preg_match("/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/", $phone)) {
			$errors['phoneForm'] = "電話番号の形式が正しくありません。";
		} else {
			
			$errors['phoneNotMatch'] = "電話番号が正しくない可能性があります";

			$mysql = 'select * from users';
			foreach($dbh->query($mysql) as $row) {
				if($phone == $row['phone']) {
					unset($errors['phoneNotMatch']);
					if($mail !== $row['email']) {
						$errors['mailNotMatch'] = 'メールアドレスが正しくありません';
					}
				}
			}

		}



		if (count($errors) === 0){
		
			$urltoken = hash('sha256',uniqid(rand(),1));
			$url = "http://groups.sub.jp/Landlords/Registration/again.php/"."?urltoken=".$urltoken;
			
			//ここでデータベースに登録する
			try{
				//例外処理を投げる（スロー）ようにする
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$mysql = 'UPDATE users SET token=:token WHERE email=:email AND phone=:phone';
				$stmt = $dbh->prepare($mysql);
				
				//プレースホルダへ実際の値を設定する
				$stmt->bindValue(':token', $urltoken, PDO::PARAM_STR);
				$stmt->bindValue(':email', $mail, PDO::PARAM_STR);
				$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
				$stmt->execute();
					
				//データベース接続切断
				$dbh = null;	
				
			}catch (PDOException $e){
				print('Error:'.$e->getMessage());
				die();
			}

			//メールの宛先
			$mailTo = $mail;
		 
			//Return-Pathに指定するメールアドレス
			$returnMail = 'wonder.homes.1234@gmail.com';
		 
			$name = "Wonder Homes";
			$mail = 'wonder.homes.1234@gmail.com';
			$subject = "【Wonder Homes】パスワード再設定";
		 
			$body = '24時間以内に下記のURLからパスワードを再設定してください。
URLをクリックすると、

	・新希望パスワード
	・新希望パスワード(確認用)

	を入力する欄がありますので、
	記入の上パスワードを再設定してください。

' . $url . '

Wonder Homes';
		 
			mb_language('ja');
			mb_internal_encoding('UTF-8');
		 
			//Fromヘッダーを作成
			$header = 'From: ' . mb_encode_mimeheader($name). ' <' . $mail. '>';
		 
			if (mb_send_mail($mailTo, $subject, $body, $header, '-f'. $returnMail)) {
			
			 	//セッション変数を全て解除
				$_SESSION = [];
			
				//クッキーの削除
				if (isset($_COOKIE["PHPSESSID"])) {
					setcookie("PHPSESSID", '', time() - 1800, '/');
				}
			
		 		//セッションを破棄する
		 		session_destroy();
		 		$regSuccess = 'ture';
		 	
			 } else {
				$errors['mail_error'] = "メールの送信に失敗しました。";
			}	
		}

	} else {
		setToken();
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Wonder Homes仮登録画面</title>
	<meta name="Keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./../Configuration/Function/style.css">
	<link rel="stylesheet" href="./../Configuration/Function/edit.style.css">
</head>
<body>


	<div id="login" class="login">

		<div class="toLogin">
			<h2>Wonder Homes</h2>
			<?php if(isset($regSuccess)): ?>
				<h4>登録されているメールアドレス宛に</br>パスワードを再登録するためのメールを</br>送りましたので、</br>再登録を進めてください。</br><span class="red">メールが届かない場合は</br>迷惑メールフォルダーを確認してみてください。</span></h4>
				<a href="/Landlords/Ownership/Top/">ログイン画面へ</a>
			<?php else: ?>
				<h3>パスワード再設定のため</br>下2つの確認事項について</br>入力をお願いします</h3>
				<h3 style="color: #ff0000;"><?= $errors['mail_error']; ?></h3>
			<?php endif; ?>
		</div>

		<?php if(empty($regSuccess)): ?>
		<div id="login-form">
			<form action="" method="post">

				<p>登録されている電話番号を</br>入力してください</br>(番号のみ入力)</p>
				<h6><?= $errors['phoneNotSet']; ?></h6>
				<h6><?= $errors['phoneForm']; ?></h6>
				<h6><?= $errors['phoneNotMatch']; ?></h6>
				<input type="text" name="phone" value="<?= $_POST['phone']; ?>">

				<p>登録されているメールアドレスを</br>入力してください</p>
				<h6><?= $errors['mailNotSet']; ?></h6>
				<h6><?= $errors['mailForm']; ?></h6>
				<h6><?= $errors['mailNotMatch']; ?></h6>
				<input type="text" name="mail" value="<?= $_POST['mail']; ?>">

				<button type="submit">確認画面</button>
				<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
			</form>
		</div> 
		<div class="new-apply">
			<a href="/Landlords/Ownership/Edit/EditTop/" class="icon-a right-angle">ログイン画面へ</a>
		</div>
		<?php endif; ?>

	</div>

 
</body>
</html>