<?php

	session_start();

	require_once(dirname(__FILE__) . '/../Configuration/Config/database.php');
	require_once(dirname(__FILE__) . '/../Configuration/Config/config.php');

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mail'])) {
		checkToken();

		header('X-FRAME-OPTIONS: SAMEORIGIN');

		$errors = [];

		if(empty($_POST)) {
			header('Location: index.php');
			exit();
		} else {
		
			$mail = isset($_POST['mail']) ? $_POST['mail'] : NULL;

			if ($mail == ''){
				$errors['mail'] = "メールアドレスが入力されていません。";
			}else{
				if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)){
					$errors['mail_check'] = "メールアドレスの形式が正しくありません。";
				}
				
				
				$mysql = 'select * from users';
				foreach($dbh->query($mysql) as $row) {
					if($row['email'] == $mail) {
						$errors['member_check'] = "このメールアドレスはすでに利用されております。";
					}
				}
				
			}

		}

		if (count($errors) === 0){
		
			$urltoken = hash('sha256',uniqid(rand(),1));
			$url = "http://groups.sub.jp/Landlords/Registration/reg.php/"."?urltoken=".$urltoken;
			
			//ここでデータベースに登録する
			try{
				//例外処理を投げる（スロー）ようにする
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$statement = $dbh->prepare("INSERT INTO pre_member (urltoken,mail,date) VALUES (:urltoken,:mail,now() )");
				
				//プレースホルダへ実際の値を設定する
				$statement->bindValue(':urltoken', $urltoken, PDO::PARAM_STR);
				$statement->bindValue(':mail', $mail, PDO::PARAM_STR);
				$statement->execute();
					
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
			$subject = "【Wonder Homes】会員登録用メール";
		 
			$body = '24時間以内に下記のURLから会員登録画面に進んでください。
URLをクリックすると、

	・希望ユーザーネーム(ログイン時必要)
	・希望パスワード(ログイン時必要)
	・希望パスワード(確認用)
	・希望ホームページ用URL

	を入力する欄がありますので、
	記入の上確認画面に進んでいただくと
	会員登録が無事完了し、

	【Wonder Homes】のサービスを
	ご利用いただけます。

' . $url . '

Wonder Homes';

			$subject_me = '【Wonder Homes】仮会員登録';
			$body_me = '仮登録が行われました。

URLとメールアドレスはこちらになります。

' . $url . '

' . $mailTo . '

';
		 
			mb_language('ja');
			mb_internal_encoding('UTF-8');
		 
			//Fromヘッダーを作成
			$header = 'From: ' . mb_encode_mimeheader($name). ' <' . $mail. '>';

			if (mb_send_mail($mailTo, $subject, $body, $header, '-f'. $returnMail)) {

				mb_send_mail($mail, $subject_me, $body_me, $header, '-f'. $returnMail);
			
			 	//セッション変数を全て解除
				$_SESSION = [];
			
				//クッキーの削除
				if (isset($_COOKIE["PHPSESSID"])) {
					setcookie("PHPSESSID", '', time() - 1800, '/');
				}
			
		 		//セッションを破棄する
		 		session_destroy();
		 	
		 	
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
	<?php include_once(dirname(__FILE__) . "/../Configuration/Config/analyticstracking.php") ?>
</head>
<body>
 
 <div id="login" class="login">

		<div class="toLogin">
			<h2>Wonder Homes</h2>
			<?php if (count($errors) === 0): ?>
				<h4>本登録用のメールが「Wonder Homes」より</br>下のメールアドレス宛に送信されますので、</br>メールに記載されたURLから会員登録を行ってください。</br></br><?= $mailTo; ?></br></br><span class="red">お手数ですが、メールが届かない場合は迷惑メールフォルダーを確認してみてください。</span></h4>
			<?php elseif(count($errors) > 0): ?>
				<?php foreach($errors as $value): ?>
					<h3 style="color: #ff0000;"><?= h($value); ?></h3>
				<?php endforeach; ?>
				<a href="javascript:history.back();">戻る</a>
			<?php endif; ?>
		</div>
	 
 </div>

 
</body>
</html>