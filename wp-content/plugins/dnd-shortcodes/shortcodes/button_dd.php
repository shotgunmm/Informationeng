<?php

/*********** Shortcode: Buttons ************************************************************/

$ABdevDND_shortcodes['button_dd'] = array(
	'attributes' => array(
		'text' => array(
			'description' => __( 'Button Text', 'dnd-shortcodes' ),
			'default' => __( 'Click Here', 'dnd-shortcodes' ),
		),
		'size' => array(
			'description' => __( 'Size', 'dnd-shortcodes' ),
			'default' => 'medium',
			'type' => 'select',
			'values' => array(
				'small' =>  __( 'Small', 'dnd-shortcodes' ),
				'medium' => __( 'Medium', 'dnd-shortcodes' ),
				'large' => __( 'Large', 'dnd-shortcodes' ),
				'xlarge' => __( 'Extra Large', 'dnd-shortcodes' ),
			),
		),
		'color' => array(
			'description' => __( 'Color', 'dnd-shortcodes' ),
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
		'style' => array(
			'description' => __( 'Style', 'dnd-shortcodes' ),
			'default' => 'normal',
			'type' => 'select',
			'values' => array(
				'normal' =>  __( 'Normal', 'dnd-shortcodes' ),
				'rounded' =>  __( 'Rounded', 'dnd-shortcodes' ),
			),
		),
		'url' => array(
			'description' => __( 'URL', 'dnd-shortcodes' ),
		),
		'target' => array(
			'description' => __( 'Target', 'dnd-shortcodes' ),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  __( 'Self', 'dnd-shortcodes' ),
				'_blank' => __( 'Blank', 'dnd-shortcodes' ),
			),
		),
		'class' => array(
			'description' => __('Class', 'dnd-shortcodes'),
			'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
		),
		'icon' => array(
			'description' => __('Icon Name', 'dnd-shortcodes'),
			'info' => __('Optional icon after button text', 'dnd-shortcodes'),
		),
	),
	'description' => __( 'Button', 'dnd-shortcodes' )
);

function ABdevDND_button_dd_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( ABdevDND_extract_attributes('button_dd'), $atts ) );
	
	$class_out = 'dnd-button';
	$class_out .= ' dnd-button_'.$color;
	$class_out .= ' dnd-button_'.$style;
	$class_out .= ' dnd-button_'.$size;
	$class_out .= ' '.$class;

	$icon_out = ($icon!='') ? '<i class="'.$icon.'"></i>' : '';

	return '<a href="'. $url .'" target="' . $target . '" class="'.$class_out.'">' . $text . $icon_out . '</a>';
}


