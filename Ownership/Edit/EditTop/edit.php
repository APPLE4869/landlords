
	<!-- ここからEdit -->

	<div id="content" class="content">
		<div class="content-inner">
			<?php include(dirname(__FILE__) . '/../../../Configuration/Frames/edit_sub.php'); ?>
			<div class="main-content">
				<div class="sub-section-title">
					<h3>トップページ</h3>
				</div>

	<!-- ここからUpdate処理結果表示 -->

				<?php if(isset($updateImage)): ?>
					<div class="registration-ok">
						<h2>画像情報を変更しました！</h2>
					</div>
				<?php endif; ?>

				<?php if(isset($deleteImage)): ?>
					<div class="registration-ok">
						<h2>画像情報を削除しました！</h2>
					</div>
				<?php endif; ?>

				<?php if(isset($updateMyInfo)): ?>
					<div class="registration-ok">
						<h2>自己紹介情報を変更しました！</h2>
					</div>
				<?php endif; ?>

				<?php if(isset($updateYoutube)): ?>
					<div class="registration-ok">
						<h2>動画情報を変更しました！</h2>
					</div>
				<?php endif; ?>

				<?php if (count($errors)) : ?>
					<div class="registration-ok">
						<h2><?= h($errors['topImage']); ?></h2>
					</div>
				<?php endif; ?>
		
	<!-- ここまでUpdate処理結果表示 -->

				<div class="edit-top-content">

	<!-- ここからスライド写真変更AREA -->

					<form action="" method="post" enctype="multipart/form-data" id="form">
						<div class="paging-explain">
							<h2>画像</h2>
							<p>トップページの最初に出てくる写真です。最も物件のイメージに直結する写真ですので、より良い写真をお選びいただくと、お客様にとても良い印象を与えられるかと思います。</br>写真は最大6種まで選択できます。6つのうち、左上の写真が最初に表示される写真になります。</p>
						</div>
						<?php for($i = 0; $i < 6; $i++): ?>
							<div class="top-image-column modal-open-click">
								<ul class="top-image-column-inner">
									<?php if(!empty($images_block[$i])): ?>
										<i id="<?= $i ?>" class="fa fa-times" aria-hidden="true"></i>
										<li style='background-image: url("./../../../../MyHome/Landlord/<?= $_SESSION['userUrl']; ?>/images/<?= h($images_block[$i]); ?>')>
											<label for="topImage<?= $i ?>">画像変更</label>
											<input id="topImage<?= $i ?>" type="file" name="file<?= $i ?>" onChange="$('#form').submit();" style="display: none;">
									<?php else: ?>
										<li style='background-image: url("../../../Configuration/images/sample.gif")'>
											<label for="topImage<?= $i ?>">画像追加</label>
											<input id="topImage<?= $i ?>" type="file" name="file<?= $i ?>" onChange="$('#form').submit();" style="display: none;">
									<?php endif; ?>
								</ul>
							</div>
						<?php endfor; ?>
						<input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
						<input type="hidden" name="topImages" value="true">
					</form>

	<!-- ここまでスライド写真変更AREA -->

	<!-- ここからスライド写真変更AREA -->

					<form action="" method="post">
						<div class="paging-explain">
							<h2>建物説明</h2>
							<p>全ページの一番上に表示される建物説明になります。建物の特徴を端的に書いてもらえるとお客様に素早く建物の特徴を感じとっていただけるかと思います。</p>
						</div>
						<div class="header-text-area">
							<textarea name="header-text"><?= h($text); ?></textarea>
						</div>
						<button type="submit">更新する</button>
						<input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
					</form>

	<!-- ここまでスライド写真変更AREA -->



	<!-- ここから大家さん自己紹介AREA -->

					<div class="myInfo-inner">
						<form action="" method="post" enctype="multipart/form-data" id="form-mi">
							<div class="paging-explain">
								<h2>大家さんの自己紹介</h2>
								<p>大家さんからの自己紹介欄になります。短すぎても長すぎても良くありませんので、200文字弱を推奨しています。ぜひお客様への物件アピールにご利用ください。</br>写真1枚と個人ブログへの誘導ボタンを設置可能です。写真の場合は「画像追加」からご希望の写真を追加、ブログへの誘導の場合は、ブログのURLを記入の上、「更新する」を押してください。</p>
							</div>
							<div class="topMyinfo-image-column modal-open-click">
								<?php if(!empty($images_block[6])): ?>
									<div class="myinfo-bgImg">
										<span style="background-image: url('../../../../MyHome/Landlord/<?= h($_SESSION['userUrl']); ?>/images/<?= h($images_block[6]); ?>')"></span>
										<i id="<?= $i ?>" class="fa fa-times" aria-hidden="true"></i>
									</div>
									<label for="topImage6">画像変更</label>
									<input id="topImage6" type="file" name="file6" onChange="$('#form-mi').submit();" style="display: none;">
								<?php else: ?>
									<div class="myinfo-bgImg">
										<span style="background-image: url('../../../Configuration/images/sample.gif')"></span>
									</div>
									<label for="topImage6">画像追加</label>
									<input id="topImage6" type="file" name="file6" onChange="$('#form-mi').submit();" style="display: none;">
								<?php endif; ?>
							</div>
							<div class="myinfo-blog-url">
								<h3>個人ブログURL</3>
								<input type="text" name="blogUrl" value="<?= $blogUrl; ?>" placeholder="個人ブログのURL">
							</div>
							<textarea name="myInfo"><?= h($myInfo); ?></textarea>
							<button type="submit">更新する</button>
							<input type="hidden" name="miImage" value="true">
							<input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
						</form>
					</div>

	<!-- ここまで大家さん自己紹介AREA -->



	<!-- ここからYoutube動画変更AREA -->
					<div class="youtube-inner">
						<form action="" method="post">
							<div class="paging-explain">
								<h2>動画掲載</h2>
								<p>Youtubeにアップされた動画を掲載することができます。物件のイメージを動画でも伝えたいという方は、ぜひご活用ください。</br></br><span class="red">【記入法】</span></br>Youtubeで掲載したい動画のページに「共有」ボタンがあります。「共有」をクリック後、「埋め込みコード」をクリックすると、下のコードが出てきます。</br>その中で、下の「○○○○○」に当たる部分を記入してください。</p></br>
								<pre>&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;○○○○○&quot; </br>frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;</pre>
							</div>
							<?php if(!empty($youtube)): ?>
								<div class="youtube-frame">
									<iframe src="<?= h($youtube); ?>" frameborder="0" allowfullscreen></iframe>
								</div>
							<?php endif; ?>
							<input type="url" name="youtube" value="<?= h($youtube); ?>" placeholder="Youtube動画 URL">
							<button type="submit">更新する</button>
							<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
						</form>
					</div>

	<!-- ここまでYoutube動画変更AREA -->

				</div>
			</div>
		</div>
	</div>

	<!-- ここまでEdit -->



	<!-- ここから画像変更用Modal -->

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

	<!-- ここまで画像変更用Modal -->