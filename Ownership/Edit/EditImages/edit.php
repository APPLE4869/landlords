	<!-- ここからEdit -->
	
	<div id="content" class="content">
		<div class="content-inner">
			<?php include(dirname(__FILE__) . '/../../../Configuration/Frames/edit_sub.php'); ?>
			<div class="main-content">
				<div class="upload-result">

	<!-- ここからUpload処理結果表示 -->

					<?php if(isset($errorMsg)): ?>
						<h3 class="<?= h($errorMsgColor); ?>"><?= h($errorMsg); ?></h3>
					<?php endif; ?>

	<!-- ここまでUpload処理結果表示 -->

				</div>
				<div class="upload-result-inner">
					<div class="paging-explain">
						<h2>画像アップロード</h2>
						<p>ホームページ制作に使用する画像をアップロードする場所になります。一回に複数の画像をアップロード可能です。</br>(一回最大20ファイルまで)</p>
					</div>
					<form action="" method="post" enctype="multipart/form-data">

						<input type="file" name="file[]" multiple="multiple" accept="image/*">
						<input type="submit" value="アップロード">
						<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
					</form>
					<div class="edit-images">

						<?php foreach($imageFiles as $imageFile): ?>
							<div class="edit-image-coulumn">
								<img src="./../../../../MyHome/Landlord/<?= $_SESSION['userUrl']; ?>/images/<?= h($imageFile); ?>">
								<p><?= h($imageFile); ?></p>
							</div>
						<?php endforeach; ?>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ここまでEdit -->

	<div id="delImg-overlay" class="delImg-overlay">
		<div class="delImg-modal">
			<form action="" method="post">
				<div class="delImg-image">
					<img src="">
				</div>
				<h3>この画像を削除しますか？</h3>
				<input id="delImg-image" type="hidden" name="deleteImg" value="">
				<div class="delImg-btn-column">
					<h4>戻る</h4>
					<button type="submit">削除</button>
				</div>
				<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
			</form>
		</div>
	</div>