<?php 

/**
	CF7 support
**/
if( in_array('contact-form-7/wp-contact-form-7.php', get_option('active_plugins')) ){ //first check if plugin is installed
	$ABdevDND_shortcodes['contact-form-7'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'id' => array(
				'description' => __('Form ID', 'dnd-shortcodes'),
			),
		),
		'description' => __('Contact Form 7', 'dnd-shortcodes'),
	);
}

