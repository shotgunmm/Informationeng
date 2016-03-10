<?php

/*
Template Name: Portfolio - 4 Columns
*/

$read_more=__('Read More','ABdev_shard');

get_header();

get_template_part('partials/title_breadcrumbs_bar'); 

global $shard_options;

?>

<?php //check if portfolio plugin is activated
if(current_user_can( 'manage_options' ) && !in_array( 'abdev-portfolio/abdev-portfolio.php', get_option( 'active_plugins') )):?>
	<section>
		<div class="container">
			<p>
				<strong><?php _e('This page requires Portfolio plugin to be activated','ABdev_shard');?></strong>
			</p>
		</div>
	</section>
<?php 
endif; 

if (have_posts()) : while (have_posts()) : the_post();
	$content = do_shortcode(get_the_content());
	if ($content != ''):?>
		<?php echo $content;?>
<?php endif; endwhile; endif;?>


<section class="clearfix <?php echo ($content != '') ? 'section_border_top' : '';?>">
	<div class="container">
		<?php 
		
		//check if portfolio plugin is activated
		if(current_user_can( 'manage_options' ) && !in_array( 'abdev-portfolio/abdev-portfolio.php', get_option( 'active_plugins') )){
			echo '<p><strong>' . __('This page requires Portfolio plugin to be activated','ABdev_shard') . '</strong></p>';
		}

		$values = get_post_custom( $post->ID );
		$selected_categories = isset($values['categories'][0]) ? $values['categories'][0] : '';

		$args = array(
			'post_type' => 'portfolio',
			'portfolio-category' => $selected_categories,
			'posts_per_page'=>-1,
		);
		$posts = new WP_Query( $args );
		$out = '';
		if ($posts->have_posts()){
			while ($posts->have_posts()){
				$posts->the_post();
				$slugs=$in_category='';		
				$terms = get_the_terms( $post->ID , 'portfolio-category' );
				if(is_array($terms)){
					foreach ( $terms as $term ) {
						if(is_object($term)){
							$slugs.=' '.$term->slug;
							$filter_slugs[$term->slug] = $term->name;
							$in_category = $term->name;
						}
					}
				}

				$out.= '<div class="portfolio_item portfolio_item_4' . $slugs . '">
					<div class="overlayed">
						' . get_the_post_thumbnail() . '
						<a class="overlay" href="'.get_permalink().'">
							<p class="overlay_title">' . get_the_title() . '</p>
							<p class="portfolio_item_tags">
								'.$in_category.'
							</p>
							<span class="dnd-button dnd-button_normal dnd-button_medium ">'.__('More', 'ABdev_shard').' <i class="icon-arrowright"></i></span>
						</a>
					</div>
				</div>';
			}
		}
		else{
			echo '<p>' . __('No Portfolio Posts Found.', 'ABdev_shard') . '</p>';
		}

		$filter_out = '<li><a href="#filter" data-option-value="*" class="selected">'.__('All', 'ABdev_shard').'</a></li>';
		if(isset($filter_slugs) && is_array($filter_slugs)){
			foreach($filter_slugs as $slug => $name){
				$filter_out .= '<li><a href="#filter" data-option-value=".'.$slug.'">'.$name.'</a></li>';
			}
		}
		?>

		<ul id="filters" class="portfolio_filter option-set clearfix" data-option-key="filter"><?php echo $filter_out;?></ul>
		<div id="ABdev_latest_portfolio" class="portfolio_items clearfix">
			<?php echo $out;?>
		</div>

	</div>
</section>

	<?php 
		if(isset($shard_options['content_after_portfolio_column_4']) && $shard_options['content_after_portfolio_column_4']!=''){
			echo do_shortcode($shard_options['content_after_portfolio_column_4']);
		}
	?>




<?php get_footer();