
	<!-- ここからEdit -->
	
	<div id="content" class="content">
		<div class="content-inner">
			<?php include(dirname(__FILE__) . '/../../../Configuration/Frames/edit_sub.php'); ?>
			<div class="main-content">
				<div class="sub-section-title">
					<h3>周辺情報登録</h3>
				</div>

	<!-- ここからUpdate処理結果表示 -->

				<?php if(isset($update)): ?>
					<div class="registration-ok">
						<h2>周辺情報の説明事項を</br>変更しました！</h2>
					</div>
				<?php endif; ?>

				<?php if(isset($delete)): ?>
					<div class="registration-ok">
						<h2>周辺施設情報を</br>削除しました！</h2>
					</div>
				<?php endif; ?>

	<!-- ここまでUpdate処理結果表示 -->

				<div class="edit-top-content">

					<div class="locationExplain-inner">
						<form action="" method="post">
							<div class="paging-explain">
								<h2>周辺情報説明</h2>
								<p>立地や地域の特徴についての説明欄になります。周辺のお店の「特徴」や「便利な点」など、お客さんが喜びそうな情報を乗せていただくと、とても良いかと思います。</p>
							</div>
							<textarea name="description"><?= h($locationExplain); ?></textarea>
							<button type="submit">変更する</button>
							<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
						</form>
					</div>

					<div class="edit-location-content">
						<div class="paging-explain">
							<h2>周辺施設情報</h2>
							<p>物件周辺の施設情報を最大15箇所掲載できる場所になります。「施設名」「徒歩所要時間」「施設説明」「地図」を記入していただき、物件周辺の情報を伝えるのにご利用ください。</p>
						</div>
						<table>
						<?php for($i = 0; $i < 15; $i++): ?>
							<tr>
								<?php if(!empty($images_block[$i])): ?>
									<th><img src="./../../../../MyHome/Landlord/<?= $_SESSION['userUrl']; ?>/images/<?= h($images_block[$i]); ?>"></th>
								<?php else: ?>
									<th><img src="../../../Configuration/images/sample.gif"></th>
								<?php endif; ?>
								<?php if(!empty($locationIcons[$i])): ?>
									<th class="location-icon"><img src="./../../../../MyHome/designs/design1/iconImages/<?= h($locationIcons[$i]); ?>"></th>
								<?php else: ?>
									<th class="location-icon"><img src="../../../Configuration/images/sample.gif"></th>
								<?php endif; ?>
								<td class="edit-location-explain">
									<h5>住所：<?= isset($address_block[$i])?h($address_block[$i]):'未入力'; ?></h5>
									<h4>施設名：<?= isset($titles_block[$i])?h($titles_block[$i]):'未入力'; ?></h4>
									<p>説明：<?= isset($explain_block[$i])?h($explain_block[$i]):'未入力'; ?></p>
								</td>
								<td><a href="/Landlords/Ownership/Edit/EditLocationDetail/?id=<?= $i+1; ?>">編集する</a></td>
								<td class="location-delete-btn" id="<?= $i; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></td>
							</tr>
						<?php endfor; ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ここまでEdit -->

	<!-- ここからDelete用Modal -->

	<?php for($i = 0; $i < 15; $i++): ?>
	<div id="locationDelete-overlay-<?= $i; ?>" class="locationDelete-overlay-form">
		<div class="locationDelete-modal-form">
			<form action="" method="post">
				<div class="locationDelete-modal-input">
					<h3>「<?= h($titles_block[$i]); ?>」の</br>周辺情報を削除しますか？</h3>
					<div class="locationDelete-insert">
						<input type="hidden" name="locationDelete" value="<?= $i+1; ?>">
					</div>
				</div>
				<div class="location-btn-column">
					<h4 class="locationDelete-btn">戻る</h4>
				</div>
				<div class="location-btn-column">
					<button type="submit">削除</button>
				</div>
				<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
			</form>
		</div>
	</div>
	<?php endfor; ?>

	<!-- ここまでDelete用Modal -->