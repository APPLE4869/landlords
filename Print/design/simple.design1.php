<style>

/*-------  ここからPrint 大枠  --------*/

.print-image {
	color: #424242;
	border: 2px solid #424242;
	width: 210mm;
	height: 297mm;
	padding: 10mm 5mm;
	margin: 0 auto 30px;
	color: #2E2E2E;
}

.out-line {
	border: 1mm solid #FA5858;
	padding: 3mm;
	border-radius: 3mm;
	font-size: 0;
	height: 86%;
}

@media print {
	
	.main-content {
		display: block;
		width: 210mm;
		height: 297mm;
		overflow: hidden;
		padding: 0;
		margin: 0;
	}

	.print-image {
		display: block;
		border-style: none;
		width: 210mm;
		height: 297mm;
		padding: 10mm 5mm;
		margin: 0;
	}
	
}


/*-------  ここまでPrint 大枠 --------*/

/*-------  ここからPrint-top --------*/

.top-detail {
	width: 100%;
	font-size: 5mm;
	border: 1mm solid #CEF6F5;
	border-radius: 3mm;
	height: 15%;

	transition: .3s;
}

.top-detail span {
	cursor: pointer;
}

.top-detail span:hover {
	background: rgba(0, 0, 0, 0.2);

	transition: .3s;
}

.top-detail span:focus {
	background: #fff;
	cursor: text;
}

.font-weight-char {
	font-weight: 900;
	font-size: 7mm;
}

.top-detail tr {
	width: 100%;
	height: 12mm;
}

.top-detail tr:last-child {
	border-style: none;
}

.top-detail th {
	text-align: center;
	font-size: 6mm;
	font-weight: bold;
	border-right: 1mm solid #CEF6F5;
	border-bottom: 1mm solid #CEF6F5;
}

.top-detail td {
	font-size: 5mm;
	border-bottom: 1mm solid #CEF6F5;
}

.top-bc {
	font-weight: 900;
	background: #CEF6F5;
}

.top-border-left {
	border-left: 1mm solid #CEF6F5;
}

/*-------  ここまでPrint-top --------*/

/*-------  ここからPrint-middle-left --------*/

.middleLeft-detail {
	display: inline-block;
	vertical-align: middle;
	width: 55%;
	max-height: 48%;
}

.middleLeft-detail-explain {
	cursor: pointer;
	height: 36%;
	padding-bottom: 1%;

	transition: .3s;
}

.middleLeft-detail-explain:hover {
	background: rgba(0, 0, 0, 0.2);

	transition: .3s;
}

.middleLeft-detail-explain:focus {
	background: #fff;
	cursor: text;
}

.middleLeft-detail h2 {
	font-size: 7mm;
	font-weight: 900;
	text-align: center;
}

.middleLeft-detail li {
	list-style: none;
	font-size: 4mm;
	padding-right: 3mm;
	display: inline-block;
	color: blue;
	font-weight: bold;
}

.middleLeft-detail h3 {
	font-size: 4.5mm;
	font-weight: bold;
}

.images-frame {
	display: block;
	position: relative;
	height: 0;
}

.middleleft-images  {
	width: 85%;
	margin: 0 auto;
	padding-top: 70%;
}

.images-frame label {
	cursor: pointer;
	position: absolute;
	top: 0;
	right: 0;
	left: 0;
	bottom: 0;
	background-size: cover;
	background-position: center center;

	transition: .3s;
}

.images-frame label:hover {
	box-shadow: 0 0 25px rgba(0, 0, 0, 0.4);

	transition: .3s;
}

/*-------  ここまでPrint-middle-left --------*/

/*-------  ここからPrint-middle-right --------*/

.middleRight-detail {
	display: inline-block;
	vertical-align: middle;
	width: 45%;
	height: 48%;
}

.middleRight-detail-image2 {
	width: 60%;
	padding-top: 60%;
	margin: 1% auto .5%;
}

.middleRight-detail-image2 label {
	background-size: contain;
	background-repeat: no-repeat;
}

.middleRight-detail-image3 {
	width: 85%;
	padding-top: 65%;
	margin: .5% auto 0;
}

/*-------  ここまでPrint-middle-right --------*/

/*-------  ここからPrint-middle-bottom --------*/

.middleBottom-detail {
	width: 100%;
	font-size: 0;
	height: 30%;
	padding-top: 5mm;
}

.middleBottom-left-detail {
	display: inline-block;
	vertical-align: top;
	width: 50%;
}

.middleBottom-detail table {
	width: 95%;
	margin: 2mm auto;

	transition: .3s;
}

.middleBottom-detail span {
	cursor: pointer;
}

.middleBottom-detail span:hover {
	background: rgba(0, 0, 0, 0.2);

	transition: .3s;
}

.middleBottom-detail span:focus {
	background: #fff;
	cursor: text;
}

.middleBottom-left-detail tr {
	height: 12mm;
	border-top: 1px solid black;
}

.middleBottom-left-detail tr:last-child {
	border-bottom: 1px solid black;
}

.middleBottom-left-detail th {
	font-size: 3.8mm;
	width: 25%;
	text-align: right;
}

.middleBottom-left-detail thead td {
	font-size: 3.5mm;
	letter-spacing: 0.2mm;
}

.middleBottom-left-detail tbody td {
	font-size: 2.8mm;
}

.middleBottom-left-detail tfoot td {
	font-size: 3mm;
}

.middleBottom-right-detail {
	display: inline-block;
	vertical-align: top;
	width: 50%;
}

.room-detail-checks li {
	cursor: pointer;
	float: left;
	width: 33.333%;
	font-size: 2.8mm;
	line-height: 5.5mm;

	transition: .3s;
}

