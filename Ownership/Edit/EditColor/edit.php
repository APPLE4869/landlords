
	<!-- ここからEdit -->

	<div id="content" class="content">
		<div class="content-inner">
			<?php include(dirname(__FILE__) . '/../../../Configuration/Frames/edit_sub.php'); ?>
			<div class="main-content">
				<div class="sub-section-title">
					<h3>イメージカラー</h3>
				</div>

	<!-- ここからUpdate処理結果表示 -->

				<?php if(isset($update)): ?>
					<div class="registration-ok">
						<h2>イメージカラーを変更しました！</h2>
					</div>
				<?php endif; ?>

	<!-- ここまでUpdate処理結果表示 -->

				<div class="edit-imageColor-content cf">
					<form action="" method="post">

						<div class="cf">
						<?php for ($i = 0; $i < count($imageColorsCollection); $i++) : ?>
							<label for="color<?= $url[$i] ?>" class="imageColor-column">
								<?php $checked = ($imageColor == $url[$i])? 'checked':''; ?>
								<input type="radio" id="color<?= $url[$i] ?>" name="imageColor" value="<?= $url[$i]; ?>" <?= $checked; ?>>
								<span style="color: <?= $code[$i]; ?>;"><?= $name[$i]; ?></span>
								<div class="image-picture">
									<img src="../../../Configuration/ImageColor/<?= $image[$i]; ?>">
								</div>
							</label>
						<?php endfor; ?>
						</div>
						
						<button type="submit">変更する</button>
						<input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- ここまでEdit -->
