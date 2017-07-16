<style>

/*-------  ここからPrint 大枠  --------*/

.print-image {
	color: #424242;
	border: 2px solid #424242;
	width: 297mm;
	height: 210mm;
	padding: 10mm 8mm;
	margin: 0 auto 30px;
	color: #2E2E2E;
	font-size: 0;
}

@media print {
	
	.main-content {
		display: block;
		width: 297mm;
		height: 210mm;
		overflow: hidden;
		margin: 0;
	}

	.print-image {
		display: block;
		border-style: none;
		width: 297mm;
		height: 210mm;
		padding: 10mm 8mm;
		margin: 0;
	}
	
}

.logo h3 {
	font-family: 'Lobster', cursive;
	position: absolute;
	right: 16.666%;
	transform: translateX(-50%);
	bottom: -5.7mm;
	line-height: 5.7mm;
	font-size: 4mm;
	font-weight: bold;
}

/*-------  ここまでPrint 大枠 --------*/

/*-------  ここからArea-Provision --------*/

.images-frame label {
	cursor: pointer;

	transition: .3s;
}

.images-frame label:hover {
	box-shadow: 0 0 25px rgba(0, 0, 0, 0.4);

	transition: .3s;
}

.left-area {
	height: 86%;
	display: inline-block;
	vertical-align: top;
	width: 66.666%;
}

.left-top-area {
	height: 119mm;
	font-size: 0;
}

.left-bottom-area {
	font-size: 0;
	height: 44mm;
}

.LT-big-images {
	vertical-align: top;
	display: inline-block;
	width: 80%;
	font-size: 0;
}

.RT-small-images {
	vertical-align: top;
	display: inline-block;
	width: 20%;
}

.B-middle-images {
	font-size: 0;
}

.right-area {
	position: relative;
	height: 83%;
	display: inline-block;
	vertical-align: top;
	width: 33.333%;
}

.footer {
	position: relative;
	font-size: 0;
	width: 100%;
	height: 14%;
	border: .5mm solid #000000;
}

.images-frame {
	position: relative;
	height: 0;
}

.images-frame label {
	position: absolute;
	top: .5mm;
	right: .5mm;
	left: .5mm;
	bottom: .5mm;
	background-size: cover;
	background-position: center center;
}

.footer-left {
	width: 18%;
	display: inline-block;
	vertical-align: top;
}

.footer-center {
	padding: .6mm 0;
	width: 52%;
	display: inline-block;
	vertical-align: top;
}

.footer-right {
	padding: .75mm 0;
	width: 30%;
	display: inline-block;
	vertical-align: top;
}

/*-------  ここまでArea-Provision --------*/

/*-------  ここからLeft-Image-LT-Big-Images --------*/

.LT-big-images span {
	vertical-align: top;
	display: inline-block;
	width: 50%;
	padding-top: 43.5mm;
}

/*-------  ここまでLeft-Image-LT-Big-Images --------*/

/*-------  ここからLeft-Image-RT-Small-Images --------*/

.RT-small-images span {
	display: block;
	width: 100%;
	padding-top: 29mm;
}

/*-------  ここまでLeft-Image-RT-Small-Images --------*/

/*-------  ここからLeft-Image-B-Middle-Images --------*/

.B-middle-images span {
	vertical-align: top;
	display: inline-block;
	width: 25%;
	padding-top: 32.20mm;
}

/*-------  ここまでLeft-Image-B-Middle-Images --------*/

/*-------  ここからLeft-Image-Bottom-Images --------*/

.left-bottom-area {
	padding: 5mm;
}

.left-bottom-area span {
	display: inline-block;
	vertical-align: top;
	width: 50%;
	position: relative;
	height: 0;
	padding-top: 34mm;
}

.left-bottom-area label {
	position: absolute;
	right: 0;
	left: 0;
	bottom: 0;
	background-size: contain;
	background-position: center center;
	background-repeat: no-repeat;
}

/*-------  ここまでLeft-Image-Bottom-Images --------*/

/*-------  ここからRight-Table-First --------*/

.right-area th, td {
	font-weight: bold;
}

.right-area span {
	cursor: pointer;
	transition: .3s;
}

