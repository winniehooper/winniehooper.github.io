/*
 * Плагин для установки валидации форм
 */
(function($) {
	var pluginName = 'ulejFormValidation';

	$.extend({
		ulejFormValidation : function(form, options) {
			this.settings.validationSetting = $.extend({}, this.settings.defaultValidationSetting, options);
			this.form = $(form);


			this.init();
		}
	});

	var $ulejFormValidation = $.ulejFormValidation;

	$ulejFormValidation.fn = $ulejFormValidation.prototype = {
		settings: {
			defaultValidationSetting: {
				errorClass: 'nb-input--invalid',
				rules: {}
			},
			formValidationSettings: {}
		}
	};

	$ulejFormValidation.fn.extend = $ulejFormValidation.extend = $.extend;

	$ulejFormValidation.fn.extend({
		init: function() {
			this.validationInitField();
		},
		validationInitField: function() { /* Устанавливаем обработчик для валидатора "validation" */
			this.addValidationMethods();
			this.form.validate(this.settings.validationSetting);
		},
		addValidationMethods: function() {
			var plugin = this;
			var methodsList = [];
			var setMethods = { /* Функции для плагина jQuery.validation */
				'errorPlacement': {
					'set': 1,
					'func': function() {
						return true;
					}
				},
				'highlight': {
					'set': 1,
					'func': function(element, errorClass) {
						$(element).parent().addClass(errorClass);
					}
				},
				'unhighlight': {
					'set': 1,
					'func': function(element, errorClass) {
						$(element).parent().removeClass(errorClass);
					}
				},
				'success': {
					'set': 0,
					'func': function(label, element) {
						$(label).parent().parent().css('display', 'none');
					}
				},
				'submitHandler': {
					'set': 0,
					'func': function(form) {
						$('input[type="text"], input[type="tel"]').each(function(i) {
							$(this).val(($(this).val()).replace(/\"/g, "'"));
						});
						form.submit();
					}
				}
			};

			$.each(this.settings.validationSetting, function(itemId) { /* Определяем какие функции нужно задать. */
				if(itemId == 'errorPlacement') setMethods.errorPlacement.set = 0;
				else if(itemId == 'highlight') setMethods.highlight.set = 0;
				else if(itemId == 'unhighlight') setMethods.unhighlight.set = 0;
				else if(itemId == 'success') setMethods.success.set = 0;
				else if(itemId == 'submitHandler') setMethods.submitHandler.set = 0;
			});
			$.each(setMethods, function(itemId, itemObj) {  /* Задаём функции. */
				if(itemObj.set || !($.inArray(itemId, methodsList) < 0)) {
					plugin.settings.validationSetting[itemId] = itemObj.func;
				}
			});

		}
	});

	$.fn.ulejFormValidation = function(options) {
		if (typeof options == 'string') {
			var instance = $(this).data(pluginName), args = Array.prototype.slice.call(arguments, 1);
			return instance[options].apply(instance, args);
		} else {
			return this.each(function() {
				var instance = $(this).data(pluginName);
				if (instance) {
					if (options) {
						$.extend(instance.options, options);
					}
					instance.reload();
				} else {
					$(this).data(pluginName, new $ulejFormValidation(this, options));
				}
			});
		}
	};
})(jQuery);