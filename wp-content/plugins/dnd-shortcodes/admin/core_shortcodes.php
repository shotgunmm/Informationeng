<?php

/*********** Shortcode: Content Section ************************************************************/

$ABdevDND_shortcodes['section_dd'] = array(
	'hide_in_dnd' => true,
	'nesting' => '1',
	'child' => 'column_dd',
	'child_title' => __('Section Column', 'dnd-shortcodes'),
	'child_button' => __('Add Column', 'dnd-shortcodes'),
	'attributes' => array(
		'section_title' => array(
			'description' => __('Section Title', 'dnd-shortcodes'),
		),
		'section_id' => array(
			'description' => __('Section ID', 'dnd-shortcodes'),
			'info' => __('ID can be used for menu navigation, e.g. #about-us', 'dnd-shortcodes'),
		),
		'section_intro' => array(
			'description' => __('Intro Text', 'dnd-shortcodes'),
		),
		'section_outro' => array(
			'description' => __('Outro Text', 'dnd-shortcodes'),
		),
		'class' => array(
			'description' => __('Class', 'dnd-shortcodes'),
			'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
		),
		'fullwidth' => array(
			'description' => __('Fullwidth Content', 'dnd-shortcodes'),
			'type' => 'checkbox',
			'default' => '0',
		),
		'no_column_margin' => array(
			'description' => __('No Margin on Columns', 'dnd-shortcodes'),
			'type' => 'checkbox',
			'default' => '0',
		),
		'equalize_five' => array(
			'description' => __('5 Columns Equalize', 'dnd-shortcodes'),
			'type' => 'checkbox',
			'default' => '0',
			'info' => __('Check this if you want 5 columns to be equal width (out of grid, use only 2/12 and 3/12 columns)', 'dnd-shortcodes'),
		),
		'bg_color' => array(
			'description' => __('Background Color', 'dnd-shortcodes'),
			'type' => 'color',
		),
		'bg_image' => array(
			'type' => 'image',
			'description' => __('Background Image', 'dnd-shortcodes'),
		),
		'parallax' => array(
			'description' => __('Parallax Amount', 'dnd-shortcodes'),
			'info' => __('Amout of parallax effect on background image, 0.1 means 10% of scroll amount, 2 means twice of scroll amount, leave blank for no parallax', 'dnd-shortcodes'),
		),
		'video_bg' => array(
			'description' => __('Video Background', 'dnd-shortcodes'),
			'type' => 'checkbox',
			'default' => '0',
			'info' => __('If checked video background will be enabled. Video files should have same name as Background Image, and same path, only different extensions (mp4,webm,ogv files required). You can use Miro Converter to convert files in required formats.', 'dnd-shortcodes'),
		),
	),
	'content' => array(
		'default' => 'Columns here',
		'description' => __('Content', 'dnd-shortcodes'),
	),
	'description' => __('Section With Columns', 'dnd-shortcodes'),
	'info' => __("Sum of all column's span attributes must be 12", 'dnd-shortcodes' )
);
function ABdevDND_section_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('section_dd'), $attributes));

	$bg_color_output = ($bg_color!='')?'background-color:'.$bg_color.';' : '';
	$bg_image_output = ($bg_image!='')?' data-background_image="'.$bg_image.'"' : '';
	$parallax_output = ($parallax!='')?' data-parallax="'.$parallax.'"' : '';
	$background_output = ($bg_image!='')?'background-image:url('.$bg_image.');' : '';
	$class .= ($parallax!='') ?' dnd-parallax' : '';
	$class .= ($video_bg==1) ?' dnd-video-bg' : '';
	$class .= ($fullwidth==1) ?' section_body_fullwidth' : '';
	$class .= ($no_column_margin==1) ?' section_no_column_margin' : '';
	$class .= ($equalize_five==1) ?' section_equalize_5' : '';
	$class .= ($section_title!='' || $section_intro!='') ?' section_with_header' : '';

	$section_title = ($section_title!='') ? '<h3>'.$section_title.'</h3>' : '';
	$section_id = ($section_id!='') ? ' id="'.$section_id.'"' : '';
	$section_intro = ($section_intro!='') ? '<p>'.$section_intro.'</p>' : '';
	$section_header = ($section_title!='' || $section_intro!='') ? '<header><div class="dnd_container">'.$section_title.$section_intro.'</div></header>' : '';
	$section_footer = ($section_outro!='') ? '<footer><div class="dnd_container">'.$section_outro.'</div></footer>' : '';

	$video_pi = pathinfo($bg_image);
	$video_no_ext_path = dirname($bg_image).'/'.$video_pi['filename'];
	$video_out=($video_bg==1) ? '<div class="dnd_video_background">
		<div style="max-width: 100%;" class="wp-video">
		<video class="section_video_background" style="max-width:100%;" poster="'.$bg_image.'" loop="1" autoplay="1" preload="metadata" controls="controls">
			<source type="video/mp4" src="'.$video_no_ext_path.'.mp4" />
			<source type="video/webm" src="'.$video_no_ext_path.'.webm" />
			<source type="video/ogg" src="'.$video_no_ext_path.'.ogv" />
		</video>
		</div>
	</div>' : '';

	return '<section'.$section_id.' class="dnd_section_dd '.$class.'"'.$bg_image_output.$parallax_output.' style="'.$bg_color_output.$background_output.'">
		'.$section_header.'
		<div class="dnd_section_content"><div class="dnd_container">'.do_shortcode($content).'</div></div>
		'.$section_footer.'
		'.$video_out.'
	</section>';
}



