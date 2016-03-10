<?php 
$portfolio_data = get_post_custom();

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
<?php endif; ?>

<section>
	<div class="container">
		<?php if (have_posts()) : while (have_posts()) : the_post();?>
			<div class="row">
				<div class="span7 content_with_right_sidebar">
					<?php the_post_thumbnail('full', array('class' => 'portfolio_item_image')); ?>
					<?php if(isset($portfolio_data['ABp_portfolio_link'][0]) && $portfolio_data['ABp_portfolio_link'][0]!=''):?>
						<p class="portfolio_item_view_link"><a href="<?php echo $portfolio_data['ABp_portfolio_link'][0];?>" target="<?php echo $portfolio_data['ABp_portfolio_link_target'][0];?>"><?php _e('Launch Site','ABdev_shard');?><i class="icon-arrowright"></i></a></p>
					<?php endif; ?>
				</div>
				<div class="portfolio_item_meta span5">
					<h2 class="column_title_left"><?php _e('Project Description', 'ABdev_shard'); ?></h2>
					<?php the_content();?>

					<?php if(isset($portfolio_data['ABp_portfolio_client'][0])):?>
						<p class="portfolio_single_detail">
							<span class="portfolio_item_meta_label"><?php _e('Client:', 'ABdev_shard');?></span>
							<a href="#"><span class="portfolio_item_meta_data"><?php echo $portfolio_data['ABp_portfolio_client'][0];?></span></a>
						</p>
					<?php endif; ?>
					
					<p class="portfolio_single_detail">
						<span class="portfolio_item_meta_label"><?php _e('Date:', 'ABdev_shard');?></span>
						<span class="portfolio_item_meta_data"><?php echo get_the_date();?></span>
					</p>

					<?php if(isset($portfolio_data['ABp_portfolio_skills'][0])):?>
						<p class="portfolio_single_detail">
							<span class="portfolio_item_meta_label"><?php _e('Skills:', 'ABdev_shard');?></span>
							<span class="portfolio_item_meta_data"><?php echo $portfolio_data['ABp_portfolio_skills'][0];?></span>
						</p>
					<?php endif; ?>

					<p class="post_meta_share portfolio_share_social">
						<a class="post_share_facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="icon-facebook"></i>Share</a>
						<a class="post_share_twitter" href="https://twitter.com/home?status=<?php echo(urlencode(__('Check this ', 'ABdev_shard'))); ?><?php the_permalink(); ?>"><i class="icon-twitter"></i>Tweet</a>
						<a class="post_share_googleplus" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="icon-googleplus"></i>Share</a>
					</p>

				</div>
			</div>
			
		<?php endwhile; endif;?>
	</div>
</section>


<?php if(isset($portfolio_data['ABp_portfolio_show_related'][0]) && $portfolio_data['ABp_portfolio_show_related'][0]==1): ?>
	<section id="related_portfolio" style="background-image: url( <?php echo ($shard_options['portfolio_single_background_image']['url']); ?>); background-size:cover" class="section_with_header">
		<header>
			<div class="dnd_container">
				<h3><?php _e('Related Projects', 'ABdev_shard'); ?></h3>
			</div>
		</header>
		<div class="dnd_section_content">
			<div class="container">
				<div class="row">
					<?php 
					$args = array(
						'post_type' => 'portfolio',
						'posts_per_page'=>4,
						'post__not_in'=>array($post->ID),
					);
					$related = new WP_Query( $args );
					$out = $error = '';
					if ($related->have_posts()){
						while ($related->have_posts()){
							$related->the_post();
							$slugs=$in_category='';		
							$terms = get_the_terms( $post->ID , 'portfolio-category' );
							if(is_array($terms)){
								foreach ( $terms as $term ) {
									if(is_object($term)){
										$slugs.=' '.$term->slug;
										$filter_slugs[$term->slug] = $term->name;
										$in_category[] = $term->name;
									}
								}
							}

							$in_category = (isset($in_category) && is_array($in_category)) ? implode(', ', $in_category) : '';

							$thumbnail_id = get_post_thumbnail_id($post->ID);
							$thumbnail_object = get_post($thumbnail_id);
							$thumbnail_src=$thumbnail_object->guid;

							echo '<div class="portfolio_item portfolio_item_4' . $slugs . '">
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
					?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

	<?php 
		if(isset($shard_options['content_after_portfolio_single']) && $shard_options['content_after_portfolio_single']!=''){
			echo do_shortcode($shard_options['content_after_portfolio_single']);
		}
	?>


<?php get_footer();