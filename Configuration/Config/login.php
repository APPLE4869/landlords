<?php

/* ここからログイン処理 */

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['password'])) {

	$mysql = 'select * from users';
	foreach($dbh->query($mysql) as $row) {
		if($_POST['name'] == $row['user'] || $_POST['name'] == $row['email']) {

			//パスワードを変数にセット
			$password = $row['password'];
			$password = substr($password, 0, -32);

			if(password_verify($_POST['password'], $password)) {
				$_SESSION['userUrl'] = $row['url'];
			} else {
				$errors['password'] = '正しいパスワードを入力してください';
			}
		} else {
			$errors['user'] = '適切なユーザー名またはメールアドレスを入力してください';
		}
			
	}

	//エラーが出た場合、エラー回数を追加
	if(count($errors) > 0) {
		$_SESSION['error-times']++;
	}

}

//エラー回数を0回にセット
if(empty($_SESSION['error-times'])) {
	$_SESSION['error-times'] = 0;
}

/* ここまでログイン処理 */