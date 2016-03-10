<?php 

if (!function_exists('ABdevDND_shortcodes')){
	function ABdevDND_shortcodes( $shortcode = false ) {
		global $ABdevDND_shortcodes;
		if ( $shortcode ){
			return $ABdevDND_shortcodes[$shortcode];
		}
		else{
			ksort($ABdevDND_shortcodes);
			return $ABdevDND_shortcodes;
		}
	}
}


if (!function_exists('ABdevDND_3rd_party')){
	function ABdevDND_3rd_party() {
		global $ABdevDND_shortcodes;
		$return = array();
		foreach($ABdevDND_shortcodes as $shortcode => $att){
			if(isset($att['third_party']) && $att['third_party'] == 1){
				$return[] = $shortcode;
			}
		}
		$return = implode(',', $return);
		return $return;
	}
}


if (!function_exists('ABdevDND_the_content_filter')){
	function ABdevDND_the_content_filter($content) {
		foreach ( ABdevDND_shortcodes() as $name => $shortcode ) {
			$shortcode_list[] = $name;
			$shortcode_list[] = str_replace('_dd', '_DD', $name);
		}
		$block = join("|", $shortcode_list);
		$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
		$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
		return $rep;
	}
}
add_filter("the_content", "ABdevDND_the_content_filter");


if (!function_exists('ABdevDND_shortcode_names')){
	function ABdevDND_shortcode_names() {
		global $ABdevDND_shortcodes;
		$return = array();
		foreach($ABdevDND_shortcodes as $shortcode => $att){
			$return[$shortcode] = (isset($att['description'])) ? $att['description'] : '';
		}
		return $return;
	}
}


if (!function_exists('ABdevDND_extract_attributes')){
	function ABdevDND_extract_attributes ($shortcode) {
		foreach($GLOBALS['ABdevDND_shortcodes'][$shortcode]['attributes'] as $att => $val){
			$defaults[$att] = (isset($val['default'])) ? $val['default'] : '';
		}
		return $defaults;
	}
}


if (!function_exists('ABdevDND_current_page_url')){
	function ABdevDND_current_page_url() {
		$pageURL = 'http';
		if( isset($_SERVER["HTTPS"]) ) {
			if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
}


if (!function_exists('ABdevDND_get_current_post_type')){
	function ABdevDND_get_current_post_type() {
	  global $post, $typenow, $current_screen;
	  //we have a post so we can just get the post type from that
	  if ( $post && $post->post_type )
	    return $post->post_type;
	  //check the global $typenow - set in admin.php
	  elseif( $typenow )
	    return $typenow;
	  //check the global $current_screen object - set in sceen.php
	  elseif( $current_screen && $current_screen->post_type )
	    return $current_screen->post_type;
	  //lastly check the post_type querystring
	  elseif( isset( $_REQUEST['post_type'] ) )
	    return sanitize_key( $_REQUEST['post_type'] );
	  //we do not know the post type!
	  return null;
	}
}

if (!function_exists('ABdevDND_trim_excerpt_do_shortcode')){
	function ABdevDND_trim_excerpt_do_shortcode($text) {
		$raw_excerpt = $text;
		if ( '' == $text ) {
			$text = get_the_content('');
			$text = do_shortcode( $text );
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]&gt;', $text);
			$text = strip_tags($text);
			$excerpt_length = apply_filters('excerpt_length', 55);
			$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
			$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
			if ( count($words) > $excerpt_length ) {
				array_pop($words);
				$text = implode(' ', $words);
				$text = $text . $excerpt_more;
			} else {
				$text = implode(' ', $words);
			}
		}
		return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
	}
}
$options = get_option( 'dnd_settings' );
$dnd_excerpt = (isset($options['dnd_excerpt']) && $options['dnd_excerpt']==1) ? 1  : 0;
if($dnd_excerpt){
	remove_filter('get_the_excerpt', 'wp_trim_excerpt');
	add_filter('get_the_excerpt', 'ABdevDND_trim_excerpt_do_shortcode');
}


if ( ! function_exists( 'ABdevDND_name_to_id' ) ){
	function ABdevDND_name_to_id($name){
		$class = strtolower(str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name));
		return $class;
	}
}