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
					$('#form-request').trigger("reset");
				}, 1000);
			});
			return false;
		});

	function showSuccess() {
		var form = $('.forma');
		//form.find('.btn-submit').hide();
		form.find('.msg-success ').fadeIn();

		function second_passed() {
			form.find('.msg-success ').fadeOut();
		}
		setTimeout(second_passed, 3000)

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