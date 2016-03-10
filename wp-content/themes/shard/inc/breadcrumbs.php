<?php 

if ( ! function_exists( 'ABdevFW_simple_breadcrumb' ) ){
	function ABdevFW_simple_breadcrumb(){
		$text['home']     = __('Home', 'ABdev_shard');;
		$text['portfolio']= __('Portfolio', 'ABdev_shard');
		$text['forum']= __('Forum', 'ABdev_shard');
		$text['tax'] 	  = __('Archive for "%s"', 'ABdev_shard');
		$text['search']   = __('Search Results for "%s"', 'ABdev_shard');
		$text['tag']      = __('Posts Tagged "%s"', 'ABdev_shard');
		$text['author']   = __('Articles by %s', 'ABdev_shard');
		$text['404']      = __('Error 404', 'ABdev_shard');
		$text['here']      = __('You are here: ', 'ABdev_shard');
		$delimiter   = ' / '; // delimiter between crumbs
		$before      = '<span class="current">'; // tag before the current crumb
		$after       = '</span>'; // tag after the current crumb
	 
		global $post;
		$homeLink = home_url() . '/';
		$link = '<a href="%s">%s</a>';
	 
			echo '<div class="breadcrumbs"><div class="breadcrumbs_inner">' . sprintf($text['here']);
			echo sprintf($link, $homeLink, $text['home']) . $delimiter;
	 
			if ( is_category() ) {
				$thisCat = get_category(get_query_var('cat'), false);
				if ($thisCat->parent != 0) {
					$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
					echo $cats;
				}
				echo $before . single_cat_title('', false) . $after;
	 
			} elseif( is_singular( 'portfolio' ) ){
				
				echo $before . $text['portfolio'] . $after . $delimiter . $before . get_the_title() . $after;
			
			} elseif( function_exists( 'is_bbpress' ) && is_bbpress() ){
				
				echo $before . $text['forum'] . $after . $delimiter . $before . get_the_title() . $after;
			
			} elseif( is_tax() ){
				$thisCat = get_category(get_query_var('cat'), false);
				if ($thisCat->parent != 0) {
					$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
					echo $cats;
				}
				echo $before . sprintf($text['tax'], single_cat_title('', false)) . $after;
			
			}elseif ( is_search() ) {
				echo $before . sprintf($text['search'], get_search_query()) . $after;
	 
			} elseif ( is_day() ) {
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
				echo $before . get_the_time('d') . $after;
	 
			} elseif ( is_month() ) {
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo $before . get_the_time('F') . $after;
	 
			} elseif ( is_year() ) {
				echo $before . get_the_time('Y') . $after;
	 
			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
					echo $delimiter . $before . get_the_title() . $after;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, $delimiter);
					echo $cats;
					echo $before . get_the_title() . $after;
				}
	 
			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());
				echo $before . $post_type->labels->singular_name . $after;
	 
			} elseif ( is_attachment() ) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				echo $cats;
				printf($link, get_permalink($parent), $parent->post_title);
				echo $delimiter . $before . get_the_title() . $after;
	 
			} elseif ( is_page() && !$post->post_parent ) {
				echo $before . get_the_title() . $after;
	 
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) {
						echo $delimiter;
					}
				}
				echo $delimiter . $before . get_the_title() . $after;
	 
			} elseif ( is_tag() ) {
				echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
	 
			} elseif ( is_author() ) {
		 		global $author;
				$userdata = get_userdata($author);
				echo $before . sprintf($text['author'], $userdata->display_name) . $after;
	 
			} elseif ( is_404() ) {
				echo $before . $text['404'] . $after;
			}
	 
			if ( get_query_var('paged') ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) { 
					echo ' (';
				}
				echo __('Page', 'ABdev_shard') . ' ' . get_query_var('paged');
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) { 
					echo ')';
				}
			}
	 
			echo '</div></div>';
	 
	} 
}