<?php

class acf_field_rgba_color_picker extends acf_field {
	
	// vars
	var $settings, // will hold info such as dir / path
		$defaults; // will hold default field options

	
	function __construct() {
		// vars
		$this->name = 'rgba_color_picker';
		$this->label = __('RGBA Color Picker');
		$this->category = __("jQuery",'acf'); // Basic, Content, Choice, etc
		$this->defaults = array(
			'default_value' => ''
		);
		add_action('acf/input/admin_enqueue_scripts', array($this, 'input_admin_enqueue_scripts'));
		
		// do not delete!
    	parent::__construct();
    	
    	
    	// settings
		$this->settings = array(
			'path' => apply_filters('acf/helpers/get_path', __FILE__),
			'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
			'version' => '1.0.0'
		);

	}
	
	
	function create_options( $field ) {
		// vars
		$key = $field['name'];
		
		?>
			<tr class="field_option field_option_<?php echo $this->name; ?>">
				<td class="label">
					<label><?php _e("Default Value",'acf'); ?></label>
				</td>
				<td>
					<?php 
					do_action('acf/create_field', array(
						'type'			=>	'text',
						'name'			=>	'fields[' .$key.'][default_value]',
						'value'			=>	$field['default_value'],
						'placeholder'	=>	'rgba(255,255,255,1)'
					));
					?>
				</td>
			</tr>
		<?php
		
	}
	
	function create_field( $field ) {
		// vars
		$o = array( 'id', 'class', 'name', 'value' );
		$e = '';
		
		
		$e .= '<div class="acf-rgba_color_picker">';
		$e .= '<input type="text"';
		
		foreach( $o as $k )
		{
			$e .= ' ' . $k . '="' . esc_attr( $field[ $k ] ) . '"';	
		}
		
		$e .= ' />';
		$e .= '</div>';
		
		
		// return
		echo $e;
	}

	function input_admin_enqueue_scripts()
	{
		// Note: This function can be removed if not used
		
		
		// register ACF scripts
		wp_register_script( 'acf-input-rgba_color_picker', $this->settings['dir'] . 'js/input.js', array('acf-input'), $this->settings['version'] );
		wp_register_style( 'acf-input-rgba_color_picker', $this->settings['dir'] . 'css/input.css', array('acf-input'), $this->settings['version'] ); 
		
		
		// scripts
		wp_enqueue_script(array(
			'acf-input-rgba_color_picker',	
		));

		// styles
		wp_enqueue_style(array(
			'acf-input-rgba_color_picker',	
		));
		
		
	}
	
}


// create field
new acf_field_rgba_color_picker();

?>
