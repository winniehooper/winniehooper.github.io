var validationSettings = {
	/*
	 * Настройки - Профиль
	 * Настройки для формы: Личные данные
	 */
	'client_form' : {
		rules: {
			name: {
				required: true
			},
			information: {
				maxlength: 2000
			}
		}
	},
	/*
	 * Настройки - Доступ
	 * Настройки для формы: Изменить email
	 */
	'setting_new_email' : {
		submitHandler: function() {
			var $button = $('<button>');

			$button.addClass('js-open-password');
			setPasswordConfirmPopup($button, $('.js-password-popup'));
			$button.trigger('click');

			return false;
		},
		rules: {
			new_email: {
				required: true,
				full_email: true
			}
		}
	},
	/*
	 * Настройки - Доступ
	 * Настройки для формы: Изменить пароль
	 */
	'js-password-change' : {
		submitHandler: function(form) {
			var $form = $(form);
			var formData = getFormData($form);

			$.ajax({
				type: "POST",
				url: '/change-password',
				data: formData,
				dataType:'json',
				success: function(data){
					if (data.status == 'error') {
						window.location.href = '/error';
					} else if(data.status == 'error-save'){
						showAlert('error');
					} else {
						showAlert('success');
						form.reset();
					}
				},
				fail: function(){
					showAlert('error');
				}
			});

			return false;
		},
		rules: {
			old_password: {
				required: true,
				minlength: 6
			},
			new_password: {
				required: true,
				minlength: 6
			},
			new_password_confirm: {
				required: true,
				equalTo: "#js_new_password"
			}
		}
	},
	/*
	 * Настройки - Доступ
	 * Настройки для формы: Установить email и пароль
	 */
	'login-and-pass' : {
		submitHandler: function(form) {
			form = $(form);
			var formData = getFormData(form);

			$.ajax({
				type: "POST",
				url: '/set-login-and-password',
				data: formData,
				dataType:'json',
				success: function(data){
					if (data.status == 'error') {
						window.location.href = '/error';
					} else if(data.status == 'error-save'){
						$.ulejMessages.showMessage('error', data.message);
					} else {
						$.ulejMessages.showMessage('success');
						window.location.href = '/settings?tab=access';
					}
				},
				fail: function(){
					$.ulejMessages.showMessage('error');
				}
			});

			return false;
		},
		rules: {
			email: {
				required: true,
				full_email: true
			},
			password: {
				required: true,
				minlength: 6
			},
			password_confirm: {
				required: true,
				equalTo: "#js-password"
			}
		}
	},
	/*
	 * Настройки - Профиль
	 * Настройки для формы: Веб-сайты
	 */
	'js-add-website-form' : {
		submitHandler: function(form) {
			var $form = $(form);
			var formData = getFormData($form);

			$.ajax({
				url: '/website-add',
				type: 'POST',
				data: {
					website_url : formData.website
				},
				dataType: 'json',
				success: function (data) {
					if (data.status == 'success') {
						$('.js-websites-container').append(
							'<div class="nb-section__field js-website">' +
								'<div class="nb-input settings__website">' +
									'<div class="settings__website__value">' + formData.website + '</div>' +
									'<a class="settings__website__action js-remove-website" href="#" onclick="return deleteWebsite(this, ' + data.id + ')">Удалить</a>' +
								'</div>' +
							'</div>'
						);

						$('#js-website-field').val('');

						$.ulejMessages.showMessage('success');
					} else if(data.status == 'error-save') {
						$.ulejMessages.showMessage('error', data.message);
					} else {
						window.location.href = '/error';
					}
				},
				error: function(){
					showAlert('error');
				}
			});

			return false;
		},
		rules: {
			website: {
				website: true
			}
		}
	},
	/*
	 * Настройки для формы: Авторизации
	 */
	'js-login' : {
		rules: {
			email: {
				required: true,
				full_email: true
			},
			password: {
				required: true,
				minlength: 6
			}
		}
	},
	/*
	 * Настройки для формы: Регистрации
	 */
	'js-registration' : {
		submitHandler: function(form) {
			form = $(form);

			var	formData = getFormData(form),
				$successBlock = $('.js_register_success'),
				$errorBlock = $('.register_fail'),
				$errorMessageBlock = $('.error_message');

			$.ajax({
				type: "POST",
				url: '/ajax-registration',
				data: formData,
				dataType:'json',
				success: function(data){
					$('.register_block').hide();

					if (data.status == 'error') {
						$successBlock.addClass('display-none');
						window.location.href = '/error';
					} else if(data.status == 'error-save'){
						$successBlock.addClass('display-none');
						$errorMessageBlock.html(data.errText);
						$errorMessageBlock.removeClass('display-none');
						$errorBlock.removeClass('display-none');
					} else {
						$successBlock.removeClass('display-none');
					}
				},
				fail: function(){
					$successBlock.hide();
					$errorBlock.show();
				}
			});

			return false;
		},
		rules: {
			name: {
				required: true
			},
			email: {
				required: true,
				full_email: true
			},
			password: {
				required: true,
				minlength: 6
			},
			password_confirm: {
				required: true,
				equalTo: "#js-reg-pass-input"
			},
			'terms-input': {
				required: true
			}
		}
	},
	/*
	 * Настройки для формы: Восстановление пароля
	 */
	'js-restore' : {
		submitHandler: function(form) {
			form = $(form);

			var	formData = getFormData(form);
			var recoveryPopup = $('.js-rest-popup'),
				$successBlock = $('.restore_success'),
				$errorBlock = $('.restore_fail'),
				$restoreForm = $('.restore_form');

			$.ajax({
				type: "POST",
				url: '/ajax-recovery',
				data: formData,
				dataType:'json',
				success: function(data){
					$('.register_block').hide();
					$restoreForm.hide();

					if (data.status == 'error') {
						$successBlock.addClass('display-none');
						$successBlock.hide();
						window.location.href = '/error';
					} else if(data.status == 'error-save'){
						$errorBlock.removeClass('display-none');
						$successBlock.addClass('display-none');
						$successBlock.hide();
						$errorBlock.show();
					} else {
						$successBlock.removeClass('display-none');
						$successBlock.show();
					}
				},
				fail: function(){
					$successBlock.hide();
					$errorBlock.show();
				}
			});

			return false;
		},
		rules: {
			user_email: {
				required: true
			}
		}
	},
	/*
	 * Настройки для формы: Введите новый пароль
	 */
	'js-recover-form' : {
		rules: {
			user_password: {
				required: true,
				minlength: 6
			},
			user_confirm_password: {
				required: true,
				equalTo: "#js-recover-pass-input"
			}
		}
	},
	/*
	 * Настройки для формы: Задать вопрос
	 */
	'js-ask-questions' : {
		submitHandler: function(form) {
			var $form = $(form),
				formData = getFormData($form),
				subjectAlias = 'faq',
				data = {
					"feedbackText" : formData.user_question,
					"userName": formData.user_name,
					"userEmail": formData.user_email,
					"subject": subjectAlias
				};

			$.ajax({
				type: "POST",
				url: '/send-feedback-form',
				data: data,
				dataType:'json',
				success: function(data){
					if (data.status == 'error') {
						window.location.href = '/error';
					} else if(data.status == 'error-send'){
						$.ulejMessages.showMessage('error', data.message);
					} else {
						$.ulejMessages.showMessage('success', data.message);
						$('.js-close-popup').click();
					}
				},
				error: function(){
					$.ulejMessages.showMessage('error', 'Ошибка. Попробуйте повторить попытку');
				}
			});

			form.reset();

			return false;
		},
		rules: {
			user_question: {
				required: true
			},
			user_name: {
				required: true
			},
			user_email: {
				required: true,
				full_email: true
			}
		}
	},
	/*
	 * Настройки для формы: Обратная связь
	 */
	'js-feedback-page-form' : {
		submitHandler: function(form) {
			var $form = $(form),
				formData = getFormData($form),
				data = {
					"feedbackText" : formData.user_question,
					"userName": formData.user_name,
					"userEmail": formData.user_email,
					"subject": formData.feedback_subject
				};

			$.ajax({
				type: "POST",
				url: '/send-feedback-form',
				data: data,
				dataType:'json',
				success: function(data){
					if (data.status == 'error') {
						window.location.href = '/error';
					} else if(data.status == 'error-send'){
						$.ulejMessages.showMessage('error', data.message);
					} else {
						$.ulejMessages.showMessage('success', data.message);
						$('.js-close-popup').click();
					}
				},
				error: function(){
					$.ulejMessages.showMessage('error', 'Ошибка. Попробуйте повторить попытку');
				}
			});

			$form.find('.js-feedback-select').data('dropDown').reset();
			form.reset();

			return false;
		},
		rules: {
			user_question: {
				required: true
			},
			user_name: {
				required: true
			},
			user_email: {
				required: true,
				full_email: true
			}
		}
	},
	/*
	 * Настройки для формы: Обратная связь
	 */
	'js-feedback-popup-form' : {
		submitHandler: function(form) {
			var $form = $(form),
				formData = getFormData($form),
				data = {
					"feedbackText" : formData.user_question,
					"userName": formData.user_name,
					"userEmail": formData.user_email,
					"subject": formData.feedback_subject
				};

			$.ajax({
				type: "POST",
				url: '/send-feedback-form',
				data: data,
				dataType:'json',
				success: function(data){
					if (data.status == 'error') {
						window.location.href = '/error';
					} else if(data.status == 'error-send'){
						$.ulejMessages.showMessage('error', data.message);
					} else {
						$.ulejMessages.showMessage('success', data.message);
						$('.js-close-popup').click();
					}
				},
				error: function(){
					$.ulejMessages.showMessage('error', 'Ошибка. Попробуйте повторить попытку');
				}
			});

			$form.find('.js-feedback-select').data('dropDown').reset();
			form.reset();

			return false;
		},
		rules: {
			user_question: {
				required: true
			},
			user_name: {
				required: true
			},
			user_email: {
				required: true,
				full_email: true
			}
		}
	},
	/*
	 * Настройки для формы: Контакты
	 */
	'js_contact_form' : {
		submitHandler: function(form) {
			var $form = $(form),
				formData = getFormData($form),
				data = {
					"feedbackText" : formData.user_message,
					"userName": formData.user_name,
					"userEmail": formData.user_email,
					"subject": 'contacts'
				};

			$.ajax({
				type: "POST",
				url: '/send-feedback-form',
				data: data,
				dataType:'json',
				success: function(data){
					if (data.status == 'error') {
						window.location.href = '/error';
					} else if(data.status == 'error-send'){
						$.ulejMessages.showMessage('error', data.message);
					} else {
						$.ulejMessages.showMessage('success', data.message);
					}
				},
				error: function(){
					$.ulejMessages.showMessage('error', 'Ошибка. Попробуйте повторить попытку');
				}
			});

			form.reset();
		},
		rules: {
			user_message: {
				required: true
			},
			user_name: {
				required: true
			},
			user_email: {
				required: true,
				full_email: true
			}
		}
	},
	/*
	 * Настройки для формы: Обратная связь
	 */
	'js-subscription' : {
		submitHandler: function(form) {
			form = $(form);
			var formData = getFormData(form);

			$.ajax({
				type: "POST",
				url: '/subscription',
				data: formData,
				dataType:'json',
				success: function(request) {
					if(request.status == 'success') {
						var form = $('.js-subscription-popup');
						form.find('form').trigger('reset');
						$.ulejMessages.showMessage('success', request.message);
						$.ulejPopupClose();
					} else {
						window.location.href = '/error';
					}
				}
			});

			return false;
		},
		rules: {
			email: {
				required: true,
				full_email: true
			}
		}
	},
	/*
	 * Страница оплаты
	 * Настройки для формы: Первый шаг оплаты
	 */
	'form-pay-step1' : {
		submitHandler:function(form) {
			form = $(form);

			//if(!$('body').data('showPopup') && form.hasClass('js-epam-project')) {
			//	$.ulejPopupOpen($('.js-poll-popup'));
			if (!form.data('confirm')) {
				var sumStr = $('#sum-block-update').val(),
					sumVal = parseFloat(sumStr.replace(' ', '')),
					commission = parseFloat($('#js-pay-commission').text().replace(',', '.')),
					sumWithCommission = sumVal + (sumVal * commission / 100);
				$('.js-pay-sum').text(sumStr);
				$('.js-pay-sum-with-commission').text(number_format(sumWithCommission, 0, '', ' '));
			} else {
				var button = $('.pay__btn--more');

				if(!form.data('ready-submit')) {
					if(!form.hasClass('validation-completed') && !button.hasClass('disabled-submit')) {
						form.data('ready-submit', true);
						disableControl($('.submit-form-pay-step1'));
						disableControl($('.js-interview-button'));

						return true;
					}
				}
			}

			return false;
		},
		rules: {
			sum: {
				required: true,
				min_amount: 1
			},
			'sum-no-gift': {
				required: true,
				min_amount: 1
			}
		}
	},
	/*
	 * Страница оплаты
	 * Настройки для формы: Второй шаг оплаты
	 */
	'form-pay-step2' : {
		submitHandler:function(form) {
			form = $(form);

			if(!$('body').data('showPopup') && form.hasClass('js-epam-project')) {
				$.ulejPopupOpen($('.js-poll-popup'));
			} else {
				var formData = getFormData(form);
				var button = $('.pay__btn--more');

				if(!form.data('ready-submit')) {
					if(!form.hasClass('validation-completed') && !button.hasClass('disabled-submit')) {
						button.addClass('disabled-submit');

						disableControl($('.submit-form-pay-step2'));
						disableControl($('.js-interview-button'));

						$.ajax({
							type: "POST",
							url: '/simply-registration',
							data: formData,
							dataType: 'json',
							success: function(request) {
								if(request.status == 'error') {
									button.removeClass('disabled-submit');
									window.location.href = '/error';
								} else if(request.status == 'error-save') {
									button.removeClass('disabled-submit');
									$.ulejMessages.showMessage('error', request.message);
									activationControl($('.submit-form-pay-step2'));
									activationControl($('.js-interview-button'));
								} else {
									$('input[name=client_id]').val(request.data.clientId);
									form.addClass('validation-completed');
									form.data('ready-submit', true);
									setTimeout(function() {
										form.trigger('submit');
									}, 1000);
									$.ulejMessages.showMessage('success', request.message);
								}
							}
						});
					}
				} else return true;
			}

			return false;
		},
		rules: {
			'fio': {
				required: true
			},
			'email': {
				required: true,
				full_email: true
			},
			'f_reciver': {
				required: true
			},
			'i_reciver': {
				required: true
			},
			'o_reciver': {
				required: true
			},
			'country': {
				required: true
			},
			'city': {
				required: true
			},
			'address': {
				required: true
			},
			'mailIndex': {
				required: true
			},
			last_name: {
				required: true
			},
			first_name: {
				required: true
			},
			patronymic: {
				required: true
			},
			doc_series: {
				required: true
			},
			doc_who_issued: {
				required: true
			},
			doc_when_issued: {
				required: true
			}
		}
	},
	/*
	 * Страница оплаты
	 * Настройки для формы: Второй шаг оплаты ЕРИП
	 */
	'form-pay-step2-erip' : {
		rules: {
			last_name: {
				required: true
			},
			first_name: {
				required: true
			},
			patronymic: {
				required: true
			},
			doc_series: {
				required: true
			},
			doc_who_issued: {
				required: true
			}
		}
	},
	/*
	 * Страница оплаты
	 * Настройки для формы: Второй шаг оплаты ЕРИП (неавтоизированный пользователь)
	 */
	'form-pay-step2-erip-unauthorized' : {
		submitHandler:function(form) {
			var $button = $('.pay__btn--more');
			form = $(form);
			if (form.data('ready-submit')) {
				return true;
			} else if(!form.hasClass('validation-completed') && !$button.hasClass('disabled-submit')) {
				var formData = getFormData(form),
					simplyRegData = {
						fio: formData.first_name + ' ' + formData.last_name,
						email: formData.email,
						project_id: formData.project_id
					};
				$button.addClass('disabled-submit');
				disableControl($button);
				$.ajax({
					type: "POST",
					url: '/simply-registration',
					data: simplyRegData,
					dataType: 'json',
					success: function(request) {
						if(request.status == 'error') {
							$button.removeClass('disabled-submit');
							window.location.href = '/error';
						} else if(request.status == 'error-save') {
							$button.removeClass('disabled-submit');
							$.ulejMessages.showMessage('error', request.message);
							activationControl($button);
						} else {
							$('input[name=client_id]').val(request.data.clientId);
							form.addClass('validation-completed');
							form.data('ready-submit', true);
							setTimeout(function() {
								form.trigger('submit');
							}, 1000);
							$.ulejMessages.showMessage('success', request.message);
						}
					}
				});
			}

			return false;
		},
		rules: {
			last_name: {
				required: true
			},
			first_name: {
				required: true
			},
			patronymic: {
				required: true
			},
			doc_series: {
				required: true
			},
			doc_who_issued: {
				required: true
			},
			email: {
				required: true,
				full_email: true
			},
			'terms-input': {
				required: true
			}
		}
	},

    /*
     * Popup страница precreate
     * Форма: Поделиться идеей
     */
    'js-share-idea-form' : {
        submitHandler: function(form) {
            form = $(form);
            var formData = getFormData(form);

            $.ajax({
                type: "POST",
                url: '/api/idea',
                data: formData,
                dataType:'json',
                success: function(data){
                    if (data.status == 'error') {
                        window.location.href = '/error';
                    } else if(data.status == 'error-send'){
                        $.ulejMessages.showMessage('error', data.message);
                    } else {
                        $.ulejPopupClose();
                        $.ulejMessages.showMessage('success', data.message);
                        form.trigger('reset');
                    }
                }
            });

            return false;
        },

        rules: {
            "idea_text": {
                required: true
            },
            "user_name": {
                required: true
            },
            "user_email": {
                required: true
            }
        }
    },

    /**
     * Popup страница precreate
     * Форма: Запись на консультацию
     */
    'js-consult-form' : {
        submitHandler: function(form) {
            form = $(form);
            var formData = getFormData(form);

            $.ajax({
                type: "POST",
                url: '/send-consul-request',
                data: formData,
                dataType:'json',
                success: function(data){
                    if (data.status == 'error') {
                        window.location.href = '/error';
                    } else if(data.status == 'error-send'){
                        $.ulejMessages.showMessage('error', data.message);
                    } else {
                        $.ulejPopupClose();
                        $.ulejMessages.showMessage('success', data.message);
                        form.trigger('reset');
                    }
                }
            });

            return false;
        },

        rules: {
            "user_name": {
                required: true
            },
            "user_phone": {
                required: true
            }
        }
    }

};

