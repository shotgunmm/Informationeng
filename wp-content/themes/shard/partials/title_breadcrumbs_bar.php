<?php 
global $shard_options, $ABdev_title_bar_title, $post;
if(is_object($post)){
	$values = get_post_custom( $post->ID );  
}

?>

<?php if(!isset($shard_options['hide_title_breadcrumbs_bar']) || $shard_options['hide_title_breadcrumbs_bar']!=1): ?>
	<section id="title_breadcrumbs_bar" class="<?php echo (isset($shard_options['show_bokah_breadcrumbs_bar']) && $shard_options['show_bokah_breadcrumbs_bar']==1)? 'bokah_enabled' : ''; ?>">
		<div class="container">
			<div class="tbb_title">
				<?php if(!isset($shard_options['hide_title_from_bar']) || $shard_options['hide_title_from_bar']!=1): ?>
					<h1><?php echo (!empty($ABdev_title_bar_title)) ? $ABdev_title_bar_title : get_the_title();?></h1>
					<?php if( isset( $values['page_subtitle'][0]) && $values['page_subtitle'][0] != '' ):?>
						<div id="page_subtitle"><?php echo $values['page_subtitle'][0]; ?></div>
					<?php endif; ?>
					<?php if( is_category() && category_description()!='' ):?>
						<div id="page_subtitle"><?php echo strip_tags(category_description()); ?></div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			<div class="tbb_breadcrumbs">
				<div class="container">
					<?php if(!isset($shard_options['hide_breadcrumbs_from_bar']) || $shard_options['hide_breadcrumbs_from_bar']!=1): ?>
						<?php ABdevFW_simple_breadcrumb(); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>