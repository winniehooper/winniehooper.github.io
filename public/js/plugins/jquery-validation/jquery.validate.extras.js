$(function() {
	$.validator.addMethod("website", function(value, element, param) {
		var pattern = /^((https?|ftp)\:\/\/)?([a-zA-Z0-9]{1})((\.[a-zA-Z0-9_\-])|([a-zA-Z0-9_\-]))*\.([a-z]{2,6})(\/[a-zA-Z0-9_\-\?\&=#\.]*)*?$/;

		return value.search(pattern) != -1;
	}, 'Проверьте правильность введённой ссылки.');

	$.validator.addMethod("full_email", function(value, element, param) {
		var pattern = /^[a-z0-9_\-\.]+@[a-z0-9_\-\.]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;

		return value.search(pattern) == 0;
	}, 'Проверьте правильность введённой электронной почты.');

	$.validator.addMethod("min_amount", function(value, element, param) {
        param = parseFloat(param) || 0;
        value = value.replace(/\s/g, '');

        return value >= param;
	}, 'Проверьте правильность введённой суммы');

	$.validator.addMethod("max_amount", function(value, element, param) {
		param = parseFloat(param) || 0;
		value = value.replace(/\s/g, '');

		return value <= param;
	}, 'Проверьте правильность введённой суммы');

	jQuery.extend(jQuery.validator.messages, {
        pattern: "Проверьте правильность введенных данных."
	});
});