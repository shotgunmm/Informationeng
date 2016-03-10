<?php
/*
Template Name: 404 page
*/

get_header();

get_template_part('partials/title_breadcrumbs_bar');

?>

	<section id="page404" class="dnd_section_dd">
		<div class="dnd_section_content">
			<div class="dnd_container">

				<div class="dnd_column_dd_span6">
					<p class="big_404"><?php _e('404', 'ABdev_shard') ?></p>
					<p class="error"><?php _e('ERROR', 'ABdev_shard') ?></p>
				</div>

				<div class="dnd_column_dd_span6 404_right_column">

					<h2><?php _e('OOPS!', 'ABdev_shard') ?></h2>
					<h4><?php _e('PAGE YOU WERE LOOKING FOR APPEARS TO HAVE BEEN MOVED, DELETED OR DOES NOT EXIST.', 'ABdev_shard') ?></h4>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
						<?php the_content();?>
					<?php endwhile; endif;?>

					<p class="text_404"><?php _e('But dont worry, we will help you get back on the track. Perhaps you could...', 'ABdev_shard') ?></p>
					
					<ul class="dnd_shortcode_ul ">
						<li><a href="<?php echo home_url(); ?>"><?php _e('Start at home page', 'ABdev_shard') ?></a></li>
						<li><a href="#" onclick="history.go(-1);return false;"><?php _e('Back to previous page', 'ABdev_shard') ?></a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>

<?php get_footer();