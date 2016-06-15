$(document).ready(function() {

	//E-mail Ajax Send
	$("form").submit(function() { //Change
		initValid();

		return false;
	});
	function showSuccess() {
		var form = $('#form-request');
		form.find('.btn-submit').hide();
		form.find('.alert-success').fadeIn()

	}

	function initValid() {
		// Validation options http://jqueryvalidation.org/documentation/
		var form_validator = $('#form-request');
		if (form_validator.length && $.fn.validate) {
			form_validator.validate({
				submitHandler: function() {
					$.ajax({
						type: "POST",
						url: "mail.php", //Change
						data: $('#form-request').serialize()
					}).done(function() {
						showSuccess();
						setTimeout(function() {
							// Done Functions
							$('#form-request').trigger("reset");
						}, 1000);
					});
				}
			});
		}
	}
	initValid();

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