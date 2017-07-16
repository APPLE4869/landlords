<div class="plan-maker-wrapper">

	<div class="plan-maker-main">
		<canvas id="canvas" width="400" height="400">
			このブラウザはCanvasに対応していません。
		</canvas>
		<div id="gallery"></div>
		<button onclick="window.print()">プリント</button>
	</div>

	<div class="parts-menu cf">
		<p>
			<select id ="penColor">
				<option value="black">黒</option>
				<option value="red">赤</option>
				<option value="blue">青</option>
				<option value="white">白</option>
			</select>
			<select id ="penWidth">
				<option value="1">細</option>
				<option value="3">中</option>
				<option value="5">太</option>
			</select>
			<input type="button" id="erase" value="消去">
			<input type="button" id="save" value="ギャラリーに追加">
		</p>
	</div>

</div>