<?php

$buildingsNames = [];
$traffic1Block = [];
$traffic2Block = [];
$traffic3Block = [];
$roomIds = [];
$addressCodeBlock = [];
$addressBlock = [];
$constructBlock = [];
$oldBlock = [];
$facilityBlock = [];
$nameBlock = [];

function trafficOut($traffic) {
	if (isset($traffic)) {
		list($non, $traffic) = explode('&', $traffic);
	}
	if (isset($traffic)) {
		list($wayside, $station, $time) = explode(' ', $traffic);
		return [$wayside, $station, $time];
	}
}

$mysql = 'select * from buildings where user = \'' . $_SESSION['userUrl'] . '\'';
foreach($dbh->query($mysql) as $row) {
	array_push($buildingsNames, $row['building_name']);

	array_push($traffic1Block, trafficOut($row['traffic1']));
	array_push($traffic2Block, trafficOut($row['traffic2']));
	array_push($traffic3Block, trafficOut($row['traffic3']));

	array_push($roomIds, $row['room_id']);

	$addressCode = '〒' . $row['zip1'] . '-' . $row['zip2'];
	array_push($addressCodeBlock, $addressCode);

	$address = $row['pref'] . $row['addr1'] . $row['addr2']; 
	array_push($addressBlock, $address);

	$construct = $row['building_construct'] . $row['building_story'] . '階建';
	array_push($constructBlock, $construct);

	if (isset($row['old'])) {
		list($oldYear, $oldMonth) = explode('&', $row['old']);
	}
	$old = $oldYear . '年' . $oldMonth . '月';
	array_push($oldBlock, $old);

	array_push($facilityBlock, $row['facility']);

	array_push($nameBlock, $row['contact_name']);
}

$mysql = 'select * from users where url = \'' . $_SESSION['userUrl'] . '\'';
foreach ($dbh->query($mysql) as $row) {
	$phoneNum = $row['phone'];
	$email = $row['email'];
}

$roomDetail = [
	'バス・トイレ別室', '温水洗浄便座', '収納すスペース', '追焚機能付', '給油', 'CATV', 'シャワー', 'システムキッチン', 'ロフト', '光ファイバー', '浴室乾燥機付', 'ガスコンロ設置可', 'フローリング', 'エレベーター', '洗顔洗面化粧台', '都市ガス', 'オートロック', '角部屋', '洗濯機置場(室内)', 'プロパンガス', 'エアコン', 'ベット相談', 'モニタ付インターホン', 'ベランダ・バルコニー'
];

$modelName = [
	'シンプルデザイン(縦)', 'シンプルデザイン(横)'	
];

$layouts = [
	'simple.layout1.php', 'simple.layout2.php'
];

$designs = [
	'simple.design1.php', 'simple.design2.php'
];

$modelNum = count($layouts);