<?php 

/**
	Native WP video shortcode support
**/

$ABdevDND_shortcodes['video'] = array(
	'third_party' => 1, 
	'attributes' => array(
		'mp4' => array(
			'description' => __('MP4 file', 'dnd-shortcodes'),
			'type' => 'media',
		),
		'm4v' => array(
			'description' => __('M4V file', 'dnd-shortcodes'),
			'type' => 'media',
		),
		'webm' => array(
			'description' => __('WEBM file', 'dnd-shortcodes'),
			'type' => 'media',
		),
		'ogv' => array(
			'description' => __('OGV file', 'dnd-shortcodes'),
			'type' => 'media',
		),
		'wmv' => array(
			'description' => __('WMV file', 'dnd-shortcodes'),
			'type' => 'media',
		),
		'flv' => array(
			'description' => __('FLV file', 'dnd-shortcodes'),
			'type' => 'media',
		),
		'poster' => array(
			'description' => __('Poster image', 'dnd-shortcodes'),
			'type' => 'image',
			'info' => __('Defines image to show as placeholder before the media plays', 'dnd-shortcodes'),
		),
		'loop' => array(
			'description' => __('Loop', 'dnd-shortcodes'),
			'default' => 'off',
			'type' => 'select',
			'values' => array( 
				'0' => 'Off',
				'1' => 'On',
			),
			'info' => __('Allows for the looping of media', 'dnd-shortcodes'),
		),
		'autoplay' => array(
			'description' => __('Autoplay', 'dnd-shortcodes'),
			'default' => 'off',
			'type' => 'select',
			'values' => array( 
				'0' => 'Off',
				'1' => 'On',
			),
			'info' => __('Causes the media to automatically play as soon as the media file is ready', 'dnd-shortcodes'),
		),
		'preload' => array(
			'description' => __('Preload', 'dnd-shortcodes'),
			'default' => 'metadata',
			'type' => 'select',
			'values' => array( 
				'metadata' => 'Metadata only',
				'none' => 'None',
				'auto' => 'Load video entirely',
			),
			'info' => __('Specifies if and how the video should be loaded when the page loads', 'dnd-shortcodes'),
		),
	),
	'description' => __('Video - HTML5', 'dnd-shortcodes'),
);

