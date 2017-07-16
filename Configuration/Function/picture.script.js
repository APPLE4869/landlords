$(function() {
	'use strict';

/*--- ここからEdit-Confirm ---*/

function deleteImg(image, userUrl, id) {
	$('#delImg-overlay').fadeIn();
	$('#delImg-overlay img').attr('src', './../../../../MyHome/Landlord/'+userUrl+'/images/'+image);
	$('#imgId').attr('value', id);
}

$('.modal-open-click h4').on('click', function() {
	var id = $(this).attr('id');
	$('.picture-overlay').fadeIn();
	$('.picture-modal').eq(id - 1).fadeIn();
});

$('.picture-modal i').on('click', function() {
	$('.picture-overlay').fadeOut();
	$('.picture-modal').fadeOut();
});

$('.modal-open-click i').on('click', function() {
	var id = $(this).attr('id');
	$('#delImg-overlay').fadeIn();
	$('#delImg-overlay img').attr('src', './../../../../MyHome/Landlord/'+userUrl+'/images/'+imagesJS[id]);
	$('#imgId').attr('value', id);
});

$('#delImg-overlay h4').on('click', function() {
	$('#delImg-overlay').fadeOut();
});

$('#appearance i').on('click', function () {
	var id = $(this).attr('id');
	if (id == 'first') {
		deleteImg(appearance1JS, userUrl, id);
	} else if (id == 'second') {
		deleteImg(appearance2JS, userUrl, id);
	}
})

$('#cmp-image i').on('click', function () {
	var id = $(this).attr('id');
	deleteImg(imageJS, userUrl, id);
});

$('#lcdImg i').on('click', function () {
	var id = $(this).attr('id');
	deleteImg(imageJS, userUrl, id);
});

$('.roomDetail-big-image-I i').on('click', function() {
	var id = $(this).attr('id');
	if (id == 'first') {
		deleteImg(bImg1JS, userUrl, id);
	} else if (id == 'second') {
		deleteImg(bImg2JS, userUrl, id);
	}
});

/*--- ここからEdit-Confirm ---*/

});