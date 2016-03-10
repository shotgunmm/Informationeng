<?php 

/**
	revslider plugin support
**/
if( in_array('revslider/revslider.php', get_option('active_plugins')) ){ //first check if plugin is installed
	$ABdevDND_shortcodes['rev_slider'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'alias' => array(
				'description' => __('Slider Alias', 'dnd-shortcodes'),
			),
		),
		'description' => __('Revolution Slider', 'dnd-shortcodes'),
	);
}

