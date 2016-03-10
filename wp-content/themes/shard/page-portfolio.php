<?php

/*
Template Name: Portfolio - Single Column
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
		<section>
			<div class="container">
				<?php echo $content;?>
			</div>
		</section>
<?php endif; endwhile; endif;?>



<section class="<?php echo ($content != '') ? 'section_border_top' : '';?>">
	<div class="container">
		<div id="portfolio_single_column">
			<?php
			$values = get_post_custom( $post->ID );
			$selected_categories = isset($values['categories'][0]) ? $values['categories'][0] : '';
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			$args = array(
				'post_type' => 'portfolio',
				'portfolio-category' => $selected_categories,
				'paged'=>$paged,
			);
			$posts = new WP_Query( $args );
			$out = $error = '';
			if ($posts->have_posts()){
				while ($posts->have_posts()){
					$posts->the_post();
					$portfolio_data = get_post_custom();
					?>
					<div class="portfolio_single_column_item">
						<div class="row">
							<div class="span6">
								<a href="<?php the_permalink();?>" class="more-link"><?php echo get_the_post_thumbnail();?></a>
							</div>
							<div class="span6">

								<div class="portfolio_item_meta">
									<h2 class="column_title_left"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>

									<?php the_content();?>
									
									<?php if(isset($portfolio_data['ABp_portfolio_client'][0])):?>
										<p class="portfolio_single_detail clearfix">
											<span class="portfolio_item_meta_label"><?php _e('Client:', 'ABdev_shard');?></span>
											<span class="portfolio_item_meta_data"><?php echo $portfolio_data['ABp_portfolio_client'][0];?></span>
										</p>
									<?php endif; ?>
									<p class="portfolio_single_detail clearfix">
										<span class="portfolio_item_meta_label"><?php _e('Date:', 'ABdev_shard');?></span>
										<span class="portfolio_item_meta_data"><?php echo get_the_date();?></span>
									</p>
									<?php if(isset($portfolio_data['ABp_portfolio_skills'][0])):?>
										<p class="portfolio_single_detail clearfix">
											<span class="portfolio_item_meta_label"><?php _e('Skills:', 'ABdev_shard');?></span>
											<span class="portfolio_item_meta_data"><?php echo $portfolio_data['ABp_portfolio_skills'][0];?></span>
										</p>
									<?php endif; ?>

									<?php if(isset($portfolio_data['ABp_portfolio_link'][0]) && $portfolio_data['ABp_portfolio_link'][0]!=''):?>
										<p class="portfolio_item_view_link"><a href="<?php echo $portfolio_data['ABp_portfolio_link'][0];?>" target="<?php echo $portfolio_data['ABp_portfolio_link_target'][0];?>"><?php _e('Launch Site','ABdev_shard');?><i class="icon-arrowright"></i></a></p>
									<?php endif; ?>

								</div>
							</div>
						</div>
					</div>
					<?php 
				}

			}
			else{
				echo '<p>' . __('No Portfolio Posts Found.', 'ABdev_shard') . '</p>';
			}
			?> 
		</div>
		<?php get_template_part( 'partials/pagination-portfolio' ); ?>
	</div>
</section>

	<?php 
		if(isset($shard_options['content_after_portfolio_column_single']) && $shard_options['content_after_portfolio_column_single']!=''){
			echo do_shortcode($shard_options['content_after_portfolio_column_single']);
		}
	?>

<?php get_footer();