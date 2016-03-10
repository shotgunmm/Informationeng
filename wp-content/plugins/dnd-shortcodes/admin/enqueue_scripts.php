<?php 

function ABdevDND_enqueue_admin_scripts($hook) {

	$options = get_option( 'dnd_settings' );
	$dnd_disable_on = (isset($options['dnd_disable_on'])) ? explode(',', $options['dnd_disable_on'])  : array();
	$dnd_disable_on = array_map('trim',$dnd_disable_on);

	if(in_array(ABdevDND_get_current_post_type(), $dnd_disable_on)){
		return;
	}
	
	if(($hook != 'post.php' && $hook != 'post-new.php')){
		return;
	}
	
	wp_enqueue_style('thickbox');
	wp_enqueue_style('wp-color-picker');
	wp_enqueue_style('dnd-shortcodes-fancybox', DND_SHORTCODES_DIR.'css/jquery.fancybox-1.3.4.css', array(), DND_VERSION);
	wp_enqueue_style('dnd-cleditor', DND_SHORTCODES_DIR.'cleditor/jquery.cleditor.css', array(), DND_VERSION);
	wp_enqueue_style('dnd-shortcodes-mCustomScrollbar', DND_SHORTCODES_DIR.'css/jquery.mCustomScrollbar.css', array(), DND_VERSION);
	wp_enqueue_style('dnd-shortcodes-ddtab', DND_SHORTCODES_DIR.'css/ddtab.css', array(), DND_VERSION);
	wp_enqueue_media();
	wp_enqueue_script('thickbox');
	wp_enqueue_script('dnd-shortcodes-fancybox', DND_SHORTCODES_DIR.'js/jquery.fancybox-1.3.4.js', array('jquery'), DND_VERSION);
	wp_enqueue_script('dnd-cleditor', DND_SHORTCODES_DIR.'cleditor/jquery.cleditor.min.js', array('jquery'), DND_VERSION);
	wp_enqueue_script('dnd-shortcodes-mousewheel', DND_SHORTCODES_DIR.'js/jquery.mousewheel.js', array('jquery'), DND_VERSION);
	wp_enqueue_script('dnd-shortcodes-mCustomScrollbar', DND_SHORTCODES_DIR.'js/jquery.mCustomScrollbar.js', array('jquery','dnd-shortcodes-mousewheel'), DND_VERSION);
	wp_enqueue_script('dnd-shortcodes-cookie', DND_SHORTCODES_DIR.'js/jquery.cookie.js', array('jquery'), DND_VERSION);
	wp_enqueue_script('dnd-shortcodes-ddtab', DND_SHORTCODES_DIR.'js/ddtab.js', array('dnd-shortcodes-mCustomScrollbar', 'dnd-cleditor', 'wp-color-picker','jquery-ui-sortable','jquery-ui-resizable','dnd-shortcodes-fancybox'), DND_VERSION,true);
	wp_localize_script('dnd-shortcodes-ddtab', 'dnd_from_WP', array(
		'plugins_url' => plugins_url('dnd-shortcodes'),
		'ABdevDND_shortcode_names' => ABdevDND_shortcode_names(),
		'ABdevDND_3rd_party' => ABdevDND_3rd_party(),
		'saved_layouts' => implode("|", array_keys(get_option('dnd_shortcodes_layouts',array()))),
		'save' => __('Save', 'dnd-shortcodes'),
		'error_to_editor' => __('<b>Content cannot be parsed</b><br>Please use Text tab instead or Revisions option to undo recently made changes.<br><br>Check the syntax:<br>- Use double quotes for attributes<br>- Every shortcode must be closed. e.g. [gallery ids="1,20"] should be [gallery ids="1,20"][/gallery]', 'dnd-shortcodes'),
		'delete_section' => __('Delete Section', 'dnd-shortcodes'),
		'duplicate_section' => __('Duplicate Section', 'dnd-shortcodes'),
		'edit_section' => __('Edit Section', 'dnd-shortcodes'),
		'remove_column' => __('Remove Column', 'dnd-shortcodes'),
		'add_column' => __('Add Column', 'dnd-shortcodes'),
		'add_element' => __('Add Element', 'dnd-shortcodes'),
		'edit_column' => __('Edit Column', 'dnd-shortcodes'),
		'text' => __('Text', 'dnd-shortcodes'),
		'delete_element' => __('Delete Element', 'dnd-shortcodes'),
		'duplicate_element' => __('Duplicate Element', 'dnd-shortcodes'),
		'edit_element' => __('Edit Element', 'dnd-shortcodes'),
		'drag_and_drop' => __('Drag & Drop', 'dnd-shortcodes'),
		'add_edit_shortcode' => __('Add / Edit Shortcode', 'dnd-shortcodes'),
		'add_section' => __('Add Section', 'dnd-shortcodes'),
		'layout_save' => __('Save Layout', 'dnd-shortcodes'),
		'layout_delete' => __('Delete Layout', 'dnd-shortcodes'),
		'layout_name' => __('Enter layout name', 'dnd-shortcodes'),
		'layout_name_delete' => __('Layout name to delete', 'dnd-shortcodes'),
		'layout_saved' => __('Layout successfully saved', 'dnd-shortcodes'),
		'layout_select_saved_first' => __('Select saved layout to load', 'dnd-shortcodes'),
		'layout_select_saved_second' => __('or', 'dnd-shortcodes'),
		'rearange_sections' => __('Rearange Sections', 'dnd-shortcodes'),
		'are_you_sure' => __('Are you sure?', 'dnd-shortcodes'),
		'custom_column_class' => __('Custom Column Class', 'dnd-shortcodes'),
		'animation' => __('Animation', 'dnd-shortcodes'),
		'none' => __('None', 'dnd-shortcodes'),
		'animation_duration' => __('Animation Duration ms', 'dnd-shortcodes'),
		'animation_delay' => __('Animation Delay ms', 'dnd-shortcodes'),
		'custom_section_class' => __('Custom Section Class', 'dnd-shortcodes'),
		'fullwidth' => __('Fullwidth Content', 'dnd-shortcodes'),
		'no_column_margin' => __('No Margin on Columns', 'dnd-shortcodes'),
		'equalize_five' => __('5 Columns Equalize', 'dnd-shortcodes'),
		'equalize_five_info' => __('Check this if you want 5 columns to be equal width (out of grid, use only 2/12 and 3/12 columns)', 'dnd-shortcodes'),
		'video_bg' => __('Video Background', 'dnd-shortcodes'),
		'video_bg_info' => __('If checked video background will be enabled. Video files should have same name as Background Image, and same path, only different extensions (mp4,webm,ogv files required). You can use Miro Converter to convert files in required formats.', 'dnd-shortcodes'),
		'background_color' => __('Background Color', 'dnd-shortcodes'),
		'background_image' => __('Background Image URL', 'dnd-shortcodes'),
		'parallax' => __('Background Parallax Factor', 'dnd-shortcodes'),
		'parallax_info' => __('0.1 means 10% of scroll, 2 means twice of scroll', 'dnd-shortcodes'),
		'flip' => __( 'Flip', 'dnd-shortcodes' ),
		'flipInX' => __( 'Flip In X', 'dnd-shortcodes' ),
		'flipInY' => __( 'Flip In Y', 'dnd-shortcodes' ),
		'fadeIn' => __( 'Fade In', 'dnd-shortcodes' ),
		'fadeInUp' => __( 'Fade In Up', 'dnd-shortcodes' ),
		'fadeInDown' => __( 'Fade In Down', 'dnd-shortcodes' ),
		'fadeInLeft' => __( 'Fade In Left', 'dnd-shortcodes' ),
		'fadeInRight' => __( 'Fade In Right', 'dnd-shortcodes' ),
		'fadeInUpBig' => __( 'Fade In Up Big', 'dnd-shortcodes' ),
		'fadeInDownBig' => __( 'Fade In Down Big', 'dnd-shortcodes' ),
		'fadeInLeftBig' => __( 'Fade In Left Big', 'dnd-shortcodes' ),
		'fadeInRightBig' => __( 'Fade In Right Big', 'dnd-shortcodes' ),
		'slideInLeft' => __( 'Slide In Left', 'dnd-shortcodes' ),
		'slideInRight' => __( 'Slide In Right', 'dnd-shortcodes' ),
		'bounceIn' => __( 'Bounce In', 'dnd-shortcodes' ),
		'bounceInDown' => __( 'Bounce In Down', 'dnd-shortcodes' ),
		'bounceInUp' => __( 'Bounce In Up', 'dnd-shortcodes' ),
		'bounceInLeft' => __( 'Bounce In Left', 'dnd-shortcodes' ),
		'bounceInRight' => __( 'Bounce In Right', 'dnd-shortcodes' ),
		'rotateIn' => __( 'Rotate In', 'dnd-shortcodes' ),
		'rotateInDownLeft' => __( 'Rotate In Down Left', 'dnd-shortcodes' ),
		'rotateInDownRight' => __( 'Rotate In Down Right', 'dnd-shortcodes' ),
		'rotateInUpLeft' => __( 'Rotate In Up Left', 'dnd-shortcodes' ),
		'rotateInUpRight' => __( 'Rotate In Up Right', 'dnd-shortcodes' ),
		'lightSpeedIn' => __( 'Light Speed In', 'dnd-shortcodes' ),
		'rollIn' => __( 'Roll In', 'dnd-shortcodes' ),
		'flash' => __( 'Flash', 'dnd-shortcodes' ),
		'bounce' => __( 'Bounce', 'dnd-shortcodes' ),
		'shake' => __( 'Shake', 'dnd-shortcodes' ),
		'tada' => __( 'Tada', 'dnd-shortcodes' ),
		'swing' => __( 'Swing', 'dnd-shortcodes' ),
		'wobble' => __( 'Wobble', 'dnd-shortcodes' ),
		'pulse' => __( 'Pulse', 'dnd-shortcodes' ),
		'upload_image' => __( 'Upload Image', 'dnd-shortcodes' ),
		'choose_image' => __( 'Choose Image', 'dnd-shortcodes' ),
		'use_image' => __( 'Use Image', 'dnd-shortcodes' ),
		'section_title' => __( 'Section Title', 'dnd-shortcodes' ),
		'section_id' => __( 'Section ID', 'dnd-shortcodes' ),
		'section_intro' => __( 'Section Intro', 'dnd-shortcodes' ),
		'section_outro' => __( 'Section Outro', 'dnd-shortcodes' ),
	));
}
add_action( 'admin_enqueue_scripts', 'ABdevDND_enqueue_admin_scripts' );



