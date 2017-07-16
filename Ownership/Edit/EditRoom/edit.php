
	<!-- ここからEdit -->

	<div id="content" class="content">
		<div class="content-inner">
			<?php include(dirname(__FILE__) . '/../../../Configuration/Frames/edit_sub.php'); ?>
			<div class="main-content">
				<div class="sub-section-title">
					<h3>部屋の情報</h3>
				</div>
				<?php if(isset($addUpdateRoom)): ?>
					<div class="registration-ok">
						<h2>部屋を追加しました！</h2>
					</div>
				<?php endif; ?>
				<?php if(isset($deleteUpdateRoom)): ?>
					<div class="registration-ok">
						<h2>部屋を削除しました！</h2>
					</div>
				<?php endif; ?>
				<div class="edit-room-content">
					<div id="newRoom-btn" class="newRoom-btn">
						<h3>お部屋追加</h3>
					</div>
					<table>
						<thead>
							<tr>
								<th>号室</th>
								<td>賃料(円)</td>
								<td>その他</br>月額合計</td>
								<td>間取り</td>
								<td>面積(㎡)</td>
								<td>入居状況</td>
								<td>公開/非公開</td>
								<td>編集</td>
								<td>消去</td>
							</tr>
						</thead>
						<tbody>
							<form action="" method="post">
							<?php for($i = 0; $i < count($roomId_block); $i++): ?>
								<tr>
									<th><b><?= h($roomNum[$i]); ?></b></th>
									<td><?= h($roomRent[$i]); ?>円</td>
									<td><?= h($roomFee[$i]); ?>円</td>
									<td><?= h($roomFloor1[$i]).h($roomFloor2[$i]); ?></td>
									<td><?= h($roomArea[$i]); ?>㎡</td>
									<td><?= h($roomCurrent[$i]); ?></td>
									<?php $public = ($roomPublic[$i] == 1)? '公開':'非公開'; ?>
									<?php $publicColor = ($roomPublic[$i] == 1)? 'room-public-color': ''; ?>
									<td class="<?= $publicColor; ?>"><?= h($public); ?></td>
									<td>
										<a href="/Landlords/Ownership/Edit/EditRoomDetail/?room=<?= $roomId_block[$i]; ?>">編集</a>
									</td>
									<td>	
										<div class="roomDelete">
											<input id="<?= $i; ?>" type="checkbox" name="roomDelete<?= $i; ?>" value="check">
											<label for="<?= $i; ?>">消去</label>
										</div>
									</td>
								</tr>
							<?php endfor; ?>
								<input type="hidden" name="deleteRoom" value="true">
								<button type="submit">消去確定</button>
								<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
							</form>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- ここまでEdit -->



	<!-- ここからお部屋追加用Modal -->

	<div id="newRoom-btn-open" class="newRoom-modal-form">
		<form action="" method="post">
			<i class="fa fa-times" aria-hidden="true"></i>
			<div class="newRoom-modal-input">
				<h3>新しい部屋を追加</h3>
				<p>お部屋の詳細については、追加後に編集することができます。</p>
				<div class="newRoom-insert">
					<h4>号室</h4>
					<input type="text" name="roomNum">
					<select name="roomNumAfter">
						<option value="号">号</option>
						<option value="">なし</option>
					</select>
				</div>
			</div>
			<button type="submit">部屋を追加</button>
			<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
		</form>
	</div>

	<!-- ここまでお部屋追加用Modal -->