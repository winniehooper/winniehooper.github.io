$(document).ready(function() {

	//E-mail Ajax Send
	$("form").submit(function() { //Change
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "mail.php", //Change
			data: th.serialize()
		}).done(function() {
			alert("Заявка отправлена. Перезвоним в течение суток");
			setTimeout(function() {
				// Done Functions
				th.trigger("reset");
			}, 1000);
		});
		return false;
	});

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