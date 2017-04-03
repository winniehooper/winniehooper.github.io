$(function() {
	var iFrameContainer = $("#js-video-container");
	if(iFrameContainer.length) {
		var iFrameHtml = $('<iframe id="js-main-project-video" src="" width="630" height="354" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
		iFrameHtml.attr('src', iFrameContainer.data('video-url'));
		iFrameContainer.append(iFrameHtml);
	}

	var anyMessage = $('.js-alert-any-message');

	if(anyMessage.length) {
		setTimeout(function() {
			anyMessage.filter(':visible').fadeOut();
		}, 10000)
	}



	$.ajaxSetup({
		data: {
			"_token": $('meta[name=csrf-token]').attr('content')
		}
	});

	setMask();

	var $lang = $('.js-lang');
	if ($lang.length) {
		function changeLanguage(lang) {
			$('.js-lang-section').hide();
			$('.js-lang-' + lang).show();
		}

		changeLanguage($('.js-lang.language-link--is-active').data('lang'));

		$lang.on('click', function(){
			var lng = $(this).data('lang');
			changeLanguage(lng);
			$lang.removeClass('language-link--is-active');
			$(this).addClass('language-link--is-active');
		});
	}

	/*Google Analytics*/
	var createProjectLink = $('.precreate__btn--more');
	var createProjectLink2 = $('.js-crate-proj');
	var registrationLink = $('#js-submit-registration');
	var registrationFbLink = $('.social-link--fb');
	var registrationVkLink = $('.social-link--vk');
	var registrationOkLink = $('.social-link--ok');
	var registrationGpLink = $('.social-link--gp');
	var sponsorInProjectLink = $('.project__aside__btn');
	var loginAndPayLink = $('.js-login-and-pay');
	var payLink = $('.js-pay-link');
	var feedbackSendButton = $('#js-ask-questions');
	var shareVkLink = $('.js-share-vk');
	var shareOkLink = $('.js-share-ok');
	var shareFbLink = $('.js-share-fb');
	var shareTwLink = $('.js-share-tw');
	var shareGpLink = $('.js-share-gp');
	var registrationAndPayLink = $('.js-registration-pay');
	var projectSocialLinksWrapper = $('.project__body__social');

	createProjectLink.click(function() {
		ga('send', 'event', 'create_new_project', 'click_new_project');
	});

	createProjectLink2.click(function() {
		ga('send', 'event', 'create_new_project', 'click_new_project');
	});

	registrationLink.click(function() {
		ga('send', 'event', 'registration', 'click_registration');
	});

	registrationFbLink.click(function() {
		ga('send', 'event', 'Signup', 'Facebook');
	});

	registrationVkLink.click(function() {
		ga('send', 'event', 'Signup', 'VKontakte');
	});

	registrationOkLink.click(function() {
		ga('send', 'event', 'Signup', 'Odnoklassniki');
	});

	registrationGpLink.click(function() {
		ga('send', 'event', 'Signup', 'Google');
	});

	sponsorInProjectLink.click(function() {
		ga('send', 'event', 'maintain', 'click_maintain');
	});

	loginAndPayLink.click(function() {
		ga('send', 'event', 'login_and_pay', 'click_login_and_pay');
	});

	payLink.click(function() {
		ga('send', 'event', 'pay', 'click_pay');
	});

	feedbackSendButton.click(function() {
		ga('send', 'event', 'feedback', 'click_ send_message');
	});

	shareVkLink.click(function() {
		ga('send', 'event', 'share', 'click_share_vk');
	});

	shareOkLink.click(function() {
		ga('send', 'event', 'share', 'click_share_ok');
	});

	shareFbLink.click(function() {
		ga('send', 'event', 'share', 'click_share_fb');
	});

	shareTwLink.click(function() {
		ga('send', 'event', 'share', 'click_share_tw');
	});

	shareGpLink.click(function() {
		ga('send', 'event', 'share', 'click_share_google');
	});

	registrationAndPayLink.click(function() {
		ga('send', 'event', 'regist_and_pay', 'click_regist_and_pay');
	});

	if(projectSocialLinksWrapper.length){
		$('a[class*="js-share-"]').on('click', function(e){
			var net =  e.currentTarget.className.match(/js-share-([^\.]+)/);
			if(!net || net.length!=2)
				return true;
			var socialShort = net[1];

			var names = {'vk':'VKontakte', 'fb':'Facebook',
				'tw': 'Twitter', 'ok': 'Odnoklasniki'};
			if(!names.hasOwnProperty(socialShort))
				return true;
			ga('send', 'social', names[socialShort], 'share', window.location.href );
			return true;
		});
	}
	///////

	var asideNavList = $('.aside-nav-list');
	if(asideNavList.length) {
		var lastId,
			nav = $(".js-sticky"),
			navHeight = nav.outerHeight() + 15,
			menuLinks = nav.find(".js-aside-nav-link"),
			scrollItems = menuLinks.map(function() {
				var item = $($(this).attr("href"));
				if(item.length) {
					return item;
				}
			});

		menuLinks.click(function(e) {
			var href = $(this).attr("href"),
				offsetTop = href === "#" ? 0 : $(href).offset().top - navHeight + 1;
			$('html, body').stop().animate({
				scrollTop: offsetTop
			}, 300);
			// history.pushState(null, null, href);
			e.preventDefault();
		});

		$(window).scroll(function() {
			var fromTop = $(this).scrollTop() + navHeight;

			var cur = scrollItems.map(function() {
				if($(this).offset().top < fromTop)
					return this;
			});
			cur = cur[cur.length - 1];
			var id = cur && cur.length ? cur[0].id : "";

			if(lastId !== id) {
				lastId = id;
				history.pushState(null, null, '#' + id);
				menuLinks
					.closest('.js-aside-nav').removeClass("aside-nav-item--active")
					.end().filter("[href=#" + id + "]").closest('.js-aside-nav').addClass("aside-nav-item--active");
			}
		});

		if(!Modernizr.csspositionsticky) {
			$('.js-sticky').Stickyfill();
		}
	}

	/*Валидация страницы создания и редактирования проекта*/
	$("#js-edit-project-form").validate({
		onkeyup: function(element) {
			var $element = $(element);
			$(this.currentForm).data('processingElement', $element);
			$element.valid()
		},
		onfocusin: function(element) {
			var $element = $(element);
			var type = $element.attr('type');

			if(type != 'text' && !$element.is('textarea')) {
				$(this.currentForm).data('processingElement', $element);
				$element.valid()
			}
		},
		onfocusout: function(element) {
			var $element = $(element);
			$(this.currentForm).data('processingElement', $element);
			$element.valid()
		},
		onclick: function(element) {
			var $element = $(element);
			var type = $element.attr('type');

			if(type != 'text' && !$element.is('textarea')) {
				$(this.currentForm).data('processingElement', $element);
				$element.valid()
			}
		},

		errorClass: 'nb-input--invalid',

		highlight: function(element, errorClass) {
			var $form = $("#js-edit-project-form");
			var $element = $(element);

			if($form.data('processingElement') && $form.data('processingElement').attr('name') == $element.attr('name')) {
				$element.parent().addClass(errorClass);

				$element.closest("section .nb-create.project-edit-form").removeClass('nb-create--valid');
				$element.closest("section .nb-section.project-edit-form").removeClass('nb-create--valid');

				setValidSection();
			}

		},

		unhighlight: function(element, errorClass) {
			var $element = $(element);
			var formSection = $element.closest("section .nb-create.project-edit-form");
			var invalidSelect = formSection.find("select." + errorClass);
			var invalidDiv = formSection.find("div." + errorClass);
			var inputs = formSection.find('input[type=text]');
			var inputsFiled = true;

			if(inputs.length) {
				var totalFill = 0;

				inputsFiled = false;

				$.each(inputs, function() {
					var input = $(this);

					if(input.val()) {
						totalFill++;
					} else {
						totalFill--;
					}
				});

				if(inputs.length == totalFill) {
					inputsFiled = true;
				}
			}

			$element.parent().removeClass(errorClass);

			if(invalidSelect.length == 0 && invalidDiv.length == 0 && invalidSelect.length == 0 && inputsFiled) {
				$element.closest("section .nb-create.project-edit-form").addClass('nb-create--valid');
				$element.closest("section .nb-section.project-edit-form").addClass('nb-create--valid');
			}

			setValidSection();
		},

		errorPlacement: function(error, element) {
			return true;
		},

		ignore: [],

		rules: {
			"project[name]": {
				required: true,
				maxlength: 60
			},
			"project[category_id]": {
				required: true
			},
			"project[image]": {
				required: true
			},
			"project[needed_sum]": {
				required: true
			},
			"project[description_short]": {
				required: true,
				rangelength: [0, 160]
			},
			"project[location]": {
				required: true
			},
			"project[days_count]": {
				required: true,
				rangelength: [1, 3],
				range: [1, 180],
				number: true
			},

			"all-gifts-count": {
				required: true
			},

			"project[description_full]": {
				required: true
			},

			"user[last_name]": {
				required: true
			},
			"user[first_name]": {
				required: true
			},
			"user[patronymic]": {
				required: true
			},
			"user[dt_birth]": {
				required: true
			},
			"user[doc_series]": {
				required: true
			},
			"user[personal_num]": {
				required: true
			},
			"user[type_doc_id]": {
				required: true
			},
			"user[doc_who_issued]": {
				required: true
			},
			"user[registration]": {
				required: true
			},
			"user[phone]": {
				required: true
			},
			"user[email]": {
				required: true,
				full_email: true
			}
		}
	});

    var editActiveProjectForm = $("#js-edit-active-project-form,#js-edit-project-form");
    editActiveProjectForm.keypress(function (event) {
        if (event.which == '13' && event.target.tagName == 'INPUT') {
            event.preventDefault();
        }
    });

    /*Валидация страницы создания и редактирования проекта*/
    editActiveProjectForm.validate({
		onkeyup: function(element, empty, event) {
			var $element = $(element);
			$(this.currentForm).data('processingElement', $element);
			$element.valid()
		},
		onfocusin: function(element) {
			var $element = $(element);
			var type = $element.attr('type');

			if(type != 'text' && !$element.is('textarea')) {
				$(this.currentForm).data('processingElement', $element);
				$element.valid()
			}
		},
		onfocusout: function(element) {
			var $element = $(element);
			$(this.currentForm).data('processingElement', $element);
			$element.valid()
		},
		onclick: function(element) {
			var $element = $(element);
			var type = $element.attr('type');

			if(type != 'text' && !$element.is('textarea')) {
				$(this.currentForm).data('processingElement', $element);
				$element.valid()
			}
		},

		errorClass: 'nb-input--invalid',

		highlight: function(element, errorClass) {
			var $form = $("#js-edit-active-project-form");
			var $element = $(element);

			if($form.data('processingElement') && $form.data('processingElement').attr('name') == $element.attr('name')) {
				$element.parent().addClass(errorClass);

				$element.closest("section .nb-create.project-edit-form").removeClass('nb-create--valid');
				$element.closest("section .nb-section.project-edit-form").removeClass('nb-create--valid');

				setValidSection();
			}

		},

		unhighlight: function(element, errorClass) {
			var $element = $(element);
			var formSection = $element.closest("section .nb-create.project-edit-form");
			var invalidSelect = formSection.find("select." + errorClass);
			var invalidDiv = formSection.find("div." + errorClass);
			var inputs = formSection.find('input[type=text]');
			var inputsFiled = true;

			if(inputs.length) {
				var totalFill = 0;

				inputsFiled = false;

				$.each(inputs, function() {
					var input = $(this);

					if(input.val()) {
						totalFill++;
					} else {
						totalFill--;
					}
				});

				if(inputs.length == totalFill) {
					inputsFiled = true;
				}
			}

			$element.parent().removeClass(errorClass);

			if(invalidSelect.length == 0 && invalidDiv.length == 0 && invalidSelect.length == 0 && inputsFiled) {
				$element.closest("section .nb-create.project-edit-form").addClass('nb-create--valid');
				$element.closest("section .nb-section.project-edit-form").addClass('nb-create--valid');
			}

			setValidSection(true);
		},

		errorPlacement: function(error, element) {
			return true;
		},

		ignore: [],

		rules: {
			"project[name]": {
				required: true,
				maxlength: 60
			},
			"project[description_short]": {
				required: true,
				rangelength: [0, 160]
			},
			"project[category_id]": {
				required: true
			},
			"project[location]": {
				required: true
			},
			"project[image]": {
				required: true
			},
			"all-gifts-count": {
				required: true
			},
			"project[description_full]": {
				required: true
			}
		}
	});

	var editProjectForm = $("#js-edit-project-form, #js-edit-active-project-form");
	var allGiftCounts = $("#js-hidden-input-gifts-count").val();
	if(editProjectForm.length && editProjectForm.valid() && Number(allGiftCounts) > 0) {
		$(".js-create-nav-btn").removeClass("create__nav__btn-more--inactive");
	}

	$(".js-default-select-value").click(function() {
		var parentElement = $(this).parent().parent();
		parentElement.siblings('select.js-ajax-project-update-info').addClass("nb-input--invalid");
		parentElement.closest("section .nb-create").removeClass('nb-create--valid');
	});

	$(".js-true-select-value").click(function() {
		var parentElement = $(this).parent().parent();
		var formSection = $(this).closest(".nb-create");
		formSection.find('select.js-ajax-project-update-info').removeClass("nb-input--invalid");
		parentElement.closest("section .nb-create").addClass('nb-create--valid');
	});

	$(".js-true-select-in-many-input-block").click(function() {
		var parentElement = $(this).parent().parent();
		var formSection = $(this).closest(".nb-create");
		formSection.find('select.js-ajax-client-update-info').removeClass("nb-input--invalid");
		if($("#js-type-docs-client-info").parent('.nb-input--invalid').length == 0) {
			parentElement.closest("section .nb-section").addClass('nb-create--valid');
		}
	});

	$(".js-default-select-in-many-input-block").click(function() {
		var parentElement = $(this).parent().parent();
		parentElement.siblings('select.js-ajax-client-update-info').addClass("nb-input--invalid");
		parentElement.closest("section .nb-create").removeClass('nb-create--valid');
	});

	$("#js-dd-time-proj").keyup(function() {
		if($(this).val() > 180 || $(this).val() < 1) {
			$(this).parent().addClass('nb-input--invalid');
		} else {
			$(this).parent().removeClass('nb-input--invalid');
		}
	});
	/////////

	/* Алгоритм для исправной работы якорей в FireFox */
	var hash = document.location.hash;
	if(hash) {
		setTimeout(function() {
			var anchor = $('a[name=' + hash.replace('#', '') + ']');

			if(anchor.length) {
				anchor.closest("details.part-faq").find("summary.faq-category").trigger('click');
				anchor.parent().trigger('click');
			}

			if($.browser.mozilla
				|| window.location.pathname == '/faq'
				|| window.location.pathname == '/settings'
			) {
				window.location.href = hash;
			}
		}, 0);
	}

	var loginImitationClick = $('.loginImitationClick');
	if(loginImitationClick.length) {
		setTimeout(function() {
			loginImitationClick.find('#js-submit-login').trigger('click');
		}, 0);
	}
	////

	/*Поисковой функционал*/
	(function() {
		var $searchField = $('.js-search-field'),
			$emptyBlock = $('.popup__body--empty'),
			$projectBlock = $('.popup__body--search'),
			xhrSearchRequest;

		if(!$searchField.length) return;

		$searchField.on('keyup', function() {
			if(xhrSearchRequest) xhrSearchRequest.abort();
			var searchText = $(this).val();
			if(searchText.length > 2) {
				/* GA search tracking */
				if(typeof( window.gaTimerId ) !== "undefined"){
					window.clearTimeout(window.gaTimerId);
				}
				window.gaTimerId = window.setTimeout(function(){
					ga('send',
						'pageview',
						'/ga/search?q='+encodeURIComponent(searchText)
					);
				}, 5000);
				/* End GA search tracking */

				$emptyBlock.addClass('display-none');
				$projectBlock.removeClass('display-none');
				$emptyBlock.hide();
				$projectBlock.show();
				$projectBlock.find('.popup__search-res').html(preloderHTML);
				xhrSearchRequest = $.ajax({
					type: "POST",
					url: '/ajax-search',
					data: {search_text: searchText},
					success: function(data) {
						if(data) {
							$projectBlock.removeClass('display-none');
							$projectBlock.show();
							$projectBlock.find('.popup__search-res').html(data);
						} else {
							$projectBlock.addClass('display-none');
							$emptyBlock.removeClass('display-none');
							$projectBlock.hide();
							$emptyBlock.show();
						}
					},
					fail: function() {
						$projectBlock.addClass('display-none');
						$emptyBlock.removeClass('display-none');
						$projectBlock.hide();
						$emptyBlock.show();
					}
				});
			} else {
				$emptyBlock.hide();
				$projectBlock.hide();
			}
		})
	})();
	////////

	/*Расчет финальной суммы*/
	var createProjectFieldSum = $("#js-project-money");

	if(createProjectFieldSum.length) {
		createProjectFieldSum.keyup(function(eventObject) {
			var TAX_BENEFIT = 4947;
			var sum = $(this).val().replace(/\s+/g, '');
			var commission = Math.round(sum / 100 * 10);
			var incomeTax = (sum > TAX_BENEFIT )
				? Math.round((sum - TAX_BENEFIT) / 100 * 13)
				: 0;
			var finalSum = sum - commission - incomeTax;

			$(".nb-create-fund__commission .nb-create-fund__value").text(number_format(commission, 0, '', ' ') + " руб.");
			$(".nb-create-fund__income-tax .nb-create-fund__value").text(number_format(incomeTax, 0, '', ' ') + " руб.");
			$(".js-create-final-sum").text(number_format(finalSum, 0, '', ' '));
		});

		if(createProjectFieldSum.val() != '') {
			createProjectFieldSum.trigger('keyup');
		}
	}
	/////////

	function getParameterByNameFromUrl(name, url) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
			results = regex.exec(url);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}
	function getParameterByNameFromUpdateProjectUrl(url) {
		var regex = new RegExp("#([^&]*)"),
			results = regex.exec(url);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}

	function surfAjaxTabsHistory(ajaxTabs, loadedUrl, isUpdateProject) {
		$(window).on('popstate', function(event) {
			var state = event.originalEvent.state,
				url = '',
				tab = '';
			if (state) {
				url = state.url ? state.url : state.path;
			} else {
				url = loadedUrl;
			}

			if(!state.elemType) {
				if(!isUpdateProject) {
					tab = getParameterByNameFromUrl('tab', url);
				} else {
					tab = getParameterByNameFromUpdateProjectUrl(url);
				}

				if (tab) {
					ajaxTabs.each(function(){
						if ($(this).prop('rel') == ('#'+tab) ) {
							$(this).data('isHistoryElement', true);
							$(this).trigger('click').focus().blur();
						}
					});
				} else {
					ajaxTabs.first().data('isHistoryElement', true);
					ajaxTabs.first().trigger('click').focus().blur();
				}
			}
		});
	}

	/*Переключение блоков на странице профиля*/
	var clientProfileTabs = $('.user__body__nav a');
	if(clientProfileTabs.length) {
		var loadedUrl = window.location.href;
		clientProfileTabs.ulejAjaxTabs({
			'content': '#client-tab-content',
			'additionalParams': {'clientId': parseInt($('#profileClientId').val())},
			'preloader': preloderHTML,
			'selectClass': 'nb-nav-underlined__link--active',
			'funcAfterAjax': function() {
				changeBeforeOpenUrl();
				setBackURL();
				setVideoPopup($('.js-add-video-popup'), $('.js-open-video'));
			}
		});

		surfAjaxTabsHistory(clientProfileTabs, loadedUrl);
	}
	/////////

	/*Переключение блоков на странице настроек профиля*/
	var clientSettingsTabs = $(".settings__nav a");
	if(clientSettingsTabs.length) {
		var loadedUrl = window.location.href;
		clientSettingsTabs.ulejAjaxTabs({
			'content': '#settings-content',
			'preloader': preloderHTML,
			'selectClass': 'nb-nav-underlined__link--active',
			'funcAfterAjax': function() {
				var passwordOpen = $('.js-open-password');
				var selectTab = $('.nb-nav-underlined__link--active');
				var selectTabId = selectTab.attr('id');

				changeBeforeOpenUrl();
				setBackURL();
				addAvatar();
				connectSocials();
				setNotifications();

				if(selectTabId == 'profile_control') {
					setValidation('client_form');
					setValidation('js-add-website-form');
				} else if(selectTabId == 'access_control') {
					setValidation('setting_new_email');
					setValidation('js-password-change');
					setValidation('login-and-pass');
				}

				if($(".settings__nav a.nb-nav-underlined__link--active").prop('id') == 'access_control') {
					$('.new-project__link--remove').show();
				} else {
					$('.new-project__link--remove').hide();
				}
			}
		});

		surfAjaxTabsHistory(clientSettingsTabs, loadedUrl);
	}
	////////

	/*Переключение блоков на странице проекта*/
	var projectTabs = $('.project-info-tab-links a');
	if(projectTabs.length) {
		var loadedUrl = window.location.href;
		projectTabs.ulejAjaxTabs({
			'content': '#project-info-block',
			'preloader': preloderHTML,
			'funcClick': function() {
				$('.nav-underlined__item').removeClass('active');
				$(this).closest('.nav-underlined__item').addClass('active');
			},
			'funcAfterAjax': function() {
				changeBeforeOpenUrl();
				setBackURL();
				setBioPopup($('.js-system-popup'), $('.js-open-bio'));
				setConfirmedEmail($('.js-open-confirmed-email'), $('.js-info-popup'));
				prohibitionSelectionGifts($('.js-open-prohibition-selection-gifts'), $('.js-info-popup'));
				previewProjectSelectionGifts($('.js-open-preview-project-selection-gifts'), $('.js-info-popup'));
			}
		});

		surfAjaxTabsHistory(projectTabs, loadedUrl);
	}
	////////

	var editProjectContainer = $('.edit-project-page-content');
	var editProjectTabs = editProjectContainer.find('.nb-create__nav-item a');

	if(editProjectContainer) {
		$.each(editProjectTabs, function() {
			$tab = $(this);
			$tab.data('controlURL', window.location.protocol + '//' + window.location.hostname + window.location.pathname + window.location.search + $tab.attr('href'));
		});

		$(".edit-project-page-content").tabs({
			activate: function(event, ui) {
				var link = ui.newTab.find('a');
				var url = link.data('controlURL');

				if(url && !link.data('isHistoryElement')) {
					window.history.pushState({ url :  url}, null, url);
				} else {
					link.data('isHistoryElement', false);
				}

				changeBeforeOpenUrl();
				setBackURL();
			}
		});

		var loadedUrl = window.location.href;
		surfAjaxTabsHistory(editProjectTabs, loadedUrl, true);
	}
	////////

	/*Оставшееся колличество символов для ввода, в блоке краткое описание*/
	var textareaElement = $("#js-description-text");
	var maxLength = 160;
	var updateShortDescrField = false;

	if(textareaElement.length) {
		var textareaValue = textareaElement.val();

		if(textareaElement.length > 0) {
			$(".js-description-entered").text(Number(textareaElement.val().length));
		}

		textareaElement.on('keyup', function() {
			var $this = $(this);
			var spanElement = $(".js-description-entered");
			var currentCountSetSymbols = Number(textareaElement.val().length);
			var symbolsCount = 0;
			updateShortDescrField = true;

			if(currentCountSetSymbols <= maxLength) {
				symbolsCount = currentCountSetSymbols;
			} else {
				symbolsCount = maxLength;
			}

			$this.val($this.val().substr(0, maxLength));
			spanElement.text(symbolsCount);
		});

		textareaElement.on('blur', function() {
			if(updateShortDescrField) {
				updateProjectData($(this));
			}
		});
	}

	var projectMoney = $('#js-project-money');
	var projectMoneyValue = '';
	var updateMoneyField = false;

	if(projectMoney.length) {

		projectMoney.on('keyup', function() {
			updateMoneyField = true;
			if(projectMoney.val() != '') {
				projectMoney.val(number_format(projectMoney.val(), 0, '', ' '));
			}
		});

		projectMoney.on('blur', function() {
			if(updateMoneyField) {
				updateMoneyField = false;
				updateProjectData($(this));
			}
		});

		if(projectMoney.val() != '') {
			projectMoney.trigger('keyup');
		}

		projectMoneyValue = projectMoney.val();
	}

	$(".new-project__inner input.js-ajax-project-update-info, .new-project__inner select.js-ajax-project-update-info, .new-project__inner textarea.js-ajax-project-update-info").on('change', function() {
			updateProjectData($(this));
	});

	function updateProjectData($this) {
		var $thisField = $this,
			templateId = getUpdateProjectTemplateId(),
			params = {
				"fieldName": $thisField.attr('param'),
				"fieldValue": $thisField.val(),
				"projectId": $("#js-project-id").val()
			};

		if($thisField.attr('id') == 'js-project-money' && params.fieldValue != '') {
			params.fieldValue = number_format(params.fieldValue, 0, '', ' ');
		}

		if(templateId) {
			params.templateId = templateId;
		}

		updateProjectInfo(params);
	}

	var editorProjectData = $('#editor');

	if(editorProjectData.length) {

		editorProjectData.redactor({
			lang: 'ru',
			imagePosition: false,
			convertImageLinks: false,
			pastePlainText: true,
			buttons: ['bold', 'italic', 'heading3', 'link', 'orderedlist', 'unorderedlist', 'image', 'video', 'iframe'],
			imageUpload: '/upload-image-about-project',
			plugins: ['image', 'video', 'heading3', 'iframe'],
			minHeight: 480,
			focus: true,
			allowedTags: ['p', 'h3', 'video', 'iframe', 'div', 'ul', 'ol', 'strong', 'em', 'a', 'img', 'li', 'br'],
			blurCallback: function(e) {
				var templateId = getUpdateProjectTemplateId(),
					fieldValue = this.code.get();

				if(editorText != fieldValue) {
					editorText = fieldValue;

					if(editorText.length > 0) {
						$('.detailed-information section.create--full-description').addClass('nb-create--valid');
					} else {
						$('.detailed-information section.create--full-description').removeClass('nb-create--valid');
					}

					var params = {
						"fieldName": 'description_full',
						"fieldValue": fieldValue,
						"projectId": $("#js-project-id").val()
					};

					if(templateId) {
						params.templateId = templateId;
					}

					setValidSection();
					updateProjectInfo(params);
				}
			}
		});

		var editorText = editorProjectData.redactor('code.get');
	}

	$(".js-save-project-info, .js-save-project-info-and-preview").click(function() {
		var $this = $(this);
		var projectId = $("#js-project-id").val();
		var form = $this.closest('form');
		var formId = form.attr('id');
		var formData = getFormData(form);

		formData['project[description_short]'] = $('#js-description-text').val();
		if ($this.hasClass('js-save-project-info-and-preview')) {
			formData['project_preview'] = true;
		}

		var url = '';
		if(formId == 'js-edit-project-form') {
			url = '/save-project-info';
		} else {
			url = '/save-active-project-info';
		}

		$.ajax({
			type: "POST",
			url: url,
			data: formData,
			dataType: 'json',
			success: function(response) {
				if(response.status_message == 'error') {
					$.ulejMessages.showMessage('error', response.message);
				} else {
					$.ulejMessages.showMessage('success');
					$(".js-date-temp-version").text('сегодня в ' + response.date);
					if (response.redirect_url) {
						setTimeout(function(){window.location.href = response.redirect_url;}, 2000);
					}
				}
			},
			error: function() {
				showAlert('error');
			}
		});
	});
	////////

	/*Ajax обновление информации о клиенте*/
	$(".create--personal input.js-ajax-client-update-info, .create--personal select.js-ajax-client-update-info, .create--personal textarea.js-ajax-client-update-info").on('change', function() {
		var thisField = $(this);
		$.ajax({
			type: "POST",
			url: "/save-client-field",
			responseType: "json",
			data: {"fieldName": thisField.attr("param"), "fieldValue": thisField.val(), "clientId": $("#js-client-id").val()},
			success: function(response) {
				var responseData = response;
				if(responseData.status_message == 'error') {
					$.ulejMessages.showMessage('error');
				} else {
					validateEditProjectForm();
					$.ulejMessages.showMessage('success');

					$(".js-date-temp-version").text('сегодня в ' + responseData.date);
				}
			},
			error: function() {
				$.ulejMessages.showMessage('error');
			}
		});
	});
	////////

	/*Загрузка картинки к проекту на сервер*/
	var uploadImageButton = $('.btn.btn--small.btn--add-media.js-btn-add-media');
	if(uploadImageButton.length) {
		var status = $('#status-upload-image');
		new AjaxUpload(uploadImageButton, {
			action: '/upload-image?type=project',
			responseType: 'json',
			name: 'uploadfile',
			onSubmit: function(file, ext) {
				if(!(ext && /^(jpg|gif|bmp|png|jpeg|jpeg2000|jpe)$/.test(ext))) {
					$('.nb-create__media__img').remove();
					$('.image-for-project').remove();
					$(".nb-create__media__img-wrap_project_image").append('<img src="/img/create_img_bg.jpg" width="630" height="354" alt="placeholder image" class="nb-create__media__img">');
					status.css('left', '10px');
					status.text('Неверный формат файла.');
					return false;
				} else {
					$(".nb-create__media__img-wrap_project_image").html($(preloderHTML).addClass('preloader-project-img'));
				}
			},
			onComplete: function(file, response) {
				var responseData = response;
				status.text('');
				if(responseData.status_message === "success") {
					var templateId = getUpdateProjectTemplateId();
					var params = {
						"fieldName": 'image',
						"fieldValue": responseData.file_name,
						"projectId": $("#js-project-id").val()
					};

					if(templateId) {
						params.templateId = templateId;
					}

					$('.nb-create__media__img').remove();
					$('.nb-card__preview img').remove();
					$('.image-for-project').remove();
					$('.nb-create__media__caption__txt--img').css("display", "none");
					$('.nb-create__media__img-wrap').removeClass('nb-create__media__img-wrap');
					$('.preloader-project-img').remove();
					$('.nb-create__media__img-wrap_project_image').append('<img class="image-for-project" src="/' + responseData.file_path_promo + responseData.file_name + '" alt="" />');
					uploadImageButton.text('Изменить обложку');
					$('.nb-card__preview').append('<img src="/' + responseData.file_path_small + responseData.file_name + '" width="300" height="169" class="nb-card__img"  />');
					$('#js-image-link-hidden').val(responseData.file_name);

					updateProjectInfo(params);
					validateEditProjectForm();
					$('.nb-create.create--media.project-edit-form.nb-create--valid').addClass('nb-create--valid');
					return false;
				} else {

					$('.preloader-project-img').remove();
					$(".nb-create__media__img-wrap_project_image").append('<img src="/img/create_img_bg.jpg" width="630" height="354" alt="placeholder image" class="nb-create__media__img">');
					$('.nb-create.create--media.project-edit-form.nb-create--valid').removeClass('nb-create--valid');

					status.text(responseData.error_message);
				}
			}
		});
	}
	/////////

	/// закрытие окна при добавлении видео
	$(document).on('click', '.js-close-video', function(){
		var $popup = $(this).closest('.popup__block');
		$('.js-close-popup', $popup).click();
	});

	var videoUploadAjax;
	/*Загрузка превью к видео с youtube и vimeo*/
	$(".add-video-preview").click(function(){
		var videoLink = $("#js-youtube-upload").val();
		if (!videoLink) return false;

		if(typeof videoUploadAjax != 'undefined') {
			videoUploadAjax.abort();
		}

		videoUploadAjax = $.ajax({
			url: '/upload-video-preview',
			type: 'POST',
			data: { videoLink: videoLink } ,
			dataType: 'json',
			success: function (response) {
				if(!response.error) {
					var $currentBlock = $('#add-video');
					$(".popup-video__field-wrap.js-video-player", $currentBlock).append('<iframe  width="700" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen src="' + response.video + '"></iframe><button class="nb-btn nb-btn--add-media popup-system__btn js-add-video js-close-video">Вставить видео</button>');
					$(".js-add-video.add-video-preview", $currentBlock).remove();
					$(".nb-input-label.popup-video__input-label", $currentBlock).remove();
					$(".popup-video__section__body .popup-video__field--right", $currentBlock).append('<button class="nb-btn nb-btn--add-media popup-system__btn reload-video-preview js-reload-video">Обновить</button>');
					$("#js-youtube-upload", $currentBlock).val('');

					$(".js-video-button").text('Изменить видео');
					loadVideoPreview(response);
					$(".reload-video-preview").click(function(){
						var videoLink = $("#js-youtube-upload").val();
						$.ajax({
							url: '/upload-video-preview',
							type: 'POST',
							data: { videoLink: videoLink } ,
							dataType: 'json',
							success: function (response) {
								if(!response.error) {
									var $currentBlock = $('#add-video');
									$(".popup-video__field-wrap.js-video-player iframe", $currentBlock).remove();
									$(".popup-video__field-wrap.js-video-player button", $currentBlock).remove();
									$(".popup-video__field-wrap.js-video-player", $currentBlock).append('<iframe  width="700" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen src="' + response.video + '"></iframe><button class="nb-btn nb-btn--add-media popup-system__btn js-add-video js-close-video">Вставить видео</button>');
									$("#js-youtube-upload", $currentBlock).val('');
									loadVideoPreview(response);
								} else {
									showAlert('error', response.error);
								}
							},
							error: function(){

							}
						});
					});
				} else {
					showAlert('error', response.error);
				}
			},
			error: function(){

			}
		});
	});
	/////////


	var cloneIframe = $("#js-main-project-video").clone();

	/*Автовоспроизведение видео на странице проекта*/
	$('.js-video-play').on('click', function(ev) {
		var container = $('#js-video-container');
		container.find('iframe').remove();
		container.append(cloneIframe);

		$("#js-main-project-video")[0].src += "&autoplay=1";
		ev.preventDefault();
	});

	var projectPageVideoBlock = document.getElementById("js-video-container");
	toggleVideo('hide', projectPageVideoBlock);
	//$("#js-video-container").find('iframe').attr('src','');
	///////

	/*Профиль: Загрузка аватарки*/
	function addAvatar() {
		var $addAvatarBtn = $('.js-add-avatar'),
			$placement = $('.js-avatar-container'),
			$placementHeader = $('.head__user__avatar-cut'),
			defaultContent = $placement.html();
		if(!$addAvatarBtn.length) return;

		new AjaxUpload($addAvatarBtn, {
			action: '/upload-image?type=avatar',
			responseType: 'json',
			name: 'uploadfile',
			onSubmit: function(file, ext) {
				if(!(ext && /^(jpg|gif|bmp|png|jpeg|jpeg2000|jpe)$/.test(ext))) {
					showAlert('avatar');
					return false;
				} else {
					defaultContent = $placement.html();
					$placement.html($(preloderHTML).addClass('preloader-avatar'));
				}
			},
			onComplete: function(file, response) {
				if(!response) {
					$placement.html(defaultContent);
					showAlert('error');
					return;
				}
				var responseData = response;
				if(responseData.status_message == "success") {
					$placement.html('<img width="160" src="' + responseData.file_path_promo + responseData.file_name + '" alt="avatar" />');
					$placementHeader.html('<img width="40" height="40" src="' + responseData.file_path_small + responseData.file_name + '" alt="avatar" />');
					showAlert('success');
				} else {
					$placement.html(defaultContent);
					showAlert('error');
				}
			}
		});
	}

	/*Настройка соц сетей*/
	function connectSocials() {
		var $socialLinks = $('.js-social-link');
		if(!$socialLinks.length) return;

		$socialLinks.on('click', function() {
			var $t = $(this),
				socialId = $t.data('id'),
				socialName = $t.data('name');

			if(!$t.hasClass('js-social-link')) return true;

			if(socialId) {
				$.ajax({
					type: "POST",
					url: '/remove-social',
					data: {
						social_name: socialName,
						social_id: socialId
					},
					dataType: 'json',
					success: function(data) {
						if(data.status == 'success') {
							$t.find('.social-link__status--connected').remove();
							$t.find('.social-link__status--disconnected').remove();
							$t.append('<span class="social-link__status">Подключить</span>');
							$t.addClass('social-link--disconnected');
							$t.removeClass('js-social-link');

							$.ulejMessages.showMessage('success');
						} else {
							$.ulejMessages.showMessage('error', data.message);
						}
					},
					fail: function() {
						$.ulejMessages.showMessage('error');
					}
				});

				return false;
			}

			return true;
		});
	}

	/////////

	/*Настройка уведомлений*/
	function setNotifications() {
		var $notifyCheckboxes = $('.js-check-notify');
		if(!$notifyCheckboxes.length) return;

		$notifyCheckboxes.on('change', function() {
			var $t = $(this),
				notifyName = $t.prop('name'),
				val = ($t.is(':checked')) ? 1 : 0;

			$.ajax({
				type: "POST",
				url: '/set-notifications',
				data: {
					notify_name: notifyName,
					value: val
				},
				dataType: 'json',
				success: function(request) {
					if(request.status == 'success') {
						$.ulejMessages.showMessage('success');
					} else {
						$.ulejMessages.showMessage('error', request.message);
					}
				},
				fail: function() {
					showAlert('error');
				}
			});
		});

	}

	addAvatar();
	connectSocials();
	setNotifications();

	/* notification pagination */
	(function() {
		var $moreNotificationsBtn = $('.js-more-notifications'),
			$notificationsBody = $('.notifications__body'),
			step = 1;
		if(!$moreNotificationsBtn.length) return;

		$moreNotificationsBtn.on('click', function() {
			var $preloader = $notificationsBody.append(preloderHTML).find('.preloader');
			$preloader.css('margin-top', 20);
			$preloader.css('min-height', 0);
			$.ajax({
				type: "POST",
				url: '/more-notifications',
				data: {step: step},
				dataType: 'json',
				success: function(request) {
					if(request.status == 'ok') {
						if(request.allNotificationsCnt <= (step * 10 + 10)) {
							$moreNotificationsBtn.hide();
						}
						$preloader.remove();
						$notificationsBody.append(request.content);
						step++;
					}
				}
			});
		});
	})();
	//////

	/* form-pay-step1 */
	var savePayTimeOut, savePayAjax;

	function savePayDate() {
		if(savePayTimeOut) {
			clearTimeout(savePayTimeOut);
		}
		if(savePayAjax) {
			savePayAjax.abort()
		}

		savePayTimeOut = setTimeout(function() {
			var formData = getFormData($('#form-pay-step1'));

			savePayAjax = $.ajax({
				type: "POST",
				url: '/save-pay-data',
				data: formData,
				dataType: 'json',
				success: function(request) {
				}
			});
		}, 500);
	}

	function updateSum(sum, all) {
		var formattedSum = '';
		if(sum) formattedSum = number_format(sum, 0, '', ' ');
		else formattedSum = sum = '';

		if(all) $('#sum-block-update').val(formattedSum);
	}

	///////

	$('#js-donate-list-input').on('change', function() {
		savePayDate();
	});

	/*флаг "без вознаграждения"*/
	$('.js-input-no-gift-value').on('keyup change', function() {
		var value = $(this).val(),
				form = $('#form-pay-step1');

		updateSum(value, true);

		if(form.data('costPreviousGift')) {
			form.data('costPreviousGift', '');
		}

		savePayDate();
	});

	/* поддержать без вознаграждения */
	$('#js-no-gift-input .js-input-no-gift-value').on('click', function(e) {
		e.stopPropagation();
	});

	$('.js-pay-gift-section').on('click', function (e) {
		e.preventDefault();

		var section = $(this),
				radio = section.find('.nb-input-radio'),
				giftCost = parseInt(radio.data('gift-cost')),
				inputs = $('#form-pay-step1').find('.js-radio-input'),
				input = this.getElementsByClassName('js-radio-input')[0];

		if (!section.hasClass('nb-section--unavailable')) {
			if (section.hasClass('nb-section--highlight')) {
				section.removeClass('nb-section--highlight');
				input.checked = false;

				updateSum('', true);
				$('input[name=compensation_id]').val('');
				$('input[name=no_gift]').val('0');
			} else {
				$('#form-pay-step1').find('.js-pay-gift-section').removeClass('nb-section--highlight');
				$(inputs).attr('checked', false);
				section.addClass('nb-section--highlight');
				input.checked = true;

				if(giftCost){
					updateSum(giftCost, true);
					$('input[name=no_gift]').val('0');
				}else{
					updateSum($('.js-input-no-gift-value').val(), true);
					$('input[name=no_gift]').val('1');
				}

				$('input[name=compensation_id]').val(radio.val());
			}
		}

		savePayDate();
	});

	$('.submit-form-pay-step1').on('click', function(e) {
		e.stopPropagation();

		var $form = $('#form-pay-step1'),
				confirmProp = $(this).hasClass('js-main-submit') ? '1' : '';
		
		$form.data('confirm', confirmProp);
		$form.submit();
	});

	/* form-pay-step2 */
	function setPayStep2Masks(){
		$('#js-pay-erip-issued').mask("99.99.9999",{placeholder:" "});

		$('#js-pay-address-index').on('keyup change', function() {
			var value = $(this).val();

			if(value) {
				value = index_format(value);
			} else {
				value = '';
			}

			$(this).val(value);
		})
	}
	setPayStep2Masks();

	/*выбор варианта доставки*/
	function updateResult(){
		var deliverySum  = 0,
				deliveryCountry,
				deliveryText  = 'Доставка в ',
				itemSum = Number($('#sum-block').val()),
				resultSum,
				payItem = $('.pay-order__item').last(),
				selectedOption = $('select[name=country] option:selected');

		deliverySum = (selectedOption.data('sum')) ? selectedOption.data('sum') : 0;
		deliveryCountry = (selectedOption.data('country')) ? selectedOption.data('country') : '';
		resultSum = parseInt((itemSum + deliverySum),10);

		payItem.find('.pay-order__strong').text(deliveryText + deliveryCountry);
		payItem.find('.pay-order__cost').text(deliverySum + ' BYN');
		$('.pay-order__result').text(resultSum + ' BYN');
		$('#sum-delivery-block').val(deliverySum);
	}


	$( ".js-dd-pay-address-country select" ).change(function() {
		console.log('change');
		var parent = $(this).closest('.js-dd-pay-address-country'),
				selectedOption = $('select[name=country] option:selected'),
				scriollMenu = $(this).parent().find('.nb-dd-items__list').first();

		if(selectedOption.val()){
			$('.js-dd-menu-item').removeClass('dd-item-link--selected');
			$('.js-dd-menu-item[data-value=' + selectedOption.val() + ']').addClass('dd-item-link--selected');
		}

		if($('#sum-delivery-block').length){
			updateResult();
		}
		if(parent.hasClass('nb-input--invalid')){
			parent.removeClass('nb-input--invalid');
		}

	}).focus(function(){
		$('.js-dd-pay-address-country .js-toggle-dd-txt').click();
	}).focusout(function(){
		console.log('focusout');

	}).keydown(function(e){
		if ( e.which == 13 ) {
			var selectedOption = $('select[name=country] option:selected');

			if(selectedOption.val()){
				$('.js-dd-menu-item[data-value=' + selectedOption.val() + ']').click();
			}else{
				$('.js-default-select-value').click();
			}
		}

	});

	$('.submit-form-pay-step2').on('click', function(e) {
		e.stopPropagation();

		var $form = $('#form-pay-step2'),
				confirmProp = $(this).hasClass('js-main-submit') ? '1' : '';

		$form.data('confirm', confirmProp);

		if($('#sum-delivery-block').length){
			var resultSum = parseInt($('#sum-block').val(),10) + parseInt($('#sum-delivery-block').val(),10);
			$('#sum-block').val(resultSum);
		}

		$form.submit();
	});

	$('.js-pay-body').on('click', '.js-radio-input, .js-radio-label', function (e) {
		e.preventDefault();
	});

	$('.js-pay-methods').on('click', '.js-pay-method', function () {
		var parent = $(this).closest('.js-pay-methods'),
				sections = parent.find('.js-pay-method');

		sections.removeClass('radio-section--selected');

		var inputs = parent.find('.js-radio-input'),
				input = this.getElementsByClassName('js-radio-input')[0];

		input.checked = true;
		$(this).addClass('radio-section--selected');

		var value = $(input).data('type'),
				selection = $('.js-pay-method-selection[data-value=' + value + ']');

		$('.js-pay-method-selection').removeClass('is-visible');
		selection.addClass('is-visible');

		$('#js-payment-type').val($(this).find('.js-radio-input').data('type'));
	});

	$('.js-pay-privacies').on('click', '.js-pay-privacy', function () {
		var parent = $(this).closest('.js-pay-privacies'),
				sections = parent.find('.js-pay-privacy');

		sections.removeClass('radio-section--selected');

		var inputs = parent.find('.js-radio-input'),
				input = this.getElementsByClassName('js-radio-input')[0];

		input.checked = true;
		$(this).addClass('radio-section--selected');
	});


	/* Страница проектов */
	var projectsDD = $('.js-projects-box');
	if (projectsDD.length) {
		var currentCategory = 0,
			currentFilter = $('.ajax-categories-filter-control.dd-item-link--selected').data('filter'),
			loadedUrl = window.location.href;

		function filterProjects(formData, surfHistory){
			currentCategory = formData.category;
			currentFilter = formData.filter;

			$.ajax({
				type: "POST",
				url: '/project-categories',
				data: formData,
				dataType: 'json',
				success: function(request) {
					if(request.status != 'ok') {
						window.location.href = '/error';
					} else {
						if(request.url && !surfHistory) {
							window.history.pushState({ url : request.url }, null, request.url);
						}

						setBackURL();
						setPreviousUrl(window.location.pathname + window.location.search);

						var projectsHtml = $($(request.html).html());
						$('#projects-page').html('').append(projectsHtml);
						projectsHtml.find('.js-dd-select-box').each(function() {
							new DropDown($(this));
						});


						setVideoPopup($('.js-add-video-popup'), $('.js-open-video'));
					}
				}
			});
		}

		/* Подгрузка контента страницы проектов с последующей заменой содержимого текущей страницы */
		$(document).on('click', '.ajax-categories-control, .ajax-categories-filter-control', function() {
			var dataFilter = $(this).data('filter'),
				dataValue = $(this).data('value'),
				dataCategory =  $(this).data('category-id'),
				formData = {};

			switch (dataFilter) {
				case 'category':
					formData = {
						filter: currentFilter,
						category: dataValue
					};
					break;
				case 'all':
					formData = {
						filter: currentFilter
					};
					break;
				default:
					formData = {
						filter: $(this).data('filter'),
						category: dataCategory
					};
			}

			if(currentCategory != formData.category || currentFilter != formData.filter) {
				filterProjects(formData, false);
			}
			return false;
		});

		$(window).on('popstate', function(event) {
			var state = event.originalEvent.state,
				url = '';

			if (state) {
				url = state.url ? state.url : state.path;
			} else {
				url = loadedUrl;
			}

			if(!state.elemType) {
				var filter = getParameterByNameFromUrl('filter', url),
					category = getParameterByNameFromUrl('category', url),
					formData = {};

				if (filter) {
					formData.filter = filter;
				} else {
					formData.filter = 'favourite';
				}

				if (category) {
					formData.category = category;
				}

				filterProjects(formData, true);
			}
		});
	}

	$('.js-delete--project-draft').parent().click(function(event){
		var $this = $(this);
		if (!$this.data('post-click')) {
			$this.data('post-click', true);
		} else {
			event.preventDefault();
		}
	});

	/* Обнуление свойств popup выбора способа оплаты */
	$('.js-close__pay-type-popup').click(function(){
		$('.js-next-step__pay-type-popup').addClass('btn--inactive');
		$('.js-pay-variant').removeClass('pay-variant--is-active');
		$('.js-pay-variant input').each(function(){
			$(this).prop('checked', false);
		});
		$('.js-variant-description').each(function(){
			$(this).removeClass('variant__description--is-visible');
		});
	});



});

