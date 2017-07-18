 $(function() {

            var modelX = 10,
                modelY = 10,
                modelH = 5,
                modelW = 160,
                speed = 20;
                moveUp = $('#move-up'),
                moveRight = $('#move-right'),
                moveLeft = $('#move-left'),
                moveDown = $('#move-down'),
                line = true,
                rad = 0,
                angleInRadians = rad * Math.PI / 180;
            var imgBroTile = new Image();
            var imgCar = new Image();
            var imgtile = new Image();
            var imgBlockTile = new Image();
            var imgSimpleTile = new Image();
            imgBroTile.src = 'images/browntile.jpg';
            imgCar.src = 'images/carIcon.jpg';
            imgtile.src = 'images/tile.jpg';
            imgBlockTile.src = 'images/blocktile.jpg';
            imgSimpleTile.src = 'images/simpletile.jpg';
            var canvas = document.getElementById("canvas");
            var ctx = canvas.getContext('2d');
            var modelFrame = $('#model-frame');

            /*----- ここからCANVAS上のフレームの動き -----*/
            function modelTransform(modelW, modelH) {
                modelFrame.css('width', modelW+'px').css('height', modelH+'px');
            }
            function modelMoving(modelX, modelY) {
                modelFrame.css('top', modelY+'px').css('left', modelX+'px');
            }
            moveUp.on('click', function () {
                if (0 <= modelY - speed) {
                    modelY -= speed;
                    modelMoving(modelX, modelY);
                }
            });
            moveRight.on('click', function () {
                if (800 >= modelX + modelW + speed) {
                    modelX += speed;
                    modelMoving(modelX, modelY);
                }
            });
            moveLeft.on('click', function () {
                if (0 <= modelX - speed) {
                    modelX -= speed;
                    modelMoving(modelX, modelY);
                }
            });
            moveDown.on('click', function () {
                if (800 >= modelY + modelH + speed) {
                    modelY += speed;
                    modelMoving(modelX, modelY);
                }
            });
            /*----- ここまでCANVAS上のフレームの動き -----*/

            //フレームの変速処理
            $('#move-speed select').on('change', function() {
            	speed = Number($(this).val());
            });

            $('#lineOut').on('click', function() {
                if (line) {
                    line = false;
                    $('#dot-frame').css('display', 'none');
                    $(this).text('線を足す');
                } else {
                    line = true;
                    $('#dot-frame').css('display', 'block');
                    $(this).text('線を消す');
                }
            });

            $('#radian select').on('change', function() {
                rad = Number($(this).val());
                angleInRadians = rad * Math.PI / 180;
            });

            function lengthRot() {
                modelH = 160;
                modelW = 5;
                modelTransform(modelW, modelH);
            }

            function sideRot() {
                modelH = 5;
                modelW = 160;
                modelTransform(modelW, modelH);
            }

            function door() {
                modelH = 30;
                modelW = 30;
                modelTransform(modelW, modelH);
                modelFrame.css('border-radius', '0 60px 0 0');
            }

            function lengthWindow() {
                console.log('aa');
                modelH = 120;
                modelW = 5;
                modelTransform(modelW, modelH);
                modelFrame.css('border-style', 'none');
                modelFrame.css('border-right', '1px dotted silver');
                modelFrame.css('border-left', '1px dotted silver');
            }

            function makeToilet(e) {
                if ( ! canvas || ! canvas.getContext ) { return false; }
                ctx.beginPath();
                ctx.fillRect(modelX, modelY, modelW, modelH);
            }

            $('#make-first').on('click', function () {
                ctx.setTransform(1, 0, 0, 1, 0, 0);
                ctx.translate(modelX, modelY);
                ctx.rotate(angleInRadians);
                makeGraphic();
            });

            $('#lengthRot').on('click', function() {
                lengthRot();
            })

            $('#sideRot').on('click', function() {
                sideRot();
            })

            $('#door').on('click', function() {
                door();
            });

            $('#lengthWindow').on('click', function() {
                lengthWindow();
            });

            $('#browntile').on('click', function() {
                if ( ! canvas || ! canvas.getContext ) { return false; }
                ctx.setTransform(1, 0, 0, 1, 0, 0);
                ctx.translate(modelX, modelY);
                ctx.rotate(angleInRadians);
                ctx.drawImage(imgBroTile, 0, 0, 50, 80);
            });

            $('#carIcon').on('click', function() {
                if ( ! canvas || ! canvas.getContext ) { return false; }
                ctx.setTransform(1, 0, 0, 1, 0, 0);
                ctx.translate(modelX, modelY);
                ctx.rotate(angleInRadians);
                ctx.drawImage(imgCar, 0, 0, 50, 80);
            });

            $('#tile').on('click', function() {
                if ( ! canvas || ! canvas.getContext ) { return false; }
                ctx.setTransform(1, 0, 0, 1, 0, 0);
                ctx.translate(modelX, modelY);
                ctx.rotate(angleInRadians);
                ctx.drawImage(imgtile, 0, 0, 50, 80);
            });

            $('#blockTile').on('click', function() {
                if ( ! canvas || ! canvas.getContext ) { return false; }
                ctx.setTransform(1, 0, 0, 1, 0, 0);
                ctx.translate(modelX, modelY);
                ctx.rotate(angleInRadians);
                ctx.drawImage(imgBlockTile, 0, 0, 50, 80);
            });

            $('#simpleTile').on('click', function() {
                if ( ! canvas || ! canvas.getContext ) { return false; }
                ctx.setTransform(1, 0, 0, 1, 0, 0);
                ctx.translate(modelX, modelY);
                ctx.rotate(angleInRadians);
                ctx.drawImage(imgSimpleTile, 0, 0, 50, 80);
            });

            $('#save').on('click', function() {
            	var img = $('<img>').attr({
            		width: 100,
            		height: 50,
            		src: canvas.toDataURL()
            	});
            	var link= $('<a>').attr({
            		href: canvas.toDataURL().replace('image/png', 'application/octet-stream'),
            		download: new Date().getTime() + '.phg'
            	});
            	$('#gallery').append(link.append(img.addClass('thumbnail')));
            	ctx.clearRect(0, 0, canvas.width, canvas.height);
            });

            function makeGraphic(e) {
                if ( ! canvas || ! canvas.getContext ) { return false; }
                ctx.beginPath();
                ctx.fillRect(0, 0, modelW, modelH);
            }


            ctx.lineJoin    = 'round';  // 角を丸く
            ctx.lineCap     = 'round';  // 線の終端を丸く
            ctx.lineWidth   = 15;        // 線の幅
            ctx.strokeStyle = '#fff';   // 線の色
            var drawing = false;
            canvas.addEventListener('mousedown', start, false);
            canvas.addEventListener('mousemove', move, false);
            window.addEventListener('mouseup', stop, false);

            function start(event) {
                ctx.beginPath();  // サブパスリセット
                ctx.moveTo(event.layerX+52, event.layerY+21);  // 初期座標を指定
                drawing = true;  // ドラッグ中フラグを立てる

                move(event);  // ドラッグせずにすぐmouseupした場合に、点を書くため
            }

            function move(event) {
                if ( ! canvas || ! canvas.getContext ) { return false; }
                if (drawing) {
                    console.log(event.layerX+52);
                    console.log(event.layerY+21);
                    ctx.lineTo(event.layerX+52, event.layerY+21);  // 直前の座標と現在の座標を直線で繋ぐ
                    ctx.stroke();  // canvasに描画
                }
            }s

            function stop(event) {
                if ( ! canvas || ! canvas.getContext ) { return false; }
                if (drawing) {
                    ctx.closePath();  // サブパスを閉じる
                }
                drawing = false;
            }

        });