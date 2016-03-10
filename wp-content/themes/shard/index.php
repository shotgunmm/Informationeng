<?php 

get_header();

$cat_id = get_query_var('cat');
$cat_data = get_option("category_$cat_id"); 

global $ABdev_title_bar_title;

$ABdev_title_bar_title  = __('Blog','ABdev_shard');

if(is_category()){
	$thisCat = get_category(get_query_var('cat'), false);
	$ABdev_title_bar_title = $thisCat -> name;
}
elseif(is_author()){
	$curauth = get_userdata(get_query_var('author'));
	$ABdev_title_bar_title = __('Posts by','ABdev_shard') . ' ' . $curauth -> display_name;
}
elseif(is_tag()){
	$ABdev_title_bar_title = __('Posts Taged','ABdev_shard').' '.get_query_var('tag');
}
elseif(is_month()){
	$month = '01-'.substr(get_query_var('m'), 4, 2).'-'.substr(get_query_var('m'), 0, 4);
	$ABdev_title_bar_title = __('Posts on ','ABdev_shard').' '.date('M Y',strtotime($month));
}

get_template_part('partials/title_breadcrumbs_bar'); 

?>
	
	<section>
		<div class="container">
			
			<?php if($cat_data['sidebar_position']=='timeline'): 
				$i = 0;
			?>
				<div id="timeline_posts" class="clearfix">
				<?php if (have_posts()) :  while (have_posts()) : the_post(); 
					$i++;
					$classes = array();
					$classes[] = 'timeline_post';
					if($i==1){
						$classes[] = 'timeline_post_first';
					}
				?>
					<div <?php post_class($classes); ?>>
						
						<h3 class="post_main_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="timeline_content">
							<?php the_content('');?>
						</div>
						
						<?php
						$custom = get_post_custom();

						if(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='soundcloud' && isset($custom['ABdevFW_soundcloud'][0]) && $custom['ABdevFW_soundcloud'][0]!=''){
							echo '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F'.$custom['ABdevFW_soundcloud'][0].'"></iframe>';
							$postclass_out = 'timeline_postmeta_soundcloud';
						}
						elseif(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='youtube' && isset($custom['ABdevFW_youtube_id'][0]) && $custom['ABdevFW_youtube_id'][0]!=''){
							echo '<div class="videoWrapper-youtube"><iframe src="http://www.youtube.com/embed/'.$custom['ABdevFW_youtube_id'][0].'?showinfo=0&amp;autohide=1&amp;related=0" frameborder="0" allowfullscreen></iframe></div>';
							$postclass_out = 'timeline_postmeta_youtube';
						}
						elseif(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='vimeo' && isset($custom['ABdevFW_vimeo_id'][0]) && $custom['ABdevFW_vimeo_id'][0]!=''){
							echo '<div class="videoWrapper-vimeo"><iframe src="http://player.vimeo.com/video/'.$custom['ABdevFW_vimeo_id'][0].'?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
							$postclass_out = 'timeline_postmeta_vimeo';
						}
						else{
							the_post_thumbnail();
							$postclass_out = 'timeline_postmeta_default';
						}
						?>
						
						<div class="timeline_postmeta <?php echo $postclass_out; ?>">
							<p class="post_meta_date"><i class="icon-calendarthree"></i><?php echo get_the_date('M j, Y'); ?></p>
							<a href="<?php the_permalink(); ?>#comments_section" class="timeline_post_meta_comments"><?php _e('Comment', 'ABdev_shard'); ?></a>
							<span class="timeline_icon">&bull;</span>
							<a href="<?php the_permalink(); ?>" class="timeline_more-link"><?php _e('Read More', 'ABdev_shard'); ?></a>
						</div>

					</div>
				<?php endwhile; 
				else: ?>
					<p><?php _e('No posts were found. Sorry!', 'ABdev_shard'); ?></p>
				<?php endif; ?>
				</div>
				<div id="timeline_loading" data-ajaxurl="<?php echo TEMPPATH; ?>/php/timeline-ajax.php?cat=<?php echo $cat_id; ?>" data-noposts="<?php _e('No older posts found', 'ABdev_shard'); ?>"></div>


			<?php else: ?>
				<div class="row">

					<div class="blog_category_index <?php echo (in_array($cat_data['sidebar_position'], array('classic_right','classic_left','classic_none'))) ? 'blog_classic_layout' : ''?> <?php echo (isset($cat_data['sidebar_position']) && ($cat_data['sidebar_position']=='none' || $cat_data['sidebar_position']=='classic_none'))?'span12':'span9';?> <?php echo (isset($cat_data['sidebar_position']) && ($cat_data['sidebar_position']=='left' || $cat_data['sidebar_position']=='classic_left'))?'content_with_left_sidebar':'content_with_right_sidebar';?>">
						<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>

							<?php $custom = get_post_custom(); ?>
								<div <?php post_class('post_wrapper clearfix'); ?>>
									<div class="post_content">
										<?php
										if(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='soundcloud' && isset($custom['ABdevFW_soundcloud'][0]) && $custom['ABdevFW_soundcloud'][0]!=''){
											$media_out = '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F'.$custom['ABdevFW_soundcloud'][0].'"></iframe>';
											$icon_out = 'icon-headphonesthree';
											$postclass_out = 'post_main_soundcloud';
										}
										elseif(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='youtube' && isset($custom['ABdevFW_youtube_id'][0]) && $custom['ABdevFW_youtube_id'][0]!=''){
											$media_out = '<div class="videoWrapper-youtube"><iframe src="http://www.youtube.com/embed/'.$custom['ABdevFW_youtube_id'][0].'?showinfo=0&amp;autohide=1&amp;related=0" frameborder="0" allowfullscreen></iframe></div>';
											$icon_out = 'icon-play';
											$postclass_out = 'post_main_youtube';
										}
										elseif(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='vimeo' && isset($custom['ABdevFW_vimeo_id'][0]) && $custom['ABdevFW_vimeo_id'][0]!=''){
											$media_out = '<div class="videoWrapper-vimeo"><iframe src="http://player.vimeo.com/video/'.$custom['ABdevFW_vimeo_id'][0].'?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
											$icon_out = 'icon-play';
											$postclass_out = 'post_main_vimeo';
										}
										else{
											$media_out = '<a href="'.get_the_permalink().'">'.get_the_post_thumbnail().'</a>';
											$icon_out = 'icon-pen';
											$postclass_out = 'post_main_default';
										}
										?>
										<?php if($cat_data['sidebar_position']=='classic_right' || $cat_data['sidebar_position']=='classic_left' || $cat_data['sidebar_position']=='classic_none') :?>
											<div class="post_main <?php echo $postclass_out; ?>">
											<?php echo $media_out;?>
											<h3 class="post_main_title"><a href="<?php the_permalink(); ?>"><?php echo ($post->post_excerpt!=='') ? get_the_excerpt() : get_the_title(); ?></a></h3>
											<?php the_content('');?>
											<div class="post-readmore">
												<p class="post_meta_date"><i class="icon-calendarthree date_icon"></i><?php echo get_the_date('M j, Y'); ?></p>
												<p class="post_meta_tags"><i class="icon-tags tags_icon"></i><?php the_tags(''); ?></p>
												<a href="<?php the_permalink(); ?>#comments_section" class="post_meta_comments"><?php _e('Comment', 'ABdev_shard'); ?></a>
												<span>&bull;</span>
												<a href="<?php the_permalink(); ?>" class="more-link"><?php _e('Read More', 'ABdev_shard');?></a>
											</div>
										</div>
										<?php else: ?>
											<div class="post_badges">
												<i class="<?php echo ($icon_out!='') ? $icon_out : 'icon-pen';?>"></i>
												<span class="post_date"><span class="post_day"><?php echo get_the_date('d M'); ?></span><span class="post_our_minute"><?php echo get_the_date('H:i'); ?></span><span class="post_am_pm"><?php echo get_the_date('a'); ?></span></span> 
											</div>
										<div class="post_main <?php echo $postclass_out; ?>">
											<div class="post_main_inner">
												<h3 class="post_main_title"><a href="<?php the_permalink(); ?>"><?php echo ($post->post_excerpt!=='') ? get_the_excerpt() : get_the_title(); ?></a></h3>
												<?php the_content('');?>
											</div>
											<?php echo $media_out;?>
											<div class="post-readmore">
												<a href="<?php the_permalink(); ?>#comments_section" class="post_meta_comments"><?php _e('Comment', 'ABdev_shard'); ?></a>
												<span>&bull;</span>
												<a href="<?php the_permalink(); ?>" class="more-link"><?php _e('Read More', 'ABdev_shard');?></a>
											</div>
										</div>
										<?php endif; ?>
									</div>
								</div>
								
							
						<?php endwhile; 
						else: ?>
							<p><?php _e('No posts were found. Sorry!', 'ABdev_shard'); ?></p>
						<?php endif; ?>

						<?php 
						if($cat_data['sidebar_position']!='timeline'){
							get_template_part( 'partials/pagination' );
						}
						?>
						
					</div><!-- end span9 main-content -->
					
					<?php if (!isset($cat_data['sidebar_position']) || ((isset($cat_data['sidebar_position']) && $cat_data['sidebar_position'] != 'none') && (isset($cat_data['sidebar_position']) && $cat_data['sidebar_position'] != 'classic_none'))):?>
						<aside class="span3 sidebar <?php echo (isset($cat_data['sidebar_position']) && ($cat_data['sidebar_position']=='left' || $cat_data['sidebar_position']=='classic_left'))?'sidebar_left':'sidebar_right';?>">
							<?php 
							if(isset($cat_data['sidebar']) && $cat_data['sidebar']!=''){
								$selected_sidebar=$cat_data['sidebar'];
							}
							else{
								$selected_sidebar=__( 'Primary Sidebar', 'ABdev_shard');
							}
							dynamic_sidebar($selected_sidebar);
							?>
						</aside><!-- end span3 sidebar -->
					<?php endif; ?>

				</div><!-- end row -->

			<?php endif; ?>
		</div>
	</section>


<?php get_footer();