function setMask() {
	var moneyInputValue = $('input[alt=money]');
	if(moneyInputValue.length) {

		$.each(moneyInputValue, function(itemId, itemObj) {
			itemObj = $(itemObj);

			if(itemObj.val()) {
				itemObj.val(number_format(itemObj.val(), 0, '', ' '));
			}

			if(!itemObj.data('money-mask')) {
				itemObj.on('keyup change', function() {
					var $this = $(this);
					var value = $this.val();

					$this.data('money-mask', true);

					if(value) {
						value = number_format(value, 0, '', ' ');
					} else {
						value = '';
					}

					$this.val(value);
				});
			}

		});

		//moneyInputValue.mask("999 999 999 999",{placeholder:""});
	}

	var integerInputValue = $("input[alt=integer]");
	if(integerInputValue.length) {
		integerInputValue.mask("9?999999999", {placeholder: ""});
	}
}

function commentDelete(element, commentId){
	var self = $(element),
		countCommentsElement = $(".comments-project-link .nav-underlined__count"),
		comment = countCommentsElement.html(),
		quantityComment = comment - 1;

	countCommentsElement.text(quantityComment);
	self.closest('.nb-comment.cf').remove();

	$.ajax({
		url: "/comment-delete",
		type: "POST",
		data:{commentId: commentId},
		dataType: "json",
		success: function (data) {
			var status = data.status;
			if (status == 'ok'){
				$.ulejMessages.showMessage('success', data.message);
			} else {
				$.ulejMessages.showMessage('error', data.message);
			}
		},
		fail: function () {
			$.ulejMessages.showMessage('error');
		}
	})
}



