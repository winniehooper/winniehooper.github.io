(function( $ ){
  $.fn.footerNavigation = function() {
    var footer = this;
    var nav = $(this).find('.js-footer-navigation');
    var footerScrollPosition = footer.offset().top;

    function scrollPos() {
      var fromTop = $(this).scrollTop();
      if (!nav.hasClass('is-expanded') && fromTop >= footerScrollPosition) {
        nav.addClass('is-expanded');
      } else if (nav.hasClass('is-expanded') && fromTop < footerScrollPosition) {
        nav.removeClass('is-expanded');
      }
    }

    $(window).on('load resize scroll',function(e){
      scrollPos();
    });

    this.each(function() {
      scrollPos($(this));
    });

    return this;
  };

  $(function() {
    $('.js-project-footer').footerNavigation();
  });

})( jQuery );