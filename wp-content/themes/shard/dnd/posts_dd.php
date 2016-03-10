<?php

/*********** Shortcode: Latest Post ************************************************************/

$ABdevDND_shortcodes['posts_dd'] = array(
	'attributes' => array(
		'style' => array(
			'description' => __( 'Style', 'ABdev_shard' ),
			'default' => 'style1',
			'type' => 	'select', 
			'values' => array(
				'style1' => __('Style 1', 'ABdev_shard'),
				'style2' => __('Style 2', 'ABdev_shard'),
				'style3' => __('Style 3', 'ABdev_shard'),
			),
		),
		'category' => array(
			'description' => __( 'Category', 'ABdev_shard' ),
		),
		'ids' => array(
			'description' => __( 'Posts IDs', 'ABdev_shard' ),
		),
		'order' => array(
			'default' => 'DESC',
			'description' => __( 'Order', 'ABdev_shard' ),
			'values' => array(
				'ASC' =>  __( 'ASC', 'ABdev_shard' ),
				'DESC' =>  __( 'DESC', 'ABdev_shard' ),
			),      
		),
		'orderby' => array(
			'default' => 'date',
			'description' => __( 'Order by', 'ABdev_shard' ),
			'values' => array(
				'ID' =>  __( 'ID', 'ABdev_shard' ),
				'none' =>  __( 'none', 'ABdev_shard' ),
				'author' =>  __( 'author', 'ABdev_shard' ),
				'title' =>  __( 'title', 'ABdev_shard' ),
				'name' =>  __( 'name', 'ABdev_shard' ),
				'date' =>  __( 'date', 'ABdev_shard' ),
				'modified' =>  __( 'modified', 'ABdev_shard' ),
				'parent' =>  __( 'parent', 'ABdev_shard' ),
				'rand' =>  __( 'rand', 'ABdev_shard' ),
				'menu_order' =>  __( 'menu_order', 'ABdev_shard' ),
				'post__in' =>  __( 'post__in', 'ABdev_shard' ),
			),      
		),
		'post_parent' => array(
			'description' => __( 'Post Parent', 'ABdev_shard' ),
		),
		'post_type' => array(
			'default' => 'post',
			'description' => __( 'Post Type', 'ABdev_shard' ),
		),
		'posts_no' => array(
			'default' => '4',
			'description' => __( 'Number of Posts', 'ABdev_shard' ),
		),
		'offset' => array(
			'default' => '0',
			'description' => __( 'Offset', 'ABdev_shard' ),
		),
		'tag' => array(
			'description' => __( 'Tag', 'ABdev_shard' ),
		),
		'tax_operator' => array(
			'default' => 'IN',
			'description' => __( 'Tax Operator', 'ABdev_shard' ),
		),
		'tax_term' => array(
			'description' => __( 'Tax Term', 'ABdev_shard' ),
		),
		'taxonomy' => array(
			'description' => __( 'Taxonomy', 'ABdev_shard' ),
		),
		'excerpt' => array(
			'description' => __( 'Custom Excerpt Limit Words', 'ABdev_shard' ),
			'info' => __( 'How many words you want to display? If left empty default WordPress excerpt will be used.', 'ABdev_shard' ),
		),
		'blog_url' => array(
			'description' => __( 'Blog URL', 'ABdev_shard' ),
			'info' => __( 'If entered link will be displayed under last post', 'ABdev_shard' ),
		),
	),
	'description' => __( 'Posts Excerpts', 'ABdev_shard' )
);

