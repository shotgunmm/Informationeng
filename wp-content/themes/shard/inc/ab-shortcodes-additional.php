<?php 

// ***************** 3rd party shortcode support ***************************************


// *************** ab-testimonials plugin support ********************

if( in_array('ab-testimonials/ab-testimonials.php', get_option('active_plugins')) ){
	$ABdev_shortcodes['AB_testimonials'] = array(
		'name' => 'AB_testimonials',
		'type' => 'single',
		'third_party' => 1, 
		'atts' => array(
			'category' => array(
				'desc' => __( 'Testimonial Category', 'ABdev_shard' ),
			),
			'count' => array(
				'desc' => __( 'Number of Testimonials to Show', 'ABdev_shard' ),
				'default' => '8',
			),
			'show_arrows' => array(
				'default' => '0',
				'type' => 'checkbox',
				'desc' => __( 'Show Navigation Arrows', 'ABdev_shard' ),
			),
			'timeoutduration' => array(
				'desc' => __( 'Delay', 'ABdev_shard' ),
				'default' => '5000',
			),
			'duration' => array(
				'desc' => __( 'Animation Duration', 'ABdev_shard' ),
				'default' => '1000',
			),
			'style' => array(
				'desc' => __( 'Style', 'ABdev_shard' ),
				'default' => '1',
				'values' => array(
					'1' =>  __( 'Big without image', 'ABdev_shard' ),
					'2' => __( 'Small with image', 'ABdev_shard' ),
				),
			),
			'fx' => array(
				'desc' => __( 'Transition Effect', 'ABdev_shard' ),
				'default' => 'crossfade',
				'values' => array(
					'none' =>  __( 'None', 'ABdev_shard' ),
					'fade' =>  __( 'Fade', 'ABdev_shard' ),
					'crossfade' =>  __( 'Crossfade', 'ABdev_shard' ),
					'cover-fade' =>  __( 'Cover Fade', 'ABdev_shard' ),
				),
			),
			'easing' => array(
				'desc' => __( 'Easing Effect', 'ABdev_shard' ),
				'default' => 'quadratic',
				'values' => array(
					'linear' =>  __( 'Linear', 'ABdev_shard' ),
					'swing' =>  __( 'Swing', 'ABdev_shard' ),
					'quadratic' =>  __( 'Quadratic', 'ABdev_shard' ),
					'cubic' =>  __( 'Cubic', 'ABdev_shard' ),
					'elastic' =>  __( 'Elastic', 'ABdev_shard' ),
				),
			),
			'direction' => array(
				'desc' => __( 'Slide Direction', 'ABdev_shard' ),
				'default' => 'left',
				'values' => array(
					'left' =>  __( 'Left', 'ABdev_shard' ),
					'right' =>  __( 'Right', 'ABdev_shard' ),
				),
			),
			'play' => array(
				'default' => '0',
				'type' => 'checkbox',
				'desc' => __( 'Autoplay', 'ABdev_shard' ),
			),
			'pauseOnHover' => array(
				'desc' => __( 'Pause on Hover', 'ABdev_shard' ),
				'default' => 'immediate',
				'values' => array(
					'false' =>  __( 'No', 'ABdev_shard' ),
					'resume' =>  __( 'Resume', 'ABdev_shard' ),
					'immediate' =>  __( 'Immediate', 'ABdev_shard' ),
				),
			),
			'class' => array(
				'default' => '',
				'desc' => __( 'Class', 'ABdev_shard' ),
			),
		),
		'desc' => __( 'AB Testimonial Slider', 'ABdev_shard' )
	);
}