
	<!-- ここからEdit -->

	<div id="content" class="content">
		<div class="content-inner">
			<?php include(dirname(__FILE__) . '/../../../Configuration/Frames/edit_sub.php'); ?>
			<div class="main-content">
				<div class="sub-section-title">
					<h3>周辺情報登録</h3>
				</div>

	<!-- ここからUpdate処理結果表示 -->

				<?php if(isset($updateDescription)): ?>
					<div class="registration-ok">
						<h2>説明事項を変更しました！</h2>
					</div>
				<?php endif; ?>

				<?php if(isset($imgCheck)): ?>
					<div class="registration-ok">
						<h2>イメージ画像を変更しました！</h2>
					</div>
				<?php endif; ?>

				<?php if(isset($deleteImage)): ?>
					<div class="registration-ok">
						<h2>イメージ画像を削除しました！</h2>
					</div>
				<?php endif; ?>

				<?php if(count($errors)): ?>
					<div class="registration-ok">
						<h2>画像変更に失敗しました！</h2>
					</div>
				<?php endif; ?>


	<!-- ここまでUpdate処理結果表示 -->

				<div class="edit-top-content">
					<div class="edit-locationD-content">
						<form action="" method="post" enctype="multipart/form-data" id="form">
							<div class="paging-explain">
								<h2>周辺施設情報</h2>
								<p>物件周辺の施設情報を最大15箇所掲載できる場所になります。「施設名」「徒歩所要時間」「施設説明」「地図」を記入していただき、物件周辺の情報を伝えるのにご利用ください。</p>
							</div>
							<div class="locationD-inner">
								<?php if(!empty($image)): ?>
									<div id="lcdImg" class="lcdImg">
										<span style="background-image:url('../../../../MyHome/Landlord/<?= $_SESSION['userUrl']; ?>/images/<?= h($image); ?>');">
										<i id="in" class="fa fa-times" aria-hidden="true"></i>
									</div>
									<label for="lcdIn">画像変更</label>
									<input id="lcdIn" type="file" name="file" onChange="$('#form').submit();" style="display: none;">
								<?php else: ?>
									<div class="lcdImg">
										<span style="background-image:url('../../../Configuration/images/sample.gif');">
									</div>
									<label for="lcdOut">画像を追加</label>
									<input id="lcdOut" type="file" name="file" onChange="$('#form').submit();" style="display: none;">
								<?php endif; ?>
								<div class="locationD-explains-column">
									<h5>施設名</h5>
									<input type="type" name="title" value="<?= isset($title)?h($title):''; ?>" placeholder="施設名">
								</div>
								<div class="locationD-explains-column cf">
									<h5>徒歩所要時間(数字のみ入力)</h5>
									<div class="locationD-time-column cf">
										<p>徒歩</p>
										<input type="type" name="time" value="<?= isset($time)?h($time):''; ?>"><p>分</p>
									</div>
								</div>
								<div class="locationD-explains-column">
									<h5>地図表示用アイコン</h5>
									<select name="locationDetail-icon">
										<option value="">--選択--</option>
										<?php for($i = 0; $i < count($icons); $i++): ?>
											<?php $iconSelect = ($icon == $i)? 'selected':''; ?>
											<option value="<?= $i; ?>" <?= $iconSelect ?>><?= $icons[$i]; ?></option>
										<?php endfor; ?>
									</select>
								</div>
								<div class="locationD-explains-column">
									<h5>施設説明</h5>
									<textarea name="explain"><?= isset($explain)?h($explain):''; ?></textarea>
								</div>
								<div class="locationD-address-columns">
									<div class="locationD-address-column postal-code">
										<p>郵便番号</p>
										<input type="text" name="zip1" maxlength="3" value="<?= isset($zip1)?$zip1:''; ?>"><span>-</span><input type="text" name="zip2" maxlength="4" onKeyUp="AjaxZip3.zip2addr('zip1','zip2','pref','addr1','addr2');" value="<?= isset($zip2)?$zip2:''; ?>">
									</div></br>
									<div class="locationD-address-column">
										<p>都道府県</p>
										<input type="text" id="pref" name="pref" value="<?= isset($pref)?h($pref):''; ?>">
									</div>
									<div class="locationD-address-column">
										<p>以降の住所</p>
										<input type="text" id="addr1" name="addr1" value="<?= isset($addr1)?h($addr1):''; ?>">
										<input type="text" id="addr2" name="addr2" value="<?= isset($addr2)?h($addr2):''; ?>">
									</div>
								</div>
								<div class="locationDetail-maping">
									<div id="map-click">
										<h3>地図を表示する</h3>
										<p>※住所入力後は必ず地図を表示させてください。</p>
									</div>
									<div class="googleMap-size">
										<div id="map_canvas"></div>
									</div>
									<input type="hidden" id="lat" name ="lat" value="<?= isset($lat)?h($lat):''; ?>">
									<input type="hidden" id="lng" name ="lng" value="<?= isset($lng)?h($lng):''; ?>">
								</div>
							</div>
							<button type="submit">変更する</button>
							<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
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