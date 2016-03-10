<?php
get_header();

get_template_part('partials/title_breadcrumbs_bar');

global $shard_options;

?>
	<section>
		<div class="container">

			<div class="row">

				<div class="span9 content_with_right_sidebar">
					<?php if (have_posts()) :  while (have_posts()) : the_post(); 
						$custom = get_post_custom(); 
						?>
						<div class="post_content">
							<div class="post_badges_single">
								<i class="icon-pen"></i>
								<span class="post_date"><span class="post_day"><?php echo get_the_date('d M'); ?></span><span class="post_our_minute"><?php echo get_the_date('H:i'); ?></span><span class="post_am_pm"><?php echo get_the_date('a'); ?></span></span> 
							</div>
							<div <?php post_class('post_main post_main_alternative'); ?>>
								<?php
								$no_media_class='';
								if(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='soundcloud' && isset($custom['ABdevFW_soundcloud'][0]) && $custom['ABdevFW_soundcloud'][0]!=''){
									echo '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F'.$custom['ABdevFW_soundcloud'][0].'"></iframe>';
								}
								elseif(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='youtube' && isset($custom['ABdevFW_youtube_id'][0]) && $custom['ABdevFW_youtube_id'][0]!=''){
									echo '<div class="videoWrapper-youtube"><iframe src="http://www.youtube.com/embed/'.$custom['ABdevFW_youtube_id'][0].'?showinfo=0&amp;autohide=1&amp;related=0" frameborder="0" allowfullscreen></iframe></div>';
								}
								elseif(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='vimeo' && isset($custom['ABdevFW_vimeo_id'][0]) && $custom['ABdevFW_vimeo_id'][0]!=''){
									echo '<div class="videoWrapper-vimeo"><iframe src="http://player.vimeo.com/video/'.$custom['ABdevFW_vimeo_id'][0].'?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
								}
								else{
									if(get_the_post_thumbnail()!=''){
										echo get_the_post_thumbnail();
									}
									else{
										$no_media_class = 'no_featured_post_media';
									}
								}
								?>

								<div class="postmeta_under_image <?php echo $no_media_class; ?>">
									<div class="author_and_categories_badges">
										<span class="posted_by_author"><?php _e('posted by ', 'ABdev_shard') ?><strong><?php the_author(); ?></strong></span>
										<?php 
										$categories = get_the_category();
										if($categories){
											echo '<div class="categories">
												'.__('categories','ABdev_shard').'
												<ul>';
											foreach($categories as $category) {
												echo '<li><a href="'.get_category_link( $category->term_id ).'">'.$category->cat_name.'</a>'.'</li>';
											}
											echo '</ul>
											</div>';
										}
										?>
									</div>
									<?php echo ($post->post_excerpt!=='') ? '<h3>'.get_the_excerpt().'</h3>' : '' ?>
									<?php the_content();?>
									
									<?php wp_link_pages('before=<div id="inner_post_pagination" class="clearfix">&after=</div>&link_before=<span>&link_after=</span>'); ?>

									<div class="postmeta_under_text_tags">
										<?php the_tags(); ?>
									</div>

									<div class="postmeta-under clearfix">
										<p class="post_meta_share">
											<a class="post_share_facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="icon-facebook"></i><?php _e('Share', 'ABdev_shard') ?></a>
											<a class="post_share_twitter" href="https://twitter.com/home?status=<?php echo(urlencode(__('Check this ', 'ABdev_shard'))); ?><?php the_permalink(); ?>"><i class="icon-twitter"></i><?php _e('Tweet', 'ABdev_shard') ?></a>
											<a class="post_share_googleplus" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="icon-googleplus"></i><?php _e('Share', 'ABdev_shard') ?></a>
										</p>
									</div>
									
								</div>

							</div>
						</div>
							
						
					<?php endwhile; 
					else: ?>
						<p><?php _e('No posts were found. Sorry!', 'ABdev_shard'); ?></p>
					<?php endif; ?>
					
					<?php 
					if( isset($shard_options['hide_comments']) && $shard_options['hide_comments'] != '1'):?>
						<section id="comments_section" class="section_border_top">
							<?php comments_template('/partials/comments.php'); ?> 
						</section>
					<?php endif; ?>

				</div><!-- end span9 main-content -->
				
				<aside class="span3 sidebar sidebar_right">
					<?php 
					if(isset($custom['custom_sidebar'][0]) && $custom['custom_sidebar'][0]!=''){
						$selected_sidebar=$custom['custom_sidebar'][0];
					}
					else{
						$selected_sidebar=__( 'Primary Sidebar', 'ABdev_shard');
					}
					dynamic_sidebar($selected_sidebar);
					?>
				</aside><!-- end span3 sidebar -->

			</div><!-- end row -->

		</div>
	</section>

<?php get_footer();