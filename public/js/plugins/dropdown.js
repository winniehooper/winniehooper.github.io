function DropDown(el) {
	el.data('dropDown', this);
    this.dd = el;
    this.toggle = this.dd.children('.js-toggle-dd');
    this.placeholder = this.dd.find('.js-toggle-dd-txt');
    this.defSel = this.dd.find('.js-dd-select');
    this.menu = this.dd.find('.js-dd-menu');
    this.opts = this.dd.find('.js-dd-menu-item');
    this.val = '';
    this.index = -1;
    this.initEvents();
}
DropDown.prototype = {
    initEvents: function () {
        var obj = this;
		obj.toggle.on('click', function(event){
			obj.menu.toggleClass('nb-dd--hidden');
			obj.dd.toggleClass('is-opened');
			event.stopPropagation();
		});

        obj.opts.on('click', function () {
            var opt = $(this);
			if (opt.attr('data-value') !== obj.defSel.find('[selected="selected"]').attr('value')) {
                obj.menu.find('.dd-item-link--selected').removeClass('dd-item-link--selected');
                obj.val = opt.text();
                obj.index = opt.index();
                obj.placeholder.text(obj.val);
				(opt.attr('data-value') === '' && !opt.attr('data-filter')) ? obj.placeholder.addClass('nb-dd-toggle-txt--default') : obj.placeholder.removeClass('nb-dd-toggle-txt--default');
                opt.addClass('dd-item-link--selected');
				obj.defSel.find('[value]').prop('selected',false);
				obj.defSel.find('[value="' + opt.attr('data-value') + '"]').prop('selected',true);
				obj.defSel.trigger('change');
            }
            obj.menu.toggleClass('nb-dd--hidden');
			obj.dd.toggleClass('is-opened');
        });
    },
    getValue: function () {
        return this.val;
    },
    getIndex: function () {
        return this.index;
    },
    closeDD: function () {
        this.menu.addClass('nb-dd--hidden');
		this.dd.removeClass('is-opened');
    },
	reset: function() {
		var obj = this, opt = obj.defSel.find('[value]'), firstOpt = opt.eq(0);
		obj.placeholder.addClass('nb-dd-toggle-txt--default');
		opt.removeAttr('selected');
		firstOpt.attr('selected','selected');
		obj.menu.find('.dd-item-link--selected').removeClass('dd-item-link--selected');
		obj.menu.find('.dd-item-link--default').addClass('dd-item-link--selected');
		obj.placeholder.text(firstOpt.text());
		obj.placeholder.addClass('nb-dd-toggle-txt--default')
	}
};