function resendActivateMail() {
	$.ajax({
		url: "/resend-activate-mail",
		type: "POST",
		data: {},
		dataType: "json",
		success: function (data) {
			var status = data.status;
			if (status == 'ok'){
				$.ulejMessages.showMessage('success', data.message);
			} else {
				$.ulejMessages.showMessage('error', data.message);
			}
		},
		fail: function () {
			$.ulejMessages.showMessage('error');
		}
	});
}

// Получение нового блока с проектами //
function getProjectsByPageNum(element) {
	var projectCount = $(".card--small").length,
		pageNum = Math.ceil(projectCount / 16) + 1,
		self = $(element),
		filterName = $('.dd-item-link--small.ajax-categories-filter-control.js-dd-menu-item.dd-item-link--selected').data('filter');


	if(!self.hasClass("disabled-projects_active_button")){
		self.addClass('disabled-projects_active_button');
		$.ajax({
			url: "/get-projects-by-page",
			type: "POST",
			data: {pageNum: pageNum , filterName: filterName},
			dataType: "json",
			success: function (data) {
				var status = data.status;
				if (status == 'ok') {
					var htmlProject = data.projects,
						allProjectCnt = 16 + $(".card--small").length;
					if (allProjectCnt >= $(".nb-cat-item__qt").text()) {
						$('.js-get-projects-by-page-num').hide();
					} else {
						$('.js-get-projects-by-page-num').show();
					}
					$('.projects__list.cf').append(htmlProject);
					self.removeClass('disabled-projects_active_button');
				} else {
					$.ulejMessages.showMessage('error', data.message);
				}
			},
			fail: function () {
				$.ulejMessages.showMessage('error');
			}
		});
	} else {
		return false;
	}
}

