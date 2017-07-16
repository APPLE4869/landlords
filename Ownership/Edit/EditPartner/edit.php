
	<!-- ここからEdit -->
	
	<div id="content" class="content">
		<div class="content-inner">
			<?php include(dirname(__FILE__) . '/../../../Configuration/Frames/edit_sub.php'); ?>
			<div class="main-content">
				<div class="sub-section-title">
					<h3>建物情報編集</h3>
				</div>

	<!-- ここからUpdate処理結果表示 -->

				<?php if(isset($update)): ?>
					<div class="registration-ok">
						<h2>建物情報を変更しました！</h2>
					</div>
				<?php endif; ?>

	<!-- ここまでUpdate処理結果表示 -->

				<div class="edit-partner-content">
					<form action="" method="post" name="form">
						<table>
							<tr>
								<th>建物名<span class="red">※</span></th>
								<td>
									<div class="partner-text-input">
										<input type="text" name="name" value="<?= h($buildingName); ?>">
									</div>
								</td>
							</tr>
							<tr>
								<th>愛称<span class="red">※</span></th>
								<td>
									<div class="partner-text-input">
										<input type="text" name="nickname" value="<?= h($petName); ?>">
										<p>ホームページには反映されません。</p>
									</div>
								</td>
							</tr>
							<tr>
								<th>取得年月</th>
								<td>
									<div class="partner-text-input">
										<input type="text" name="getDay" value="<?= h($getDay); ?>">
										<p>ホームページには反映されません。</p>
									</div>
								</td>
							</tr>
							<tr>
								<th>取得価格</th>
								<td>
									<div class="partner-num-input">
										<div class="partner-else-column">
											<input type="text" name="getValue" value="<?= h($getMoney); ?>">万円
										</div>
										<div class="partner-else-column">
											取得時利回り<input type="text" name="yield" value="<?= h($getYeild); ?>">%
										</div>
									</div>
									<div class="partner-else-column">
										価格公開
										<select name="moneyPublic">
											<option value="0" <?= $gMPublicSelect[0]; ?>>公開</option>
											<option value="1" <?= $gMPublicSelect[1]; ?>>非公開</option>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<th>種目<span class="red">※</span></th>
								<td>
									<select name="type">
										<?php $check = ($speaces == 'アパート')?'selected':''; ?>
										<option value="アパート" <?= $check; ?>>アパート</option>
										<?php $check = ($speaces == 'マンション')?'selected':''; ?>
										<option value="マンション" <?= $check; ?>>マンション</option>
										<?php $check = ($speaces == 'ハイツ/コーポ')?'selected':''; ?>
										<option value="ハイツ/コーポ" <?= $check; ?>>ハイツ/コーポ</option>
										<?php $check = ($speaces == 'テラスハウス')?'selected':''; ?>
										<option value="テラスハウス" <?= $check; ?>>テラスハウス</option>
										<?php $check = ($speaces == 'タウンハウス')?'selected':''; ?>
										<option value="タウンハウス" <?= $check; ?>>タウンハウス</option>
										<?php $check = ($speaces == '一戸建て')?'selected':''; ?>
										<option value="一戸建て" <?= $check; ?>>一戸建て</option>
										<?php $check = ($speaces == 'シェアハウス')?'selected':''; ?>
										<option value="シェアハウス" <?= $check; ?>>シェアハウス</option>
										<?php $check = ($speaces == '店舗・事務所')?'selected':''; ?>
										<option value="店舗・事務所" <?= $check; ?>>店舗・事務所</option>
										<?php $check = ($speaces == '店舗付き住宅')?'selected':''; ?>
										<option value="店舗付き住宅" <?= $check; ?>>店舗付き住宅</option>
										<?php $check = ($speaces == '事業用建物')?'selected':''; ?>
										<option value="事業用建物" <?= $check; ?>>事業用建物</option>
										<?php $check = ($speaces == 'その他')?'selected':''; ?>
										<option value="その他" <?= $check; ?>>その他</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>建物構造<span class="red">※</span></th>
								<td>
									<select name="construct">
										<?php $check = ($construct == '木造')?'selected':''; ?>
										<option value="木造" <?= $check; ?>>木造</option>
										<?php $check = ($construct == '軽量鉄骨造')?'selected':''; ?>
										<option value="軽量鉄骨造" <?= $check; ?>>軽量鉄骨造</option>
										<?php $check = ($construct == '鉄骨造')?'selected':''; ?>
										<option value="鉄骨造" <?= $check; ?>>鉄骨造</option>
										<?php $check = ($construct == '鉄筋コンクリート造')?'selected':''; ?>
										<option value="鉄筋コンクリート造" <?= $check; ?>>鉄筋コンクリート造</option>
										<?php $check = ($construct == '鉄骨鉄筋コンクリート造')?'selected':''; ?>
										<option value="鉄骨鉄筋コンクリート造" <?= $check; ?>>鉄骨鉄筋コンクリート造</option>
										<?php $check = ($construct == 'その他')?'selected':''; ?>
										<option value="その他" <?= $check; ?>>その他</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>築年月(西暦)<span class="red">※</span></th>
								<td>
									<select name="year">
										<?php for($i = 2017; $i >= 1940; $i--): ?>
											<?php $yearCheck = ($oldYear == $i) ? 'selected':''; ?>
											<option value="<?= $i; ?>" <?= $yearCheck; ?>><?= $i; ?><p>年</p>
										<?php endfor; ?>
									</select>
									<select name="month">
										<?php for($i = 1; $i <= 12; $i++): ?>
											<?php $monthCheck = ($oldMonth == $i) ? 'selected':''; ?>
											<option value="<?= $i; ?>" <?= $monthCheck; ?>><?= $i; ?><p>月</p>
										<?php endfor; ?>
									</select>
								</td>
							</tr>
							<tr>
								<th>階層<span class="red">※</span></th>
								<td>
									<div class="partner-num-input">
										地上<input type="text" name="story" value="<?= h($story); ?>">階
										地下<input type="text" name="underground" value="<?= $underground; ?>">階
									</div>
								</td>
							</tr>
							<tr>
								<th>駐車場<span class="red">※</span></th>
								<td>
									<div class="partner-else-column">
										<div class="partner-num-input">
											<input type="text" name="parking-num" value="<?= $parkingNum; ?>">台
										</div>
									</div>
									<div class="partner-else-column">
										<select name ="parking-situation">
											<?php $check = ($parkingSituation == '空きなし')?'selected':''; ?>
											<option value="空きなし" <?= $check; ?>>空きなし</option>
											<?php $check = ($parkingSituation == '空きあり')?'selected':''; ?>
											<option value="空きあり" <?= $check; ?>>空きあり</option>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<th>住所<span class="red">※</span></th>
								<td>
									<div class="partner-text-input">
										<div class="partner-address-column postal-code">
											<p>郵便番号</p>
											<input type="text" name="zip1" maxlength="3" value="<?= $zip1; ?>"><span>-</span><input type="text" name="zip2" maxlength="4" onKeyUp="AjaxZip3.zip2addr('zip1','zip2','pref','addr1','addr2');" value="<?= $zip2; ?>">
										</div></br>
										<div class="partner-address-column">
											<p>都道府県</p>
											<input type="text" id="pref" name="pref" value="<?= h($pref); ?>">
										</div>
										<div class="partner-address-column">
											<p>以降の住所</p>
											<input type="text" id="addr1" name="addr1" value="<?= h($addr1); ?>">
											<input type="text" id="addr2" name="addr2" value="<?= h($addr2); ?>">
										</div>
									</div>
									<div id="map-click">
										<h3>地図を表示する</h3>
										<p>※住所入力後は必ず地図を表示させてください。</p>
									</div>
									<div class="googleMap-size">
										<div id="map_canvas"></div>
									</div>
									<input type="hidden" id="lat" name ="lat" value="<?= h($lat); ?>">
									<input type="hidden" id="lng" name ="lng" value="<?= h($lng); ?>">
  								</td>
							</tr>
							<tr>
								<th>交通機関(1)<span class="red">※</span></th>
								<td>
									<div class="partner-circle-column">
										<input type="radio" id="train-label1" name="traffic1" value="電車" <?= $trafficSpeT1; ?>>
										<label for="train-label1">電車</label>
									</div>
									<div class="partner-circle-column">
										<input type="radio" id="bus-label1" name="traffic1" value="バス" <?= $trafficSpeB1; ?>>	
										<label for="bus-label1">バス</label>
									</div>

									<div id="train-column1" class="train-column">
										都道府県
										<select name="pref1" onChange="setMenuItem(0,this[this.selectedIndex].value, 0)">
											<option value="0" selected>-----
											<option value="1">北海道
											<option value="2">青森県
											<option value="3">岩手県
											<option value="4">宮城県
											<option value="5">秋田県
											<option value="6">山形県
											<option value="7">福島県
											<option value="8">茨城県
											<option value="9">栃木県
											<option value="10">群馬県
											<option value="11">埼玉県
											<option value="12">千葉県
											<option value="13">東京都
											<option value="14">神奈川県
											<option value="15">新潟県
											<option value="16">富山県
											<option value="17">石川県
											<option value="18">福井県
											<option value="19">山梨県
											<option value="20">長野県
											<option value="21">岐阜県
											<option value="22">静岡県
											<option value="23">愛知県
											<option value="24">三重県
											<option value="25">滋賀県
											<option value="26">京都府
											<option value="27">大阪府
											<option value="28">兵庫県
											<option value="29">奈良県
											<option value="30">和歌山県
											<option value="31">鳥取県
											<option value="32">島根県
											<option value="33">岡山県
											<option value="34">広島県
											<option value="35">山口県
											<option value="36">徳島県
											<option value="37">香川県
											<option value="38">愛媛県
											<option value="39">高知県
											<option value="40">福岡県
											<option value="41">佐賀県
											<option value="42">長崎県
											<option value="43">熊本県
											<option value="44">大分県
											<option value="45">宮崎県
											<option value="46">鹿児島県
											<option value="47">沖縄県
										</select>
										沿線<select name="s0" onChange="setMenuItem(1,this[this.selectedIndex].value, 0)">
											<option selected>----
										</select> 
										<input type="hidden" id="lineName1" name="lineName1">
										駅<select id="stationNameS1" name="s1">
											<option selected>----
										</select></br>
										バス乗車<input type="text" name="trainBus1">分
										徒歩<input type="text" name="trainWalk1">分
									</div>

									<div id="bus-column1" class="bus-column">
										バス会社<input type="text" name="busInc1">
										バス停名<input type="text" name="busStop1">
										徒歩<input type="busWalk1">分
									</div>

									<div class="trafficCon">
										<h4><?= h($trafficCon1); ?></h4>
									</div>
									
								</td>
							</tr>
							<tr>
								<th>交通機関(2)</th>
								<td>
									<div class="partner-circle-column">
										<input type="radio" id="train-label2" name="traffic2" value="電車"  <?= $trafficSpeT2; ?>>
										<label for="train-label2">電車</label>
									</div>
									<div class="partner-circle-column">
										<input type="radio" id="bus-label2" name="traffic2" value="バス"  <?= $trafficSpeB2; ?>>
										<label for="bus-label2">バス</label>
									</div>

									<div id="train-column2" class="train-column">
										都道府県
										<select name="pref2" onChange="setMenuItem(0,this[this.selectedIndex].value, 1)">
											<option value="0" selected>-----
											<option value="1">北海道
											<option value="2">青森県
											<option value="3">岩手県
											<option value="4">宮城県
											<option value="5">秋田県
											<option value="6">山形県
											<option value="7">福島県
											<option value="8">茨城県
											<option value="9">栃木県
											<option value="10">群馬県
											<option value="11">埼玉県
											<option value="12">千葉県
											<option value="13">東京都
											<option value="14">神奈川県
											<option value="15">新潟県
											<option value="16">富山県
											<option value="17">石川県
											<option value="18">福井県
											<option value="19">山梨県
											<option value="20">長野県
											<option value="21">岐阜県
											<option value="22">静岡県
											<option value="23">愛知県
											<option value="24">三重県
											<option value="25">滋賀県
											<option value="26">京都府
											<option value="27">大阪府
											<option value="28">兵庫県
											<option value="29">奈良県
											<option value="30">和歌山県
											<option value="31">鳥取県
											<option value="32">島根県
											<option value="33">岡山県
											<option value="34">広島県
											<option value="35">山口県
											<option value="36">徳島県
											<option value="37">香川県
											<option value="38">愛媛県
											<option value="39">高知県
											<option value="40">福岡県
											<option value="41">佐賀県
											<option value="42">長崎県
											<option value="43">熊本県
											<option value="44">大分県
											<option value="45">宮崎県
											<option value="46">鹿児島県
											<option value="47">沖縄県
										</select>
										沿線<select name="s2" onChange="setMenuItem(1,this[this.selectedIndex].value, 1)">
											<option selected>----
										</select> 
										<input type="hidden" id="lineName2" name="lineName2">
										駅<select name="s3">
											<option selected>----
										</select></br>
										バス乗車<input type="text" name="trainBus2">分
										徒歩<input type="text" name="trainWalk2">分
									</div>

									<div id="bus-column2" class="bus-column">
										バス会社<input type="text" name="busInc2">
										バス停名<input type="text" name="busStop2">
										徒歩<input type="busWalk2">分
									</div>
									<div class="trafficCon">
										<h4><?= h($trafficCon2); ?></h4>
									</div>
								</td>
							</tr>
							<tr>
								<th>交通機関(3)</th>
								<td>
									<div class="partner-circle-column">
										<input type="radio" id="train-label3" name="traffic3" value="電車"  <?= $trafficSpeT3; ?>>
										<label for="train-label3">電車</label>
									</div>
									<div class="partner-circle-column">
										<input type="radio"　value="バス" id="bus-label3" name="traffic3" value="バス"  <?= $trafficSpeB3; ?>>
										<label for="bus-label3">バス</label>
									</div>

									<div id="train-column3" class="train-column">
										都道府県
										<select name="pref3" onChange="setMenuItem(0,this[this.selectedIndex].value, 2)">
											<option value="0" selected>-----
											<option value="1">北海道
											<option value="2">青森県
											<option value="3">岩手県
											<option value="4">宮城県
											<option value="5">秋田県
											<option value="6">山形県
											<option value="7">福島県
											<option value="8">茨城県
											<option value="9">栃木県
											<option value="10">群馬県
											<option value="11">埼玉県
											<option value="12">千葉県
											<option value="13">東京都
											<option value="14">神奈川県
											<option value="15">新潟県
											<option value="16">富山県
											<option value="17">石川県
											<option value="18">福井県
											<option value="19">山梨県
											<option value="20">長野県
											<option value="21">岐阜県
											<option value="22">静岡県
											<option value="23">愛知県
											<option value="24">三重県
											<option value="25">滋賀県
											<option value="26">京都府
											<option value="27">大阪府
											<option value="28">兵庫県
											<option value="29">奈良県
											<option value="30">和歌山県
											<option value="31">鳥取県
											<option value="32">島根県
											<option value="33">岡山県
											<option value="34">広島県
											<option value="35">山口県
											<option value="36">徳島県
											<option value="37">香川県
											<option value="38">愛媛県
											<option value="39">高知県
											<option value="40">福岡県
											<option value="41">佐賀県
											<option value="42">長崎県
											<option value="43">熊本県
											<option value="44">大分県
											<option value="45">宮崎県
											<option value="46">鹿児島県
											<option value="47">沖縄県
										</select>
										沿線<select name="s4" onChange="setMenuItem(1,this[this.selectedIndex].value, 2)">
											<option selected>----
										</select> 
										<input type="hidden" id="lineName3" name="lineName3">
										駅<select name="s5">
											<option selected>----
										</select></br>
										バス乗車<input type="text" name="trainBus3">分
										徒歩<input type="text" name="trainWalk3">分
									</div>

									<div id="bus-column3"class="bus-column">
										バス会社<input type="text" name="busInc3">
										バス停名<input type="text" name="busStop3">
										徒歩<input type="busWalk3">分
									</div>

									<div class="trafficCon">
										<h4><?= h($trafficCon3); ?></h4>
									</div>

								</td>
							</tr>
							<tr>
								<th>建物設備</th>
								<td class="partner-square-radio">
									<span class="partner-square-column">
										<?php $facility1Check = (array_search('エレベータ', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility1" value="エレベータ" name="facility1" <?= $facility1Check; ?>>
										<label for="facility1">エレベータ</label>
									</span>
									<span class="partner-square-column">
										<?php $facility2Check = (array_search('オートロック', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility2" value="オートロック" name="facility2" <?= $facility2Check; ?>>
										<label for="facility2">オートロック</label>
									</span>
									<span class="partner-square-column">
										<?php $facility3Check = (array_search('宅配ボックス', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility3" value="宅配ボックス" name="facility3" <?= $facility3Check; ?>>
										<label for="facility3">宅配ボックス</label>
									</span>
									<span class="partner-square-column">
										<?php $facility4Check = (array_search('監視カメラ', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility4" value="監視カメラ" name="facility4" <?= $facility4Check; ?>>
										<label for="facility4">監視カメラ</label>
									</span>
									<span class="partner-square-column">
										<?php $facility5Check = (array_search('自動販売機', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility5" value="自動販売機" name="facility5" <?= $facility5Check; ?>>
										<label for="facility5">自動販売機</label>
									</span>
									<span class="partner-square-column">
										<?php $facility6Check = (array_search('管理人常駐', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility6" value="管理人常駐" name="facility6" <?= $facility6Check; ?>>
										<label for="facility6">管理人常駐</label>
									</span>
									<span class="partner-square-column">
										<?php $facility7Check = (array_search('警備会社契約', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility7" value="警備会社契約" name="facility7" <?= $facility7Check; ?>>
										<label for="facility7">警備会社契約</label>
									</span>
									<span class="partner-square-column">
										<?php $facility8Check = (array_search('ケーブルＴＶ', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility8" value="ケーブルＴＶ" name="facility8" <?= $facility8Check; ?>>
										<label for="facility8">ケーブルＴＶ</label>
									</span>
									<span class="partner-square-column">
										<?php $facility9Check = (array_search('BS・CSアンテナ', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility9" value="BS・CSアンテナ" name="facility9" <?= $facility9Check; ?>>
										<label for="facility9">BS・CSアンテナ</label>
									</span>
									<span class="partner-square-column">
										<?php $facility10Check = (array_search('都市ガス', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility10" value="都市ガス" name="facility10" <?= $facility10Check; ?>>
										<label for="facility10">都市ガス</label>
									</span>
									<span class="partner-square-column">
										<?php $facility11Check = (array_search('プロパンガス（LPガス）', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox"　id="facility11" value="プロパンガス（LPガス）" name="facility11" <?= $facility11Check; ?>>
										<label for="facility11">プロパンガス（LPガス）</label>
									</span>
									<span class="partner-square-column">
										<?php $facility12Check = (array_search('オール電化', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility12" value="オール電化" name="facility12" <?= $facility12Check; ?>>
										<label for="facility12">オール電化</label>
									</span>
									<span class="partner-square-column">
										<?php $facility13Check = (array_search('バイク置き場', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility13" value="バイク置き場" name="facility13" <?= $facility13Check; ?>>
										<label for="facility13">バイク置き場</label>
									</span>
									<span class="partner-square-column">
										<?php $facility14Check = (array_search('駐輪場', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility14" value="駐輪場" name="facility14" <?= $facility14Check; ?>>
										<label for="facility14">駐輪場</label>
									</span>
									<span class="partner-square-column">
										<?php $facility15Check = (array_search('敷地内ゴミ置き場', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility15" value="敷地内ゴミ置き場" name="facility15" <?= $facility15Check; ?>>
										<label for="facility15">敷地内ゴミ置き場</label>
									</span>
									<span class="partner-square-column">
										<?php $facility16Check = (array_search('共同トイレ', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility16" value="共同トイレ" name="facility16" <?= $facility16Check; ?>>
										<label for="facility16">共同トイレ</label>
									</span>
									<span class="partner-square-column">
										<?php $facility17Check = (array_search('共同シャワー', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility17" value="共同シャワー" name="facility17" <?= $facility17Check; ?>>
										<label for="facility17">共同シャワー</label>
									</span>
									<span class="partner-square-column">
										<?php $facility18Check = (array_search('共同風呂', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility18" value="共同風呂" name="facility18" <?= $facility18Check; ?>>
										<label for="facility18">共同風呂</label>
									</span>
									<span class="partner-square-column">
										<?php $facility19Check = (array_search('共同キッチン', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility19" value="共同キッチン" name="facility19" <?= $facility19Check; ?>>
										<label for="facility19">共同キッチン</label>
									</span>
									<span class="partner-square-column">
										<?php $facility20Check = (array_search('共同洗濯機', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility20" value="共同洗濯機" name="facility20" <?= $facility20Check; ?>>
										<label for="facility20">共同洗濯機</label>
									</span>
									<span class="partner-square-column">
										<?php $facility21Check = (array_search('共同乾燥機', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility21" value="共同乾燥機" name="facility21" <?= $facility21Check; ?>>
										<label for="facility21">共同乾燥機</label>
									</span>
									<span class="partner-square-column">
										<?php $facility22Check = (array_search('共同リビング', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility22" value="共同リビング" name="facility22" <?= $facility22Check; ?>>
										<label for="facility22">共同リビング</label>
									</span>
									<span class="partner-square-column">
										<?php $facility23Check = (array_search('コインランドリー', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility23" value="コインランドリー" name="facility23" <?= $facility23Check; ?>>
										<label for="facility23">コインランドリー</label>
									</span>
									<span class="partner-square-column">
										<?php $facility24Check = (array_search('カーシェアリング', $facility_block) !== false)?'checked':''; ?>
										<input type="checkbox" id="facility24" value="カーシェアリング" name="facility24" <?= $facility24Check; ?>>
										<label for="facility24">カーシェアリング</label>
									</span>
								</td>
							</tr>
						</table>
						<button type="submit">変更する</button>
						<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- ここまでEdit -->