.room-detail-checks li:hover {
	background: rgba(0, 0, 0, 0.2);

	transition: .3s;
}

.room-detail-checks li:active {
	background: rgba(0, 0, 0, 0.5);
}

.square::before {
	content: '\f096';
}

.squareCheck::before {
	content: '\f046';
}

.room-detail-else {
	margin-top: 2mm;
	padding: 2mm;
	border: 0.5mm solid black;
	position: relative;
}

.room-detail-else {
	height: 15mm;
}

.room-detail-else h3 {
	font-size: 3mm;
	position: absolute;
	top: -2mm;
	line-height: 4mm;
	left: 2mm;
	opacity: 1;
	background: #fff;
}

.room-detail-else p {
	cursor: pointer;
	font-size: 2.5mm;

	transition: .3s;
}

.room-detail-else p:hover {
	background: rgba(0, 0, 0, 0.2);

	transition: .3s;
}

.room-detail-else p:focus {
	cursor: text;
	background: #fff;
}

/*-------  ここまでPrint-middle-bottom --------*/

/*-------  ここまでPrint-middle-bottom --------*/

.else-area {
	height: 3.5%;
	position: relative;
}

.else-area p {
	font-size: 3mm;
	position: absolute;
	top: 50%;
	transform: translateY(-50%);
}

.else-area p:first-child {
	font-size: 6mm;
	color: #0B0B3B;
	font-family: 'Lobster', cursive;
	left: 2mm;
	font-weight: bold;
}

.else-area p:nth-of-type(2) {
	left: 50%;
	transform: translateX(-50%) translateY(-50%);
}

.else-area p:last-child {
	right: 2mm;
	text-decoration: underline;
}

.else-area-last {
	cursor: pointer;

	transition: .3s;
}

.else-area-last:hover {
	background: rgba(0, 0, 0, 0.2);

	transition: .3s;
}

.else-area-last:focus {
	cursor: text;
	background: #fff;
}

/*-------  ここまでPrint-middle-bottom --------*/

/*-------  ここからPrint-bottom --------*/

.bottom-detail {
	width: 100%;
	height: 11.5%;
	position: relative;
	font-size: 0;
	overflow: hidden;
}

.bottom-detail {
	cursor: pointer;

	transition: .3s;
}

.bottom-detail:hover {
	background: rgba(0, 0, 0, 0.2);

	transition: .3s;
}

.bottom-detail:focus {
	cursor: text;
	background: #fff;
}

.bottom-detail-left {
	position: absolute;
	top: 0;
	left: 0;
	right: 20%;
	width: 80%;
}

.bottom-detail-left p {
	text-align: center;
	font-size: 2.5mm;
	line-height: 4mm;
}

.bottom-detail-left p:first-child {
	padding-top: 3mm;
}

.bottom-detail-left h2 {
	text-align: center;
	font-size: 5mm;
	font-weight: bold;
	line-height: 5.5mm;
}

.bottom-detail-leftBtm {
	font-size: 0;
}

.bottom-detail-leftBtm span {
	text-align: center;
	font-weight: bold;
	font-size: 2.5mm;
	vertical-align: middle;
}

.bottom-detail-leftBtm b {
	font-size: 1.5mm;
}

.bottom-detail-leftBtm ul {
	display: inline;
	height: 6mm;
	margin-left: 1mm;
	vertical-align: middle;
}

.bottom-detail-leftBtm li {
	display: inline-block;
	vertical-align: middle;
	border-top: 0.1mm solid #424242;
	border-bottom: 0.1mm solid #424242;
	border-right: 0.1mm solid #424242;
	font-size: 1.5mm;
	line-height: 6mm;
}

.bottom-detail-leftBtm li:first-child {
	border-left: 0.1mm solid #424242;
}

.bottom-detail-leftBtm li:nth-of-type(1) {
	font-size: 1.2mm;
	line-height: 3mm;
	text-align: center;
}

.bottom-detail-leftBtm li:nth-of-type(6) {
	font-size: 1.2mm;
	line-height: 3mm;
	text-align: center;
}

.bottom-detail-leftBtm li:nth-of-type(3) {
	width: 12mm;
	text-align: right;
}

.bottom-detail-leftBtm li:nth-of-type(5) {
	width: 12mm;
	text-align: right;
}

.bottom-detail-leftBtm li:nth-of-type(7) {
	width: 12mm;
	text-align: right;
}

.bottom-detail-leftBtm li:nth-of-type(9) {
	width: 12mm;
	text-align: right;
}

.bottom-detail-right {
	width: 20%;
	position: absolute;
	top: 0;
	left: 80%;
	right: 0;
}

.bottom-detail-rColumn {
	border: 0.2mm solid black;
	width: 90%;
	margin: 2mm auto 0;
}

.bottom-detail-rTitle {
	background: #424242;
	height: 4.5mm;
	padding: 0.1mm 0;
}

.bottom-detail-rTitle h3 {
	background: #fff;
	font-size: 3mm;
	font-weight: bold;
	text-align: center;
	border-radius: 50%;
	line-height: 4.3mm;
	margin: 0 auto;
	display: block;
	width: 25mm;
}

.bottom-detail-rColumn h5 {
	font-size: 7mm;
	line-height: 15mm;
	text-align: center;
	font-weight: bold;
	color: #ff0000;
}

.bottom-detail-right p {
	text-align: center;
	font-weight: bold;
	font-size: 2mm;
	line-height: 3.5mm;
}

/*-------  ここまでPrint-bottom --------*/

	</style>