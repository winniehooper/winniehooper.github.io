<script type="text/javascript" src="/js/modernizr.custom.min.js?2.3.7"></script>
<script type="text/javascript" async>
    Modernizr.load([
        {
            load: 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js',
            complete: function () {
                if (!window.jQuery) {
                    Modernizr.load('js/jquery.min.js');
                }
            }
        },
        {
            test: Modernizr.details,
            nope: '/js/plugins/jquery.details.min.js',
            complete: function () {
                if (!Modernizr.details) {
                    $('details').details();
                }
            }
        },
        {
            test: Modernizr.input.placeholder,
            nope: '/js/plugins/placeholder-enhanced/js/jquery.placeholder-enhanced.min.js',
            complete: function () {
                if (!Modernizr.input.placeholder) {
                    $('input[placeholder], textarea[placeholder]').placeholderEnhanced();
                }
            }
        },
        {
            load: ['/js/jquery-ui.min.js',
                '/js/plugins/jquery-validation/jquery.validate.js',
                '/js/plugins/jquery-validation/additional-methods.js',
                '/js/plugins/jquery-validation/jquery.validate.extras.js',
                '/js/plugins/jquery.details.min.js',
                '/js/plugins/jquery.cookie.js',
                '/js/jquery.mb.browser.min.js',
                '/js/plugins/jquery.datetimepicker.js',
                '/js/plugins/jquery.maskedinput.min.js',
                '/js/plugins/jquery.pusher.js',
                '/js/redactor.prod.js?2.3.7',
                '/js/ulejMessage.js?2.3.7',
                '/js/ulejAjaxTabs.js?2.3.7',
                '/js/ulejPopup.js?2.3.7',
                '/js/dropdown.js?2.3.7',
                '/js/stickyfill.min.js?2.3.7',
                '/js/main.js?2.3.7',
                '/js/init.js?2.3.7',
                '/js/ulejFormValidation.js?2.3.7',
                '/js/forms.js?2.3.7'
                //'/js/project-nav.js?2.3.7'
            ]
        }
    ]);
</script>