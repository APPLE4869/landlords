
	<!-- ここからEdit -->

	<div id="content" class="content">
		<div class="content-inner">
			<?php include(dirname(__FILE__) . '/../../../Configuration/Frames/edit_sub.php'); ?>
			<div class="main-content">
				<div class="sub-section-title">
					<h3><?= h($num); ?>募集情報</h3>
				</div>

	<!-- ここからUpdate処理結果表示 -->

				<?php if(isset($update)): ?>
					<div class="registration-ok">
						<h2><?= h($num); ?>の情報を変更しました！</h2>
					</div>
				<?php endif; ?>

				<?php if(isset($updateImage)): ?>
					<div class="registration-ok">
						<h2><?= h($num); ?>の写真情報を</br>変更しました！</h2>
					</div>
				<?php endif; ?>

				<?php if(isset($bImgCheck)): ?>
					<div class="registration-ok">
						<h2>写真情報を変更しました！</h2>
					</div>
				<?php endif; ?>

				<?php if(isset($deleteImage)): ?>
					<div class="registration-ok">
						<h2>写真情報を削除しました！</h2>
					</div>
				<?php endif; ?>

				<?php if(count($errors)): ?>
					<div class="registration-ok">
						<h2><?= $errors['bImgCheck']; ?></h2>
					</div>
				<?php endif; ?>

	<!-- ここまでUpdate処理結果表示 -->

				<div class="edit-roomDetail-content">
					<form action="" method="post">
						<table>

	<!-- ここから公開情報AREA -->

							<tr>
								<th>公開状況</th>
								<td class="roomDetail-circle-radio">
									<span class="roomDetail-circle-column">
										<?php $publicCheck = ($public == 1)?'checked':''; ?>
										<input type="radio" id="public1" value="公開する" name="public" <?= $publicCheck?>>
										<label for="public1">公開する</label>
									</span>
									<span class="roomDetail-circle-column">
										<?php $localCheck = ($public == 0)?'checked':''; ?>
										<input type="radio" id="public2" value="非公開" name="public" <?= $localCheck; ?>>
										<label for="public2">非公開</label>
									</span>
								</td>
							</tr>

	<!-- ここまで公開情報AREA -->



	<!-- ここから現況AREA -->

							<tr>
								<th>現況</th>
								<td class="roomDetail-circle-radio">
									<span class="roomDetail-circle-column">
										<?php $current1Check = ($current == '入居中')?'checked':''; ?>
										<input type="radio" id="current1" value="入居中" name="current" <?= $current1Check; ?>>
										<label for="current1">入居中</label>
									</span>
									<span class="roomDetail-circle-column">
										<?php $current2Check = ($current == '空室')?'checked':''; ?>
										<input type="radio" id="current2" value="空室" name="current" <?= $current2Check; ?>>
										<label for="current2">空室</label>
									</span>
									<span class="roomDetail-circle-column">
										<?php $current3Check = ($current == '退去予定')?'checked':''; ?>
										<input type="radio" id="current3" value="退去予定" name="current" <?= $current3Check; ?>>
										<label for="current3">退去予定</label>
									</span>
									<span class="roomDetail-circle-column">
										<?php $current4Check = ($current == '入居予定')?'checked':''; ?>
										<input type="radio" id="current4" value="入居予定" name="current" <?= $current4Check; ?>>
										<label for="current4">入居予定</label>
									</span>
								</td>
							</tr>

	<!-- ここまで現況AREA -->



	<!-- ここから間取りAREA -->

							<tr>
								<th>間取り</th>
								<td>
									<div class="edit-roomDetail-input">
										<input type="text" name="floor1" value="<?= h($floor1); ?>">
									</div>
									<div class="edit-roomDetail-select">
										<select name="floor2">
											<option value="">--</option>
											<?php $selected = ($floor2 == 'ルーム') ? 'selected':'' ; ?>
											<option value="ルーム" <?= $selected; ?>>ルーム</option>
											<?php $selected = ($floor2 == 'K') ? 'selected':'' ; ?>
											<option value="K" <?= $selected; ?>>K</option>
											<?php $selected = ($floor2 == 'SK') ? 'selected':'' ; ?>
											<option value="SK" <?= $selected; ?>>SK</option>
											<?php $selected = ($floor2 == 'DK') ? 'selected':'' ; ?>
											<option value="DK" <?= $selected; ?>>DK</option>
											<?php $selected = ($floor2 == 'SDK') ? 'selected':'' ; ?>
											<option value="SDK" <?= $selected; ?>>SDK</option>
											<?php $selected = ($floor2 == 'LK') ? 'selected':'' ; ?>
											<option value="LK" <?= $selected; ?>>LK</option>
											<?php $selected = ($floor2 == 'SLK') ? 'selected':'' ; ?>
											<option value="SLK" <?= $selected; ?>>SLK</option>
											<?php $selected = ($floor2 == 'LDK') ? 'selected':'' ; ?>
											<option value="LDK" <?= $selected; ?>>LDK</option>
											<?php $selected = ($floor2 == 'SLDK') ? 'selected':'' ; ?>
											<option value="SLDK" <?= $selected; ?>>SLDK</option>
											<?php $selected = ($floor2 == '事務所') ? 'selected':'' ; ?>
											<option value="事務所" <?= $selected; ?>>事務所</option>
											<?php $selected = ($floor2 == '店舗') ? 'selected':'' ; ?>
											<option value="店舗" <?= $selected; ?>>店舗</option>
											<?php $selected = ($floor2 == '倉庫') ? 'selected':'' ; ?>
											<option value="倉庫" <?= $selected; ?>>倉庫</option>
										</select>
									</div>
								</td>
							</tr>

	<!-- ここまで間取りAREA -->



	<!-- ここから専有面積・賃料AREA -->

							<tr>
								<th>専有面積</th>
								<td>
									<div class="roomDetail-input">
										<input type="text" name="area" value="<?= h($area); ?>"><p>㎡</p>
									</div>
								</td>
							</tr>
							<tr>
								<th>賃料</th>
								<td>
									<div class="roomDetail-input">
										<input type="text" name="rent" value="<?= h($rent); ?>"><p>円</p>
									</div>
								</td>							
							</tr>

	<!-- ここまで専有面積・賃料AREA -->



	<!-- ここからその他月額費用・初期費用AREA -->

							<tr>
								<th>その他月額費用</th>
								<td>
									<div class="edit-roomDetail-select">
										<select name="feeMethod1-1">
											<option value="">--</option>
											<option value="管理費" <?= $administrative[0]; ?>>管理費</option>
											<option value="共益費" <?= $commonService[0]; ?>>共益費</option>
											<option value="町会費" <?= $townCouncil[0]; ?>>町会費</option>
											<option value="インターネット代" <?= $internet[0]; ?>>インターネット代</option>
										</select>
									</div>
									<div class="roomDetail-input">
										<input type="text" name="feeMoney1-2" value="<?= h($fee_block[0]); ?>">
										<p>円</p>
									</div></br>
									<div class="edit-roomDetail-select">
										<select name="feeMethod2-1">
											<option value="">--</option>
											<option value="管理費" <?= $administrative[1]; ?>>管理費</option>
											<option value="共益費" <?= $commonService[1]; ?>>共益費</option>
											<option value="町会費" <?= $townCouncil[1]; ?>>町会費</option>
											<option value="インターネット代" <?= $internet[1]; ?>>インターネット代</option>
										</select>
									</div>
									<div class="roomDetail-input">
										<input type="text" name="feeMoney2-2" value="<?= h($fee_block[1]); ?>">
										<p>円</p>
									</div></br>
									<div class="edit-roomDetail-select">	
										<select name="feeMethod3-1">
											<option value="">--</option>
											<option value="管理費" <?= $administrative[2]; ?>>管理費</option>
											<option value="共益費" <?= $commonService[2]; ?>>共益費</option>
											<option value="町会費" <?= $townCouncil[2]; ?>>町会費</option>
											<option value="インターネット代" <?= $internet[2]; ?>>インターネット代</option>
										</select>
									</div>
									<div class="roomDetail-input">
										<input type="text" name="feeMoney3-2" value="<?= h($fee_block[2]); ?>">
										<p>円</p>
									</div></br>
									<div class="edit-roomDetail-input">
										<input type="text" name="fee4-1" value="">
									</div>
									<div class="roomDetail-input">
										<input type="text" name="fee4-2" value="">
										<p>円</p>
									</div></br>
									<div class="edit-roomDetail-input">
										<input type="text" name="fee5-1" value="">
									</div>
									<div class="roomDetail-input">
										<input type="text" name="fee1-2" value="">
										<p>円</p>
									</div>
								</td>
							</tr>

	<!-- ここまでその他月額費用・初期費用AREA -->



	<!-- ここから初期費用AREA -->

							<tr>
								<th>初期費用</th>
								<td>
									<div class="firstFee-column">
										<div class="edit-roomDetail-select">
											<select name="first-fee1-1">
												<option value="0" <?= $depositName_select[0]; ?>>敷金</option>
												<option value="1" <?= $depositName_select[1]; ?>>保証金</option>
											</select>
										</div>
										<div class="edit-roomDetail-input">
											<input type="text" name="first-fee1-2" value="<?= h($depositValue); ?>">
										</div>
										<div class="edit-roomDetail-select">
											<select name="first-fee1-3">
												<option value="カ月" <?= $depositFeild_select[0]; ?>>カ月</option>
												<option value="円" <?= $depositFeild_select[1]; ?>>円</option>
											</select>
										</div>
									</div>
	
									<div class="firstFee-column">
										（内	
										<div class="edit-roomDetail-select">
											<select name="first-fee2-1">
												<option value="敷引">敷引</option>
											</select>
										</div>
										<div class="edit-roomDetail-input">
											<input type="text" name="first-fee2-2" value="<?= $shikiMoneyValue; ?>">
										</div>
										<div class="edit-roomDetail-select">
											<select name="first-fee2-3">
												<option value="カ月" <?= $keyMoneyFeild_select[0]; ?>>カ月</option>
												<option value="円" <?= $keyMoneyFeild_select[1]; ?>>円</option>
											</select>
										</div>
										）
									</div>

									<div class="firstFee-column">
										<div class="edit-roomDetail-select">
											<select name="first-fee3-1">
												<option value="礼金">礼金</option>
											</select>
										</div>
										<div class="edit-roomDetail-input">
											<input type="text" name="first-fee3-2" value="<?= $keyMoneyValue; ?>">	
										</div>
										<div class="edit-roomDetail-select">		
											<select name="first-fee3-3">
												<option value="カ月" <?= $keyMoneyFeild_select[0]; ?>>カ月</option>
												<option value="円" <?= $keyMoneyFeild_select[1]; ?>>円</option>
											</select>
										</div>
									</div>

									<div class="firstFee-column">	
										<div class="edit-roomDetail-input">
											<input type="text" name="first-fee4-1" value="">
										</div>
										<div class="edit-roomDetail-input">
											<input type="text" name="first-fee4-2">
										</div>
										<div class="edit-roomDetail-select">	
											<select name="first-fee4-3">
												<option value="カ月">カ月</option>
												<option value="円">円</option>
											</select>
										</div>
									</div>

									<div class="firstFee-column">
										<div class="edit-roomDetail-input">
											<input type="text" name="first-fee5-1" value="">
										</div>
										<div class="edit-roomDetail-input">
											<input type="text" name="first-fee5-2">
										</div>
										<div class="edit-roomDetail-select">	
											<select name="first-fee5-3">
												<option value="カ月">カ月</option>
												<option value="円">円</option>
											</select>
										</div>
									</div>
								</td>
							</tr>

	<!-- ここまで初期費用AREA -->



	<!-- ここから駐車場AREA -->

							<tr>
								<th>駐車場</th>
								<td class="parking-area">
									<?php $parking1Check = ($parkingCondition == '空きなし')?'checked':''; ?>
									<input type="radio" id="parking1-1" value="空きなし" name="parking1" <?= $parking1Check; ?>>
									<label for="parking1-1">空きなし</label>
									
									<?php $parking2Check = ($parkingCondition == '空きあり')?'checked':''; ?>
									<input type="radio" id="parking1-2" value="空きあり" name="parking1" <?= $parking2Check; ?>>
									<label for="parking1-2">空きあり</label>
									
									<div class="edit-roomDetail-select">	
										<select name="parking2">
											<option value="">--</option>
											<option value="敷地内" <?= $parkingS1[0]; ?>>敷地内</option>
											<option value="近隣" <?= $parkingS1[1]; ?>>近隣</option>
										</select>
									</div>
									
									<div class="edit-roomDetail-select">	
										<select name="parking3">
											<option value="">--</option>
											<option value="屋内" <?= $parkingS2[0]; ?>>屋内</option>
											<option value="屋外" <?= $parkingS2[1]; ?>>屋外</option>
										</select>
									</div>
									
									<div class="edit-roomDetail-select">				
										<select name="parking4">
											<option value="">--</option>
											<option value="平面" <?= $parkingS3[0]; ?>>平面</option>
											<option value="機械式" <?= $parkingS3[1]; ?>>機械式</option>
											<option value="立体" <?= $parkingS3[2]; ?>>立体</option>
										</select>
									</div>
									
									<div class="roomDetail-input-park">
										<input type="text" name="parking5" value="<?= h($parkingFee); ?>">
										<p>円/月</p>
									</div>
								</td>
							</tr>

	<!-- ここまで駐車場AREA -->



	<!-- ここから入居時期AREA -->
							<tr>
								<th>入居時期</th>
								<td class="roomDetail-circle-radio">
									<span class="roomDetail-circle-column">
										<?php $movingData1Check = ($movingData == '即日')?'checked':''; ?>
										<input type="radio" id="move-in1" value="即日" name="move-in" <?= $movingData1Check; ?>>
										<label for="move-in1">即日</label>
									</span>
									<span class="roomDetail-circle-column">
										<?php $movingData2Check = ($movingData == '相談')?'checked':''; ?>
										<input type="radio" id="move-in2" value="相談" name="move-in" <?= $movingData2Check; ?>>
										<label for="move-in2">相談</label>
									</span>
									<span class="roomDetail-circle-column">
										<input type="radio" id="move-in3" value="" name="move-in">
										<label for="move-in3">文字入力</label>
									</span>
								</td>
							</tr>

	<!-- ここまで入居時期AREA -->



	<!-- ここから部屋詳細AREA -->

							<tr>
								<th>部屋詳細</th>
								<td>
									<?php for($i = 0; $i < 10; $i++): ?>
										<div class="room-detail-column">
											<div class="roomDetail-input1">
												<p><?= $i + 1; ?></p>
												<select name="roomDetail<?= $i + 1; ?>-1">
													<option value="">----</option>
													<option value="洋" <?= $you[$i] ?>>洋</option>
													<option value="和" <?= $wa[$i] ?>>和</option>
													<option value="L" <?= $L[$i] ?>>L</option>
													<option value="D" <?= $D[$i] ?>>D</option>
													<option value="K" <?= $K[$i] ?>>K</option>
													<option value="DK" <?= $DK[$i] ?>>DK</option>
													<option value="LDK" <?= $LDK[$i] ?>>LDK</option>
													<option value="LOFT" <?= $LOFT[$i] ?>>LOFT</option>
												</select>
											</div>
											<div class="roomDetail-input2">
												<input type="text" name="roomDetail<?= $i + 1; ?>-2" value="<?= h($roomDetailArea[$i]); ?>">
												<p>畳</p>
											</div>
										</div>
									<?php endfor; ?>

								</td>
							</tr>

	<!-- ここまで部屋詳細AREA -->



	<!-- ここから所在階・主要採光面AREA -->

							<tr>
								<th>所在階</th>
								<td>
									<div class="roomDetail-input">
										<input type="text" name="story" value="<?= h($story); ?>">
										<p>階</p>
									</div>
								</td>
							</tr>
							<tr>
								<th>主要採光面</th>
								<td>
									<div class="edit-roomDetail-select">	
										<select name="sun">
											<?php for($i = 0; $i < count($sunData); $i++): ?>
												<option value="<?= $sunData[$i]; ?>" <?= $sunChecks[$i]; ?>><?= $sunData[$i]; ?></option>
											<?php endfor; ?>
										</select>
									</div>
								</td>
							</tr>

	<!-- ここまで所在階・主要採光面AREA -->



	<!-- ここからバルコニー面積・住宅保険AREA -->

							<tr>
								<th>バルコニー面積</th>
								<td>
									<div class="roomDetail-input">
										<input type="text" name="balcony" value="<?= h($balcony); ?>">
										<p>㎡</p>
									</div>
								</td>
							</tr>
							<tr>
								<th>住宅保険</th>
								<td class="roomDetail-circle-radio">
									<span class="roomDetail-circle-column">
										<?php $insurance1Check = ($insurance == '要')?'checked':''; ?>
										<input type="radio" id="insurance1" value="要" name="insurance" <?= $insurance1Check; ?>>
										<label for="insurance1">要</label>
									</span>
									<span class="roomDetail-circle-column">
										<?php $insurance2Check = ($insurance == '不要')?'checked':''; ?>
										<input type="radio" id="insurance2" value="不要" name="insurance" <?= $insurance2Check; ?>>
										<label for="insurance2">不要</label>
									</span>
									<span class="roomDetail-circle-column">
										<?php $insurance3Check = ($insurance == '確認')?'checked':''; ?>
										<input type="radio" id="insurance3" value="確認" name="insurance" <?= $insurance3Check; ?>>
										<label for="insurance3">確認</label>
									</span>
								</td>
							</tr>

	<!-- ここまでバルコニー面積・住宅保険AREA -->



	<!-- ここから入居条件AREA -->


							<tr>
								<th>入居条件</th>
								<td class="roomDetail-square-checkbox">
									<?php for($i = 0; $i < count($terms); $i++): ?>
										<span class="roomDetail-square-column">
											<input type="checkbox" id="term<?= $i+1; ?>" value="<?= h($terms[$i]); ?>" name="term<?= $i+1; ?>" <?= $termsCheck[$i]; ?>>
											<label for="term<?= $i+1; ?>"><?= h($terms[$i]); ?></label>
										</span>
									<?php endfor; ?>
								</td>
							</tr>

	<!-- ここまで入居条件AREA -->



	<!-- ここから部屋位置AREA -->

							<tr>
								<th>部屋位置</th>
								<td class="roomDetail-square">
									<?php for($i = 0; $i < count($positions); $i++): ?>
										<span class="roomDetail-square-column">
											<input type="checkbox" id="position<?= $i+1; ?>" value="<?= h($positions[$i]); ?>" name="position<?= $i+1; ?>" <?= $positionCheck[$i]; ?>>
											<label for="position<?= $i+1; ?>"><?= h($positions[$i]); ?></label>
										</span>
									<?php endfor; ?>
								</td>
							</tr>

	<!-- ここまで部屋位置AREA -->



	<!-- ここから特徴/設置品AREA -->

							<tr>
								<th>特徴/設置品</th>
								<td class="roomDetail-square">
									<?php for($i = 0; $i < count($features); $i++): ?>
										<span class="roomDetail-square-column">
											<input type="checkbox" id="feature<?= $i+1; ?>" value="<?= h($features[$i]); ?>" name="feature<?= $i+1; ?>" <?= $featureCheck[$i]; ?>>
											<label for="feature<?= $i+1; ?>"><?= h($features[$i]);
											 ?></label>
										</span>
									<?php endfor; ?>
								</td>
							</tr>

	<!-- ここまで特徴/設置品AREA -->



	<!-- ここから収納 ・ 放送・通信 ・ セキュリティ ・ 特典AREA -->

							<tr>
								<th>収納</th>
								<td class="roomDetail-square">
									<?php for($i = 0; $i < count($receipts); $i++): ?>
										<span class="roomDetail-square-column">
											<input type="checkbox" id="receipt<?= $i+1; ?>" value="<?= h($receipts[$i]); ?>" name="receipt<?= $i+1; ?>" <?= $receiptCheck[$i]; ?>>
											<label for="receipt<?= $i+1; ?>"><?= h($receipts[$i]); ?></label>
										</span>
									<?php endfor; ?>
								</td>
							</tr>

							<tr>
								<th>放送・通信</th>
								<td class="roomDetail-square">
									<?php for($i = 0; $i < count($broadcasts); $i++): ?>
										<span class="roomDetail-square-column">
											<input type="checkbox" id="broadcast<?= $i+1; ?>" value="<?= h($broadcasts[$i]); ?>" name="broadcast<?= $i+1; ?>" <?= $broadcastCheck[$i]; ?>>
											<label for="broadcast<?= $i+1; ?>"><?= h($broadcasts[$i]); ?></label>
										</span>
									<?php endfor; ?>
								</td>
							</tr>

							<tr>
								<th>セキュリティ</th>
								<td class="roomDetail-square">
									<?php for($i = 0; $i < count($securitys); $i++): ?>
										<span class="roomDetail-square-column">
											<input type="checkbox" value="<?= h($securitys[$i]); ?>" id="security<?= $i+1; ?>" name="security<?= $i+1; ?>" <?= $securityCheck[$i]; ?>>
											<label for="security<?= $i+1; ?>"><?= h($securitys[$i]); ?></label>
										</span>
									<?php endfor; ?>
								</td>
							</tr>

							<tr>
								<th>特典</th>
								<td class="roomDetail-square">
									<?php for($i = 0; $i < count($privileges); $i++): ?>
										<span class="roomDetail-square-column">
											<input type="checkbox" value="<?= h($privileges[$i]); ?>" id="privilege<?= $i+1 ?>" name="privilege<?= $i+1 ?>" <?= $privilegeCheck[$i]; ?>>
											<label for="privilege<?= $i+1 ?>"><?= h($privileges[$i]); ?></label>
										</span>
									<?php endfor; ?>
								</td>
							</tr>

	<!-- ここまで収納 ・ 放送・通信 ・ セキュリティ ・ 特典AREA -->

						</table>
						<button type="submit">変更する</button>
						<input type="hidden" name="roomListSet" value="true">
						<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
					</form>

	<!-- ここから間取り・内観写真AREA -->

					<form id="form1" action="" method="post" enctype="multipart/form-data" class="roomDetail-big-images">
						<div class="roomDetail-big-image modal-open-click">
							<h3>間取り</h3>
							<?php if(h($floorImage) !== ''): ?>
								<div class="roomDetail-big-image-I">
									<span style="background-image: url('../../../../MyHome/Landlord/<?= $_SESSION['userUrl']; ?>/images/<?= h($floorImage); ?>')"></span>
									<i id="first" class="fa fa-times" aria-hidden="true"></i>
								</div>
								<label for="rdb1-img">画像変更</label>
								<input id="rdb1-img" type="file" name="fileB1" onChange="$('#form1').submit();" style="display: none;">
							<?php else: ?>
								<div class="roomDetail-big-image-I">
									<span style="background-image: url('../../../Configuration/images/sample.gif')"></span>
								</div>
								<label for="rdb1-img">画像を追加</label>
								<input id="rdb1-img" type="file" name="fileB1" onChange="$('#form1').submit();" style="display: none;">	
							<?php endif; ?>
						</div>

						<div class="roomDetail-big-image modal-open-click">
							<h3>内観画像</h3>
							<?php if(h($previewImage) !== ''): ?>
								<div class="roomDetail-big-image-I">
									<span style="background-image: url('../../../../MyHome/Landlord/<?= $_SESSION['userUrl']; ?>/images/<?= h($previewImage); ?>')"></span>
									<i id="second" class="fa fa-times" aria-hidden="true"></i>
								</div>
								<label for="rdb2-img">画像変更</label>
								<input id="rdb2-img" type="file" name="fileB2" onChange="$('#form1').submit();" style="display: none;">
							<?php else: ?>
								<div class="roomDetail-big-image-I">
									<span style="background-image: url('../../../Configuration/images/sample.gif')"></span>
								</div>
								<label for="rdb2-img">画像を追加</label>
								<input id="rdb2-img" type="file" name="fileB2" onChange="$('#form1').submit();" style="display: none;">	
							<?php endif; ?>
						</div>
						<input type="hidden" name="bImgSet" value="true">
						<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
					</form>
 
	<!-- ここから間取り・内観写真AREA -->



	<!-- ここからその他内観写真AREA -->

					<div class="roomDetail-small-images cf">
						<h3>その他内観</br>設備画像</h3>
						<form id="form2" action="" method="post" enctype="multipart/form-data">
							<?php for ($i = 0; $i < 10; $i++) : ?>
								<div class="roomDetail-small-image modal-open-click cf">
									<?php if (!empty($previewImages_block[$i])) : ?>

										<input type="text" name="facilityNames<?= $i; ?>" value="<?= h($previewsNames_block[$i]); ?>" placeholder="タイトル">
										<div class="roomDetail-small-image-I">
											<span style="background-image:url('../../../../MyHome/Landlord/<?= $_SESSION['userUrl']; ?>/images/<?= h($previewImages_block[$i]); ?>')"></span>
											<i id="<?= $i ?>" class="fa fa-times" aria-hidden="true"></i>
										</div>
										<textarea name="facilityTexts<?= $i; ?>"><?= h($previewsTexts_block[$i]); ?></textarea>
										<label for="smImgs<?= $i ?>">画像変更</label>
										<input id="smImgs<?= $i ?>" type="file" name="file<?= $i ?>" onChange="$('#form2').submit();" style="display: none;">

									<?php else : ?>

										<div class="roomDetail-small-image-input">タイトル欄</div>
										<div class="roomDetail-small-image-I">
											<span style="background-image:url('../../../Configuration/images/sample.gif')"></span>
										</div>
										<label for="smImgs<?= $i ?>">画像を追加</label>
										<input id="smImgs<?= $i ?>" type="file" name="file<?= $i ?>" onChange="$('#form2').submit();" style="display: none;">

									<?php endif; ?>
								</div>
							<?php endfor; ?>
							<button text="submit">更新する</button>
							<input type="hidden" name="roomFacSet" value="true">
							<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
						</form>
					</div>

	<!-- ここまでその他内観写真AREA -->

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