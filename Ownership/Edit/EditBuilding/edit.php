
	<!-- ここからEdit -->

	<div id="content" class="content">
		<div class="content-inner">
			<?php include(dirname(__FILE__) . '/../../../Configuration/Frames/edit_sub.php'); ?>
			<div class="main-content">
				<div class="sub-section-title">
					<h3>建物情報</h3>
				</div>

	<!-- ここからUpdate処理結果表示 -->

				<?php if(isset($updateText)): ?>
					<div class="registration-ok">
						<h2>建物情報を変更しました！</h2>
					</div>
				<?php endif; ?>

				<?php if(isset($updateImage)): ?>
					<div class="registration-ok">
						<h2>画像情報を変更しました！</h2>
					</div>
				<?php endif; ?>

				<?php if(isset($deleteImage)): ?>
					<div class="registration-ok">
						<h2>画像を削除しました！</h2>
					</div>
				<?php endif; ?>

	<!-- ここまでUpdate処理結果表示 -->

				<div class="edit-building-content">
					<div class="buildingA-images">
						<div class="paging-explain">
							<h2>外観写真</h2>
							<p>本物件の外観写真を2つ掲載する箇所になります。最も物件の印象を左右する箇所ですので、物件をより良く見せる写真をお使いいただくと、とても良い印象をお客様に与えらえるかと思われます。</p>
						</div>
						<form action="" method="post" enctype="multipart/form-data" id="form" class="buildingA-images-area">
							<div id="appearance" class="buildingA-image-column modal-open-click">
								<h3>外観写真1</h3>
								<?php if(!empty($appearance1)): ?>
									<div class="buildingA-image">
										<i id="first" class="fa fa-times" aria-hidden="true"></i>
										<img src="../../../../MyHome/Landlord/<?= h($_SESSION['userUrl']); ?>/images/<?= h($appearance1); ?>">
									</div>
									<label for="topImage0">画像変更</label>
									<input id="topImage0" type="file" name="file0" onChange="$('#form').submit();" style="display: none;">
								<?php else: ?>
									<img src="../../../Configuration/images/sample.gif">
									<label for="topImage0">画像を追加</label>
									<input id="topImage0" type="file" name="file0" onChange="$('#form').submit();" style="display: none;">
								<?php endif; ?>
							</div>
							<div id="appearance" class="buildingA-image-column modal-open-click">
								<h3>外観写真2</h3>
								<?php if(!empty($appearance2)): ?>
									<div class="buildingA-image">
										<i id="second" class="fa fa-times" aria-hidden="true"></i>
										<img src="../../../../MyHome/Landlord/<?= h($_SESSION['userUrl']); ?>/images/<?= h($appearance2); ?>">
									</div>
									<label for="topImage1">画像変更</label>
									<input id="topImage1" type="file" name="file1" onChange="$('#form').submit();" style="display: none;">
								<?php else: ?>
									<img src="../../../Configuration/images/sample.gif">
									<label for="topImage1">画像を追加</label>
									<input id="topImage1" type="file" name="file1" onChange="$('#form').submit();" style="display: none;">
								<?php endif; ?>
							</div>
							<input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
						</form>
					</div>
					<div class="buildingF-images">
						<div class="paging-explain">
							<h2>物件設備写真</h2>
							<p>本物件の設備を最大12種掲載することができる箇所になります。本物件を細かく知りたいというお客様のことを考えると、できるだけ物件の特徴がわかるように、物件内外の場所を掲載いただくと、とても良いかと思われます。</p>
						</div>
						<form id="facilitys-sub" action="" method="post" enctype="multipart/form-data">
							<?php for($i = 2; $i < 14; $i++): ?>
								<div class="buildingF-image-column modal-open-click">
									<h3>物件設備<?= $i - 1; ?></h3>
									<?php if(!empty($facilityImages_block[$i - 2])): ?>
										<div class="buildingF-image">
											<i id="<?= $i-2 ?>" class="fa fa-times" aria-hidden="true"></i>
											<img src="../../../../MyHome/Landlord/<?= h($_SESSION['userUrl']); ?>/images/<?= h($facilityImages_block[$i-2]); ?>">
										</div>
										<label for="topImage<?= $i ?>">画像変更</label>
										<input id="topImage<?= $i ?>" type="file" name="file<?= $i ?>" onChange="$('#facilitys-sub').submit();console.log('change');" style="display: none;">
										<input type="text" name="facilityTexts<?= $i - 2; ?>" value="<?= h($facilityTexts_block[$i-2]); ?>" placeholder="設備名称">
										<textarea name="facilityExplains<?= $i - 2; ?>"><?= h($facilityExplains_block[$i-2]); ?></textarea>

									<?php else: ?>
										
										<div class="buildingF-image">
											<img src="../../../Configuration/images/sample.gif">
										</div>
										<label for="topImage<?= $i ?>">画像を追加</label>
										<input id="topImage<?= $i ?>" type="file" name="file<?= $i ?>" onChange="$('#facilitys-sub').submit();" style="display: none;">

									<?php endif; ?>
								</div>
							<?php endfor; ?>
							<button type="submit">変更する</button>
							<input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
							<input type="hidden" name="facilitysSet" value="true">
						</form>
					</div>
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