/* Изменение ссылки возврата URL до открытия Popup */
function changeBeforeOpenUrl() {
	var jsPreviousUrl = $('.js-previous-url');
	var jsPopupChangeUrl = $('.js-popup-change-url');
	var url = document.location.pathname + document.location.search + document.location.hash;

	jsPopupChangeUrl.attr('href', url);
	jsPreviousUrl.val(url);
}

/*Усекаем текст описания проекта, в зависимости от длины текста названия проекта*/
function projectCutDescription(text, title) {
	var cuttedText = '',
		TITLE_LINE_LENGTH = 21,
		textLines = 7 - title.match(/\S.{1,19}\S(\s+|$)/gi).length,
		TEXT_LINE_LENGTH = 27,
		endPart,
		endPartLength,
		words = text.split(' '),
		n = 1,
		lineLength = 0,
		wordLength;

	if(textLines > 4) {
		textLines = 4;
	}
	else if(textLines < 2) {
		textLines = 2;
	}

	endPart = '';
	for(var i = 0, len = words.length; i < len; i++) {
		wordLength = words[i].length;
		endPartLength = (n == textLines) ? 3 : 0;
		if(lineLength + wordLength + endPartLength > TITLE_LINE_LENGTH) {
			n++;
			if(n > textLines) {
				endPart = '...';
				break;
			}
			lineLength = wordLength;
		} else {
			lineLength += wordLength;
		}
		cuttedText += words[i] + ' ';
	}
	cuttedText = cuttedText.slice(0, -1);
	if(endPart) cuttedText += endPart;

	return cuttedText;
}

