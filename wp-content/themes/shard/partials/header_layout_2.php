<?php global $shard_options; ?>

<div id="ABdev_topbar">
	<div class="container">
		<div class="row">
			<div id="header_phone_email_info" class="span8">
				<?php 
				echo (isset($shard_options['header_freetext']) && $shard_options['header_freetext'] != '') ? '<span>'.$shard_options['header_freetext'].'</span>' : '';
				echo (isset($shard_options['header_phone']) && $shard_options['header_phone'] != '') ? '<span><i class="icon-phone"></i>'.$shard_options['header_phone'].'</span>' : '';
				echo (isset($shard_options['header_email']) && $shard_options['header_email'] != '') ? '<span><i class="icon-emailalt"></i><a href="mailto:'.$shard_options['header_email'].'">'.$shard_options['header_email'].'</a></span>' : '';
				?>
			</div>
			<div id="header_social_search" class="span4 right_aligned">
				<?php 
				$target = (isset($shard_options['header_social_target'])) ? $shard_options['header_social_target'] : '_blank';
				?>
				<?php if(isset($shard_options['facebook_url']) && $shard_options['facebook_url'] != ''):?>
					<a href="<?php echo $shard_options['facebook_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Facebook', 'ABdev_shard') ?>" data-gravity="n"  target="<?php echo $target; ?>"><i class="icon-facebook"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['linkedin_url']) && $shard_options['linkedin_url'] != ''):?>
					<a href="<?php echo $shard_options['linkedin_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Linkedin', 'ABdev_shard') ?>" data-gravity="n"  target="<?php echo $target; ?>"><i class="icon-linkedin"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['skype_url']) && $shard_options['skype_url'] != ''):?>
					<a href="<?php echo $shard_options['skype_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Contact us on Skype', 'ABdev_shard') ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-skype"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['googleplus_url']) && $shard_options['googleplus_url'] != ''):?>
					<a href="<?php echo $shard_options['googleplus_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Google+', 'ABdev_shard') ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-googleplus"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['twitter_url']) && $shard_options['twitter_url'] != ''):?>
					<a href="<?php echo $shard_options['twitter_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Twitter', 'ABdev_shard') ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-twitter"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['youtube_url']) && $shard_options['youtube_url'] != ''):?>
					<a href="<?php echo $shard_options['youtube_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Youtube','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-youtube"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['pinterest_url']) && $shard_options['pinterest_url'] != ''):?>
					<a href="<?php echo $shard_options['pinterest_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Pinterest','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-pinterest"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['feed_url']) && $shard_options['feed_url'] != ''):?>
					<a href="<?php echo $shard_options['feed_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Feed','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-rss"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['behance_url']) && $shard_options['behance_url'] != ''):?>
					<a href="<?php echo $shard_options['behance_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Behance','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-behance"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['blogger_url']) && $shard_options['blogger_url'] != ''):?>
					<a href="<?php echo $shard_options['blogger_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Blogger','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-blogger"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['delicious_url']) && $shard_options['delicious_url'] != ''):?>
					<a href="<?php echo $shard_options['delicious_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Delicious','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-delicious"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['designContest_url']) && $shard_options['designContest_url'] != ''):?>
					<a href="<?php echo $shard_options['designContest_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on DesignContest','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-designcontest"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['deviantART_url']) && $shard_options['deviantART_url'] != ''):?>
					<a href="<?php echo $shard_options['deviantART_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on DeviantART','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-deviantart"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['digg_url']) && $shard_options['digg_url'] != ''):?>
					<a href="<?php echo $shard_options['digg_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Digg','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-digg"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['dribbble_url']) && $shard_options['dribbble_url'] != ''):?>
					<a href="<?php echo $shard_options['dribbble_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Dribbble','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-dribbble"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['dropbox_url']) && $shard_options['dropbox_url'] != ''):?>
					<a href="<?php echo $shard_options['dropbox_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Dropbox','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-dropbox"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['email_url']) && $shard_options['email_url'] != ''):?>
					<a href="mailto:<?php echo $shard_options['email_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Send us Email','ABdev_shard'); ?>" data-gravity="n"><i class="icon-emailalt"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['flickr_url']) && $shard_options['flickr_url'] != ''):?>
					<a href="<?php echo $shard_options['flickr_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Flickr','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-flickr"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['forrst_url']) && $shard_options['forrst_url'] != ''):?>
					<a href="<?php echo $shard_options['forrst_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Forrst','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-forrst"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['instagram_url']) && $shard_options['instagram_url'] != ''):?>
					<a href="<?php echo $shard_options['instagram_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Instagram','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-instagram"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['last.fm_url']) && $shard_options['last.fm_url'] != ''):?>
					<a href="<?php echo $shard_options['last.fm_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Last.fm','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-lastfm"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['myspace_url']) && $shard_options['myspace_url'] != ''):?>
					<a href="<?php echo $shard_options['myspace_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on MySpace','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-myspace"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['picasa_url']) && $shard_options['picasa_url'] != ''):?>
					<a href="<?php echo $shard_options['picasa_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Picasa','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-picasa"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['stumbleUpon_url']) && $shard_options['stumbleUpon_url'] != ''):?>
					<a href="<?php echo $shard_options['stumbleUpon_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on StumbleUpon','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-stumbleupon"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['vimeo_url']) && $shard_options['vimeo_url'] != ''):?>
					<a href="<?php echo $shard_options['vimeo_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Vimeo','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-vimeo"></i></a>
				<?php endif;?>
				<?php if(isset($shard_options['zerply_url']) && $shard_options['zerply_url'] != ''):?>
					<a href="<?php echo $shard_options['zerply_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Zerply','ABdev_shard'); ?>" data-gravity="n" target="<?php echo $target; ?>"><i class="icon-zerply"></i></a>
				<?php endif;?>
							
				<?php get_template_part('partials/header_searchform');?>
			</div>
		</div>
		
	</div>
</div>

<header id="ABdev_main_header" class="clearfix">
	<div class="container">
		<div id="logo">
			<div class="logo_inner">
				<a href="<?php echo home_url(); ?>"><img src="<?php echo (isset($shard_options['header_logo']['url']) && $shard_options['header_logo']['url'] != '') ? $shard_options['header_logo']['url'] : TEMPPATH.'/images/logo.png';?>" alt="<?php bloginfo('name');?>"></a>
			</div>
		</div>
		<nav>
			<?php
			wp_nav_menu(array( 
				'theme_location' => 'header-menu',
				'container' => false,
				'menu_id' => 'main_menu',
				'menu_class' => '',
				'walker' => new shard_walker_nav_menu_icons,
				'fallback_cb' => false 
			));
			?>
		</nav>
		<div id="ABdev_menu_toggle"><i class="icon-menumobile"></i></div>
	</div>
</header>
