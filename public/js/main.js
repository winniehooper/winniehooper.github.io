function initialize() {
	var mapOptions = {
		zoom: 18,
		center: new google.maps.LatLng(53.915591, 27.571756),
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		disableDefaultUI: true
	};


	// ulej icon
	var icon = {
		path: "M27.876 7.736L17.129 1.567c-1.318-.756-2.941-.756-4.258 0L2.124 7.736C.806 8.493-.005 9.89-.005 11.403v12.338c0 1.513.811 2.911 2.129 3.667l10.747 6.169c1.317.756 2.94.756 4.258 0l10.747-6.169c1.317-.756 2.129-2.154 2.129-3.667V11.403c0-1.513-.812-2.91-2.129-3.667zm-8.231 16.681c0 3.897-9.287 3.897-9.287 0l-.003-16.045c0-.279.353-.506 1.366-.506 1.012 0 1.365.227 1.365.506l.003 16.045c0 2.44 3.825 2.44 3.825 0l-.001-16.044v-.001c0-.279.354-.506 1.366-.506s1.366.227 1.366.506v16.045z",
		fillColor: '#06B7C5',
		anchor: new google.maps.Point(20,20),
		fillOpacity: 1,
		strokeWeight: 0,
		scale: 1
	};

	// walk path symbol
	var lineSymbol = {
		path: 'M 0,-1 0,1',
		strokeOpacity: 1,
		strokeColor: '#06B7C5',
		scale: 2
	};

	// walk path coordinates
	var walkCoordinates = [
		new google.maps.LatLng(53.915583, 27.571190),
		new google.maps.LatLng(53.915397, 27.571807),
		new google.maps.LatLng(53.915451, 27.571918),
		new google.maps.LatLng(53.915328, 27.572312),
		new google.maps.LatLng(53.915380, 27.572456),
		new google.maps.LatLng(53.915292, 27.572550)
	]

	// walk path line
	var walkPath = new google.maps.Polyline({
		path: walkCoordinates,
		strokeOpacity: 0,
		icons: [{
			icon: lineSymbol,
			offset: '0',
			repeat: '10px'
		}],
		map: map
	});

	var map = new google.maps.Map(document.getElementById('js-map-canvas'),
		mapOptions);

	// add ulej logo marker to the map
	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(53.915260, 27.572598),
		map: map,
		draggable: false,
		icon: icon,
		title: 'ул. Красная, 7, корпус 8, 2 этаж, офис 14'
	});


	walkPath.setMap(map);
}

function loadMapScript() {
	var script = document.createElement('script');
	script.type = 'text/javascript';
	script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBs75zYLT3VjidIfKo863ea1Pia3qayNo8' +
		'&callback=initialize';
	document.body.appendChild(script);
}

if ($('#js-map-canvas').length) loadMapScript();

var preloderHTML =
	'<div class="preloader">' +
		'<div class="preloader-center">' +
			'<svg class="preloader-icon" width="34" height="38" viewBox="0 0 34 38">' +
				'<path class="preloader-path" stroke-dashoffset="0" d="M29.437 8.114L19.35 2.132c-1.473-.86-3.207-.86-4.68 0L4.153 8.114C2.68 8.974 1.5 10.56 1.5 12.28v11.964c0 1.718 1.22 3.306 2.69 4.165l10.404 5.98c1.47.86 3.362.86 4.834 0l9.97-5.98c1.472-.86 2.102-2.45 2.102-4.168V12.28c0-1.72-.59-3.306-2.063-4.166z">' +
					'<animate attributeType="XML" attributeName="stroke-dashoffset" from="0" to="102px" dur="1s" repeatCount="indefinite"/>' +
				'</path>' +
			'</svg>' +
		'</div>' +
	'</div>';

