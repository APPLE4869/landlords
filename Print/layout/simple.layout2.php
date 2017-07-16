
	<?php include(dirname(__FILE__) . '/handbill.style.php'); ?>

	
				<form action="" method="post" enctype="multipart/form-data" class="print-image">
					
					<div class="left-area">
						<div class="left-top-area">

							<div class="LT-big-images">
								<span class="images-frame">
									<label for="image1" style="background-image:url('../../Configuration/images/homeOut.jpg');"></label>
									<input type="file" id="image1" name="file1" style='display: none;'>
								</span>

								<span class="images-frame">
									<label for="image2" style="background-image:url('../../Configuration/images/homeOut.jpg');"></label>
									<input type="file" id="image2" name="file2" style='display: none;'>
								</span>

								<span class="images-frame">
									<label for="image3" style="background-image:url('../../Configuration/images/homeOut.jpg');"></label>
									<input type="file" id="image3" name="file3" style='display: none;'>
								</span>

								<span class="images-frame">
									<label for="image4" style="background-image:url('../../Configuration/images/homeOut.jpg');"></label>
									<input type="file" id="image4" name="file4" style='display: none;'>
								</span>
							</div>

							<div class="RT-small-images">
								<span class="images-frame">
									<label for="image5" style="background-image:url('../../Configuration/images/homeOut.jpg');"></label>
									<input type="file" id="image5" name="file5" style='display: none;'>
								</span>

								<span class="images-frame">
									<label for="image6" style="background-image:url('../../Configuration/images/homeOut.jpg');"></label>
									<input type="file" id="image6" name="file6" style='display: none;'>
								</span>

								<span class="images-frame">
									<label for="image7" style="background-image:url('../../Configuration/images/homeOut.jpg');"></label>
									<input type="file" id="image7" name="file7" style='display: none;'>
								</span>
							</div>

							<div class="B-middle-images">
								<span class="images-frame">
									<label for="image8" style="background-image:url('../../Configuration/images/homeOut.jpg');"></label>
									<input type="file" id="image8" name="file8" style='display: none;'>
								</span>

								<span class="images-frame">
									<label for="image9" style="background-image:url('../../Configuration/images/homeOut.jpg');"></label>
									<input type="file" id="image9" name="file9" style='display: none;'>
								</span>

								<span class="images-frame">
									<label for="image10" style="background-image:url('../../Configuration/images/homeOut.jpg');"></label>
									<input type="file" id="image10" name="file10" style='display: none;'>
								</span>

								<span class="images-frame">
									<label for="image11" style="background-image:url('../../Configuration/images/homeOut.jpg');"></label>
									<input type="file" id="image11" name="file11" style='display: none;'>
								</span>
							</div>

						</div>

						<div class="left-bottom-area">

							<span class="images-frame">
								<label for="image12" style="background-image:url('../../Configuration/images/homeOut.jpg');"></label>
								<input type="file" id="image13" name="file13" style='display: none;'>
							</span>

							<span class="images-frame">		
								<label for="image13" style="background-image:url('../../Configuration/images/homeOut.jpg');"></label>
								<input type="file" id="image14" name="file14" style='display: none;'>
							</span>

						</div>
					</div>

					<div class="right-area">
						<table class="right-area-first">
							<thead>
								<tr>
									<th><span contentEditable="true">名称</span></th>
									<td colspan="3" class="focus-text"><span contentEditable="true"><?= h($buildingsNames[$num]) ?></span></td>
								</tr>
								<tr>
									<th><span contentEditable="true">間取タイプ</span></th>
									<td colspan="3" class="focus-text"><span contentEditable="true"></span></td>
								</tr>
								<tr>
									<th><span contentEditable="true">詳細</span></th>
									<td colspan="3" class="focus-text"><span contentEditable="true">和)○帖 和)○帖 DK)○帖</span></td>
								</tr>
								<tr>
									<th><span contentEditable="true">所在地</span></th>
									<td colspan="3"><span contentEditable="true"><?= h($addressBlock[$num]); ?></span></td>
								</tr>
								<tr>
									<th><span contentEditable="true">家賃</span></th>
									<td colspan="3"><span contentEditable="true">○○○円</span></td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th><span contentEditable="true">敷金</span></th>
									<td><span contentEditable="true">
										<span>0</span>
										カ月
									</span></td>
									<th><span contentEditable="true">礼金</span></th>
									<td><span contentEditable="true">
										<span>0</span>
										カ月
									</span></td>
								</tr>
								<tr>
									<th><span contentEditable="true">共益費</span></th>
									<td><span contentEditable="true">○○○円</span></td>
									<th><span contentEditable="true">仲介手数料</span></th>
									<td><span contentEditable="true">
										<span>0</span>
										カ月
									</span></td>
								</tr>
								<tr>
									<th><span contentEditable="true">町費</span></th>
									<td><span contentEditable="true">○○○円/月</span></td>
									<td colspan="2" class="sun-detail"><span contentEditable="true">○向き・日当たり良好</br>○○駅○.○km</span></td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<th><span contentEditable="true">建物備考</span></th>
									<td colspan="3"><span contentEditable="true">○ 階　　　　○棟　　　　全 ○○ 戸</span></td>
								</tr>
								<tr>
									<th><span contentEditable="true">築年数</span></th>
									<td><span contentEditable="true"><?= h($oldBlock[$num]); ?></span></td>
									<th><span contentEditable="true">建物構造</span></th>
									<td><span contentEditable="true"><?= h($constructBlock[$num]); ?></span></td>
								</tr>
							</tfoot>
						</table>
						<table class="right-area-second">
							<tr>
								<th><span contentEditable="true">設備</span></th>
								<td><span contentEditable="true"><?= h($facilityBlock[$num]); ?></span></td>
							</tr>
							<tr>
								<th><span contentEditable="true">備考</span></th>
								<td><span contentEditable="true">◆○○○○</br>◆○○○○</br>◆○○○○</br>◆○○○○</span></td>
							</tr>
							<tr>
								<th><span contentEditable="true">オプション契約</span></th>
								<td><span contentEditable="true">★○○○○</br>★○○○○</br>★○○○○</span></td>
							</tr>
						</table>
						<div class="logo">
							<h3>Wonder Homes</h3>
						</div>
					</div>

					<div class="footer">
						<div class="footer-left" contentEditable="true">
							<p>こんな特化満載の賃貸アパートほかにありますか！ご入居者様早期募集中！</p>
							<h4>家主が直接募集だからお得満載なんです！</h4>
						</div>
						<div class="footer-center" contentEditable="true">
							<h4><?= h($buildingsNames[$num]) ?></h4>
							<h4><?= $addressCodeBlock[$num] ?> <?= h($addressBlock[$num]); ?></h4>
							<h4>○○○○株式会社 苗字 名前</h4>
						</div>
						<div class="footer-right" contentEditable="true">
							<ul>
								<li>担当直通 : <?= h($phoneNum) ?></li>
								<li>FAX : ○○-○○○○-○○○○</li>
								<li>E-mail : <?= h($email); ?></li>
							</ul>
						</div>
					</div>

				</form>