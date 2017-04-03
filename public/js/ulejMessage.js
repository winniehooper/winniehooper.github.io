(function() {
    /*
    * Плагин для множественного вывода сообщений
    */

    $.extend({
        ulejMessages: {
            messagesSettingDate: {'success': {}, 'error': {}}, /* Группы сообщений */
            messagesContainer:  $('.nb-alert-container'), /* Контейнер сообщения */
            maxShowMessages: 3, /* Максимальное число отображаемых сообщений */
            fadeInTime: 1000, /* Время появления */
            fadeOutTime: 2000, /* Время исчезновения */
            waitingTime: 2000, /* Время отображения сообщения */
			defaultMessages: { /* Сообщения по уполчанию для определённого типа */
				'success': 'Данные успешно сохранены',
				'error': 'Внимание! Ошибка сохранения'
			},

			/*
			 *  Инициализация групп сообщений
			 */
            init: function() {
                this.messagesSettingDate.success = this.messagesSettingDate.error = {
                    counter: 0, /* Количество сообщений в группе */
                    pendingMessages: [] /* Набор сообщений */
                };
            },
			/*
			 * Отображение сообщения
			 *
			 * type - один из вышеперечисленных типов сообщения
			 * message - текст сообщения
			 *
			 * @param string type
			 * @param string message
			 */
            showMessage: function(type, message) {
                var messageHTML = this.getAlertContentTemplate(type, message);

                if(messageHTML) {
                    this.showCurrentMessage(type, messageHTML);
                }
            },
			/*
			 *	Отображение текущего сообщения
			 *
			 *  type - один из вышеперечисленных типов сообщения
			 *  message - блок текущего сообщения
			 *
			 *	@param string type
			 *	@param object message
			 */
            showCurrentMessage:function(type, message) {
                var $this = this;
                this.messagesContainer.prepend(message); /* Устанавливаем сообщение перед предыдущими */

				message.fadeIn(this.fadeInTime, function() {}); /* Отображаем сообщение */
				setTimeout(function() {
					/*
					* По истечении установленного количества времени на отображение сообщение, прячем его и удаляем из разметки.
					* После этого уменьшаем значение счётчика и переходим к выборке другого ожидающего сообщения, если конечно таковые имеются
					* */
                    message.fadeOut($this.fadeOutTime, function() {
                        $this.changingNumberMessages(type, true);
                        $this.getPendingMessage(type);
                        message.remove();
                    });
                }, this.waitingTime);
            },
			/*
			 *	Осуществляем выборку следующего сообщения
			 */
            getPendingMessage: function(type) {
                if(this.messagesSettingDate[type].pendingMessages.length) {
					/*
					*	Выбераем из массива ожидающих сообщений все начиная со второго
					*/
                    var $this = this, pendingMessages = this.messagesSettingDate[type].pendingMessages.slice(1);
					/*
					 *	Первое сообщение отправляем на отображение
					 */
                    this.showCurrentMessage(type, this.messagesSettingDate[type].pendingMessages[0]);
					/*
					 *	Обновляем список ожидающих сообщений (без первого, т.к. оно уже перешло на стадию отображения)
					 */
                    this.messagesSettingDate[type].pendingMessages = pendingMessages;
                }
            },
			/*
			*  Осуществляем поиск шаблона сообщения, дублируем и передаём сообщение на вывод или помещаем в список ожидающих сообщений одной из групп
			*/
            getAlertContentTemplate: function(type, message) {
                var alert = $("#js-alert-" + type).clone();
                alert.removeAttr('id');

				/*
				* Увеличиваем значение счётчика
				*/
                this.changingNumberMessages(type);

				/*
				 * Устанавливаем сообщение или используе сообщение по умолчанию
				 */
                if(message) {
                    alert.html(message);
                } else if(this.defaultMessages[type]) {
					alert.html(this.defaultMessages[type]);
				}

				/*
				 * Если количество отображаемых сообщений более максимального, то пополняем группу без передачи блока сообщения
				 */
                if(this.messagesSettingDate[type].counter > this.maxShowMessages) {
                    this.messagesSettingDate[type].pendingMessages.push(alert)
                }

				/*
				 * Если в группе нет ожидающих сообщений передаём текущее
				 */
                if(!this.messagesSettingDate[type].pendingMessages.length) {
                    return alert;
                }
            },
            changingNumberMessages: function(type, minus) {
                if(minus) this.messagesSettingDate[type].counter--;
                else this.messagesSettingDate[type].counter++;
            }
        }
    });

    $.ulejMessages.init();
})(jQuery);