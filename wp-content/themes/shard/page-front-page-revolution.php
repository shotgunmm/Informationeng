<?php

/*
Template Name: Front Page - Revolution Slider
*/

get_header();

$values = get_post_custom( $post->ID );  
?>

	<section id="dz_main_slider">
		<?php 
		if( isset( $values['revslider_alias'][0]) && $values['revslider_alias'][0] != '' ){
			if(function_exists('putRevSlider')){
				putRevSlider( $values['revslider_alias'][0] );
			}
		}
		else{
			_e('You did not select any slider in <i>Front Page Options</i> metabox.', 'ABdev_shard');
		}
		?>
	</section>
	
	<?php if ( have_posts()) : while (have_posts()) : the_post(); 
		the_content();
	endwhile;
	endif;
	?>

<?php get_footer();