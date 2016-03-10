<?php 


/**
	abdev-portfolio plugin support
**/
if( in_array('abdev-portfolio/abdev-portfolio.php', get_option('active_plugins')) ){ //first check if plugin is installed
	$ABdevDND_shortcodes['portfolio'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'category' => array(
				'description' => __('Portfolio Category', 'dnd-shortcodes'),
				'info' => __('Show only items from specific category, displays all categories if not specified (category slug string)', 'dnd-shortcodes'),
			),
			'count' => array(
				'description' => __('Count', 'dnd-shortcodes'),
				'info' => __('Number of portfolio items to be shown', 'dnd-shortcodes'),
				'default' => 8,
			),
			'link_text' => array(
				'description' => __('More Link Text', 'dnd-shortcodes'),
				'info' => __('Enter text to be displayed below items as a link to complete portfolio', 'dnd-shortcodes'),
			),
			'link_url' => array(
				'description' => __('More Link URL', 'dnd-shortcodes'),
				'info' => __('Enter URL for link to complete portfolio', 'dnd-shortcodes'),
			),
		),
		'description' => __('Portfolio', 'dnd-shortcodes'),
	);
}
