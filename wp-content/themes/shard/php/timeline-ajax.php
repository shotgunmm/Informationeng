<?php
define('WP_USE_THEMES', false);
require_once('../../../../wp-load.php');

$page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;
$cat = (isset($_GET['cat'])) ? $_GET['cat'] : '';

query_posts(array(
	'paged'    => $page,
	'cat'      => $cat,
));

if (have_posts()) :  while (have_posts()) : the_post(); ?>
	<div <?php post_class('timeline_post timeline_appended'); ?>>
		
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="timeline_content">
			<?php the_content('');?>
		</div>
		
		<?php
		$custom = get_post_custom();

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
			the_post_thumbnail();
		}
		?>
		
		<div class="timeline_postmeta">
			<p class="post_meta_date"><i class="icon-calendarthree"></i><?php the_date('M j, Y'); ?></p>
			<a href="<?php the_permalink(); ?>#comments_section" class="timeline_post_meta_comments"><?php _e('Comment', 'ABdev_shard') ?></a>
			<span class="timeline_icon">&bull;</span>
			<a href="<?php the_permalink(); ?>" class="timeline_more-link"><?php _e('Read More', 'ABdev_shard') ?></a>
		</div>

	</div>
<?php 
endwhile; 
endif;
wp_reset_query();