$(document).ready(function() {
	/*
	 * Настройки - Профиль
	 * Форма: Личные данные
	 */
	setValidation('client_form');

	/*
	 * Настройки - Профиль
	 * Форма: Веб-сайты
	 */
	setValidation('js-add-website-form');

	/*
	 * Настройки - Доступ
	 * Форма: Изменить email
	 */
	setValidation('setting_new_email');

	/*
	 * Настройки - Доступ
	 * Форма: Изменить пароль
	 */
	setValidation('js-password-change');

	/*
	 * Настройки - Доступ
	 * Форма: Установить email и пароль
	 */
	setValidation('login-and-pass');

	/*
	 * Форма: Авторизации
	 */
	setValidation('js-login');

	/*
	 * Форма: Регистрации
	 */
	setValidation('js-registration');

	/*
	 * Форма: Восстановление пароля
	 */
	setValidation('js-restore');

	/*
	 * Форма: Введите новый пароль
	 */
	setValidation('js-recover-form');

	/*
	 * F.A.Q.
	 * Форма: Задать вопрос
	 */
	setValidation('js-ask-questions');

	/*
	 * Страница обратной связи
	 * Форма: Обратная связь
	 */
	setValidation('js-feedback-page-form');

	/*
	 * Попап обратной связи
	 * Форма: Обратная связь
	 */
	setValidation('js-feedback-popup-form');

	/*
	 * Страница контактов
	 * Форма: Контакты
	 */
	setValidation('js_contact_form');

	/*
	 * Попап подписка на рассылку
	 * Форма: Подпишись на новости
	 */
	setValidation('js-subscription');

	/*
	 * Страница оплаты
	 * Форма: Первый шаг оплаты
	 */
	setValidation('form-pay-step1');

	/*
	 * Страница оплаты
	 * Форма: Второй шаг оплаты
	 */
	setValidation('form-pay-step2');

	/**
	 * Страница оплаты
	 * Форма: Второй шаг оплаты ЕРИП
	 */
	setValidation('form-pay-step2-erip');

	/**
	 * Страница оплаты
	 * Форма: Второй шаг оплаты ЕРИП (неавторизированный пользователь)
	 */
	setValidation('form-pay-step2-erip-unauthorized');

    /**
     * Popup страница precreate
     * Форма: Поделиться идеей
     */
    setValidation('js-share-idea-form');

    /**
     * Popup страница precreate
     * Форма: Запись на консультацию
     */
    setValidation('js-consult-form');
});

/*
* Задаём валидацию для форм.
* Принимает строку -идентификатор формы (formIdentifier).
*
* @param string formIdentifier
*/
function setValidation(formIdentifier) {
	var form = $("#" + formIdentifier);

	if(form.length && validationSettings[formIdentifier]) {
		$("#" + formIdentifier).ulejFormValidation(validationSettings[formIdentifier]);
	}
}

/*
* Выборка массива полей формы
*
* @params object form
*
* @return object processingData
*/
function getFormData(form) {
	var formData = form.serializeArray(), processingData = {};

	if(formData.length > 0) {
		$.each(formData, function(fieldId, fieldObj) {
			processingData[fieldObj.name] = fieldObj.value;
		});
	}

	return processingData;
}

function emailValid(value) {
	var pattern = /^[a-z0-9_\-\.]+@[a-z0-9_\-\.]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;

	return value.search(pattern) != -1;
}