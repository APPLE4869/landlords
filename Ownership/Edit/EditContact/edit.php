
	<!-- ここからEdit -->
	
	<div id="content" class="content">
		<div class="content-inner">
			<?php include(dirname(__FILE__) . '/../../../Configuration/Frames/edit_sub.php'); ?>
			<div class="main-content">
				<div class="sub-section-title">
					<h3>電話からのお問い合わせ設定</h3>
				</div>

	<!-- ここからUpdate処理結果表示 -->

				<?php if(isset($update)): ?>
					<div class="registration-ok">
						<h2>お問い合わせ設定を</br>変更しました！</h2>
					</div>
				<?php endif; ?>

	<!-- ここまでUpdate処理結果表示 -->

				<div class="edit-top-content">
					<div class="edit-contact-content">
						<form action="" method="post">
							<h3>お問い合わせ先</h3>
							<input type="text" name="name" value="<?= h($name); ?>">
							<h3>お問い合わせ先電話番号</h3>
							<div class="contact-noChange-area" onClick="alert('電話番号は変更できません');">
								<h4><?= h($phone); ?></h4>
							</div>
							<h3>お問い合わせ受信用</br>メールアドレス</h3>
							<div class="contact-noChange-area" onClick="alert('メールアドレスは変更できません');">
								<h4><?= h($mail); ?></h4>
							</div>
							<h3>コメント1</h3>
							<textarea name="message1"><?= $message1; ?></textarea>
							<h3>コメント2</h3>
							<textarea name="message2"><?= $message2; ?></textarea>
							<button type="submit">変更する</button>
							<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ここまでEdit -->