/*
 * Ajax обновление информации о проекте
 *
 * @param object data
 *
 * @property string data.fieldName
 * @property string data.fieldValue
 * @property int data.projectId
 * @property int data.templateId - необязательный
 * */
function updateProjectInfo(data) {
	var action = "/save-project-field";

	if(data.templateId) {
		action = "/save-active-project-field"
	}


	$.ajax({
		type: "POST",
		url: action,
		data: data,
		responseType:'json',
		success: function(response) {
			var responseData = response;
			var cuttedText, titleLength;
			if(responseData.status == 'error') {
				$.ulejMessages.showMessage('error', responseData.message);
			} else {
				var projectTitle = $('#js-project-title').val();
				validateEditProjectForm();
				$.ulejMessages.showMessage('success');

				$(".js-date-temp-version").text('сегодня в ' + responseData.date);

				if(data.fieldName == 'name') {
					if(data.fieldValue.length > 0) {
						$("#js-cart-tmp-project-name").text(data.fieldValue);
						$(".js-proj-draf-" + data.projectId).find('.proj__name--draft').text(data.fieldValue);
					} else {
						$("#js-cart-tmp-project-name").text('Название вашего проекта');
						$(".js-proj-draf-" + data.projectId).find('.proj__name--draft').text('Название вашего проекта');
					}

					// обновляем значение поля описание
					cuttedText = $('#js-description-text').val();
					if(cuttedText) {
						if(projectTitle) {
							cuttedText = projectCutDescription(cuttedText, projectTitle);
						}
						$("#js-cart-tmp-description").text(cuttedText);
					}
				}
				if(data.fieldName == 'description_short') {
					if(data.fieldValue.length > 0) {
						cuttedText = data.fieldValue;

						if(projectTitle) {
							cuttedText = projectCutDescription(cuttedText, projectTitle);
						}

						$("#js-cart-tmp-description").text(cuttedText);
					} else {
						$("#js-cart-tmp-description").text('Краткое описание вашего проекта');
					}
				}
				if(data.fieldName == 'days_count') {
					if(data.fieldValue.length > 0) {
						$("#js-card-tmp-left-days").text(data.fieldValue);
					} else {
						$("#js-card-tmp-left-days").text('0');
					}
				}
				if(data.fieldName == 'location') {
					if(data.fieldValue.length > 0) {
						$("#js-card-tmp-location").text(data.fieldValue);
					} else {
						$("#js-card-tmp-location").text('Локация проекта');
					}
				}
			}
		},
		error: function() {
			showAlert('error');
		}
	});
}

