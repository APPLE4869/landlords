
	<!-- ここからEdit -->

	<div id="content" class="content">
		<div class="content-inner">
			<?php include(dirname(__FILE__) . '/../../../Configuration/Frames/edit_sub.php'); ?>
			<div class="main-content">
				<div class="sub-section-title">
					<h3>お知らせ</h3>
				</div>

	<!-- ここからUpdate処理結果表示 -->

				<?php if(isset($update) && isset($deleted)): ?>
					<div class="registration-ok">
						<h2>お知らせ情報を削除しました！</h2>
					</div>
				<?php elseif(isset($update)): ?>
					<div class="registration-ok">
						<h2>お知らせ情報を変更しました！</h2>
					</div>
				<?php endif; ?>

				<?php if(isset($newCreated)): ?>
					<div class="registration-ok">
						<h2>新規お知らせを追加しました！</h2>
					</div>
				<?php endif; ?>

				<?php if (count($success)) :?>
					<div class="registration-ok">
						<h2><?= $success['noticeNum']; ?></h2>
					</div>
				<?php endif; ?>

	<!-- ここからUpdate処理結果表示 -->
	
				<div class="edit-top-content">
					<div id="notice-btn" class="notice-btn">
						<h3>お知らせを追加</h3>
					</div>
					<div class="public-notice-num">
						<div class="paging-explain">
							<h2>公開お知らせ数</h2>
							<p>最新のお知らせ情報のうち何件をホームページに掲載するかを決める欄になります。(初期設定では最新3件を表示します)</p>
						</div>
						<form id="public-notice-num-form" action="" method="post">
							<select id="public-notice-num" name="public-notice-num">
								<?php for ($i = 1; $i <= count($noticesId_block); $i++) : ?>
									<option <?= $public_notice_check[$i] ?>><?= $i ?>つ公開
								<?php endfor; ?>
							</select>
							<input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
						</form>
					</div>
					<div class="public-notice-num">
						<div class="paging-explain">
							<h2>お知らせ一覧</h2>
							<p>公開中のお知らせ一覧になります。「編集」する際には、編集したいお知らせをクリックしてください。</p>
						</div>
					</div>
					<div class="edit-notice-content">
					<?php if($noticesSitation == 'true'): ?>
						<?php $i = 0; ?>
						<?php foreach($createds_block as $created_block): ?>
							<ul id="<?= $i ?>">
								<li><?= h($created_block); ?></li>
								<li><?= h($titles_block[$i]); ?></li>
								<li><?= h($texts_block[$i]); ?></li>
							</ul>
							<div class="notice-modal-form">
								<form action="" method="post">
									<i class="fa fa-times" aria-hidden="true"></i>
										<div class="notice-modal-input">
											<p>公開日</p>
											<input type="text" name="created<?= $i; ?>" value="<?= h($created_block); ?>">
										</div>
										<div class="notice-modal-input">
											<p>タイトル</p>
											<input type="text" name="title<?= $i; ?>" value="<?= h($titles_block[$i]); ?>">
										</div>
										<textarea name="text<?= $i; ?>"><?= h($texts_block[$i]); ?></textarea>
										<div class="noticeDelete-column">
											<input type="checkbox" id="delete<?= $i; ?>" value="check" name="noticeDelete<?= $i; ?>">
											<label for="delete<?= $i; ?>">削除</label>
										</div>
									<button type="submit">変更する</button>
									<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
									<input type="hidden" name="noticeSet" value="true">
								</form>
							</div>
						<?php $i++; ?>
						<?php endforeach; ?>
						<?php else: ?>
							<h3>現在公開されている</br>お知らせ情報はありません。</h3>
						<?php endif; ?>
						<div id="notice-btn-open" class="notice-modal-form">
							<form action="" method="post">
								<i class="fa fa-times" aria-hidden="true"></i>
								<div class="notice-modal-input">
									<p>公開日</p>
									<input type="text" name="newCreated" value="<?= date('Y'); ?>-<?= date('m'); ?>-<?= date('d'); ?>">
								</div>
								<div class="notice-modal-input">
									<p>タイトル</p>
									<input type="text" name="newTitle" placeholder="タイトル">
								</div>
								<textarea name="newText" placeholder="お知らせ内容"></textarea>
								<button type="submit">新規追加</button>
								<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ここまでEdit -->