if ( ! function_exists( 'ABdevDND_posts_dd_shortcode' ) ){
	function ABdevDND_posts_dd_shortcode( $attributes ) {
		extract(shortcode_atts(ABdevDND_extract_attributes('posts_dd'), $attributes));

		$args = array(
			'category_name'  => $category,
			'order'          => $order,
			'orderby'        => $orderby,
			'post_type'      => explode( ',', $post_type ),
			'posts_per_page' => $posts_no,
			'offset'         => $offset,
			'tag'            => $tag,
		);
		if( $ids ) {
			$posts_in = array_map( 'intval', explode( ',', $ids ) );
			$args['post__in'] = $posts_in;
		}
		if ( !empty( $taxonomy ) && !empty( $tax_term ) ) {
			$tax_term = explode( ', ', $tax_term );
			if( !in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) ){
				$tax_operator = 'IN';
			}
			$tax_args = array(
				'tax_query' => array(
					array(
						'taxonomy' => $taxonomy,
						'field'    => 'slug',
						'terms'    => $tax_term,
						'operator' => $tax_operator
					)
				)
			);
			$args = array_merge( $args, $tax_args );
		}
		if( $post_parent ) {
			if( 'current' == $post_parent ) {
				global $post;
				$post_parent = $post->ID;
			}
			$args['post_parent'] = $post_parent;
		}
		$listing = new WP_Query( apply_filters( 'display_posts_shortcode_args', $args, $attributes ) );
		if ( ! $listing->have_posts() ){
			return apply_filters( 'display_posts_shortcode_no_results', false );
		}
			;

		$output = '<div class="dnd_posts_shortcode'.(($style!='') ? ' dnd_posts_shortcode_'.$style : '').'">';
		while ( $listing->have_posts() ): $listing->the_post(); 
			global $post;

			$thumbnail = get_the_post_thumbnail($post->ID,'thumbnail');
			$classes_out = ($thumbnail!='') ? 'has_thumbnail' : 'without_thumbnail';

			$output .= '<div class="dnd_post_single clearfix '.$classes_out.'">';
			
			if($style == 'style1'){
				$output .= '<p class="dnd_latest_news_time"><span class="day">'.get_the_date('d M').'</span><span class="our">'.get_the_date('H').'</span><span class="minutes">:'.get_the_date('i').'</span><span class="am_pm">'.get_the_date('a').'</span></p>';
				$output .= ($thumbnail!='') ? '<a class="dnd_latest_news_shortcode_thumb" href="' . get_permalink() . '">' . get_the_post_thumbnail($post->ID,'thumbnail') . '</a>' :'';
			}
			elseif($style == 'style2'){
				$output .= '<p class="dnd_latest_news_time"><span class="days">'.get_the_date('d').'</span><span class="months"> '.get_the_date('M').'</span></p>';
				$output .= ($thumbnail!='') ? '<a class="dnd_latest_news_shortcode_thumb" href="' . get_permalink() . '">' . get_the_post_thumbnail($post->ID,'thumbnail') . '</a>' :'';
			}
			else{
				$output .= '<p class="dnd_latest_news_time"><span class="style3_days">'.get_the_date('d').'</span><span class="style3_months">'.get_the_date('M').',</span><span class="style3_years">'.get_the_date('Y').'</span></p>';
			}
			
			$output .= '<div class="dnd_latest_news_shortcode_content">';
			$output .= '<h5><a href="' . get_permalink() . '">' . get_the_title() . '</a></h5>';

			$text = do_shortcode(get_the_content());
			if($excerpt > 0){
				$text = apply_filters('the_content', $text);
				$text = str_replace(']]>', ']]&gt;', $text);
				$text = strip_tags($text);
				$words = preg_split("/[\n\r\t ]+/", $text, $excerpt+1, PREG_SPLIT_NO_EMPTY);
				$words = array_slice($words, 0, $excerpt);
				$text = implode(' ', $words);
			}
			else{
				$text = get_the_excerpt();
			}

			$output .= '<p>' . rtrim($text,'[&hellip;]') . '<a href="'.get_permalink().'">[...]</a></p>';
			$output .= '</div>';
			$output .= '</div>';

		endwhile; 
		wp_reset_postdata();

		if($blog_url!=''){
			$output .= '<a href="'.$blog_url.'" class="dnd_posts_blog_link">'.__('Go to Blog', 'ABdev_shard').' <i class="icon-arrowright"></i></a>';
		}
		$output .= '</div>';
		return $output;
	}
}

