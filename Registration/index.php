<?php 

session_start();

require_once(dirname(__FILE__) . '/../Configuration/Config/config.php');

header('X-FRAME-OPTIONS: SAMEORIGIN');

setToken();

?>
<!DOCTYPE html>
<html lang="ja">
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

		<!-- ここからLogin -->

		<div id="login" class="login">

				<div class="toLogin">
					<h2>Wonder Homes</h2>
					<h3>新規会員登録メールアドレス確認画面</br>こちらは「大家」専用サービスですので、</br>現在「大家」ではない方が登録された場合、</br>発覚次第、強制的にアカウント情報を削除させていただきます。</h3>
				</div>

				<div id="login-form">
					<form action="mail_check.php" method="post">

						<p>メールアドレスを入力してください。</p>
						<h6><?= (isset($mailMiss)) ? 'メールアドレスを入力してください': ''; ?></h6>
						<input type="text" name="mail">

						<button type="submit">確認画面</button>
						<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
					</form>
				</div> 
				<div class="new-apply">
					<a href="/Landlords/Ownership/Edit/EditTop/" class="icon-a right-angle">ログイン画面へ</a>
				</div>

		</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="./../Configuration/Function/script.js"></script>
</body>
</html>