function ABdevDND_enqueue_frontend_script() {

	wp_enqueue_style('wp-mediaelement');
	
	wp_enqueue_style('dnd_icons_default', DND_SHORTCODES_DIR.'css/icons-default.css', array(), DND_VERSION);

	$options = get_option( 'dnd_settings' );
	if(isset($options['dnd_enable_fa']) && $options['dnd_enable_fa']==1){
		wp_enqueue_style('dnd_icons_fa', DND_SHORTCODES_DIR.'css/icons-fa.css', array(), DND_VERSION);
	}
	if(isset($options['dnd_enable_whhg']) && $options['dnd_enable_whhg']==1){
		wp_enqueue_style('dnd_icons_whhg', DND_SHORTCODES_DIR.'css/icons-whhg.css', array(), DND_VERSION);
	}
	
	wp_enqueue_style('ABdev_animo-animate', DND_SHORTCODES_DIR.'css/animo-animate.css', array(), DND_VERSION);
	wp_enqueue_style('ABdev_prettify', DND_SHORTCODES_DIR.'css/prettify.css', array(), DND_VERSION);
	if(is_file(get_stylesheet_directory().'/css/dnd-shortcodes.css')){
		wp_enqueue_style('ABdev_shortcodes', get_stylesheet_directory_uri().'/css/dnd-shortcodes.css', array('ABdev_animo-animate', 'ABdev_prettify'), DND_VERSION);
	}
	else{
		wp_enqueue_style('ABdev_shortcodes', DND_SHORTCODES_DIR.'css/shortcodes-default.css', array('ABdev_animo-animate', 'ABdev_prettify'), DND_VERSION);
	}
	wp_enqueue_style('ABdev_shortcodes_responsive', DND_SHORTCODES_DIR.'css/responsive.css', array('ABdev_shortcodes'), DND_VERSION);
	wp_enqueue_script('wp-mediaelement');
	wp_enqueue_script('prettify', DND_SHORTCODES_DIR.'js/prettify.js', DND_VERSION, true);
	wp_enqueue_script('google_maps_api', 'http://maps.google.com/maps/api/js?sensor=false','','', true);
	wp_enqueue_script('google_maps_jquery', DND_SHORTCODES_DIR.'js/jquery.gmap.min.js', array('jquery', 'google_maps_api'), DND_VERSION, true);
	wp_enqueue_script('animo', DND_SHORTCODES_DIR.'js/animo.js', array('jquery'), DND_VERSION, true);
	wp_enqueue_script('inview', DND_SHORTCODES_DIR.'js/jquery.inview.js', array('jquery'), DND_VERSION, true);
	wp_enqueue_script('parallax', DND_SHORTCODES_DIR.'js/jquery.parallax-1.1.3.js', array('jquery'), DND_VERSION, true);
	wp_enqueue_script('tipsy', DND_SHORTCODES_DIR.'js/jquery.tipsy.js', array('jquery'), DND_VERSION, true);
	wp_enqueue_script('knob', DND_SHORTCODES_DIR.'js/jquery.knob-custom.js', array('jquery'), DND_VERSION, true);

	$options = get_option( 'dnd_settings' );
	$dnd_tipsy_opacity = (isset($options['dnd_tipsy_opacity'])) ? $options['dnd_tipsy_opacity'] : '0.8';

	wp_enqueue_script('dnd-shortcodes', DND_SHORTCODES_DIR.'js/init.js', array('jquery', 'jquery-ui-accordion', 'jquery-ui-tabs', 'jquery-effects-slide', 'animo', 'google_maps_jquery', 'parallax', 'inview' , 'tipsy' , 'knob' , 'prettify'), DND_VERSION, true);
	wp_localize_script( 'dnd-shortcodes', 'dnd_options', array( 
		'dnd_tipsy_opacity' => $dnd_tipsy_opacity, 
	) );
}
add_action( 'wp_enqueue_scripts', 'ABdevDND_enqueue_frontend_script' );