function validateEditProjectForm() {
	var editProjectForm = $("#js-edit-project-form, #js-edit-active-project-form");
	var allGiftCounts = $("#js-hidden-input-gifts-count").val();

	if(editProjectForm.length && editProjectForm.valid() && Number(allGiftCounts) > 0) {
		$(".js-create-nav-btn").removeClass("create__nav__btn-more--inactive");
	} else {
		$(".js-create-nav-btn").addClass("create__nav__btn-more--inactive");
	}
}

function setValidSection($activeProject) {
	var countValidSectionInGeneralTab;
	if($activeProject) {
		countValidSectionInGeneralTab = 5;
	} else {
		countValidSectionInGeneralTab = 6;
	}
	var generalInfoLinkInHead = $(".nb-link.create__nav__link.general-info-link");
	var countSectionInGeneralTab = $("div.general-information .new-project__left section.nb-create--valid").length;
	if(countSectionInGeneralTab == countValidSectionInGeneralTab) {
		generalInfoLinkInHead.addClass("nb-create__nav__link--valid");
	} else {
		generalInfoLinkInHead.removeClass("nb-create__nav__link--valid");
	}

	var allGiftCounts = $("#js-hidden-input-gifts-count").val();
	var giftTabLinkInHead = $(".nb-link.create__nav__link.awards-and-gifts-link");
	if(Number(allGiftCounts) > 0) {
		giftTabLinkInHead.addClass("nb-create__nav__link--valid");
	} else {
		giftTabLinkInHead.removeClass("nb-create__nav__link--valid");
	}

	var detailedInfoTabLinkInHead = $(".nb-link.create__nav__link.detailed-info-link");
	var countSectionInDetailedTab = $("div.detailed-information .new-project__left section.nb-create--valid").length;
	if(countSectionInDetailedTab == 1) {
		detailedInfoTabLinkInHead.addClass("nb-create__nav__link--valid");
	} else {
		detailedInfoTabLinkInHead.removeClass("nb-create__nav__link--valid");
	}

	var paymentInfoTabLinkInHead = $(".nb-link.create__nav__link.payment-info-link");
	var countSectionInPaymentTab = $("div.payment-information .new-project__left section.nb-create--valid").length;
	if(countSectionInPaymentTab == 1) {
		paymentInfoTabLinkInHead.addClass("nb-create__nav__link--valid");
	} else {
		paymentInfoTabLinkInHead.removeClass("nb-create__nav__link--valid");
	}
}

