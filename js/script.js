$(document).ready(function() {

	//https://igorescobar.github.io/jQuery-Mask-Plugin/
	$('#phone').mask('+375 00 000-00-00', {placeholder: "+375"});

	//E-mail Ajax Send
	$("form").submit(function() { //Change
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "mail.php", //Change
			data: th.serialize()
		}).done(function() {
			showSuccess();
			setTimeout(function() {
				// Done Functions
				th.trigger("reset");
			}, 1000);
		});
		return false;
	});

	function showSuccess() {
		$('.msg-success ').fadeIn();
	}

	// function initValid() {
	// 	// Validation options http://jqueryvalidation.org/documentation/
	// 	var form_validator = $('#form-request');
	// 	if (form_validator.length && $.fn.validate) {
	// 		form_validator.validate({
	// 			submitHandler: function() {
	// 				$.ajax({
	// 					type: "POST",
	// 					url: "mail.php", //Change
	// 					data: $('#form-request').serialize()
	// 				}).done(function() {
	// 					showSuccess();
	// 					setTimeout(function() {
	// 						// Done Functions
	// 						$('#form-request').trigger("reset");
	// 					}, 1000);
	// 				});
	// 			}
	// 		});
	// 	}
	// }
	// initValid();

});

$(window).scroll(function() {

	var st = $(this).scrollTop() /18;

	$(".parallobject_1").css({
		"transform" : "translate3d(0px, -" + st  + "%, .01px)",
		"-webkit-transform" : "translate3d(0px, -" + st  + "%, .01px)"
	});

});

$(window).scroll(function() {

	var st = $(this).scrollTop() /15;

	$(".parallobject_2").css({
		"transform" : "translate3d(0px, -" + st  + "%, .01px)",
		"-webkit-transform" : "translate3d(0px, -" + st  + "%, .01px)"
	});

});
$(window).scroll(function() {

	var st = $(this).scrollTop() /25;

	$(".parimg-slider").css({
		"transform" : "translate3d(0px, -" + st  + "%, .01px)",
		"-webkit-transform" : "translate3d(0px, -" + st  + "%, .01px)"
	});

});

!function () {
	function isVisible( row, container ){

		var elementTop = $(row).offset().top,
			elementHeight = $(row).height(),
			containerTop = container.scrollTop(),
			containerHeight = container.height();

		return ((((elementTop - containerTop) + elementHeight) > 0) && ((elementTop - containerTop) < containerHeight));
	}


	// Call functions
	$(function () {

	});

	$(window).on('scroll', function () {
		$('.hasAnim').each(function(){
			if(isVisible($(this), $(window))){
				$(this).addClass('animated fadeInUp');
				//console.log();
			}
		});

		
		// затоговка эффекта
		/*$('.tutclass').each(function(){
			if(isVisible($(this), $(window))){
				$(this).addClass('animated fadeInUp');
				//console.log();
			}
		});*/
	});
}();
