<?php 

/**
	ab-testimonials plugin support
**/
if( in_array('ab-testimonials/ab-testimonials.php', get_option('active_plugins')) ){ //first check if plugin is installed
	$ABdevDND_shortcodes['AB_testimonials'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'category' => array(
				'description' => __('Testimonial Category', 'dnd-shortcodes'),
				'info' => __('Show only testimonials from specific category, displays all categories if not specified (category slug string)', 'dnd-shortcodes'),
			),
			'count' => array(
				'description' => __('Count', 'dnd-shortcodes'),
				'info' => __('Number of testimonials to show', 'dnd-shortcodes'),
				'default' => '8',
			),
			'show_arrows' => array(
				'description' => __('Show Arrows', 'dnd-shortcodes'),
				'type' => 'checkbox',
				'default' => '0',
			),
			'style' => array(
				'default' => '1',
				'type' => 'select',
				'values' => array( 
					'1' => 'Testimonial Big',
					'2' => 'Testimonial Small with Image',
				),
				'description' => __('Style', 'dnd-shortcodes'),
			),
			'fx' => array(
				'default' => 'crossfade',
				'type' => 'select',
				'values' => array( 
					'crossfade' => 'Crossfade',
					'cover-fade' => 'Cover-Fade',
					'fade' => 'Fade',
					'none' => 'None',
				),
				'description' => __('Slide Effect Name', 'dnd-shortcodes'),
			),
			'easing' => array(
				'default' => 'quadratic',
				'type' => 'select',
				'values' => array( 
					'linear' => 'linear',
					'swing' => 'swing',
					'quadratic' => 'quadratic',
					'cubic' => 'cubic',
					'elastic' => 'elastic',
				),
				'description' => __('Slide Effect Easing', 'dnd-shortcodes'),
			),
			'duration' => array(
				'description' => __('Duration', 'dnd-shortcodes'),
				'default' => 1000,
				'info' => __('Duration of slide effect in milliseconds', 'dnd-shortcodes'),
			),
			'pauseOnHover' => array(
				'default' => 'immediate',
				'type' => 'select',
				'values' => array( 
					'false' => 'false',
					'resume' => 'resume',
					'immediate' => 'immediate',
				),
				'description' => __('Pause on Hover', 'dnd-shortcodes'),
				'info' => __('Determines whether the timeout between transitions should be paused "onMouseOver" (only applies when play="true")', 'dnd-shortcodes'),
			),
			'timeoutduration' => array(
				'description' => __('Slide Duration', 'dnd-shortcodes'),
				'default' => 5000,
				'info' => __('Pause between two slide animations in milliseconds', 'dnd-shortcodes'),
			),
			'direction' => array(
				'default' => 'left',
				'type' => 'select',
				'values' => array( 
					'left' => 'left',
					'right' => 'right',
				),
				'description' => __('Slide Direction', 'dnd-shortcodes'),
			),
			'play' => array(
				'description' => __('Autoplay Slider', 'dnd-shortcodes'),
				'type' => 'checkbox',
				'default' => '1',
			),
			'class' => array(
				'description' => __('Class', 'dnd-shortcodes'),
				'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
			),

		),
		'description' => __('AB Testimonials Slider', 'dnd-shortcodes'),
	);

	$ABdevDND_shortcodes['AB_testimonials_submit_form'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'client_placeholder' => array(
				'description' => __('Name field placeholder', 'dnd-shortcodes'),
				'default' => __('Your Name', 'dnd-shortcodes'),
			),
			'client_url_placeholder' => array(
				'description' => __('Profile field placeholder', 'dnd-shortcodes'),
				'default' => __('Your Profile Link', 'dnd-shortcodes'),
			),
			'client_image_placeholder' => array(
				'description' => __('Image upload field label', 'dnd-shortcodes'),
				'default' => __('Your Image', 'dnd-shortcodes'),
			),
			'company_placeholder' => array(
				'description' => __('Company name field placeholder', 'dnd-shortcodes'),
				'default' => __('Your Company', 'dnd-shortcodes'),
			),
			'company_url_placeholder' => array(
				'description' => __('Company link field placeholder', 'dnd-shortcodes'),
				'default' => __('Your Company Link', 'dnd-shortcodes'),
			),
			'text_placeholder' => array(
				'description' => __('Testimonial textarea placeholder', 'dnd-shortcodes'),
				'default' => __('Your Testimonial', 'dnd-shortcodes'),
			),
			'button_text_placeholder' => array(
				'description' => __('Submit button text', 'dnd-shortcodes'),
				'default' => __('Submit Testimonial', 'dnd-shortcodes'),
			),
			'class' => array(
				'description' => __('Class', 'dnd-shortcodes'),
				'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
			),
		),
		'description' => __('AB Testimonial Submit Form', 'dnd-shortcodes'),
	);
}
