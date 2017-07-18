
<?php if($_SESSION['error-times'] < 3): ?>

	<!-- ここからLogin -->

	<div id="login" class="login">
		<div class="login-title">
			<h2>Wonder Homes</h2>
		</div>

		<div id="login-form">
			<form action="" method="post">
				<p>ユーザー名またはメールアドレス</p>
				<?php if (isset($errors['user'])) : ?>
					<h6><?= $errors['user']; ?></h6>
				<?php endif; ?>
				<input type="text" name="name">
				<p>パスワード</p>
				<?php if (isset($errors['password'])) : ?>
					<h6><?= $errors['password']; ?></h6>
				<?php endif; ?>
				<input type="password" name="password">
				<button type="submit">ログイン</button>
			</form>
		</div>
		<div class="new-apply">
			<a href="/Landlords/Registration/password.php" class="icon-a right-angle">パスワードをお忘れですか？</a></br>
			<a href="/Landlords/Registration/" class="icon-a right-angle">新規会員申し込み</a>
		</div>
	</div>

	<!-- ここまでLogin -->

<?php else: ?>

	<!-- ここからError -->

	<div id="login" class="login">
		<div class="login-title">
			<h2>Wonder Homes</h2>
		</div>

		<div id="login-form">
			<h5>3回のログインエラーにより本サイトはあなたへのサービスを停止します。</br>会員登録の際は下の項目から進んでください。</br>再ログインを希望される場合は、下のメールアドレスまたは公式LINE@の方までご報告をお願い致します。</br>apple.4869.s@gmail.com</h5>
		</div>
		<div class="new-apply">
			<a href="/Landlords/Registration/" class="icon-a right-angle">新規会員申し込み</a>
		</div>
	</div>

	<!-- ここまでError -->

<?php endif; ?>