				
			<?php

			$thisdir = basename(dirname($_SERVER['SCRIPT_NAME']));

			function nowNav($thisdir, $dir) {
				$nowNav = ($thisdir == $dir) ? 'nowNav':'' ;
				return $nowNav;
			}

			$nowNav1 = nowNav($thisdir, "Edit");
			$nowNav2 = nowNav($thisdir, "EditPartner");
			$nowNav3 = nowNav($thisdir, "EditRoom");
			$nowNav3 = ($nowNav3 == '') ? nowNav($thisdir, "EditRoomDetail"):$nowNav3;
			$nowNav4 = nowNav($thisdir, "EditManage");
			$nowNav5 = nowNav($thisdir, "EditTop");
			$nowNav6 = nowNav($thisdir, "EditBuilding");
			$nowNav7 = nowNav($thisdir, "EditCampaign");
			$nowNav8 = nowNav($thisdir, "EditLocation");
			$nowNav8 = ($nowNav8 == '') ? nowNav($thisdir, "EditLocationDetail"):$nowNav8;
			$nowNav9 = nowNav($thisdir, "EditContact");
			$nowNav10 = nowNav($thisdir, "EditNotice");
			$nowNav11 = nowNav($thisdir, "EditImages");

			?>

			<div id="nav-menu" class="nav-menu">
				<i class="fa fa-bars" aria-hidden="true"></i>
				<h4>MENU</h4>
			</div>

			<div id="menus-overlay" class="menus-overlay"></div>

			<div id="sub-content" class="sub-content">
				<div class="sub-content-title">
					<h3><?= h($buildingName); ?></h3>
				</div>
				<div class="sub-content-list">
					<ul>
						<li class="sub-list-primary"><a href="/MyHome/Landlord/<?= h($_SESSION['userUrl']); ?>/<?= h($file_name); ?>/top/" target="_blank">ホームページを見る</a><li>
						<li class="sub-list-primary"><a id="<?= $nowNav1; ?>" href="/Landlords/Ownership/Edit/">物件概要</a></li>
						<li class="sub-list-trivial"><a id="<?= $nowNav2; ?>" href="/Landlords/Ownership/Edit/EditPartner/">建物情報編集</a></li>
						<li class="sub-list-primary"><a id="<?= $nowNav3; ?>" href="/Landlords/Ownership/Edit/EditRoom/">部屋の情報</a></li>
						<li class="sub-list-primary"><a id="<?= $nowNav4; ?>" href="/Landlords/Ownership/Edit/EditManage/">ホームページ管理</a></li>
						<li class="sub-list-trivial"><a id="<?= $nowNav5; ?>" href="/Landlords/Ownership/Edit/EditTop/">トップページ</a></li>
						<li class="sub-list-trivial"><a id="<?= $nowNav6; ?>" href="/Landlords/Ownership/Edit/EditBuilding/">建物情報</a></li>
						<li class="sub-list-trivial"><a id="<?= $nowNav7; ?>" href="/Landlords/Ownership/Edit/EditCampaign/">キャンペーン</a></li>
						<li class="sub-list-trivial"><a id="<?= $nowNav8; ?>" href="/Landlords/Ownership/Edit/EditLocation/">周辺情報</a></li>
						<li class="sub-list-trivial"><a id="<?= $nowNav9; ?>" href="/Landlords/Ownership/Edit/EditContact/">お問い合わせ</a><li>
						<li class="sub-list-trivial"><a id="<?= $nowNav10; ?>" href="/Landlords/Ownership/Edit/EditNotice/">お知らせ</a><li>
						<!--<li class="sub-list-trivial"><a id="<?= $nowNav11; ?>" href="/Landlords/Ownership/Edit/EditImages/">保存画像</a><li>-->
					</ul>
				</div>
			</div>