$(document).ready(function(){
	var body = $('body'),
		head = body.find('.js-head'),
		openMenu = head.find('.js-open-menu'),
		menu = head.find('.js-menu'),
		authPopup = body.find('.js-auth-popup'),
		openAuth = body.find('.js-open-auth'),
		loginContent = authPopup.find('.js-login-content'),
		regContent = authPopup.find('.js-reg-content'),
		restContent = authPopup.find('.js-rest-content'),
		openReg = authPopup.find('.js-open-reg'),
		openRest = authPopup.find('.js-open-rest'),
		openLoginReg = regContent.find('.js-open-login'),
		openLoginRest = restContent.find('.js-open-login'),
		openSearch = head.find('.js-open-search'),
		searchPopup = body.find('.js-search-popup'),
		openMessage = body.find('.js-open-message'),
		sectionLocation = body.find('.js-section-location'),
		mapLocation = sectionLocation.find('#js-create-map'),
		videoContainer = body.find('.js-video-container'),
		videoPreview = body.find('.js-video-preview'),
		videoPlay = body.find('.js-video-play'),
		openVideo = body.find('.js-open-video'),
		videoPopup = body.find('.js-add-video-popup'),
		systemPopup = body.find('.js-system-popup'),
		openBio = body.find('.js-open-bio'),
		infoPopup = body.find('.js-info-popup'),
		openProjects = body.find('.js-open-projects'),
		openPassword = body.find('.js-open-password'),
		openDeleteAccount = body.find('.js-open-delete-account'),
		openDeleteAccountNoPass = body.find('.js-open-delete-account-nopass'),
		passwordPopup = body.find('.js-password-popup'),
		confirmPassword = passwordPopup.find('.js-confirm-password'),
		openSubscription = body.find('.js-open-subscription'),
		subscriptionPopup = body.find('.js-subscription-popup'),
		closeSubscription = subscriptionPopup.find('.js-close-popup'),
		openAdditionalCheck = body.find('.js-open-additional-check'),
		openConfirmedEmail = body.find('.js-open-confirmed-email'),
		openProhibitionSelectionGifts = body.find('.js-open-prohibition-selection-gifts'),
		openPreviewProjectSelectionGifts = body.find('.js-open-preview-project-selection-gifts'),
		openProhibitionEditing = body.find('.js-open-prohibition-editing'),
		openEmptyEmail = body.find('.js-open-empty-email'),
		openConfirmedUserEmail = body.find('.js-open-confirmed-user-email'),
		openPostcreateDoc = body.find('.js-open-postcreate-doc'),
		openRequestChange = body.find('.js-open-request-change'),
		openDonationContractPopup = body.find('.js-open-donation-contract'),
		donationContractPopup = body.find('.js-donation-contract-popup'),
		openFeedbackPopup = body.find('.js-open-feedback-popup'),
		feedbackPopup = body.find('.js-feedback-popup'),
		deleteProjectPopup = body.find('.js-delete-project-popup'),
		openDeleteProjectPopup = body.find('.js-open-delete-project-popup'),
		openPoll = body.find('.js-open-poll'),
		pollPopup = body.find('.js-poll-popup'),
		openPayType = body.find('.js-open-pay-type'),
		payTypePopup = body.find('.js-pay-type-popup'),
        openShareIdeaPopup = body.find('.js-open-share-idea'),
        shareIdeaPopup = body.find('.js-share-idea-popup'),
        openConsultPopup = body.find('.js-open-consult'),
		consultPopup = body.find('.js-consult-popup'),
		openAbout = body.find('.js-open-about'),
		aboutPopup = body.find('.js-about-popup');

	Modernizr.addTest('isios', function(){
		var iOS = /(iPad|iPhone|iPod)/g.test( navigator.userAgent );
		return iOS;
	});

	var pusherLinks = 'a.js-open-login, a.js-open-auth, a.js-open-rest, a.js-open-reg, a.js-open-search, a.js-popup-change-url';
		$(document).pusher({

		//watch on all 'a' in the document excpet external links
		watch: pusherLinks,

		before: function(done) {
			//show loading before page load
			done();
			var expectedLink = false,
				$this = this,
				pusherLinkObj = $(pusherLinks),
				pattern = "^(([^:/\\?#]+):)?(//(([^:/\\?#]*)(?::([^/\\?#]*))?))?([^\\?#]*)(\\?([^#]*))?(#(.*))?$",
				rx = new RegExp(pattern),
				parts = rx.exec(this.state.path),
				urlParts = {
					href: parts[0] || "",
					protocol: parts[1] || "",
					host: parts[4] || "",
					hostname: parts[5] || "",
					port: parts[6] || "",
					pathname: parts[7] || "/",
					search: parts[8] || "",
					hash: parts[10] || ""
				};

			$.each(pusherLinkObj, function() {
				var self = $(this);
				if($this.state.path == self.attr('href')) {
					expectedLink = true;
				}
			});

			if(this.state.elemType == 'popup') {
				if(this.state && this.state.path && expectedLink) {
					switch (urlParts.pathname) {
						case '/login':
							resetForm(loginContent.find('form'));

							regContent.removeClass('popup__block__registration--show');
							loginContent.removeClass('popup__block__login-registration--hidden');
							restContent.removeClass('popup__block__restore--show');
							loginContent.removeClass('popup__block__login-restore--hidden');
							authPopup.addClass('overlayer--show');
							break;
						case '/recovery':
							resetView(restContent);

							authPopup.addClass('overlayer--show');
							loginContent.addClass('popup__block__login-restore--hidden');
							restContent.addClass('popup__block__restore--show');
							break;
						case '/registration':
							resetView(regContent);

							authPopup.addClass('overlayer--show');
							loginContent.addClass('popup__block__login-registration--hidden');
							regContent.addClass('popup__block__registration--show');
							break;
						case '/search':
							resetView(regContent);

							regContent.removeClass('popup__block__registration--show');
							loginContent.removeClass('popup__block__login-registration--hidden');
							restContent.removeClass('popup__block__restore--show');
							loginContent.removeClass('popup__block__login-restore--hidden');
							authPopup.removeClass('overlayer--show');
							searchPopup.addClass('overlayer--show');
							break;
					}
				}
			} else {
				if(this.state.prevElemType == 'popup' && !this.state.elemType || this.state.elemType && this.state.elemType != 'closePopup') {
					$.ulejPopupClose(true);
					$('.js-auth-popup').removeClass('overlayer--show');
				} else {
					regContent.removeClass('popup__block__registration--show');
					restContent.removeClass('popup__block__restore--show');
					searchPopup.removeClass('overlayer--show');
					$('.js-auth-popup').removeClass('overlayer--show');
				}
			}
		}
	});

	openMenu.on('click', function(event){
		openMenu.toggleClass('head__user__avatar--menu-opened');
		menu.toggle();
		event.stopPropagation();
	});

	/* Открытие / Закрытие всплывающих окон */


	/* Всплывающее окно: Опрос */
	var continueBtn = $('.js-continue');

	pollPopup.on('click', '.js-radio', function() {
		$('input[name=interview]').val($(this).val());
		continueBtn.removeAttr('disabled').removeClass('popup-system__btn--inactive');
	});

	pollPopup.on('click', '.js-continue', function() {
		$('.js-payment-form').submit();

		return false;
	});

	pollPopup.on('click', '.js-skip', function() {
		$('input[name=interview]').val(0);
		$('body').data('showPopup', true);
		$('.js-payment-form').submit();

		return false;
	});

    /* Всплывающее окно: Как работает краудфандинг */
	openAbout.ulejPopup({
        popupArea: aboutPopup
    });

	var $footerNavigation = $('.js-footer-navigation');

	if($footerNavigation.length) {
		$('.js-footer-navigation').Stickyfill();
	}

    /* Всплывающее окно: Поделиться идеей*/
    openShareIdeaPopup.ulejPopup({
        popupArea: shareIdeaPopup
    });

    /* Всплывающее окно: Записаться на консультацию*/
    openConsultPopup.ulejPopup({
        popupArea: consultPopup
    });

	/* Всплывающее окно: Условия дарения */
	openDonationContractPopup.ulejPopup({
		popupArea: donationContractPopup
	});

	/* Всплывающее окно: Форма обратной связи */
	openFeedbackPopup.ulejPopup({
		popupArea: feedbackPopup
	});

	/* Всплывающее окно: Подтверждение удаление проекта */
	openDeleteProjectPopup.ulejPopup({
		popupArea: deleteProjectPopup
	});

	/* Всплывающее окно: Поиск */
	openSearch.ulejPopup({
		popupArea: searchPopup,
		popupPage: true,
		afterShow: function() {
			//window.history.pushState(null, null, '/search');
		},
		afterClose: function() {
			//window.history.replaceState(null, null, getPreviousUrl());
		}
	});

	/* Всплывающее окно: Авторизации */
	openAuth.ulejPopup({
		popupArea: authPopup,
		popupPage: true,
		beforeInitEvents: function() {
			var urlPart = location.protocol + '//' + location.hostname;

			openLoginReg.on('click', function(){
				resetForm(loginContent.find('form'));

				regContent.removeClass('popup__block__registration--show');
				loginContent.removeClass('popup__block__login-registration--hidden');

				//window.history.pushState(null, null, '/login');
			});

			openLoginRest.on('click', function(){
				resetForm(loginContent.find('form'));

				restContent.removeClass('popup__block__restore--show');
				loginContent.removeClass('popup__block__login-restore--hidden');
				//window.history.pushState(null, null, '/login');
			});

			openRest.on('click', function(){
				resetView(restContent);

				loginContent.addClass('popup__block__login-restore--hidden');
				restContent.addClass('popup__block__restore--show');

				//window.history.pushState(null, null, '/recovery');
			});

			openReg.on('click', function() {
				resetView(regContent);

				loginContent.addClass('popup__block__login-registration--hidden');
				regContent.addClass('popup__block__registration--show');

				//window.history.pushState(null, null, '/registration');
			});
		},
		afterShow: function() {
			//window.history.pushState(null, null, '/login');
		},
		afterClose: function() {
			//window.history.back();
			//window.history.pushState({elemType:'closePopup'}, null, getPreviousUrl());
			regContent.removeClass('popup__block__registration--show');
			restContent.removeClass('popup__block__restore--show');
			loginContent.removeClass('popup__block__login-registration--hidden').removeClass('popup__block__login-restore--hidden');
		}
	});


	/* Всплывающее окно: Видео */
	setVideoPopup(videoPopup, openVideo);

	/* Всплывающее окно: Системные сообщения */
	openMessage.ulejPopup({
		popupArea: systemPopup,
		beforeShow: function($control) {
			openMessagePopup($control, true);
		}
	});

	/* Всплывающее окно: Информация о пользователе */
	setBioPopup(systemPopup, openBio);

	/* Всплывающее окно: Список проектов добавленных/поддержанных проектов. */
	setProjectPopup(systemPopup, openProjects);

	/* Всплывающее окно: Сообщение о подписании договоров */
	openPostcreateDoc.ulejPopup({
		popupArea: infoPopup,
		beforeShow: function($control) {
			infoPopup.find('.js-info-messages').hide();
			infoPopup.find('.js-info-postcreate-doc').show();
		}
	});

	/* Всплывающее окно: Сообщение о возможности изменения данных */
	openRequestChange.ulejPopup({
		popupArea: infoPopup,
		beforeShow: function($control) {
			infoPopup.find('.nb-section__head').hide();
			infoPopup.find('.js-info-messages').hide();
			infoPopup.find('.js-request-change').show();
		},
		afterClose: function() {
			infoPopup.find('.nb-section__head').show();
		}
	});

	/* Всплывающее окно: Запрет поддержки собственных проектов */
	prohibitionSelectionGifts(openProhibitionSelectionGifts, infoPopup);

	/* Всплывающее окно: Запрет выбора подарка в режиме предпросмотра */
	previewProjectSelectionGifts(openPreviewProjectSelectionGifts, infoPopup);

	/* Всплывающее окно: Сообщение для подтверждения email */
	openConfirmedUserEmail.ulejPopup({
		popupArea: infoPopup,
		beforeShow: function($control) {
			infoPopup.find('.js-info-messages').hide();
			infoPopup.find('.js-system-popup-content').show();
			infoPopup.find('.js-info-confirmed-user-email').show();
		}
	});

	/* Всплывающее окно: Сообщение для указания email */
	openEmptyEmail.ulejPopup({
		popupArea: infoPopup,
		beforeShow: function($control) {
			infoPopup.find('.js-info-messages').hide();
			infoPopup.find('.js-system-popup-content').show();
			infoPopup.find('.js-info-empty-email').show();
		},
		afterClose: function() {
			//infoPopup.find('.js-system-popup-content').hide();
		}
	});

	/* Всплывающее окно: Запрет поддержки собственных проектов */
	openProhibitionEditing.ulejPopup({
		popupArea: infoPopup,
		beforeShow: function($control) {
			infoPopup.find('.js-info-messages').hide();
			infoPopup.find('.js-system-popup-content').hide();
			infoPopup.find('.js-info-prohibition-editing').show();
		}
	});

	/* Всплывающее окно: Подписание договоров */
	openAdditionalCheck.ulejPopup({
		popupArea: infoPopup,
		beforeShow: function($control) {
			infoPopup.find('.js-info-messages').hide();
			infoPopup.find('.js-system-popup-content').hide();
			infoPopup.find('.js-info-additional-check').show();
		}
	});

	/* Всплывающее окно: Подтверждающее сообщение */
	setConfirmedEmail(openConfirmedEmail, infoPopup);

	/* Всплывающее окно: Подтверждение изменения почты */
	setPasswordConfirmPopup(openPassword, passwordPopup);

	/* Всплывающее окно: Подтверждающее удаление аккаунта */
	openDeleteAccount.ulejPopup({
		popupArea: passwordPopup,
		beforeShow: function($control) {
			$('#email_change').prop('action', '/delete-profile');
			passwordPopup.find('.js-password-popup-text').hide();
			passwordPopup.addClass('delete-account');
		},
		afterClose: function() {
			this.removeClass('delete-account');
		}
	});

	/* Всплывающее окно: Сообщение подтверждения при удалении аккаунта */
	openDeleteAccountNoPass.ulejPopup({
		popupArea: passwordPopup,
		beforeShow: function($control) {
			$('#email_change').prop('action', '/delete-profile');
			passwordPopup.find('.js-password-popup-text').hide();
			passwordPopup.addClass('delete-account-nopass');
		},
		afterClose: function() {
			this.removeClass('delete-account-nopass');
		}
	});

	$('#email_change').on('submit', function() {
		return false;
	});
	
	$('#email_change input.popup-system-password__input').on('keyup', function(e) {
		if(e.keyCode == 13) {
			confirmPassword.trigger('click');
		}
	});

	/* Всплывающее окно: Подтверждающее удаление аккаунта */
	if(confirmPassword.length) {
		confirmPassword.on('click', function() {
			var form = document.getElementById('email_change'),
				formData = new FormData(form),
				action = $(form).prop('action'),
				field = $(form).find('input.popup-system-password__input'),
				fieldEmail = $('#setting_new_email #js-set-email').val(),
				fieldValue = field.val();

			if(!confirmPassword.closest(".js-system-popup-content").find(".js-enter-pass-form-wrapper").is(":visible")){
				$.ajax({
					type: "POST",
					url: '/delete-profile',
					async: false,
					success: function(data){
						if (data.status == 'error') {
							window.location.href = '/error';
						} else if(data.status == 'error-save'){
							if (data.message) {
								showAlert('error', data.message);
							} else {
								showAlert('error');
							}
						} else {
							if (action.indexOf('/delete-profile') != -1) {
								showAlert('success', 'Аккаунт удален');
								window.location.href = '/';
							} else {
								showAlert('success');
								$('#js-set-email').val('');
							}

							passwordPopup.removeClass('delete-account change-email');
						}

						$.ulejPopupClose();
					},
					fail: function(){
						showAlert('error');
					}
				});
			} else if (fieldValue && fieldValue.length >= 6 && (emailValid(fieldEmail) || passwordPopup.hasClass('delete-account-nopass') || passwordPopup.hasClass('delete-account'))) {
				field.parent().removeClass('nb-input--invalid');
				$.ajax({
					type: "POST",
					url: action,
					processData: false,
					contentType: false,
					data: formData,
					dataType: 'json',
					async: false,
					success: function(data){
						if (data.status == 'error') {
							window.location.href = '/error';
						} else if(data.status == 'error-save'){
							if (data.message) {
								showAlert('error', data.message);
							} else {
								showAlert('error');
							}
						} else {
							if (action.indexOf('/delete-profile') != -1) {
								showAlert('success', 'Аккаунт удален');
								window.location.href = '/';
							} else {
								showAlert('success');
								$('#js-set-email').val('');
							}

							passwordPopup.removeClass('delete-account change-email');
						}

						$.ulejPopupClose();
					},
					fail: function(){
						showAlert('error');
					}
				});
			} else {
				field.parent().addClass('nb-input--invalid');
			}
		})
	}

	$('.js-dd-cat,' +
			'.js-dd-sort-proj,' +
			'.js-dd-proj-verify,' +
			'.js-dd-time-proj,' +
			'.js-dd-doc-type,' +
			'.js-dd-settings-sex' +
			'.js-dd-feedback,' +
		// payment page /index-create-step4.html dropdown variants
			'.js-dd-edit-pay-receiver,' +
		// payment page /index-create-step4.html dropdown document types
			'.js-dd-select-doc-box,' +
			'.js-dd-edit-new-lot-date-month,' +
			'.js-dd-edit-new-lot-date-year,' +
			'.js-dd-edit-new-lot-delivery,' +
			'.js-dd-edit-new-lot-delivery-country,' +
			'.js-dd-pay-address-country').addClass('js-dd-select-box');

	// payment page /index-create-step4.html variants of layout
	var paymentVariantsClassnames = {
		0 : 'person',
		1 : 'ip',
		2 : 'legal'
	};

	// payment page /index-create-step4.html changing variants
	function openVariantBody(value) {
		var hiddenClass = 'is-hidden';
		$('.js-variant').addClass(hiddenClass);
		$('.js-variant-' + value).removeClass(hiddenClass);
	}

	// payment page /index-create-step4.html set layout on document ready
	openVariantBody(paymentVariantsClassnames[$('.js-dd-edit-pay-receiver .js-dd-select').val()]);

	// payment page /index-create-step4.html on changing dropdown — change layout
	$('.js-dd-edit-pay-receiver').on('change', function (event){
		openVariantBody(paymentVariantsClassnames[event.target.value]);
	});

	function openVariantDelivery(value) {
		var hiddenClass = 'is-hidden';
		$('.js-lot-delivery-var').addClass(hiddenClass);
		$('.js-lot-delivery-var-' + value).removeClass(hiddenClass);
	}

	$('.js-dd-edit-new-lot-delivery').on('change', function (event){
		var checkedVar = event.target.value;
		openVariantDelivery(checkedVar);
	});

	var deliveryCountryString =
			'            <div class="nb-section__field js-country-string cf"> '+
			'              <div class="nb-input-wrap input-wrap--33"> '+
			'                <div class="nb-dd-toggle-wrap js-dd-edit-new-lot-delivery-country"> '+
			'                  <div class="nb-dd-toggle js-toggle-dd"> '+
			'                    <span class="nb-dd-toggle-txt js-toggle-dd-txt nb-dd-toggle-txt--default">Выберите страну</span> '+
			'                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="9" class="nb-dd-arrow-icon" preserveAspectRatio="xMidYMid" viewBox="0 0 13 9"><path fill-rule="evenodd" d="M12.003 1L6.502 6.592 1 1" class="cls-dd-arrow-Aqua"/></svg> '+
			'                  </div> '+
			'                  <select class="nb-dd-default js-dd-select" name="edit-pay-receiver"> '+
			'                    <option class="js-dd-option" selected>Выберите страну</option> '+
			'                    <option class="js-dd-option" value="0">Беларусь</option> '+
			'                    <option class="js-dd-option" value="1">Украина</option> '+
			'                    <option class="js-dd-option" value="2">Россия</option> '+
			'                  </select> '+
			'                  <ul class="nb-dd nb-dd--hidden js-dd-menu"> '+
			'                    <li class="nb-dd-item"> '+
			'                      <div class="dd-item-link js-dd-menu-item dd-item-link--default dd-item-link--selected js-default-select-value"> '+
			'                        <span>Выберите страну</span> '+
			'                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="9" class="nb-dd-arrow-icon" preserveAspectRatio="xMidYMid" viewBox="0 0 13 9"><path fill-rule="evenodd" d="M.992 6.606l5.501-5.592 5.502 5.592" class="cls-dd-arrow-Aqua"></path></svg> '+
			'                      </div> '+
			'                    </li> '+
			'                    <li class="nb-dd-items"> '+
			'                      <ul class="nb-dd-items__list"> '+
			'                        <li class="nb-dd-item"><div data-value="0" class="dd-item-link dd-item-link--selected js-dd-menu-item">Беларусь</div></li> '+
			'                        <li class="nb-dd-item"><div data-value="1" class="dd-item-link js-dd-menu-item">Украина</div></li> '+
			'                        <li class="nb-dd-item"><div data-value="2" class="dd-item-link js-dd-menu-item">Россия</div></li> '+
			'                      </ul> '+
			'                    </li> '+
			'                  </ul> '+
			'                </div> '+
			'              </div> '+
			'              <div class="nb-input-wrap input-wrap--33 nb-create__gift-delivery-sum"> '+
			'                <input required type="number" name="" class="nb-input input--with-postfix" placeholder="Стоимость доставки"/> '+
			'                <span class="input-postfix">BYN</span> '+
			'              </div> '+
			'              <div class="nb-input-wrap input-wrap--33 lot-remove-wrap"> '+
			'                <a href="javascript:void(0);" class="nb-link create-gift__link--remove js-remove-country">Удалить</a> '+
			'              </div> '+
			'            </div> ';

	$('.js-add-country').on('click', function () {
		$('.js-delivery-countries').append($(deliveryCountryString));
		$('.js-dd-edit-new-lot-delivery-country').addClass('js-dd-select-box');
	});

	$('.js-delivery-countries').on('click', '.js-remove-country', function () {
		var parent = $(this).closest('.js-country-string');
		parent.remove();
	})

	var deliveryExceptionString =
			'            <div class="nb-section__field js-country-string cf"> '+
			'              <div class="nb-input-wrap input-wrap--33"> '+
			'                <div class="nb-dd-toggle-wrap js-dd-edit-new-lot-delivery-exception"> '+
			'                  <div class="nb-dd-toggle js-toggle-dd"> '+
			'                    <span class="nb-dd-toggle-txt js-toggle-dd-txt nb-dd-toggle-txt--default">Выберите страну</span> '+
			'                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="9" class="nb-dd-arrow-icon" preserveAspectRatio="xMidYMid" viewBox="0 0 13 9"><path fill-rule="evenodd" d="M12.003 1L6.502 6.592 1 1" class="cls-dd-arrow-Aqua"/></svg> '+
			'                  </div> '+
			'                  <select class="nb-dd-default js-dd-select" name="edit-pay-receiver"> '+
			'                    <option class="js-dd-option" selected>Выберите страну</option> '+
			'                    <option class="js-dd-option" value="0">Беларусь</option> '+
			'                    <option class="js-dd-option" value="1">Украина</option> '+
			'                    <option class="js-dd-option" value="2">Россия</option> '+
			'                  </select> '+
			'                  <ul class="nb-dd nb-dd--hidden js-dd-menu"> '+
			'                    <li class="nb-dd-item"> '+
			'                      <div class="dd-item-link js-dd-menu-item dd-item-link--default dd-item-link--selected js-default-select-value"> '+
			'                        <span>Выберите страну</span> '+
			'                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="9" class="nb-dd-arrow-icon" preserveAspectRatio="xMidYMid" viewBox="0 0 13 9"><path fill-rule="evenodd" d="M.992 6.606l5.501-5.592 5.502 5.592" class="cls-dd-arrow-Aqua"></path></svg> '+
			'                      </div> '+
			'                    </li> '+
			'                    <li class="nb-dd-items"> '+
			'                      <ul class="nb-dd-items__list"> '+
			'                        <li class="nb-dd-item"><div data-value="0" class="dd-item-link dd-item-link--selected js-dd-menu-item">Беларусь</div></li> '+
			'                        <li class="nb-dd-item"><div data-value="1" class="dd-item-link js-dd-menu-item">Украина</div></li> '+
			'                        <li class="nb-dd-item"><div data-value="2" class="dd-item-link js-dd-menu-item">Россия</div></li> '+
			'                      </ul> '+
			'                    </li> '+
			'                  </ul> '+
			'                </div> '+
			'              </div> '+
			'              <div class="nb-input-wrap input-wrap--33 nb-create__gift-delivery-sum"> '+
			'                <input required type="number" name="" class="nb-input input--with-postfix" placeholder="Стоимость доставки"/> '+
			'                <span class="input-postfix">BYN</span> '+
			'              </div> '+
			'              <div class="nb-input-wrap input-wrap--33 lot-remove-wrap"> '+
			'                <a href="javascript:void(0);" class="nb-link create-gift__link--remove js-remove-exception">Удалить</a> '+
			'              </div> '+
			'            </div> ';

	$('.js-add-exception').on('click', function () {
		$('.js-delivery-exceptions').append($(deliveryExceptionString));
		$('.js-dd-edit-new-lot-delivery-exception').addClass('js-dd-select-box');
	});

	$('.js-delivery-exceptions').on('click', '.js-remove-exception', function () {
		var parent = $(this).closest('.js-country-string');
		parent.remove();
	});

	$('#js-gift-count-limit-input').on('change', function (event) {
		show_hideGiftCountInput(event.target);
	});

	// duplicate. remove
	function show_hideGiftCountInput(element) {
		var giftCountBlock = $(element).parent().siblings(".nb-create__gift-limit");
		if($(element).prop("checked")) {
			giftCountBlock.show();
		} else {
			giftCountBlock.hide();
		}
	}




	//dropdown

	$(window).on('click', function (event) {
		if (!$(event.target).closest('.js-dd-menu').length && !$('.js-toggle-dd').is(event.target)) {
			var dropdowns = document.getElementsByClassName('nb-dd-toggle-wrap');
			for (var i = 0, length = dropdowns.length; i < length; i++) {
				var currentDropdown = $(dropdowns[i]);
				if (currentDropdown.hasClass('is-opened')) {
					currentDropdown.removeClass('is-opened');
					currentDropdown.find('.js-dd-menu').addClass('nb-dd--hidden');
					currentDropdown.find('.js-dd-select').trigger('change')
				}
			}
		}
	});

	$.fn.DropDown = function(options) {
		return this.each(function() {
			if (undefined == $(this).data('DropDown')) {
				var plugin = new DropDown(this, options);
				$(this).data('DropDown', plugin);
			}
		});
	};

	$('html').click(function() {
		openMenu.removeClass('head__user__avatar--menu-opened');
		menu.hide();
		$('.js-dd-menu').addClass('nb-dd--hidden');
		$('.js-dd-select-box').removeClass('is-opened');
	});


	/* Всплывающее окно: Подписаться на новости */
	openSubscription.ulejPopup({
		popupArea: subscriptionPopup
	});

	videoPlay.on('click',function(){
		videoContainer.toggleClass('project__video__container--hidden');
		videoPreview.toggleClass('project__video__preview--hidden')
	});

	$(document).keyup(function(e) {
		var keycode = (e.keyCode ? e.keyCode : e.which);

		if (keycode === 27) {
			$.ulejPopupClose();
		}
	});

	$('.js-dd-select-box').each(function() {
		new DropDown($(this));
	});

	$('#datetimepicker').on('focus', function(){
		$(this).closest('.js-get-dob-wrap').addClass('nb-input-wrap-date--opened');
		$(this).datetimepicker({
			onGenerate:function(ct,$i ){
				// $('#datetimepicker').show();
				// TODO: пока пришлось отредактировать исходники datetimepicker'a
			},
			onSelectDate: function(ct,$i){
				$i.datetimepicker('destroy');
				$i.blur();
				$i.closest('.js-get-dob-wrap').removeClass('nb-input-wrap-date--opened');
				$i.change();
			},
			inline: true,
			todayButton: false,
			timepicker:false,
			format:'Y-m-d',
			lang:'ru',
			dayOfWeekStart:1,
			closeOnDateSelect:true,
			maxDate:0,
			defaultSelect: false,
			yearStart:1900,
			yearEnd:2015,
			scrollInput:false
		});
	});

});

