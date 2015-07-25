(function($){
	
	Color.prototype.toString = function(remove_alpha) {
		if (remove_alpha == 'no-alpha') {
			return this.toCSS('rgba', '1').replace(/\s+/g, '');
		}
		if (this._alpha < 1) {
			return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');
		}
		var hex = parseInt(this._color, 10).toString(16);
		if (this.error) return '';
		if (hex.length < 6) {
			for (var i = 6 - hex.length - 1; i >= 0; i--) {
				hex = '0' + hex;
			}
		}
		return '#' + hex;
	};
	
	function initialize_field( $el ) {
		var $input = $el.find("input[type='text']");
		var value = $input.val().replace(/\s+/g, '');
		var transparencyClass = "acf-rgba-transparency";
		var alphaSliderContainerClass = "acf-rgba-alpha-container";
		var alphaSliderClass = "acf-rgba-slider-alpha";
		$input.wpColorPicker({ // change some things with the color picker
			palettes: false, // remove the color palettes
			mode: 'hsl'
		});
		$('<div class="' + alphaSliderContainerClass + '"><div class="' + alphaSliderClass + '"></div><div class="' + transparencyClass + '"></div></div>').appendTo($input.parents('.wp-picker-container'));
		var $alpha_slider = $input.parents('.wp-picker-container:first').find('.' + alphaSliderClass);
		// if in format RGBA - grab A channel value
		if (value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)) {
			var alpha_val = parseFloat(value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)[1]) * 100;
			var alpha_val = parseInt(alpha_val);
		} else {
			var alpha_val = 100;
		}
		$alpha_slider.slider({
			slide: function(event, ui) {
				$(this).find('.ui-slider-handle').text(ui.value); // show value on slider handle
				var _new_value = $input.val();
			},
			create: function(event, ui) {
				var v = $(this).slider('value');
				$(this).find('.ui-slider-handle').text(v);
			},
			value: alpha_val,
			range: "max",
			step: 1,
			min: 0,
			max: 100
		}); // slider
		$alpha_slider.slider().on('slidechange', function(event, ui) {
			var new_alpha_val = parseFloat(ui.value),
				iris = $input.data('a8cIris'),
				color_picker = $input.data('wpWpColorPicker');
			iris._color._alpha = new_alpha_val / 100.0;
			$input.val(iris._color.toString());
			color_picker.toggler.css({
				backgroundColor: $input.val()
			});
			// fix relationship between alpha slider and the 'side slider not updating.
			var get_val = $input.val();
			$($input).wpColorPicker('color', get_val);
		});
		
	}
	
	
	if( typeof acf.add_action !== 'undefined' ) {
		
		acf.add_action('ready append', function( $el ){
			
			// search $el for fields of type 'rgba_color_picker'
			acf.get_fields({ type : 'rgba_color_picker'}, $el).each(function(){
				
				initialize_field( $(this) );
				
			});
			
		});
		
		
	} else {
		
		$(document).on('acf/setup_fields', function(e, postbox){
			
			$(postbox).find('.field[data-field_type="rgba_color_picker"]').each(function(){
				
				initialize_field( $(this) );
				
			});
		
		});
	
	}


})(jQuery);
