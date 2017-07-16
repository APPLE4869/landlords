
	<!-- ここからEdit -->
	
	<div id="content" class="content">
		<div class="content-inner">
			<?php include(dirname(__FILE__) . '/../../../Configuration/Frames/edit_sub.php'); ?>
			<div class="main-content">
				<div class="section-title">
					<h3>ホームページ管理</h3>
				</div>
				<div class="edit-top">
					<div class="sub-section-title">
						<h3>基本設定</h3>
					</div>
					<div class="edit-content">
						<table>
							<tbody>
								<tr>
									<th>公開状況</th>
									<td>-</td>
									<td id="pagePublicChange" class="icon-b <?= $publicClass; ?> public-change"><?= $pagePublicName; ?></td>
								</tr>
								<tr>
									<th>ホームページデザイン</th>
									<td>準備中</td>
									<td class="icon-b change-icon"><a onClick="alert('ただいま準備中です');">準備中</a></td>
								</tr>
								<tr>
									<th>ホームページイメージカラー</th>
									<td>skyblue</td>
									<td class="icon-b change-icon"><a href="/Landlords/Ownership/Edit/EditColor/">変更する</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="edit-bottom">
					<div class="sub-section-title">
						<h3>ページ設定</h3>
					</div>
					<div class="edit-content">
						<table>
							<thead>
								<tr>
									<td>ページ情報区分</td>
									<td>ページ情報登録状況</td>
									<td>ページ表示/非表示変更</td>
									<td>ページ情報編集</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>トップページ</th>
									<td>〇登録済み</td>
									<td>表示必須</td>
									<td class="icon-b pen-icon"><a href="/Landlords/Ownership/Edit/EditTop/">編集する</a></td>
								</tr>
								<tr>
									<th>建物情報ページ</th>
									<td>〇登録済み</td>
									<td>表示必須</td>
									<td class="icon-b pen-icon"><a href="/Landlords/Ownership/Edit/EditBuilding/">編集する</a></td>
								</tr>
								<tr>
									<th>周辺情報ページ</th>
									<td>〇登録済み</td>
									<td>
										<h4 id="locationPublicChange" class="icon-b <?= $locationPublicClass; ?> public-change"><?= $locationPublicName; ?></h4>
									</td>
									<td class="icon-b pen-icon"><a href="/Landlords/Ownership/Edit/EditLocation/">編集する</a></td>
								</tr>
								<tr>
									<th>空室情報ページ</th>
									<td>〇登録済み</td>
									<td>表示必須</td>
									<td class="icon-b pen-icon"><a href="/Landlords/Ownership/Edit/EditRoom/">編集する</a></td>
								</tr>
								<tr>
									<th>キャンペーンページ</th>
									<td>〇登録済み</td>
									<td>
										<h4 id="campaignPublicChange" class="icon-b <?= $campaignPublicClass; ?> public-change"><?= $campaignPublicName; ?></h4>
									</td>
									<td class="icon-b pen-icon"><a href="/Landlords/Ownership/Edit/EditCampaign/">編集する</a></td>
								</tr>
								<tr>
									<th>お問い合わせページ</th>
									<td>〇登録済み</td>
									<td>表示必須</td>
									<td class="icon-b pen-icon"><a href="/Landlords/Ownership/Edit/EditContact/">編集する</a></td>
								</tr>
								<tr>
									<th>お知らせ</th>
									<td>〇登録済み</td>
									<td>表示必須</td>
									<td class="icon-b pen-icon"><a href="/Landlords/Ownership/Edit/EditNotice/">編集する</a></td>
								</tr>
								<tr>
									<th>保存画像</th>
									<td>-</td>
									<td>-</td>
									<td class="icon-b pen-icon"><a href="/Landlords/Ownership/Edit/EditImages/">編集する</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ここまでEdit -->