function resetForm($form) {
	$form.trigger('reset');
}

function resetView($popup) {
	$('.js-auth-form', $popup).show();
	$('.js-auth-message', $popup).addClass('display-none');

	resetForm($popup.find('form'));
}

function resetPoll() {
	$('.js-radio').attr('checked', false);
	$('.js-continue').attr('disabled','disabled').addClass('popup-system__btn--inactive');
}

function setProjectPopup(area, control) {
	control.ulejPopup({
		popupArea: area,
		beforeShow: function($control) {
			var $projectsContent = $('.js-system-content');

			$projectsContent.html($(preloderHTML).addClass('preloader-project-list'));

			$.ajax({
				type: "POST",
				url: '/get-projects-container',
				data: {
					client_id : $control.data('client'),
					type: $control.data('type')
				},
				dataType: 'json',
				success: function(data){
					if(data.status == 'success') {
						$projectsContent.html(data.content);
					} else {
						$.ulejMessages.showMessage('error', data.message);
					}
				}
			});
		}
	});
}

function prohibitionSelectionGifts(controll, area) {
	controll.ulejPopup({
		popupArea: area,
		beforeShow: function($control) {
			area.find('.js-info-messages').hide();
			area.find('.js-system-popup-content').hide();
			area.find('.js-info-prohibition-selection-gifts').show();
		}
	});
}

