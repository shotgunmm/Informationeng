<?php

/*********** Shortcode: Search ************************************************************/
$ABdevDND_shortcodes['search_dd'] = array(
	'attributes' => array(
		'label' => array(
			'description' => __('Label', 'dnd-shortcodes'),
			'default' => __('Search', 'dnd-shortcodes'),
		),
		'class' => array(
			'description' => __('Class', 'dnd-shortcodes'),
			'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
		),
	),
	'description' => __('Search Field', 'dnd-shortcodes' )
);
function ABdevDND_search_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('search_dd'), $attributes));

	$return = '
		<div class="dnd_search">
			<form name="search" id="search" method="get" action="'.home_url().'">
				<input name="s" type="text" placeholder="'.$label.'" value="'.get_search_query().'">
				<a class="submit"><i class="ABdev_icon-search"></i></a>
			</form>
		</div>';

	return $return;
}