function loadVideoPreview(responseData) {
	$(".js-add-video").click(function() {
		var templateId = getUpdateProjectTemplateId();
		var action = "/save-project-field";
		var previewParams = {
				"fieldName": 'preview_url',
				"fieldValue": responseData.image.name,
				"projectId": $("#js-project-id").val(),
				"templateId": templateId
			},
			videoParams = {
				"fieldName": 'video_url',
				"fieldValue": responseData.video,
				"projectId": $("#js-project-id").val(),
				"templateId": videoParams
			};

		if(templateId) {
			action = "/save-active-project-field"
		}

		$(".video-preview").remove();
		$(".nb-create__media--video .nb-create__media__video-preview").append('<img style="" class="video-preview" src="/' + responseData.image.full + '" alt="" />');
		$("#js-preview-video-image").val(responseData.image.name);
		$("#js-video-link").val(responseData.video);

		$.ajax({
			type: "POST",
			url: action,
			data: previewParams,
			success: function(date) {
			},
			error: function() {
				showAlert('error');
			}
		});
		$.ajax({
			type: "POST",
			url: action,
			data: videoParams,
			success: function(date) {
				showAlert('success');
			},
			error: function() {
				showAlert('error');
			}
		});
		$("body").removeClass('body--popup');
	});
}

function showAlert(type, message) {
	var alert = $(".js-alert-" + type);

	if(!alert.data('defaultMessage')) {
		alert.data('defaultMessage', alert.text());
	}

	if(message) {
		alert.html(message);
	} else {
		alert.html(alert.data('defaultMessage'));
	}

	alert.fadeIn(1500);
	alert.fadeOut(1500);
}

function show_hideGiftCountInput(element) {
	var giftCountBlock = $(element).parent().siblings(".nb-create__gift-limit");
	if($(element).prop("checked")) {
		giftCountBlock.show();
	} else {
		giftCountBlock.hide();
	}
}

function addGift() {
	var giftBlock = $(".new-project__gifts.js-project-gifts");
	var giftSumInput = $("#js-gift-sum-input");
	var giftCountInput = $("#js-gift-count-input");
	var giftCountCheckbox = $("#js-gift-count-limit-input");
	var giftDescriptionTextarea = $("#js-gift-description-textarea");
	var giftSum = parseInt(giftSumInput.val().replace(/\s+/g, ''));
	var giftDescription = giftDescriptionTextarea.val();
	var giftCount = giftCountInput.val();
	var isLimitValid = false;

	if(giftCountCheckbox.prop("checked") === false) {
		giftCount = '';
		isLimitValid = true;
	}else{
		if(giftCount !== ''){
			isLimitValid = true;
		}
	}

	giftSumInput.parent().removeClass('nb-input--invalid');
	giftDescriptionTextarea.parent().removeClass('nb-input--invalid');

	if(giftSum > 0 && giftDescription.length > 0 && isLimitValid) {
		$.ajax({
			type: "POST",
			url: '/gift/add',
			data: {
				sum: giftSum,
				description: giftDescription,
				count: giftCount,
				projectId: $("#js-project-id").val(),
				templateId: getUpdateProjectTemplateId()
			},
			dataType: 'json',
			async: false,
			success: function(response) {
				if(response.status == 'success') {
					giftBlock.append(response.content);
					setMask();

					giftSumInput.val('');
					giftCountInput.val('');
					giftDescriptionTextarea.val('');

					var limitCheckbox = $('#js-gift-count-limit-input');

					var editProjectForm = $("#js-edit-project-form, #js-edit-active-project-form");
					var allGiftsCountHiddenInput = $("#js-hidden-input-gifts-count");
					var giftTabLinkInHead = $(".nb-link.create__nav__link.awards-and-gifts-link");
					var allGiftsCount = allGiftsCountHiddenInput.val();
					var newAllCountGifts = Number(allGiftsCount) + 1;
					allGiftsCountHiddenInput.val(newAllCountGifts);
					if(editProjectForm.length && editProjectForm.valid() && newAllCountGifts > 0) {
						$(".js-create-nav-btn").removeClass("create__nav__btn-more--inactive");
					}
					if(newAllCountGifts > 0) {
						giftTabLinkInHead.addClass("nb-create__nav__link--valid");
					} else {
						giftTabLinkInHead.removeClass("nb-create__nav__link--valid");
					}

					if(limitCheckbox.prop("checked")){
						limitCheckbox.click();
					}

					$.ulejMessages.showMessage('success');
				} else if(response.status == 'error') {
					$.ulejMessages.showMessage('error', response.message);
				} else {
					if(response.status == 'redirect') {
						window.location.replace("/");
					}
				}
			},
			error: function() {
				$.ulejMessages.showMessage('error');
			}
		});
	} else {
		if(!giftSum || giftSum.length == 0) {
			giftSumInput.parent().addClass('nb-input--invalid');
		} else {
			giftSumInput.parent().removeClass('nb-input--invalid');
		}
		if(giftDescription.length == 0) {
			giftDescriptionTextarea.parent().addClass('nb-input--invalid');
		} else {
			giftDescriptionTextarea.parent().removeClass('nb-input--invalid');
		}
		if(giftCountCheckbox.prop("checked") && giftCount === '') {
			giftCountInput.parent().addClass('nb-input--invalid');
		}
	}
}

function deleteGiftData(giftNumber, templateId) {
	var params = {
		giftId: giftNumber
	};

	if(templateId) {
		params.templateId = templateId
	}

	$.ajax({
		type: "POST",
		url: '/gift/delete',
		data: params,
		success: function() {
			var editProjectForm = $("#js-edit-project-form, #js-edit-active-project-form");
			var classForDeleteGiftForm = $(".gift-number-" + giftNumber);
			var allGiftsCountHiddenInput = $("#js-hidden-input-gifts-count");
			var giftTabLinkInHead = $(".nb-link.create__nav__link.awards-and-gifts-link");
			var allGiftsCount = allGiftsCountHiddenInput.val();
			var newAllCountGifts = Number(allGiftsCount) - 1;
			allGiftsCountHiddenInput.val(newAllCountGifts);
			if(editProjectForm.valid() && newAllCountGifts > 0) {
				$(".js-create-nav-btn").removeClass("create__nav__btn-more--inactive");
			}
			if(newAllCountGifts > 0) {
				giftTabLinkInHead.addClass("create__nav__link--valid");
			} else {
				giftTabLinkInHead.removeClass("create__nav__link--valid");
			}
			classForDeleteGiftForm.remove();
			$.ulejMessages.showMessage('success', 'Подарок удален успешно');
		},
		error: function() {
			$.ulejMessages.showMessage('error');
		}
	});
}

function showEditGiftForm(giftId) {
	var giftDataBlock = $(".pay-gift-info-block.gift-number-" + giftId);
	var editGiftForm = $(".pay-gift-edit-block.gift-number-" + giftId);

	editGiftForm.show('fast');
	giftDataBlock.hide('fast');

	setMask();
}

function updateEditGiftInfo(giftId) {
	var giftDataBlock = $(".pay-gift-info-block.gift-number-" + giftId);
	var editGiftForm = $(".pay-gift-edit-block.gift-number-" + giftId);

	var giftSumElement = giftDataBlock.find(".donate__strong");
	var giftDescriptionElement = giftDataBlock.find(".donate__description");
	var allGiftCountElement = giftDataBlock.find(".js-all-gifts");
	var remainGiftCountElement = giftDataBlock.find(".js-available-gifts");
	var giftCountCheckbox = editGiftForm.find(".js-gift-count-limit-input-edit");
	var giftCountGiftInput = editGiftForm.find(".nb-create__gift-limit input");
	var giftCount = giftCountGiftInput.val();

	var giftSumInput = giftDataBlock.find(".js-gift-sum");
	var giftDescriptionInput = giftDataBlock.find(".js-short-description-gift");
	var giftCountInput = giftDataBlock.find(".js-gift-count");

	var giftSumValue = editGiftForm.find(".js-gift-sum-edit-form").val();
	var giftSumParsedValue = parseInt(giftSumValue.replace(/\s+/g, ''));
	var giftDescriptionValue = editGiftForm.find(".nb-create__gift-description textarea").val();
	var giftCountValue = giftCountGiftInput.val();

	var isLimitValid = false;

	if(giftCountCheckbox.prop("checked") === false) {
		giftCount = '';
		isLimitValid = true;
		giftCountGiftInput.val(giftCount);
	}else{
		if(giftCount !== ''){
			isLimitValid = true;
		}
	}

	var giftSumEditInput = editGiftForm.find(".nb-create__gift-sum input");
	var giftDescriptionEditTextarea = editGiftForm.find(".nb-create__gift-description textarea");

	giftSumInput.parent().removeClass('nb-input--invalid');
	giftDescriptionInput.parent().removeClass('nb-input--invalid');

	if(giftSumParsedValue > 0 && giftDescriptionValue.length > 0 && isLimitValid) {
		var data = {
			sum: giftSumValue.replace(/\s+/g, ''),
			description: giftDescriptionValue,
			count: giftCountValue,
			giftId: giftId
		};

		if(getUpdateProjectTemplateId()) {
			data.templateId = giftId;
		}

		editGiftForm.hide('fast');
		giftDataBlock.show('fast');

		$.ajax({
			type: "POST",
			url: '/gift/update',
			data: data,
			dataType: 'json',
			success: function(response) {
				if(response.status == 'error') {
					$.ulejMessages.showMessage('error', response.message);
				} else {
					$(".js-date-temp-version").text('сегодня в ' + response.content);
					$.ulejMessages.showMessage('success');
					giftSumElement.text(giftSumValue + ' BYN');
					giftSumInput.val(giftSumParsedValue);

					giftDescriptionElement.html(giftDescriptionValue.replace(/\n/g,"<br>"));
					giftDescriptionInput.val(giftDescriptionValue);

					if(Number(giftCountValue) > 0) {
						giftDataBlock.find('.donate__status').css('display', 'block');
						giftDataBlock.find('.nb-section__divider').css('display', 'block');
						allGiftCountElement.text(giftCountValue);
						remainGiftCountElement.text(giftCountValue + ' заказов');
						giftCountInput.val(giftCountValue);
					} else {
						giftDataBlock.find('.donate__status').css('display', 'none');
						giftDataBlock.find('.nb-section__divider').css('display', 'none');
						allGiftCountElement.text('');
						giftCountInput.val('');
						giftCountGiftInput.val('');
					}
				}
			},
			error: function() {
				$.ulejMessages.showMessage('error');
			}
		});
	} else {
		if(giftSumValue.length == 0) {
			giftSumEditInput.parent().addClass('nb-input--invalid');
		} else {
			giftSumEditInput.parent().removeClass('nb-input--invalid');
		}
		if(giftDescriptionValue.length == 0) {
			giftDescriptionEditTextarea.parent().addClass('nb-input--invalid');
		} else {
			giftDescriptionEditTextarea.parent().removeClass('nb-input--invalid');
		}
		if(giftCountCheckbox.prop("checked") && giftCount === '') {
			giftCountGiftInput.parent().addClass('nb-input--invalid');
		}else {
			giftDescriptionEditTextarea.parent().removeClass('nb-input--invalid');
		}
	}
}

