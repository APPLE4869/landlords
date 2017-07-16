$(function() {
	'use strict';

/*--- ここからSub-Contents ---*/

	$('#nav-menu').on('click', function() {
		$('#sub-content').fadeToggle();
		$('#menus-overlay').fadeToggle();
	});

	$('#right-icon').on('click', function() {
		$('#nav').fadeToggle();
		$('#menus-overlay').fadeToggle();
	});

	$('#menus-overlay').on('click', function() {
		$('#sub-content').css('display', 'none');
		$('#nav').css('display', 'none');
		$(this).css('display', 'none');
	});

/*--- ここまでSub-Contents ---*/

/*--- ここからRegistration ---*/

	$('#regConfirm-overlay i').on('click', function() {
		$('#regConfirm-overlay').fadeOut();
	});

/*--- ここまでRegistration ---*/

/*--- ここからEdit-Confirm ---*/

	$('.maked-artice li').on('click', function() {
		$('.edit-confirm').fadeIn();
		var pageName = $(this).text();
		$('.edit-confirm-inner h3').text('「' + pageName + '」');
	});

	$('#fadeout-click').on('click', function() {
		$('.edit-confirm').fadeOut();
	});

	$('.registration-ok').on('click', function() {
		$(this).slideUp();
	})

/*--- ここまでEdit-Confirm ---*/

/*--- ここからModal ---*/

$('.edit-notice-content ul').on('click', function() {
	var order = $(this).attr('id');
	$('.notice-modal-form').eq(order).fadeIn();
});

$('.notice-modal-form i').on('click', function() {
	$('.notice-modal-form').fadeOut();
});

$('#notice-btn').on('click', function() {
	$('#notice-btn-open').fadeIn();
});

$('#newRoom-btn').on('click', function() {
	$('#newRoom-btn-open').fadeIn();
});

$('#newRoom-btn-open i').on('click', function() {
	$('#newRoom-btn-open').fadeOut();
});

$('.location-delete-btn').on('click', function() {
	var order = $(this).attr('id');
	$('#locationDelete-overlay-' + order).fadeIn();
});

$('.locationDelete-modal-form h4').on('click', function() {
	$('.locationDelete-overlay-form').fadeOut();
});

$('.building-delete-btn').on('click', function() {
	var order = $(this).attr('id');
	$('#buildingDelete-overlay-' + order).fadeIn();
});

$('.buildingDelete-btn').on('click', function() {
	$('.buildingDelete-overlay-form').fadeOut();
});

/*--- ここまでModal ---*/

/*--- ここから公開情報変更処理 ---*/

function publicChange(id, postName, nonPublic, Public) {

	var publicChange = true;
	$(id).on('click', function() {
		if(publicChange == true) {
			publicChange = false;
			var text = $(this).text();
			var hasClass = $(this).hasClass('icon-blue');

			if(hasClass) {
				$(this).text(nonPublic).removeClass('icon-blue eye-icon').addClass('icon-red nonEye-icon');

				$.ajax({
					type: 'post',
					url: 'index.php',
					data: {
						'type': postName,
						'publicChange': 1
					},
				});

			} else {
				$(this).text(Public).removeClass('icon-red nonEye-icon').addClass('icon-blue eye-icon');

				$.ajax({
					type: 'post',
					url: 'index.php',
					data: {
						'type': postName,
						'publicChange': 0
					},
				});

			}
		}
		publicChange = true;
		return false;
	});

}

publicChange('#pagePublicChange', 'page', '非公開', '公開');
publicChange('#campaignPublicChange', 'campaign', '非表示', '表示中');
publicChange('#locationPublicChange', 'location', '非表示', '表示中');

/*--- ここまで公開情報変更処理 ---*/

/*--- ここからtrain & bus Change ---*/

	$('#train-label1').on('click', function() {
		$('#bus-column1').css('display', 'none');
		$('#train-column1').css('display', 'block');
	});

	$('#bus-label1').on('click', function() {
		$('#train-column1').css('display', 'none');
		$('#bus-column1').css('display', 'block');
	});

	$('#train-label2').on('click', function() {
		$('#bus-column2').css('display', 'none');
		$('#train-column2').css('display', 'block');
	});

	$('#bus-label2').on('click', function() {
		$('#train-column2').css('display', 'none');
		$('#bus-column2').css('display', 'block');
	});

	$('#train-label3').on('click', function() {
		$('#bus-column3').css('display', 'none');
		$('#train-column3').css('display', 'block');
	});

	$('#bus-label3').on('click', function() {
		$('#train-column3').css('display', 'none');
		$('#bus-column3').css('display', 'block');
	});

/*--- ここまでtrain & bus Change ---*/

/*--- ここから画像削除処理 ---*/

$('.edit-image-coulumn').on('click', function() {
	var index = $('.edit-image-coulumn').index(this);
	$('#delImg-overlay').fadeIn();
	$('#delImg-overlay img').attr('src', './../../../../MyHome/Landlord/'+userUrl+'/images/'+imgs[index]);
	$('#delImg-image').attr('value', imgs[index])
});

$('#delImg-overlay h4').on('click', function() {
	$('#delImg-overlay').fadeOut();
});

/*--- ここまで画像削除処理 ---*/

/*--- ここからお知らせ公開数変更処理 ---*/

$('#public-notice-num').on('change', function() {
	alert('公開数を変更してよろしいでしょうか？');
	$('#public-notice-num-form').submit();
});

/*--- ここまでお知らせ公開数変更処理 ---*/

});