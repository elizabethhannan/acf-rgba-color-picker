<?php

class acf_field_rgba_color_picker extends acf_field {
	
	
	function __construct() {
		
		
		$this->name = 'rgba_color_picker';
		$this->label = __('RGBA Color Picker', 'acf-rgba_color_picker');
		$this->category = 'jquery';
		$this->defaults = array(
			'default_value'	=> '',
		);
		// do not delete!
    	parent::__construct();
    	
	}

	
	function render_field_settings( $field ) {

		
		// display_format
		acf_render_field_setting( $field, array(
			'label'			=> __('Default Value','acf'),
			'instructions'	=> '',
			'type'			=> 'text',
			'name'			=> 'default_value',
			'placeholder'	=> 'rgba(255,255,255,1)'
		));

	}
	
	function render_field( $field ) {
		// vars
		$atts = array();
		$e = '';
		
		
		// populate atts
		foreach( array( 'id', 'class', 'name', 'value' ) as $k ) {
		
			$atts[ $k ] = $field[ $k ];
			
		}
		
		
		// render
		$e .= '<div class="acf-rgba_color_picker">';
		$e .= '<input type="text" ' . acf_esc_attr($atts) . ' />';
		$e .= '</div>';
		
		
		// return
		echo $e;
	}
	

	
	function input_admin_enqueue_scripts() {
		
		$dir = plugin_dir_url( __FILE__ );

		// register & include JS
		wp_register_script( 'acf-input-rgba_color_picker', "{$dir}js/input.js" );
		wp_enqueue_script('acf-input-rgba_color_picker');
		
		// register & include CSS
		wp_register_style( 'acf-input-rgba_color_picker', "{$dir}css/input.css" ); 
		wp_enqueue_style('acf-input-rgba_color_picker');
		
	}
	
	
}


// create field
new acf_field_rgba_color_picker();

?>