function clearEditGiftForm(giftId) {
	var giftDataBlock = $(".pay-gift-info-block.gift-number-" + giftId);
	var editGiftForm = $(".pay-gift-edit-block.gift-number-" + giftId);

	editGiftForm.hide('fast');
	giftDataBlock.show('fast');
}

function addFAQ() {
	var faqBlock = $(".nb-create__faq");
	var questionInput = $("#js-full-desc-question");
	var answerTextarea = $("#js-full-desc-answer");
	var question = questionInput.val();
	var answer = answerTextarea.val();

	if(question.length > 0 && answer.length > 0) {
		$.ajax({
			type: "POST",
			url: '/faq/add',
			data: {
				question: question,
				answer: answer,
				projectId: $("#js-project-id").val(),
				templateId: getUpdateProjectTemplateId()
			},
			dataType: 'json',
			success: function(response) {
				if(response.status == 'success') {
					$(".nb-create-media-divider.nb-create-media-summary-divider").css("display", 'block');
					faqBlock.append(response.content);
					questionInput.val("");
					answerTextarea.val("");
					$.ulejMessages.showMessage('success');
				} else if(response.status == 'error') {
					$.ulejMessages.showMessage('error', response.message);
				} else if(response.status == 'redirect') {
					window.location.replace("/");
				}
			},
			error: function() {
				$.ulejMessages.showMessage('error');
			}
		});
	} else {
		if(question.length == 0) {
			questionInput.parent().addClass('nb-input--invalid');
		} else {
			questionInput.parent().removeClass('nb-input--invalid');
		}
		if(answer.length == 0) {
			answerTextarea.parent().addClass('nb-input--invalid');
		} else {
			questionInput.parent().removeClass('nb-input--invalid');
		}
	}
}

function deleteFAQData(faqId, faqTemplateId) {
	var params = {
		faqId: faqId
	};

	if(faqTemplateId) {
		params.templateId = faqTemplateId
	}

	$.ajax({
		type: "POST",
		url: '/faq/delete',
		data: params,
		dataType: 'json',
		success: function(request) {
			if(request.status == 'success') {
				var faqBlock = $(".nb-create__faq");
				var classForDeleteFaqBlock = $(".faq-number-" + faqId);

				classForDeleteFaqBlock.remove();

				if(faqBlock.find('details').length == 0) {
					faqBlock.find('.nb-create-media-divider.nb-create-media-summary-divider').hide();
				}

				$.ulejMessages.showMessage('success', request.message);
			} else {
				$.ulejMessages.showMessage('error');
			}
		},
		error: function() {
			showAlert('error');
		}
	});
}

function showEditFAQForm(faqId) {
	var faqBlockElement = $(".nb-create-details.faq-number-" + faqId);
	var faqEditFormElement = faqBlockElement.find(".faq-edit-form");

	faqEditFormElement.show('fast');
}

function updateEditFAQInfo(faqId) {
	var faqBlockElement = $(".nb-create-details.faq-number-" + faqId);
	var faqEditFormElement = faqBlockElement.find(".faq-edit-form");
	var questionElement = faqBlockElement.find(".question-text-faq");
	var answerElement = faqBlockElement.find("div.nb-details-content .nb-details-content-txt");
	var questionInputElement = faqBlockElement.find("#js-faq-question");
	var answerInputElement = faqBlockElement.find("#js-faq-answer");
	var questionValue = faqBlockElement.find("#js-full-desc-question").val();
	var answerValue = faqBlockElement.find("#js-full-desc-answer").val();

	if(questionValue.length > 0 && answerValue.length > 0) {
		var data = {
			question: questionValue,
			answer: answerValue,
			faqId: faqId
		};

		if(getUpdateProjectTemplateId()) {
			data.templateId = faqId;
		}

		questionElement.text(questionValue);
		answerElement.text(answerValue);

		questionInputElement.val(questionValue);
		answerInputElement.val(answerValue);

		faqEditFormElement.hide('fast');

		$.ajax({
			type: "POST",
			url: '/faq/update',
			data: data,
			dataType: 'json',
			success: function(response) {
				if(response.status == 'error') {
					$.ulejMessages.showMessage('error', response.message);
				} else {
					$(".js-date-temp-version").text('сегодня в ' + response.content);
					$.ulejMessages.showMessage('success');
				}
			},
			error: function() {
				$.ulejMessages.showMessage('error');
			}
		});
	} else {
		if(questionValue == 0) {
			faqBlockElement.find("#js-full-desc-question").parent().addClass('nb-input--invalid');
		} else {
			faqBlockElement.find("#js-full-desc-question").parent().removeClass('nb-input--invalid');
		}

		if(answerValue == 0) {
			faqBlockElement.find("#js-full-desc-answer").parent().addClass('nb-input--invalid');
		} else {
			faqBlockElement.find("#js-full-desc-answer").parent().removeClass('nb-input--invalid');
		}
	}
}

function clearEditFAQForm(faqId) {
	var faqBlockElement = $(".nb-create-details.faq-number-" + faqId);
	var faqEditFormElement = faqBlockElement.find(".faq-edit-form");

	faqEditFormElement.hide('fast');
}

function deleteWebsite(link, websiteId) {
	if(websiteId) {
		$.ajax({
			url: '/website/delete',
			type: 'POST',
			data: {
				website_id: websiteId
			},
			dataType: 'json',
			success: function(data) {
				if(data.status == 'success') {
					$(link).closest('.js-website').remove();
					$.ulejMessages.showMessage('success');
				} else {
					$.ulejMessages.showMessage('error', data.message);
				}
			},
			error: function() {
				$.ulejMessages.showMessage('error');
			}
		});
	}

	return false;
}

function toggleVideo(state, block) {
	// if state == 'hide', hide. Else: show video
	var div = '';
	if(block) {
		div = block;
	} else {
		div = document.getElementById("popup-video__player-wrap")
	}
	div.getElementsByTagName("iframe")[0].contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
}

addCommentAjaxRequest = undefined;
/*Добавление комментария к проекту*/
function addCommentForProject(projectAuthor) {
	var input = $('#js-comment-text'),
		commentText = input.val(),
		projectId = $('#js-project-id').val(),
		authorAvatarClass = '';


	if(projectAuthor == true) {
		authorAvatarClass = 'nb-comment-project-author__avatar-wrap';
	}

	if(!commentText || addCommentAjaxRequest) return;

	input.val('');

	addCommentAjaxRequest = $.ajax({
		url: '/add-comment',
		type: 'POST',
		data: {
			comment_text: commentText,
			project_id: projectId
		},
		dataType: 'json',
		success: function(data) {
			if(data.status == 'success') {
				var avatarUrl = $("#js-author-avatar").prop('src'),
					name = $("#js-author-name").val(),
					commentId = data.commentId,
					countCommentsElement = $(".comments-project-link .nav-underlined__count"),
					comment = countCommentsElement.html(),
					quantityComment = + comment + 1;

				countCommentsElement.text(quantityComment);

				$("#js-project-comment-block").prepend(
					"<div class='nb-comment cf'>" +
						"<div class='nb-comment__author'>" +
							"<div class='nb-comment__author__avatar-wrap " + authorAvatarClass + "'>" +
								"<img width='52' height='52' src='" + avatarUrl + "' alt='avatar'>" +
							"</div>" +
						"</div>" +
						"<div class='nb-comment__content'>" +
							"<a href='#' class='nb-comment__author-link'>" +
								"<strong class='nb-comment__author__name'>" + name + "</strong>" +
							"</a>" +
							"<div class='nb-comment__info'>" +
								"<time class='nb-comment__info__date' datetime=''>Только что</time>" +
							"</div>" +
							"<div class='nb-comment__txt'>" + data.comment + "</div>" +
							"<div class='nb-comment__delete'>" +
								"<a href='javascript:void(0);' class='nb-link nb-comment__link js-remove-comment comment__delete' onclick='commentDelete(this, " + commentId + ");'>Удалить</a>" +
							"</div>" +
						"</div>" +
					"</div>"
				);
			} else if(data.status == 'error-save') {
				$.ulejMessages.showMessage('error', data.message);
			} else {
				$.ulejMessages.showMessage('error');
			}
			addCommentAjaxRequest = undefined;
		},
		error: function() {
			showAlert('error');
			addCommentAjaxRequest = undefined;
		}
	});
}
/////////

/* Получение идентификатора проекта передаваемого в качестве идентификатора шаблона. Форма обновления информации проекта. */
function getUpdateProjectTemplateId() {
	var template = $('input[name=template_id]'),
		data = 0;

	if(template.length) {
		data = parseInt(template.val());
	}

	return data;
}

function disableControl($control) {
	$control.on('click.disableControl', function() {
		return false;
	});
}

function activationControl($control) {
	$control.off('click.disableControl');
}
