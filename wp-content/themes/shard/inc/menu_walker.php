<?php


// Allow HTML descriptions in WordPress Menu
remove_filter( 'nav_menu_description', 'strip_tags' );
add_filter( 'wp_setup_nav_menu_item', 'cus_wp_setup_nav_menu_item' );
function cus_wp_setup_nav_menu_item( $menu_item ) {
     $menu_item->description = (isset($menu_item->post_content)) ? do_shortcode(apply_filters( 'nav_menu_description', $menu_item->post_content )) : '';
     return $menu_item;
}


// Menu without icons
class shard_walker_nav_menu extends Walker_Nav_Menu {
 
public function display_element($el, &$children, $max_depth, $depth = 0, $args, &$output){
	$id = $this->db_fields['id'];    

	if(isset($children[$el->$id])){
		$el->classes[] = 'has_children';
	}

	parent::display_element($el, $children, $max_depth, $depth, $args, $output);
}

 
// add classes to ul sub-menus
function start_lvl( &$output, $depth = 0, $args = array() ) {
	// depth dependent classes
	$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
	$display_depth = ( $depth + 1); // because it counts the first submenu as 0
	$classes = array(
		'navi',
		( $display_depth ==1 ? 'first' : '' ),
		( $display_depth >=2 ? 'navi' : '' ),
		'menu-depth-' . $display_depth
		);
	$class_names = implode( ' ', $classes );

	// build html
	$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
}
// add main/sub classes to li's and links
 function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	global $wp_query;
	$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
	
	static $is_first;
	$is_first++;
	// depth dependent classes
	$depth_classes = array(
		( $depth == 0 ? 'main-menu-item' : '' ),
		( $depth >=2 ? 'navi' : '' ),
		( $is_first ==1 ? 'menu-first' : '' ),
		'menu-item-depth-' . $depth
	);
	$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
	// passed classes
	$classes = empty( $item->classes ) ? array() : (array) $item->classes;
	$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

	$is_mega_menu = (strpos($class_names,'mega') !== false) ? true : false;
	$use_desc = (strpos($class_names,'use_desc') !== false) ? true : false;
	$no_title = (strpos($class_names,'no_title') !== false) ? true : false;

	if(!$is_mega_menu){
		$class_names .= ' normal_menu_item';
	}

	// build html
	$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
	// link attributes
	$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

	$html_output = ($use_desc) ? '<div class="description_menu_item">'.$item->description.'</div>' : '';
	$item_output = (!$no_title) ? '<a ' . $attributes . '><span>' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span></a>'.$html_output : $html_output;
	// build html
	$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args ).(($is_mega_menu)?'<div class="sf-mega"><div class="sf-mega-inner clearfix">':'');
}

function end_el( &$output, $item, $depth = 0, $args = array() ) {
	
	$classes = empty( $item->classes ) ? array() : (array) $item->classes;
	$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

	$is_mega_menu = (strpos($class_names,'mega') !== false) ? true : false;
 
    $output .= (($is_mega_menu)?'</div></div>':'') . "</li>\n";
}

}





// Menu with icons
class shard_walker_nav_menu_icons extends Walker_Nav_Menu {
 
public function display_element($el, &$children, $max_depth, $depth = 0, $args, &$output){
	$id = $this->db_fields['id'];    

	if(isset($children[$el->$id])){
		$el->classes[] = 'has_children';
	}

	parent::display_element($el, $children, $max_depth, $depth, $args, $output);
}

 
// add classes to ul sub-menus
function start_lvl( &$output, $depth = 0, $args = array() ) {
	// depth dependent classes
	$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
	$display_depth = ( $depth + 1); // because it counts the first submenu as 0
	$classes = array(
		'navi',
		( $display_depth ==1 ? 'first' : '' ),
		( $display_depth >=2 ? 'navi' : '' ),
		'menu-depth-' . $display_depth
		);
	$class_names = implode( ' ', $classes );

	// build html
	$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
}
// add main/sub classes to li's and links
 function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	global $wp_query;
	$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
	
	static $is_first;
	$is_first++;
	// depth dependent classes
	$depth_classes = array(
		( $depth == 0 ? 'main-menu-item' : '' ),
		( $depth >=2 ? 'navi' : '' ),
		( $is_first ==1 ? 'menu-first' : '' ),
		'menu-item-depth-' . $depth
	);
	$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
	// passed classes
	$classes = empty( $item->classes ) ? array() : (array) $item->classes;
	$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

	$is_mega_menu = (strpos($class_names,'mega') !== false) ? true : false;
	$use_desc = (strpos($class_names,'use_desc') !== false) ? true : false;
	$no_title = (strpos($class_names,'no_title') !== false) ? true : false;

	if(!$is_mega_menu){
		$class_names .= ' normal_menu_item';
	}

	// build html
	$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
	// link attributes
	$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

	$icon='';
	if($depth == 0){  //icon for main menu items
		$icon = $item->description;
		if ($icon != ''){
			$icon = '<i class="'.$icon.'"></i>';
		}
		else{
			$icon = '<div class="menu-placeholder"></div>';
		}
	}

	$html_output = ($use_desc) ? '<div class="description_menu_item">'.$item->description.'</div>' : '';
	$item_output = (!$no_title) ? '<a ' . $attributes . '>' . $icon . '<span>' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span></a>'.$html_output : $html_output;
	// build html
	$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args ).(($is_mega_menu)?'<div class="sf-mega"><div class="sf-mega-inner clearfix">':'');

}

function end_el( &$output, $item, $depth = 0, $args = array() ) {
	
	$classes = empty( $item->classes ) ? array() : (array) $item->classes;
	$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

	$is_mega_menu = (strpos($class_names,'mega') !== false) ? true : false;
 
    $output .= (($is_mega_menu)?'</div></div>':'') . "</li>\n";
}

}
