
	<!-- ここからContent -->

	<div id="nav-menu" class="nav-menu">
		<i class="fa fa-bars" aria-hidden="true"></i>
		<h4>MENU</h4>
	</div>
	
	<div id="content" class="content">
		<div class="content-inner">
			<div id="sub-content" class="sub-content">
				<div class="sub-content-title">
					<h3>所有物件</h3>
				</div>
				<div class="sub-content-list">
					<ul>
						<?php for($i = 0; $i < $buildingNum; $i++): ?>
							<li class="sub-list-primary"><a href="/Landlords/Ownership/Edit?id=<?= $hadBuilding[$i] ?>"><?= h($perTitle[$i]); ?></a></li>
						<?php endfor; ?>
					</ul>
				</div>
			</div>
			<div class="main-content">
				<div class="registration-inner">
					<div class="sub-section-title">
						<h3>新規物件登録</h3>
					</div>
					<h5>あなたの物件の希望URLを入力後、「登録する」に進んでください。</br>編集は登録後に行えます。</h5>
					<?php if(isset($reg_ok)): ?>
						<div class="registration-ok">
							<h2>登録が無事完了しました！<br>詳細情報を入力しましょう！</h2>
						</div>
					<?php endif; ?>
					<?php if(isset($urlFomat)): ?>
						<div class="registration-ok">
							<h2>urlは英数文字で登録してください。</h2>
						</div>
					<?php endif; ?>
					<?php if($urlCheck === False): ?>
						<div class="registration-ok">
							<h2>すでに存在するURL名です。</br>違うURLを指定してください。</h2>
						</div>
					<?php endif; ?>
					<div class="registration-insert">
						<form action="" method="post">
							<h4>物件名</h4>
							<p>後からでも変更可能です</p>
							<input type="text" name="buildingsName">
							<h4>希望URL</h4>
							<p>二度と変更はできません。</p>
							<p>例:simizu, himawari</br>(/を含まないようローマ字のみでお願いします。)</p>
							<input type="text" name="url">
							<button type="submit">登録する</button>
							<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ここまでContent -->