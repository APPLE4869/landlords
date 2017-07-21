
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
			<div class="new-building">
				<?php if($group == '無料会員' && $buildingRegLock == 'true'): ?>
					<p>無料会員の場合、</br>物件登録は2つまでです。</p>
				<?php elseif($group == '無料会員'): ?>
					<p>無料会員の場合、2つまで登録可能です。</p>
					<a href="/Landlords/Ownership/Registration/">物件登録</a>
				<?php else: ?>
					<a href="/Landlords/Ownership/Registration/">物件登録</a>
				<?php endif; ?>
			</div>
			<div class="main-content">
				<div class="building-columns">
					<div class="sub-section-title">
						<h3>所有物件</h3>
					</div>
					<?php for($i = 0; $i < $buildingNum; $i++): ?>
						<div class="building-column">
							<div class="building-image">
								<?php if(!empty($perImage[$i][0])): ?>
									<img src="../../../MyHome/Landlord/<?= h($_SESSION['userUrl']); ?>/images/<?= h($perImage[$i][0]); ?>">
								<?php else: ?>
									<img src="../../Configuration/images/sample.gif">
								<?php endif; ?>
							</div>
							<div class="building-feature">
								<table>
									<tr>
										<th>物件名(愛称)</th>
										<td><?= h($perTitle[$i]); ?></td>
									</tr>
									<tr>
										<th>所在地</th>
										<td><?= h($perAddress[$i]); ?></td>
									</tr>
									<tr>
										<th>入居中/総戸数</th>
										<td><?= h($perUnits[$i]); ?></td>
									</tr>
									<tr>
										<th>ホームページ公開状況</th>
										<td class="<?= h($publicClass[$i]); ?>"><h5><?= h($public[$i]); ?></h5></td>
									</tr>
								</table>
								<ul class="cf">
									<li class="building-feature-btn1"><a href="/Landlords/Ownership/Edit?id=<?= $hadBuilding[$i] ?>">物件概要</a></li>
									<li class="building-feature-btn1"><a href="/Landlords/Ownership/Edit/EditRoom/?id=<?= $hadBuilding[$i] ?>">部屋一覧</a></li>
									<li class="building-feature-btn2"><a href="/Landlords/Ownership/Edit/EditManage?id=<?= $hadBuilding[$i] ?>">ホームページ管理</a></li>
									<i id="<?= $i; ?>" class="building-delete-btn fa fa-trash-o" aria-hidden="true"></i>
								</ul>
							</div>
						</div>
					<?php endfor; ?>
				</div>
			</div>
		</div>
	</div>

	<!-- ここまでContent -->

	<?php for($i = 0; $i < count($hadBuilding); $i++): ?>
	<div id="buildingDelete-overlay-<?= $i; ?>" class="buildingDelete-overlay-form">
		<div class="buildingDelete-modal-form">
			<form action="" method="post">
				<div class="buildingDelete-modal-input">
					<h3>「<?= h($perTitle[$i]); ?>」の</br>物件情報を削除しますか？</h3>
					<div class="buildingDelete-insert">
						<input type="hidden" name="buildingDelete" value="<?= $hadBuilding[$i]; ?>">
					</div>
				</div>
				<div class="building-btn-column">
					<h4 class="buildingDelete-btn">戻る</h4>
				</div>
				<div class="building-btn-column">
					<button type="submit">削除</button>
				</div>
				<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
			</form>
		</div>
	</div>
	<?php endfor; ?>

	<!-- ここまでDelete用Modal -->