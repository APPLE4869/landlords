	<!-- ここからEdit -->
	
	<div id="content" class="content">
		<div class="content-inner">
			<?php include(dirname(__FILE__) . '/../../Configuration/Frames/print_sub.php'); ?>
			<div class="main-content">
				<div class="sub-section-title">
					<h3>チラシ生成</h3>
				</div>
				<div class="print-buildings">
					<form id="buildingNum" action="" method="post">
						<select name="buildingNum" onChange='$("#buildingNum").submit();'>
							<?php for ($i = 0; $i < count($buildingsNames); $i++) : ?>
								<option value="<?= $i; ?>" <?= h($selected[$i]); ?>><?= h($buildingsNames[$i]); ?></option>
							<?php endfor; ?>
						</select>
						<input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
					</form>
				</div>
				<?php include(dirname(__FILE__) . '/../layout/' . $layouts[$frameNum]); ?>
				<div class="print-form">
					<button onclick="window.print()">
						<i class="fa fa-print" aria-hidden="true"></i>
						印刷/PDF
					</button>
				</div>
			</div>
		</div>
	</div>

	<!-- ここまでEdit -->