function previewProjectSelectionGifts(controll, area) {
	controll.ulejPopup({
		popupArea: area,
		beforeShow: function($control) {
			area.find('.js-info-messages').hide();
			area.find('.js-system-popup-content').hide();
			area.find('.js-info-preview-project-selection-gifts').show();
		}
	});
}

function setConfirmedEmail(controll, area) {
	controll.ulejPopup({
		popupArea: area,
		beforeShow: function($control) {
			var self = controll,
				confirmMsg = 'js-msg-confirmed-email',
				setMsg = 'js-msg-set-email',
				loginMsg = 'js-msg-login',
				msgArea = area.find('.js-info-confirmed-email');

			area.find('.js-info-messages').hide();
			area.find('.js-system-popup-content').hide();
			msgArea.show();

			if(self.hasClass(confirmMsg)) {
				msgArea.find('.' + setMsg).hide();
				msgArea.find('.' + loginMsg).hide();
				msgArea.find('.' + confirmMsg).show();
			} else if(self.hasClass(setMsg)) {
				msgArea.find('.' + confirmMsg).hide();
				msgArea.find('.' + loginMsg).hide();
				msgArea.find('.' + setMsg).show();
			} else if(self.hasClass(loginMsg)) {
				msgArea.find('.' + confirmMsg).hide();
				msgArea.find('.' + setMsg).hide();
				msgArea.find('.' + loginMsg).show();
			}
		}
	});
}

