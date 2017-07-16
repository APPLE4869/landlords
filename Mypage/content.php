
<div class="logout-menu">
	<form action="" method="post">
		<input type="hidden" name="logout" value="true">
		<button type="submit">ログアウト</button>
		<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>"> 
	</form>
</div>

<?php if(isset($conf)): ?>

	<div class="logout">
		<div class="logout-inner">
			<form action="" method="post">
				<p>ログアウトしてもよろしいでしょうか？</p>
				<input type="hidden" name="conf" value="true">
				<button type="submit">ログアウト</button>
				<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>"> 
			</form>
		</div>
	</div>

<?php endif; ?>

<style>

.logout-menu {
	padding-top: 40vh;
}

.logout-menu button {
	cursor: pointer;
	display: block;
	margin: 0 auto;
	width: 150px;
	border-radius: 10px;
	line-height: 38px;
	font-size: 21px;
	text-align: center;
	background: #0080FF;
	border: 2px outset #0080FF;
	color: #fff;

	transition: .3s;
}

.logout-menu button:hover {
	text-shadow: 0 0 5px #fff;

	transition: .3s;
}

.logout-menu button:active {
	border: 2px inset #0080FF;
}

.logout {
	position: fixed;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background: rgba(0, 0, 0, 0.4);
}

.logout-inner form {
	background: #fff;
	position: absolute;
	top: 40vh;
	left: 50%;
	transform: translateX(-50%);
	height: 20vh;
	width: 500px;
	border-radius: 10px;
}

.logout-inner form p {
	font-size: 18px;
	line-height: 10vh;
	text-align: center;
	font-weight: bold;
	color: #2E2E2E;
}

.logout-inner button {
	cursor: pointer;
	display: block;
	margin: 0 auto;
	width: 150px;
	border-radius: 10px;
	line-height: 38px;
	font-size: 21px;
	text-align: center;
	background: #0080FF;
	border: 2px outset #0080FF;
	color: #fff;

	transition: .3s;
}

.logout-inner button:hover {
	text-shadow: 0 0 5px #fff;

	transition: .3s;
}

.logout-inner button:active {
	border: 2px inset #0080FF;
}

</style>