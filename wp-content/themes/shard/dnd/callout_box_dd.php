<?php

/*********** Shortcode: Callout box ************************************************************/

$ABdevDND_shortcodes['callout_box_dd'] = array(
	'attributes' => array(
		'title' => array(
			'description' => __( 'Title', 'dnd-shortcodes' ),
		),
		'no_button' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __( 'No Button', 'dnd-shortcodes' ),
		),
		'button_text' => array(
			'description' => __( 'Button Text', 'dnd-shortcodes' ),
			'default' => __( 'Click Here', 'dnd-shortcodes' ),
		),
		'button_size' => array(
			'description' => __( 'Button Size', 'dnd-shortcodes' ),
			'default' => 'medium',
			'type' => 'select',
			'values' => array(
				'small' =>  __( 'Small', 'dnd-shortcodes' ),
				'medium' => __( 'Medium', 'dnd-shortcodes' ),
				'large' => __( 'Large', 'dnd-shortcodes' ),
				'xlarge' => __( 'Extra Large', 'dnd-shortcodes' ),
			),
		),
		'button_color' => array(
			'description' => __( 'Button Color', 'dnd-shortcodes' ),
			'default' => 'light',
			'type' => 'select',
			'values' => array(
				'light' =>  __( 'Light', 'dnd-shortcodes' ),
				'dark' =>  __( 'Dark', 'dnd-shortcodes' ),
				'yellow' =>  __( 'Yellow', 'dnd-shortcodes' ),
				'green' =>  __( 'Green', 'dnd-shortcodes' ),
				'red' =>  __( 'Red', 'dnd-shortcodes' ),
				'blue' =>  __( 'Blue', 'dnd-shortcodes' ),
				'gray' =>  __( 'Gray', 'dnd-shortcodes' ),
				'cyan' =>  __( 'Cyan', 'dnd-shortcodes' ),
				'aquamarine' =>  __( 'Aquamarine', 'dnd-shortcodes' ),
			),
		),
		'button_style' => array(
			'description' => __( 'Button Style', 'dnd-shortcodes' ),
			'default' => 'normal',
			'type' => 'select',
			'values' => array(
				'normal' =>  __( 'Normal', 'dnd-shortcodes' ),
				'rounded' =>  __( 'Rounded', 'dnd-shortcodes' ),
			),
		),
		'button_url' => array(
			'description' => __( 'Button URL', 'dnd-shortcodes' ),
		),
		'button_target' => array(
			'default' => '_self',
			'type' => 'select',
			'description' => __( 'Button Target', 'dnd-shortcodes' ),
			'values' => array(
				'_self' =>  __( 'Self', 'dnd-shortcodes' ),
				'_blank' => __( 'Blank', 'dnd-shortcodes' ),
			),
		),
		'button_icon' => array(
			'description' => __('Button Icon Name', 'dnd-shortcodes'),
			'info' => __('Optional icon after button text', 'dnd-shortcodes'),
		),
		'class' => array(
			'description' => __('Class', 'dnd-shortcodes'),
			'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
		),
	),
	'content' => array(
		'description' => __( 'Content', 'dnd-shortcodes' ),
	),
	'description' => __( 'Callout Box', 'dnd-shortcodes' )

);

function ABdevDND_callout_box_dd_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( ABdevDND_extract_attributes('callout_box_dd'), $atts ) );
	
	$class = ($no_button == '1') ? 'dnd-callout_box_no_button '.$class : $class;

	$button_class_out = 'dnd-button';
	$button_class_out .= ' dnd-button_'.$button_color;
	$button_class_out .= ' dnd-button_'.$button_style;
	$button_class_out .= ' dnd-button_'.$button_size;
	$button_icon_out = ($button_icon!='') ? '<i class="'.$button_icon.'"></i>' : '';

	$return = '<div class="dnd-callout_box '.$class.'">';
	
	if ( $no_button != '1' ){
		$return .= '<div class="dnd_container"><div class="dnd_column_dd_span9">';
	}

	$return .= '<span class="dnd-callout_box_title">'.$title.'</span>
		<p>'.do_shortcode($content).'</p>';
	
	if ( $no_button != '1' ){
		$return .= '</div>
				<div class="dnd_column_dd_span3">
					<a href="'. $button_url .'" target="' . $button_target . '" class="'.$button_class_out.'">'.$button_text.$button_icon_out.'</a>
				</div>
			</div>';
	} 

	$return .= '</div>';

	return $return;
}



