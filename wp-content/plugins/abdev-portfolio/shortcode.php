<?php
// Usage: [portfolio category="" count=""]
function ABp_portfolio_shortcode($atts, $content){
	extract(shortcode_atts(array( 
		'category' 		=> '',
		'count' 		=> '8',
		'link_text'		=> '',
		'link_url' 		=> '',
	), $atts));


	$cat = ($category!='') ? '&portfolio-category='.$category : '';

	$query='post_type=portfolio&posts_per_page='.$count.$cat;

	$post = new WP_Query( $query );
	$out = $error = '';
	if ($post->have_posts()){
		while ($post->have_posts()){
			$post->the_post();
			$slugs=$in_category='';		
			$terms = get_the_terms( get_the_ID() , 'portfolio-category' );
			if(is_array($terms)){
				foreach ( $terms as $term ) {
					if(is_object($term)){
						$slugs.=' '.$term->slug;
						$filter_slugs[$term->slug] = $term->name;
						$in_category[] = $term->name;
					}
				}
			}

			$in_category = (is_array($in_category)) ? implode(', ', $in_category) : '';

			$thumbnail_id = get_post_thumbnail_id(get_the_ID());
			$thumbnail_object = get_post($thumbnail_id);
			$thumbnail_src=$thumbnail_object->guid;

			$out.= '<div class="portfolio_item portfolio_item_4' . $slugs . '">
				<div class="overlayed">
					' . get_the_post_thumbnail() . '
					<a class="overlay" href="'.get_permalink().'">
						<p class="overlay_title">' . get_the_title() . '</p>
						<p class="portfolio_item_tags">
							'.$in_category.'
						</p>
						<span class="dnd-button dnd-button_normal dnd-button_medium">'.__('More', 'ABdev_shard').' <i class="icon-arrowright"></i></span>
					</a>
				</div>
			</div>';
		}
	}
	wp_reset_postdata();
	$filter_out='<li><a href="#filter" data-option-value="*" class="selected">All</a></li>';
	if(isset($filter_slugs) && is_array($filter_slugs)){
		foreach($filter_slugs as $slug => $name){
			$filter_out.='<li><a href="#filter" data-option-value=".'.$slug.'">'.$name.'</a></li>';
		}
	}

	$more_link='';
	if($link_text!='' && $link_url!=''){
		$more_link = '<div class="more_portfolio_link"><a href="'.$link_url.'">'.$link_text.'</a></div>';
	}

	return '
		<ul id="filters" class="portfolio_filter option-set clearfix" data-option-key="filter">'.$filter_out.'</ul>
		<div id="ABdev_latest_portfolio" class="clearfix">
			' . $out . '
		</div>'.$more_link;

}
add_shortcode( 'portfolio', 'ABp_portfolio_shortcode');


function ABp_scripts() {
	wp_enqueue_style('ABp_portfolio_shortcode', plugins_url().'/abdev-portfolio/css/portfolio_shortcode.css');
}
add_action( 'wp_enqueue_scripts', 'ABp_scripts' );

