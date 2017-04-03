(function($) {
    $.extend({
        ulejAjaxTabs: {
            settings: {
                preloderClass: 'js-tab-preloader',
                funcClick: function() {},
                funcAfterAjax: function() {}
            },
            init: function(controls, settings) {
                this.settings = $.extend(this.settings, settings);
                this.settings.controls = controls;

                this.processingControls();
                this.setEvents();
            },
            processingControls: function() { /* Предварительная обработка табов */
                var $this = this;

                $.each(this.settings.controls, function(controlId, controlObj) {
                    controlObj = $(controlObj);
                    controlObj.data('controlURL', $this.getControlUrl(controlObj));
                });
            },
            setEvents: function() { /* Устанавка обработчиков событий */
                var $this = this;

                this.settings.controls.on('click', function(e) {
                    var self = $(this), data = $this.getControlDate(self);
                    if($this.settings.additionalParams) {
                        data.params = $.extend(data.params, $this.settings.additionalParams);
                    }
                    $this.showPreloader();
                    if(typeof $this.settings.funcClick == 'function') {
                        $this.settings.funcClick.apply(this, self);
                    }

                    $this.settings.controls.removeClass($this.settings.selectClass);
                    self.addClass($this.settings.selectClass);

                    if(!self.data('isHistoryElement')) {
                        $this.changeURL(self.data('controlURL'));
                    } else {
                        self.data('isHistoryElement', false)
                    }
                    $this.submitRequest(data);

                    e.preventDefault();
                })
            },
            getControlDate: function(control) { /* Сбор данных */
                return {
                    'method' : this.settings.method || 'POST',
                    'url' : this.settings.url || control.data('url'),
                    'dataType' : this.settings.dataType || 'json',
                    'content' : this.settings.content || '',
                    'tabParams' : control.data('tab-params') || '',
                    'params' : this.settings.params || control.data('params')
                };
            },
            getControlUrl: function(control) { /* Формирование ссылки */
                var tabParams = control.data('tab-params'), newUrl = '', controlPathname = control.data('pathname');

                if(tabParams) {
                    var pathname, search = document.location.search;
                    if(controlPathname) {
                        pathname = '/' + controlPathname;
                    } else {
                        pathname = document.location.pathname;
                    }

                    /*if(search && tabParams) {
                        search = '&' + tabParams;
                    } else */if(tabParams) {
                        search = '?' + tabParams;
                    }

                    newUrl = pathname + search;
                }

                return newUrl;
            },
            changeURL: function(url) { /* Подмена URL */
                if(url) {
                    window.history.pushState({ url : url }, null, url);
                }
            },
            showPreloader: function() { /* Отображать прелоадер */
                if(this.settings.preloader) {
                    var preloader = $(this.settings.preloader);
                    $(this.settings.content).html(preloader.addClass(this.settings.preloderClass));
                }
            },
            submitRequest: function(data) { /* Отправка запроса на сервер */
				var $this = this;

                if(typeof this.settings.xhr != 'undefined') {
					this.settings.xhr.abort();
				}

                this.settings.xhr = $.ajax({
                    type: data.method,
                    url: data.url,
                    data: data.params,
                    dataType: data.dataType,
                    success: function(request) {
                        var content = $(data.content);
                        if(request.status != 'ok' || !request) {
                            content.html('');
                        } else {
                            content.html(request.content);
                            if(typeof $this.settings.funcAfterAjax == 'function') {
                                $this.settings.funcAfterAjax.apply(this, self);
                            }
                        }
                    }
                });
            }
        }
    });

    $.fn.extend({
        ulejAjaxTabs: function(options) {
            return $.ulejAjaxTabs.init(this, options);
        }
    });
})(jQuery);