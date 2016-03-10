<?php
get_header();

get_template_part('partials/title_breadcrumbs_bar'); 

?>

<?php
$uri = $_SERVER['REQUEST_URI'];
if ( strpos($uri,'nrtd') !== false ) {
   echo do_shortcode("[metaslider id=300]"); 
} elseif ( strpos($uri,'data-cards') !== false ) {
   echo do_shortcode("[metaslider id=300]"); 
} elseif ( strpos($uri,'package-insert-programs') !== false ) {
   echo do_shortcode("[metaslider id=300]"); 
} elseif ( strpos($uri,'data-cards/families') !== false ) {
   echo do_shortcode("[metaslider id=300]"); 
} elseif ( strpos($uri,'data-cards/pet-owners') !== false ) {
   echo do_shortcode("[metaslider id=300]"); 
} elseif ( strpos($uri,'data-cards/otc') !== false ) {
   echo do_shortcode("[metaslider id=300]"); 
} elseif ( strpos($uri,'data-cards/health-beauty') !== false ) {
   echo do_shortcode("[metaslider id=300]"); 
} elseif ( strpos($uri,'data-cards/diet-products') !== false ) {
   echo do_shortcode("[metaslider id=300]"); 
} elseif ( strpos($uri,'data-cards/beer-buyers') !== false ) {
   echo do_shortcode("[metaslider id=300]"); 
} else {
}
?>
     

	<section>
		<div class="container">

			<div class="row">

				<div class="span8 content">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
						<?php the_content();?>
					<?php endwhile; endif;?>
				</div><!-- end span8 main-content -->
				
				<aside class="span4 sidebar sidebar_right">
					<?php get_sidebar(); ?>
				</aside><!-- end span4 sidebar -->

			</div><!-- end row -->

		</div>
	</section>

<?php get_footer();