.right-area span:hover {
	background: rgba(0, 0, 0, 0.2);

	transition: .3s;
}

.right-area span:focus {
	background: #fff;
	cursor: text;
}

.right-area table {
	width: 100%;
	border-right: .5mm solid #000000;
	border-left: .5mm solid #000000;
}

.right-area table:first-child {
	border-top: .5mm solid #000000;
}

.right-area-second {
	border-bottom: .5mm solid #000000;
}

.right-area tr {
	width: 100%;
}

.right-area-first th {
	width: 18mm;
	font-size: 2.8mm;
	text-align: center;
}

.right-area-first tr {
	border-bottom: .5mm solid #000000;
}

.right-area-first th {
	border-right: .5mm solid #000000;
}

.right-area-first thead tr {
	height: 8mm;
}

.right-area-first thead td {
	line-height: 8mm;
	text-align: center;
	font-weight: 900;
	font-size: 4mm;
}

.focus-text {
	font-size: 6mm;
	background: #add8e6;
}

.right-area-first tbody tr {
	height: 6mm;
}

.right-area-first tbody th:nth-of-type(2) {
	border-left: .5mm solid #000000;
}

.right-area-first tbody td {
	font-size: 2.5mm;
	text-align: right;
}

.right-area-first tfoot tr {
	height: 4mm;
}

.right-area-first tfoot td {
	line-height: 4mm;
	font-size: 2.5mm;
	text-align: center;
}

.sun-detail {
	text-align: center;
	border-left: .5mm solid #000000;
	font-size: 3mm;
	line-height: 2.6mm;
}

#text-align-center {
	text-align: center;
}

/*-------  ここまでRight-Table-First --------*/

/*-------  ここからRight-Table-Second --------*/

.right-area-second th {
	width: 3.5mm;
	font-size: 2mm;
	text-align: center;
	border-right: .5mm solid #000000;
	transform: scale(0.7);
}

.right-area-second tr {
	border-bottom: .5mm solid #000000;
	overflow: hidden;
}

.right-area-second tr:first-child {
	height: 20mm;
}

.right-area-second tr:nth-of-type(2) {
	height: 14.4mm;
}

.right-area-second tr:last-child {
	border-style: none;
	height: 50mm;
}

.right-area-second td {
	padding: 1mm .5mm;
	font-size: 2.8mm;
	line-height: 3.4mm;
}

/*-------  ここまでRight-Table-Second --------*/

/*-------  ここからFooter-Label --------*/

.footer-left {
	border-right: .5mm solid #000000;
}

.footer-left p {
	cursor: pointer;
	font-size: 2.8mm;
	line-height: 6mm;
	transition: .3s;
}

.footer-left p:hover {
	background: rgba(0, 0, 0, 0.2);
	transition: .3s;
}

.footer-left h4 {
	cursor: pointer;
	bottom: 2mm;
	left: 1mm;
	font-size: 3.2mm;
	line-height: 3.2mm;
	position: absolute;
	color: #ff0000;
	font-weight: bold;
	background: #fff;
	height: 3.2mm;
	transition: .3s;
}

.footer-left h4:hover {
	background: rgba(0, 0, 0, 0.2);
	transition: .3s;
}

.footer-left:focus {
	background: #fff;
	cursor: text;
}

.footer-center {
	border-right: .5mm solid #000000;
}

.footer-center h4 {
	cursor: pointer;
	text-align: center;
	line-height: 8.4mm;
	font-size: 5.5mm;
	font-weight: 900;
	transition: .3s;
}

.footer-center h4:hover {
	background: rgba(0, 0, 0, 0.2);
	transition: .3s;
}

.footer-center h4:focus {
	background: #fff;
	cursor: text;
}

.footer-right li {
	cursor: pointer;
	font-size: 4mm;
	line-height: 8.3mm;
	font-weight: bold;
	text-align: center;
	transition: .3s;
}

.footer-right li:hover {
	background: rgba(0, 0, 0, 0.2);
	transition: .3s;
}

.footer-right li:last-child {
	font-size: 3.5mm;
}

.footer-center:right {
	background: #fff;
	cursor: text;
}

/*-------  ここまでFooter-Label --------*/

</style>