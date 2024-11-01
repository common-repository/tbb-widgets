;(function ( $, window, document, undefined ) {


    var pluginName = "tbb_widget",
        defaults = {
        };

    // The actual plugin constructor
    function Plugin( element, options ) {
        this.element = element;
				this.$element = $(element);

        this.options = $.extend( {}, defaults, options) ;

        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

    Plugin.prototype = {

        init: function() {
					this.initLastTab(this.$element);
					this.initSwitch(this.$element);
					this.initEditor(this.$element);
					this.initSelect(this.$element);
					this.initSlider(this.$element);				
        },
        initLastTab: function(el) {
					el.find('.tbb-widget-last-tab').each(function(){
						var input = $(this);
						var panels = input.parent().find('.panel');
						panels.on('shown.bs.collapse', function (e) {
							var id = $(e.currentTarget).find('.panel-collapse').attr('id');
							input.val(id);
						})
					});
					
        },
        initSwitch: function(el) {
					el.find('.tbb-widget-switch').each(function(){
						var input = $(this);
						var hidden = $(':hidden[name="' + input.attr('name') + '"]');
						input.bootstrapSwitch({
							   size: 'small',
							   onSwitchChange:function(event, state) {
							   	hidden.val(state ? 1 : 0);
							   }
						   });
					});
					
        },
        initSelect: function(el) {
					el.find('input.tbb-widget-select').each(function(){
						var input = $(this);
						input.select2({
						   multiple: input.data('multiple'),
						   data: input.data('data'),
						   width: input.data('width'),
					   })
						 
						 if(input.data('ace-mode')){
							var div = input.closest('form .tbb-widget').find('.tbb-widget-editor');		
							var editor = ace.edit(div.attr('id'));
							editor.getSession().setMode("ace/mode/" + input.val());
							
						 	input.on("select2-selecting", function(e) { 		
								editor.getSession().setMode("ace/mode/" + e.val);
							})
						 }
					});				
        },
        initSlider: function(el) {
					el.find('.tbb-widget-slider').each(function(){
						var slider = $(this);
						
						try{
							slider.noUiSlider({
								start: slider.data('start'),
								step: slider.data('step'),
								range: {
									'min': [ slider.data('min') ],
									'max': [ slider.data('max') ]
								},
								serialization: {
									lower: [
										new $.noUiSlider.Link({
											target: slider.parent().find('[type=number]')
										})
									],
									format: {
										decimals: 0,
										//mark: ','
									}
								}
							});
						}catch(err){
							//ignore
						}
						
					});				
        },
				initEditor: function(el) {
					el.find('.tbb-widget-editor').each(function(){
						var div = $(this);
						
						var editor = ace.edit(div.attr('id'));
						var textarea = div.parent().find('.tbb-widget-editor-textarea');
						editor.setTheme("ace/theme/chrome");
						editor.getSession().setMode("ace/mode/html");
						editor.on("input", function () {
							   textarea.val(editor.getSession().getValue());
						});
					});				
        },
    };

    // A really lightweight plugin wrapper around the constructor,
    // preventing against multiple instantiations
    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName,
                new Plugin( this, options ));
            }
        });
    };

})( jQuery, window, document );

jQuery(document).ready(function($) { 
	
	$( document ).ajaxSuccess(function(event,xhr,options) { 

			var name = 'widget-id';
			name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
			var regexS = "[\\?&]" + name + "=([^&#]*)";
			var regex = new RegExp(regexS);
			var results = regex.exec(options.data);
			
			if(results){
				var id = results[1];
			
				if(id.indexOf("tbb_widget") != -1){
					$('div[id$=' + id + ']').tbb_widget({});
				}
			}

	});
});