function setBioPopup(area, control) {
	control.ulejPopup({
		popupArea: area,
		beforeShow: function($control) {
			var $bioContent = $('.js-system-content');

			$bioContent.html($(preloderHTML).addClass('preloader-client-bio'));

			$.ajax({
				type: "POST",
				url: '/get-client-bio',
				data: {
					client_id : $control.data('client'),
					type: $control.data('type')
				},
				dataType: 'json',
				success: function(data){
					if(data.status == 'success') {
						$bioContent.html(data.content);
						var openConfirmedEmail = $bioContent.find('.js-open-confirmed-email');
						var openMessage = $bioContent.find('.js-open-message');
						if(openConfirmedEmail.length) {
							setConfirmedEmail(openConfirmedEmail, $('.js-info-popup'));
						} else {
							openMessage.on('click', openMessagePopup);
						}
						setProjectPopup($('.js-system-popup'), $('.js-open-projects'));
					} else {
						$.ulejMessages.showMessage('error', data.message);
					}
				}
			});
		}
	});
}

function getPreviousUrl(){
	var previousUrl = $('#js-previous-url').val();
	if(previousUrl.length == 0){
		return '/';
	} else {
		return previousUrl;
	}
}

function setPreviousUrl(url){
	$('.js-popup-change-url').attr('href', url);
	$('.js-previous-url').val(url);
}

