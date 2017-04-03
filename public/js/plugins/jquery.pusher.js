;(function ( $, window, document ) {

  "use strict";
  
  var pluginName = "pusher",
    defaults = {
      watch: "a",
      initialPath: window.location.pathname + window.location.search + window.location.hash,
      before: function(done) {
        done();
      },
      handler: function() {
      },
      after: function() {
      },
      fail: function() {
        window.alert("Failed to load " + this.state.path);
      },
      onStateCreation: function(state, elem) {
      }
    };

  function Plugin(element, options) {
    this.element = element;
    this.options = $.extend({}, defaults, options);
    this._defaults = defaults;
    this._name = pluginName;
    this.init();
  }

  Plugin.prototype = {

    init: function() {
      
      var self = this;

      if (!history.pushState) {
        return;
      }
      var link = $('a[href="' + self.options.initialPath + '"]').eq(0);
      //create the initial state
      var initialStateParams = {
        path: self.options.initialPath
      };
      if(link.length) {
        initialStateParams.elemType = link.data('link-type')
      }
      var initialState = createState(initialStateParams, self.options.onStateCreation);
      
      history.replaceState(initialState, null, initialState.path);

      //click event
      $(self.element).on('click', self.options.watch, function (e) {
        e.preventDefault();

        self.elemType = $(this).data('link-type');

        var state = createState({
          path: $(this).attr('href'),
          elem: $(this),
          elemType: self.elemType
        }, self.options.onStateCreation);

        run(self, state, true);
      });
      
      //popstate event
      window.addEventListener('popstate', function(e) {
        window.console.log("pop", e.state);
        var state = $.extend(e.state, {prevElemType: self.elemType});
        run(self, state);
      });

    }

  };
  
  var createState = function(params, fn) {
    var state = {};
    params = params || {};
    state.path = params.path;
    state.time = new Date().getTime();
    if(params.prevElemeType) {
        state.prevElemeType = params.prevElemeType;
    }
    if(params.elemType) {
        state.elemType = params.elemType;
    }
    if(fn) {
      fn(state, params.elem);
    }
    return state;
  };
  
  var run = function(plugin, state, push) {
    
    if(!state) {
      return;
    }

    window.console.log("run", state);
    
    var context = {
      state: state,
      plugin: plugin,
      get: function(query) {
        return get(context.res, query);
      },
      updateText: function(query) {
        var el = $(query);
        this.get(query).each(function(i) {
          var txt = $(this).text();  
          el.eq(i).text(txt);
        });
      },
      updateHtml: function(query) {
        var el = $(query);
        this.get(query).each(function(i) {
          var cnt = $(this).contents();  
          el.eq(i).html(cnt);
        });
      }
    };


    var done = function(ajax) {
      if(ajax) {
        $.ajax({
          type: 'GET',
          url: state.path
        }).done(function (res) {
          context.res = res;
          if(push) {
            history.pushState(state, null, state.path);
          }
          plugin.options.handler.apply(context);
        }).fail(function () {
          plugin.options.fail.apply(context);
        }).always(function () {
          plugin.options.after.apply(context);
        });
      } else {
        if(push) {
          history.pushState(state, null, state.path);
        }
      }
    };
  
    plugin.options.before.apply(context, [done]);
  };

  var get = function(data, query) {
    var html = $("<root>").html(data);
    return html.find(query);
  };

  $.fn[pluginName] = function (options) {
    if (!$.data(document, "plugin_" + pluginName)) {
      $.data(document, "plugin_" + pluginName, new Plugin( this, options ));
    }
  };

})( jQuery, window, document );
