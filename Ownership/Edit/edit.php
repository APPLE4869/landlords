
	<!-- ここからEdit -->
	
	<div id="content" class="content">
		<div class="content-inner">
			<?php include(dirname(__FILE__) . '/../../Configuration/Frames/edit_sub.php'); ?>
			<div class="main-content">
				<div class="Overview-top">
					<h1><?= h($buildingName); ?>(<?= h($petName); ?>)</h1>
				</div>
				<div class="Overview-middle">
					<div class="Overview-image">
						<?php if($image_block[0] !== ''): ?>
							<img src="../../../MyHome/Landlord/<?= h($_SESSION['userUrl']); ?>/images/<?= h($image_block[0]); ?>">
						<?php else: ?>
							<img src="../../Configuration/images/sample.gif">
						<?php endif; ?>
					</div>
					<div class="Overview-list">
						<table>
							<tr>
								<th>構造</th>
								<td><?= h($construct); ?></td>
							</tr>
							<tr>
								<th>種目</th>
								<td><?= h($speaces); ?></td>
							</tr>
							<tr>
								<th>築年月</th>
								<td><?= isset($oldDisplay)?h($oldDisplay):''; ?></td>
							</tr>
							<tr>
								<th>所在地</th>
								<td><?= h($address); ?></td>
							</tr>
							<tr>
								<th>取得年月日</th>
								<td><?= h($getDay); ?></td>
							</tr>
							<tr>
								<th>取得金額</th>
								<td><?= h($getMoney); ?>万円</td>
							</tr>
							<tr>
								<th>総戸数</th>
								<td><?= h($allUnits); ?>戸</td>
							</tr>
							<tr>
								<th>入居数</th>
								<td><?= h($inUnits); ?>戸 ※入居率:<?= h($unitsData); ?>%</td>
							</tr>
							<tr>
								<th>駐車場</th>
								<td><?= h($parking); ?></td>
							</tr>
							<tr>
								<th>設備</th>
								<td><?= h($facility); ?></td>
							</tr>
							<tr class="cf">
								<th>ホームページ</th>
								<?php $publicClass = ($publicNum == 0)?'Overview-public':'Overview-local'; ?>
								<td class="<?= h($publicClass); ?>"><h5><?= h($public); ?></h5></td>
								<a href="">物件ホームページ管理</a>
							</tr>
						</table>
					</div>
				</div>
				<div class="Overview-bottom">
						<h3>ステータス</h3>
					<div class="Overview-bottom-inner">
						<div class="Overview-bottom-left">
							<table>
								<tr>
									<th>総戸数</th>
									<td><?= h($allUnits); ?>戸</td>
								</tr>
								<tr>
									<th>入居数</th>
									<td><?= h($inUnits); ?>戸</td>
								</tr>
								<tr>
									<th>入居率</th>
									<td><?= h($unitsData); ?>%</td>
								</tr>
							</table>
							<p>※総戸数は登録された部屋数を元に表示しています。</p>
						</div>
						<div class="Overview-bottom-right">
							<table>
								<thead>
									<th>現状</th>
								</thead>
								<tbody>
									<tr>
										<th>月額家賃収入</th>
										<td><?= h($monthFee); ?>万円(家賃: <?= h($totalRent); ?>万円、その他月額: <?= h($totalFee); ?>万円)</td>
									</tr>
									<tr>
										<th>年間家賃収入</th>
										<td><?= h($yearFee); ?>万円</td>
									</tr>
								</tbody>
							</table>
							<table>
								<thead>
									<th>満室時</th>
								</thead>
								<tbody>
									<tr>
										<th>月額家賃収入</th>
										<td><?= h($monthFeeIn); ?>万円(家賃: <?= h($totalRentIn); ?>万円、その他月額: <?= h($totalFeeIn); ?>万円)</td>
									</tr>
									<tr>
									<th>年間家賃収入</th>
									<td><?= h($yearFeeIn); ?>万円</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ここまでEdit -->