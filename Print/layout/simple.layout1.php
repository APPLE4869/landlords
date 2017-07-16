				

	<?php include(dirname(__FILE__) . '/handbill.style.php'); ?>

	
				<form action="" method="post" enctype="multipart/form-data" class="print-image">
					<div class="out-line">
						<table class="top-detail">
							<thead>
								<tr>
									<th rowspan="2" class="top-bc"><span contentEditable="true">貸マンション</span></th>
									<td rowspan="2"><span contentEditable="true">賃料</span></td>
									<td rowspan="2" class="top-border-left"><span contentEditable="true">○○○号室 <strong class="font-weight-char">○○○○○○○</strong>円</span></td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th><span contentEditable="true"><?= h($traffic1Block[$num][0]); ?></span></th>
									<td><span contentEditable="true">礼 なし　敷 なし</span></td>
									<td class="top-border-left"><span contentEditable="true">管理費○○○○円/月</span></td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<th rowspan="2"><span contentEditable="true"><?= h($traffic1Block[$num][1]); ?>駅</br><?= h($traffic1Block[$num][2]); ?></span></th>
									<td colspan="2"><span contentEditable="true">1K</span></td>
								</tr>
								<tr>
									<td colspan="2"><span contentEditable="true">駐車場</span></td>
								</tr>
							</tfoot>
						</table>
						<div class="middleLeft-detail">
							<div class="middleLeft-detail-explain" contentEditable="true">
								<h2>《<?= h($buildingsNames[$num]); ?>》</h2>
								<ul>
									<li>★1階フロアー100円ショップ</li>
									<li>★大型収納スペース</li>
									<li>★エアコン付</li>
									<li>★BSアンテナ</li>
									<li>★光ファイバー</li>
									<li>★保証会社利用可(全保連)</li>
									<li>★外観タイル張り</li>
									<li>★フロアータイル仕様</li>
									<li>★IHクッキングヒーター</li>
								</ul>
							</div>
							<div class="middleleft-images images-frame">
								<label for="image1" style="background-image:url('../../Configuration/images/homeOut.jpg');"></label>
								<input type="file" id="image1" name="file1" style='display: none;'>
							</div>
						</div>
						<div class="middleRight-detail">
							<div class="middleRight-detail-image2 images-frame">
								<label for="image2" style="background-image:url('../../Configuration/images/floor.jpg');"></label>
								<input type="file" id="image2" name="file1" style="display: none;">
							</div>
							<div class="middleRight-detail-image3 images-frame">
								<label for="image3" style="background-image:url('../../Configuration/images/houseIn.jpg');"></label>
								<input type="file" id="image3" name="file1" style="display: none;">
							</div>
						</div>
						<div class="middleBottom-detail">
							<div class="middleBottom-left-detail">
								<table>
									<thead>
										<tr>
											<th>所在地:</th>
											<td colspan="3"><span contentEditable="true"><?= h($addressBlock[$num]); ?></span></td>
										</tr>
										<tr>
											<th>構造・規模:</th>
											<td colspan="3"><span contentEditable="true"><?= h($constructBlock[$num]); ?></span></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th>築年月:</th>
											<td><span contentEditable="true"><?= h($oldBlock[$num]); ?></span></td>
											<th>契約期間:</th>
											<td><span contentEditable="true">○年(○○○)</span></td>
										</tr>
										<tr>
											<th>入居時期:</th>
											<td><span contentEditable="true">○○</span></td>
											<th>保険等加入:</th>
											<td><span contentEditable="true">○○○○円/○年</span></td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<th>備考:</th>
											<td colspan="3"><span contentEditable="true">○○○○○○○○○○○</span></td>
										</tr>
									</tfoot>
								</table>
							</div>
							<div class="middleBottom-right-detail">
								<div class="room-detail-checks">
									<ul class="cf">
										<?php foreach($roomDetail as $block): ?>
											<li class="icon-b square"><?= $block; ?></li>
										<?php endforeach; ?>
									</ul>
									<div class="room-detail-else">
										<h3>【その他設備】</h3>
										<p contentEditable="true">○○○、○○○○</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="else-area">
						<p>Wonder Homes</p>
						<p>不動産会社専用図面</p>
						<p class="else-area-last" contentEditable="true">物件番号 ○○○○○○○○○</p>
					</div>
					<div class="bottom-detail out-line" contentEditable="true">
						<div class="bottom-detail-left">
							<p>○○県○○免許(○)第○○○号</br>○○○ ○-○-○(住所)</p>
							<h2>株式会社カナカン</h2>
							<p>TEL ○○○-○○○-○○○○　FAX ○○○-○○○-○○○○</p>
							<div class="bottom-detail-leftBtm">
								<span>■取引態様：専任媒介  ■手数料</span>
								<ul class="cf">
									<li>手数料</br>負担の割合</li>
									<li>貸主</li>
									<li><b>○○</b>%</li>
									<li>借主</li>
									<li><b>○○</b>%</li>
									<li>手数料</br>配分の割合</li>
									<li><b>○○</b>%</li>
									<li>寄付</li>
									<li><b>○○</b>%</li>
								</ul>
							</div>
						</div>
						<div class="bottom-detail-right">
							<div class="bottom-detail-rColumn">
								<div class="bottom-detail-rTitle">
									<h3>客付会社様へ</h3>
								</div>
								<h5>○○</h5>
							</div>
							<p>■情報公開日: 29.○○.○○</p>
						</div>
					</div>
				</form>