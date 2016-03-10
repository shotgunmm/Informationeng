<?php
define('THEME_NAME', 'Shard');
define('THEME_VERSION', '1.0.0');
define('TEMPPATH', get_template_directory_uri());
define('IMAGES', TEMPPATH . "/images");


/********* Load Redux Options Framework ***********/
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/inc/redux/ReduxCore/framework.php' ) ) {
	require_once( dirname( __FILE__ ) . '/inc/redux/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/inc/redux.php' ) ) {
	require_once( dirname( __FILE__ ) . '/inc/redux.php' );
}

/********* AB Shortcodes Plugin - Additional Shortcodes ***********/
require_once 'inc/ab-shortcodes-additional.php';


add_action('after_setup_theme', 'ABdev_shard_theme_setup');

if ( ! function_exists( 'ABdev_shard_theme_setup' ) ){
	function ABdev_shard_theme_setup(){

		global $shard_options;

		add_theme_support( 'post-thumbnails' ); 
		add_theme_support('automatic-feed-links');

		require_once 'inc/activate_plugins.php';

		if( !isset($content_width) ){
			$content_width = 1060;
		}

		load_theme_textdomain('ABdev_shard', get_template_directory() . '/languages');

		if(isset($shard_options['sidebars']) && is_array($shard_options['sidebars'])){
			foreach($shard_options['sidebars'] as $sidebar){
				$sidebar_class = ABdev_shard_name_to_class($sidebar);
				register_sidebar(array(
					'name'=>$sidebar,
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<div class="sidebar-widget-heading"><h3>',
					'after_title' => '</h3></div>',
				));
			}
		}

		/********* Register sidebars ***********/
		require_once 'inc/sidebars.php';

		/*****Widgets!******/
		add_filter('widget_text', 'do_shortcode');
		require_once 'inc/widgets/contact-info.php';
		require_once 'inc/widgets/flickr.php';

		/*****Breadcrumbs!******/
		require_once 'inc/breadcrumbs.php';

		/********* Additional fields in page and post editor ***********/
		require_once 'inc/admin/page_additional_fields.php';
		require_once 'inc/admin/post_additional_fields.php';

		/********* Additional fields in categories ***********/
		require_once 'inc/admin/categories_additional_fields.php';

		add_action( 'wp_enqueue_scripts', 'ABdev_shard_scripts');
		add_action('admin_enqueue_scripts', 'ABdev_load_admin_menu_script');

		add_action('init', 'ABdev_shard_register_my_menus');
		add_filter( 'the_content_more_link', 'ABdev_shard_remove_more_link_scroll_wrap');

		
		require_once 'inc/menu_walker.php';
		if ( ! function_exists( 'ABdev_shard_register_my_menus' ) ){
			function ABdev_shard_register_my_menus(){
				register_nav_menus(array(
					'header-menu'  => __('Header Menu', 'ABdev_shard'),
				));
			}
		}
	}
}

/********* Menu  ***********/

