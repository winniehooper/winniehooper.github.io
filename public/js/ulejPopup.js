/*
 * Плагин для обработки всплывающих окон
 * */
(function($) {
	var pluginName = 'ulejPopup';

	$.extend({
		ulejPopup : function(control, options) {
			this.settings = $.extend({}, this.settings, options);
			this.area = this.settings.popupArea;
			this.settings.popupControl = $(control);

			this.init();
		},
		/*
		* Закрытие последнего открытого всплывающего окна
		*/
		ulejPopupClose : function($isHistory) {
			var popupObj = $(document).data('lastOpenPopup');
			if(popupObj) {
				if($isHistory) {
					$(popupObj.settings.closeControl).data('history', true);
				}
                $(".overlayer--show .js-close-popup:first").trigger('click');
			}
		},
		/*
		* Открытие отдельного попапа
		*/
		ulejPopupOpen : function($popup) {
			var popupObj = new $.ulejPopup;
			popupObj.settings.popupArea = $popup;
			popupObj.area = $popup;
			popupObj.showPopup();

			$(document).data('lastOpenPopup', popupObj);

			popupObj.settings.popupArea.off('click', popupObj.settings.closeControl);
			popupObj.settings.popupArea.on('click', popupObj.settings.closeControl, function(){
				popupObj.closePopup();
				if(!$(this).hasClass('js-popup-change-url') || $(this).data('history')) {
					$(this).data('history', false);
					return false;
				}
			});
		}
	});

	var $ulejPopup = $.ulejPopup;

	$ulejPopup.fn = $ulejPopup.prototype = {
		settings: {
			closeControl: '.js-close-popup'
		}
	};

	$ulejPopup.fn.extend = $ulejPopup.extend = $.extend;

	$ulejPopup.fn.extend({
		init: function() {
			var obj = this;

			/*
			* Вызов пользовательской функции срабатываемой прежде установки событий
			*/
			if(typeof this.settings.beforeInitEvents == 'function') {
				this.settings.beforeInitEvents.call(this.settings.popupArea)
			}

			/*
			* Устанавливаем событие открытия
			*/
			this.settings.popupControl.on('click', function() {
				/*
				 * Пользовательская функция срабатывающая прежде чем окно откроется
				 */
				if(typeof obj.settings.beforeShow == 'function') {
					obj.settings.beforeShow.call(obj.settings.popupArea, $(this))
				}

				obj.offset = $(window).scrollTop();

				obj.showPopup();

				/*
				 * Пользовательская функция срабатывающая после открытия окна
				 */
				if(typeof obj.settings.afterShow == 'function') {
					obj.settings.afterShow.call(obj.settings.popupArea, $(this))
				}

				/*
				 * Сохраняем последнее открытое окно
				 */
				$(document).data('lastOpenPopup', obj.settings.popupControl.data(pluginName));

				/*
				 * Если выспвающее окно не уникально, устанавливаем событие закрытия для открывшегося
				 */
				if(!obj.settings.popupPage) {
					obj.settings.popupArea.off('click', obj.settings.closeControl);
					obj.settings.popupArea.on('click', obj.settings.closeControl, function(){
						obj.closePopup();
						if(!$(this).hasClass('js-popup-change-url') || $(this).data('history')) {
							$(this).data('history', false);
							return false;
						}
					});
				}

				//return false;
			});

			/*
			 * Если выспвающее окно уникально, устанавливаем событие закрытия
			 */
			if(this.settings.popupPage) {
				obj.settings.popupArea.on('click', obj.settings.closeControl, function(){
					obj.closePopup();
					if(!$(this).hasClass('js-popup-change-url') || $(this).data('history')) {
						$(this).data('history', false);
						return false;
					}
				});
			}
		},

		/*
		 * Открытие всплывающего окна
		 */
		showPopup : function() {
			var body = $('body');

			$('.overlayer').removeClass('overlayer--show');

			this.settings.popupArea.addClass('overlayer--show');

			if(!body.data('showPopup')) {
				this.setOffset(-parseInt(this.offset));
				body.addClass('body--popup');
				body.data('showPopup', true);
			}
		},

		/*
		 * Закрытие всплывающего окна
		 */
		closePopup : function() {
			if(typeof this.settings.beforeClose == 'function') {
				this.settings.beforeClose.call(this.settings.popupArea)
			}

			var body = $('body');
			this.settings.popupArea.removeClass('overlayer--show');
			body.removeClass('body--popup');
			/* Временное решение для корректной работы всплывающих окон */
			$('html,body').css({height: 'auto'}).scrollTop(parseInt(body.css('top'), 10) * (-1)).css({height: ''});
			body.css('top',0);
			body.data('showPopup', false);

			if(typeof this.settings.afterClose == 'function') {
				this.settings.afterClose.call(this.settings.popupArea)
			}
		},

		getOffset: function() {
			return parseFloat($('body').css('top')) * -1;
		},

		setOffset: function(value) {
			$('body').css('top', value);
		}
	});

	$.fn.ulejPopup = function(options) {
		return this.each(function() {
			var instance = $(this).data(pluginName);
			if (!instance) {
				$(this).data(pluginName, new $ulejPopup(this, options));
			}
		});
	};
})(jQuery);