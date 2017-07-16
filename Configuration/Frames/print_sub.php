


		<div class="sub-content">
			<button onclick="window.print()">
				<i class="fa fa-print" aria-hidden="true"></i>
				印刷/PDF
			</button>
			<div class="sub-content-list">
				<ul>
					<?php for ($i = 0; $i < $modelNum; $i++) :?>
					<?php $activeM = ($frameNum == $i)? 'active-menu' : ''; ?>
						<li>
							<a class="<?= $activeM ?>" href="/Landlords/Print/Handbill/?frame=<?= $i ?>"><?= $modelName[$i] ?></a>
						</li>
					<?php endfor; ?>
				</ul>
			</div>
		</div>