function setVideoPopup(area, control) {
	control.ulejPopup({
		popupArea: area,
		beforeShow: function(control) {
			var blockName = control.data('show'),
				$displayBlock = area.find(blockName);
			area.find('.js-video-block').hide();
			$displayBlock.show().removeClass('display-none');
			if (blockName == '#view-video'){
				$displayBlock.find('iframe').prop('src', control.data('src') + '?rel=0&autoplay=1&enablejsapi=1');
			}

			$('#view-video h2.nb-heading--small.section__heading--small').html(control.data('video-name'));
		},
		afterClose: function() {
			var $displayBlock = area.find('.js-video-block:visible');

			if ($displayBlock.prop('id') == 'view-video') {
				toggleVideo('hide');
				$displayBlock.find('iframe').attr('src','');
			}
		}
	});
}

function setPasswordConfirmPopup(control, area) {
	control.ulejPopup({
		popupArea: area,
		beforeShow: function($control) {
			var email = $('#js-set-email').val();

			$('#js-new-email-input').val(email);
			$('#email_change').prop('action', '/change-email');

			$('.js-password-popup').addClass('change-email');
		},
		afterClose: function() {
			this.removeClass('change-email');
		}
	});
}

function openMessagePopup($control, isPlugin){
	var $messageContent = $('.js-system-content'), body = $('body'), systemPopup = body.find('.js-system-popup');

	if(!isPlugin) {
		$control = $(this);
	}

	$messageContent.html($(preloderHTML).addClass('preloader-message'));
	$data = {
		client_id : $control.data('client'),
		is_profile: $control.data('is-profile') || 0
	};

	$.ajax({
		type: "POST",
		url: '/get-message-container',
		data: $data,
		success: function(data){
			$messageContent.html(data);
			$messageContent.find('.js-send-message').on('click', sendMessage);
		},
		fail: function(){

		}
	});

	return false;
}

