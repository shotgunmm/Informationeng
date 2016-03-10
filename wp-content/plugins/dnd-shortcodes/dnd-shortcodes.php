<?php
/*
Plugin Name: Drag and Drop Shortcodes
Plugin URI: http://themeforest.net/user/ab-themes?ref=ab-themes
Description: Visual drag and drop page builder containing great collection of animated shortcodes with paralax effects and video backgrounds
Version: 2.1.0
Author: ab-themes
Author URI: http://themeforest.net/user/ab-themes?ref=ab-themes
*/


define('DND_SHORTCODES_DIR', plugin_dir_url( __FILE__ ));
define('DND_VERSION', '2.1.0');

global $ABdevDND_shortcodes;
$ABdevDND_shortcodes = array();


require_once 'admin/options_page.php';
require_once 'admin/functions.php';
require_once 'admin/core_shortcodes.php';

if(is_dir(get_stylesheet_directory().'/dnd')){
	$theme_override = scandir(get_stylesheet_directory().'/dnd');
}

/*
Files from dnd folder (in theme's root) will be included instead same named plugin shortcode files. And after that files from dnd/additional folder will be included.
That way theme can override any plugin's shortcode (same file in dnd folder) or add some new shortcodes (dnd/additional).
**/

/* Include shortcodes form plugin or theme (if overridden) */
$files = scandir(dirname( __FILE__ ) . '/shortcodes');
foreach($files as $file) {
	if(is_file(dirname( __FILE__ ) . '/shortcodes/'.$file)){
		if(isset($theme_override) && is_array($theme_override) && in_array($file, $theme_override)){
  			include_once (get_stylesheet_directory() . '/dnd/'.$file);
		}else{
  			include_once (dirname( __FILE__ ) . '/shortcodes/'.$file);
		}
	}
}

/* Include 3rd-party shortcode definitions */
$files = scandir(dirname( __FILE__ ) . '/shortcodes/3rd-party');
foreach($files as $file) {
	if(is_file(dirname( __FILE__ ) . '/shortcodes/3rd-party/'.$file)){
  		include_once (dirname( __FILE__ ) . '/shortcodes/3rd-party/'.$file);
	}
}

/* Include theme's additional shortcodes */
if(is_dir(get_stylesheet_directory().'/dnd/additional')){
	$files = scandir(get_stylesheet_directory() . '/dnd/additional');
	foreach($files as $file) {
		if(is_file(get_stylesheet_directory() . '/dnd/additional/'.$file)){
	  		include_once (get_stylesheet_directory() . '/dnd/additional/'.$file);
		}
	}
}



require_once 'admin/enqueue_scripts.php';


function ABdevDND_add_sidebars() {
	$options = get_option( 'dnd_settings' );
	$dnd_sidebars = (isset($options['dnd_sidebars'])) ? explode(',', $options['dnd_sidebars'])  : array();
	$dnd_sidebars = array_map('trim',$dnd_sidebars);
	$dnd_sidebars = array_filter($dnd_sidebars);

	if(is_array($dnd_sidebars)){
		foreach($dnd_sidebars as $sidebar){
			register_sidebar(array(
				'name'=>$sidebar,
				'id'            => 'dd_'.ABdevDND_name_to_id($sidebar),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<div class="sidebar-widget-heading"><h3>',
				'after_title' => '</h3></div>',
			));
		}
	}
}
add_action('widgets_init', 'ABdevDND_add_sidebars');




function ABdevDND_plugins_loaded() {
	add_filter('widget_text', 'do_shortcode');
	load_plugin_textdomain('dnd-shortcodes', false, dirname(plugin_basename( __FILE__ )).'/languages/');

	foreach (ABdevDND_shortcodes() as $shortcode=>$params) {
		if (empty($params['third_party']) || $params['third_party']!=1){
			add_shortcode( $shortcode, 'ABdevDND_'.$shortcode.'_shortcode');
			add_shortcode( str_replace('_dd', '_DD', $shortcode), 'ABdevDND_'.str_replace('_dd', '_DD', $shortcode).'_shortcode');  // support for uppercase version of shortcode suffix 
		}
		if (isset($params['nesting']) && $params['nesting']!=''){
			add_shortcode( $shortcode.'_child', 'ABdevDND_'.$shortcode.'_shortcode');
			add_shortcode( str_replace('_dd', '_DD', $shortcode).'_child', 'ABdevDND_'.str_replace('_dd', '_DD', $shortcode).'_shortcode');  // support for uppercase version of shortcode suffix 
		}
	}

}
add_action('plugins_loaded', 'ABdevDND_plugins_loaded');


function ABdevDND_save_layout(){
	global $wpdb; 
	add_option( 'dnd_shortcodes_layouts', '', '', 'no' );
	$layouts = get_option( 'dnd_shortcodes_layouts', array() );
	$name = $_POST['name'];
	$i = 1;
	while(isset($layouts[$name])){
		$i++;
		$name = $_POST['name'] . '_' . $i;
	}
	$layouts[$name]=$_POST['layout'];
	update_option('dnd_shortcodes_layouts', $layouts);
	die(__('Layout Saved', 'dnd-shortcodes'));
}
add_action('wp_ajax_ABdevDND_save_layout', 'ABdevDND_save_layout');

function ABdevDND_delete_layout(){
	global $wpdb; 
	$name = $_POST['name'];
	$layouts = get_option('dnd_shortcodes_layouts', '');
	if(isset($layouts[$name])){
		unset($layouts[$name]);
		update_option('dnd_shortcodes_layouts', $layouts);
		$out=__('Layout Deleted', 'dnd-shortcodes');
	}
	else{
		$out=__('Layout doesn\'t exist', 'dnd-shortcodes');
	}
	die($out);
}
add_action('wp_ajax_ABdevDND_delete_layout', 'ABdevDND_delete_layout');

function ABdevDND_load_layout(){
	global $wpdb; 
	$layouts = get_option('dnd_shortcodes_layouts', '');
	$out = str_replace('\"', '"', $layouts[$_POST['selected_layout']]);
	die($out);
}
add_action('wp_ajax_ABdevDND_load_layout', 'ABdevDND_load_layout');

