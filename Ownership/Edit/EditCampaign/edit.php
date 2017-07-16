
	<!-- ここからEdit -->
	
	<div id="content" class="content">
		<div class="content-inner">
			<?php include(dirname(__FILE__) . '/../../../Configuration/Frames/edit_sub.php'); ?>
			<div class="main-content">
				<div class="sub-section-title">
					<h3>キャンペーン</h3>
				</div>

	<!-- ここからUpdate処理結果表示 -->

				<?php if(isset($updateText)): ?>
					<div class="registration-ok">
						<h2>キャンペーンの文章を</br>変更しました！</h2>
					</div>
				<?php endif; ?>

				<?php if(isset($updateImage)): ?>
					<div class="registration-ok">
						<h2>キャンペーンのイメージ写真を</br>変更しました！</h2>
					</div>
				<?php endif; ?>

				<?php if(isset($deleteImage)): ?>
					<div class="registration-ok">
						<h2>キャンペーンのイメージ写真を</br>削除しました！</h2>
					</div>
				<?php endif; ?>

	<!-- ここまでUpdate処理結果表示 -->

				<div class="edit-campaign-content">
					<form action="" method="post" enctype="multipart/form-data" id="form" class="campaign-image-column">
						<div class="paging-explain">
							<h2>イメージ画像</h2>
							<p>キャンペーンページのイメージ画像です。文字だけでなく画像を挿入することで、お客様がイメージしやすくなりますので、こちらのイメージ画像は挿入しておくことをおススメします。</p>
						</div>
						<?php if(h($image) !== ''): ?>
							<div id="cmp-image" class="cmpImg">
								<span style="background-image:url('../../../../MyHome/Landlord/<?= $_SESSION['userUrl']; ?>/images/<?= h($image); ?>');">
								<i id="0" class="fa fa-times" aria-hidden="true"></i>
							</div>
							<label for="cmpImgIn">画像を変更</label>
							<input id="cmpImgIn" type="file" name="file" onChange="$('#form').submit();" style="display: none;">
						<?php else: ?>
							<div class="cmpImg">
								<span style="background-image:url('../../../Configuration/images/sample.gif');">
							</div>
							<label for="cmpImgOut">画像を追加</label>
							<input id="cmpImgOut" type="file" name="file" onChange="$('#form').submit();" style="display: none;">
						<?php endif; ?>
						<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
					</form>
					<form action="" method="post">
						<div class="paging-explain">
							<h2>告知メッセージ</h2>
							<p>物件購入にあたり、「期間限定の特典」や「お勧めポイント」などをアピールする場所になります。お客様としても、こういったキャンペーンがあると、購入意欲が高まりますので、できるだけ入力することをおススメします。</p>
						</div>
						<textarea name="description"><?= h($comment); ?></textarea>
						<button type="submit">変更する</button>
						<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- ここまでEdit -->

	<!-- ここから画像削除用Modal -->

	<div id="delImg-overlay" class="delImg-overlay">
		<div class="delImg-modal">
			<form action="" method="post">
				<div class="delImg-image">
					<img src="">
				</div>
				<h3>この画像を削除しますか？</h3>
				<div class="delImg-btn-column">
					<h4>戻る</h4>
					<button type="submit">削除</button>
				</div>
				<input id="imgId" type="hidden" name="imgId" value="">
				<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
			</form>
		</div>
	</div>

	<!-- ここまで画像削除用Modal -->