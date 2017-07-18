<?php

//tcpdf.phpを読み込む
require_once(dirname(__FILE__) . '/../../Configuration/tcpdf/tcpdf.php');
//ページの設定
$pdf = new TCPDF("P", "mm", "A4", true, "UTF-8" );
//フォントの設定
$pdf->SetFont('kozminproregular', '', 12);
//ヘッダーとフッターを消すよ
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->SetMargins(20, 10, true);

$pdf->AddPage();

$html = file_get_contents('handbill.php');
$css = file_get_contents('handbill.style.php');

//出力するところ
//$pdf->writeHTML($_POST['css'] . $_POST['$html'], true, 0, treu, 0);
$pdf->writeHTML($css . $html, true, 0, treu, 0);

ob_end_clean();
$pdf->Output("test.pdf", "I");