function sendMessage(){
	var toClientId = $(this).data('client'),
		messageText = $('.js-system-content').find('#js-message-text').val(),
		body = $('body'),
		systemPopup = body.find('.js-system-popup');

	if (messageText) {
		$.ajax({
			type: "POST",
			url: '/send-message',
			dataType: 'json',
			data: {
				to_client_id : toClientId,
				text: messageText
			},
			success: function(data){
				if (data.status == 'success') {
					systemPopup.removeClass('overlayer--show');
					body.removeClass('body--popup').scrollTop(Math.abs(parseInt(body.css('top'), 10))).css('top',0);
					$.ulejMessages.showMessage('success', data.message);
				} else {
					$.ulejMessages.showMessage('error', data.message);
				}
			},
			fail: function(){

			}
		});
	}
}

function setBackURL() {
	var data = {
		uri: window.location.pathname + window.location.search/* + window.location.hash*/
	};

	$.ajax({
		type: "POST",
		url: '/set-back-url',
		data: data,
		dataType: 'json',
		success: function (request) {
			if (request.status != 'ok') {
				window.location.href = '/error';
			}
		}
	});
}

/***
 number - исходное число
 decimals - количество знаков после разделителя
 dec_point - символ разделителя
 thousands_sep - разделитель тысячных
 ***/
function number_format(number, decimals, dec_point, thousands_sep) {
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function(n, prec) {
			var k = Math.pow(10, prec);
			return '' + (Math.round(n * k) / k)
				.toFixed(prec);
		};
	// Fix for IE parseFloat(0.55).toFixed(0) = 0;
	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
		.split('.');
	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}
	if ((s[1] || '')
			.length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1)
			.join('0');
	}
	return s.join(dec);
}

function index_format(text) {
	return text.replace(/[^A-Za-z0-9\- ]+/g, '');
}