/*********** Shortcode: Content Column ************************************************************/
$ABdevDND_shortcodes['column_dd'] = array(
	'nesting' => '1',
	'hidden' => '1',
	'hide_in_dnd' => true,
	'attributes' => array(
		'span' => array(
			'default' => '1',
			'description' => __('Span 1-12 Columns', 'dnd-shortcodes'),
		),
		'animation' => array(
			'default' => '',
			'description' => __('Entrance Animation', 'dnd-shortcodes'),
			'type' => 'select',
			'values' => array(
				'' => __('None', 'dnd-shortcodes'),
				'flip' => __('Flip', 'dnd-shortcodes'),
				'flipInX' => __('Flip In X', 'dnd-shortcodes'),
				'flipInY' => __('Flip In Y', 'dnd-shortcodes'),
				'fadeIn' => __('Fade In', 'dnd-shortcodes'),
				'fadeInUp' => __('Fade In Up', 'dnd-shortcodes'),
				'fadeInDown' => __('Fade In Down', 'dnd-shortcodes'),
				'fadeInLeft' => __('Fade In Left', 'dnd-shortcodes'),
				'fadeInRight' => __('Fade In Right', 'dnd-shortcodes'),
				'fadeInUpBig' => __('Fade In Up Big', 'dnd-shortcodes'),
				'fadeInDownBig' => __('Fade In Down Big', 'dnd-shortcodes'),
				'fadeInLeftBig' => __('Fade In Left Big', 'dnd-shortcodes'),
				'fadeInRightBig' => __('Fade In Right Big', 'dnd-shortcodes'),
				'slideInLeft' => __('Slide In Left', 'dnd-shortcodes'),
				'slideInRight' => __('Slide In Right', 'dnd-shortcodes'),
				'bounceIn' => __('Bounce In', 'dnd-shortcodes'),
				'bounceInDown' => __('Bounce In Down', 'dnd-shortcodes'),
				'bounceInUp' => __('Bounce In Up', 'dnd-shortcodes'),
				'bounceInLeft' => __('Bounce In Left', 'dnd-shortcodes'),
				'bounceInRight' => __('Bounce In Right', 'dnd-shortcodes'),
				'rotateIn' => __('Rotate In', 'dnd-shortcodes'),
				'rotateInDownLeft' => __('Rotate In Down Left', 'dnd-shortcodes'),
				'rotateInDownRight' => __('Rotate In Down Right', 'dnd-shortcodes'),
				'rotateInUpLeft' => __('Rotate In Up Left', 'dnd-shortcodes'),
				'rotateInUpRight' => __('Rotate In Up Right', 'dnd-shortcodes'),
				'lightSpeedIn' => __('Light Speed In', 'dnd-shortcodes'),
				'rollIn' => __('Roll In', 'dnd-shortcodes'),
				'flash' => __('Flash', 'dnd-shortcodes'),
				'bounce' => __('Bounce', 'dnd-shortcodes'),
				'shake' => __('Shake', 'dnd-shortcodes'),
				'tada' => __('Tada', 'dnd-shortcodes'),
				'swing' => __('Swing', 'dnd-shortcodes'),
				'wobble' => __('Wobble', 'dnd-shortcodes'),
				'pulse' => __('Pulse', 'dnd-shortcodes'),
			),
		),
		'duration' => array(
			'description' => __('Animation Duration (in ms)', 'dnd-shortcodes'),
			'default' => '1000',
		),		
		'delay' => array(
			'description' => __('Animation Delay (in ms)', 'dnd-shortcodes'),
			'default' => '0',
		),		
		'class' => array(
			'description' => __('Class', 'dnd-shortcodes'),
			'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
		),
	),
	'content' => array(
		'description' => __('Column Content', 'dnd-shortcodes'),
	),
	'description' => __('Column', 'dnd-shortcodes' )
);
function ABdevDND_column_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('column_dd'), $attributes));
	$parametars_out='';
	if($animation!=''){
		$class.= ' dnd-animo';
		$parametars_out = ' data-animation="'.$animation.'" data-duration="'.$duration.'" data-delay="'.$delay.'"';
	}
    return '<div class="dnd_column_dd_span'.$span.' '.$class.'"'.$parametars_out.'>'.do_shortcode($content).'</div>';
}

