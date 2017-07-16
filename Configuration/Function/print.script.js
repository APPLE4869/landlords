$(function() {
	'use strict';

/*--- ここからEdit-Confirm ---*/

$('.room-detail-checks li').on('click', function() {
	var nowClass = $(this).hasClass('square');
	if(nowClass) {
		$(this).addClass('squareCheck').removeClass('square');
	} else {
		$(this).removeClass('squareCheck').addClass('square');
	}
});

$('.images-frame input').change(function() {
	var img = $(this)[0].files[0].name;
	var id = $(this).attr('id');
	var index = id.replace(/[^0-9^\.]/g,"")-1;
	$('.images-frame label').eq(index).css('background-image', 'url("../../../../MyHome/Landlord/' + userUrl + '/images/' + img + '")')
});

/*--- ここからEdit-Confirm ---*/

});