if ( ! function_exists( 'ABdev_shard_scripts' ) ){
	function ABdev_shard_scripts() {
		global $shard_options;

		wp_enqueue_style('font_css','//fonts.googleapis.com/css?family=Lato:100,300,400,700');
		wp_enqueue_style('ABdev_icomoon', TEMPPATH.'/css/icomoon.css', array(), THEME_VERSION);
		wp_enqueue_style('fancybox', TEMPPATH.'/css/jquery.fancybox-1.3.4.css', array(), THEME_VERSION);
		wp_enqueue_style('main_css', get_stylesheet_uri(), array('font_css','ABdev_icomoon','fancybox'), THEME_VERSION);

		if(isset($shard_options['disable_responsiveness']) && $shard_options['disable_responsiveness'] != '1'){
			wp_enqueue_style('responsive_css', TEMPPATH.'/css/responsive.css', array('main_css'), THEME_VERSION);
		}

		$custom_css = '';
		include 'inc/colors.php'; //colors from options - appends styles to $custom_css variable
		$custom_css .= (isset($shard_options['custom_css'])) ? $shard_options['custom_css'] : '';
		wp_add_inline_style('main_css', $custom_css);

		wp_enqueue_script( 'inview', TEMPPATH.'/js/jquery.inview.js', array( 'jquery' ), THEME_VERSION, true );
		wp_enqueue_script( 'placeholder', TEMPPATH.'/js/jquery.placeholder.min.js', array( 'jquery' ), THEME_VERSION, true );
		wp_enqueue_script( 'isotope', TEMPPATH.'/js/jquery.isotope.min.js', array( 'jquery' ), THEME_VERSION, true );
		wp_enqueue_script( 'fancybox', TEMPPATH.'/js/jquery.fancybox-1.3.4.js', array( 'jquery' ), THEME_VERSION, true );
		wp_enqueue_script( 'knob', TEMPPATH.'/js/jquery.knob.js', array( 'jquery' ), THEME_VERSION, true );
		wp_enqueue_script( 'superfish', TEMPPATH.'/js/superfish.js', array( 'jquery' ), THEME_VERSION, true );
		wp_enqueue_script( 'masonry', TEMPPATH.'/js/masonry.pkgd.min.js', array( 'jquery'), THEME_VERSION, true );
		wp_enqueue_script( 'imagesloaded', TEMPPATH.'/js/imagesloaded.pkgd.min.js', array( 'jquery'), THEME_VERSION, true );
		wp_enqueue_script( 'jpreloader', TEMPPATH.'/js/jpreloader.js', array( 'jquery'), THEME_VERSION, true );
		wp_enqueue_script( 'waypoints', TEMPPATH.'/js/waypoints.js', array( 'jquery'), THEME_VERSION, true );
		wp_enqueue_script( 'shard_custom', TEMPPATH.'/js/custom.js', array( 'inview','superfish','placeholder','jpreloader','waypoints','knob','isotope','masonry','imagesloaded','fancybox','google_maps_jquery' ), THEME_VERSION, true );
		wp_enqueue_script( 'smthscrll', TEMPPATH.'/js/sscr.js', '', THEME_VERSION, true );
	}
}

if ( ! function_exists( 'ABdev_load_admin_menu_script' ) ){
	function ABdev_load_admin_menu_script($hook) {
		if( $hook != 'nav-menus.php') 
			return;
		wp_enqueue_script( 'ABdev_additional_menu_fields', TEMPPATH.'/js/admin_additional_menu_fields.js' );
	}
}

if ( ! function_exists( 'ABdev_shard_remove_more_link_scroll_wrap' ) ){
	function ABdev_shard_remove_more_link_scroll_wrap( $link ) {
		$link = preg_replace( '|#more-[0-9]+|', '', $link );
	    return '<div class="post-readmore">'.$link.'</div>';
	}
}

if ( ! function_exists( 'ABdev_shard_search_content_highlight' ) ){
	function ABdev_shard_search_content_highlight() {
		$content = ABdev_shard_search_res_excerpt(strip_tags(do_shortcode(get_the_content())),get_search_query());
		$keys = implode('|', explode(' ', get_search_query()));
		$content = preg_replace('/(' . $keys .')/iu', '<span class="search-highlight">\0</span>', $content);
		echo $content;
	}
}

if ( ! function_exists( 'ABdev_shard_search_title_highlight' ) ){
	function ABdev_shard_search_title_highlight() {
		$title = get_the_title();
		$keys = implode('|', explode(' ', get_search_query()));
		$title = preg_replace('/(' . $keys .')/iu', '<span class="search-highlight">\0</span>', $title);
		echo $title;
	}
}

if ( ! function_exists( 'ABdev_shard_search_res_excerpt' ) ){
	function ABdev_shard_search_res_excerpt($text, $phrase, $radius = 200, $ending = "...") { 
		$phraseLen = strlen($phrase); 
		if ($radius < $phraseLen) { 
			$radius = $phraseLen; 
		 } 
		$phrases = explode (' ',$phrase);
		foreach ($phrases as $phrase) {
			$pos = strpos(strtolower($text), strtolower($phrase)); 
			if ($pos > -1) {
				break;
			}
		}
		$startPos = 0; 
		if ($pos > $radius) { 
			$startPos = $pos - $radius; 
		} 
		$textLen = strlen($text); 
		$endPos = $pos + $phraseLen + $radius; 
		if ($endPos >= $textLen) { 
			$endPos = $textLen; 
		} 
		$excerpt = substr($text, $startPos, $endPos - $startPos); 
		if ($startPos != 0) { 
			$excerpt = substr_replace($excerpt, $ending, 0, $phraseLen); 
		} 
		if ($endPos != $textLen) { 
			$excerpt = substr_replace($excerpt, $ending, -$phraseLen); 
		} 
		return $excerpt; 
	}
}

if ( ! function_exists( 'ABdev_shard_name_to_class' ) ){
	function ABdev_shard_name_to_class($name){
		$class = str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name);
		return $class;
	}
}


