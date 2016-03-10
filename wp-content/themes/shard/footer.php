<?php 
global $shard_options;
?>
	<footer id="main_footer">

		<?php if(is_active_sidebar('First Footer Widget') || is_active_sidebar('Second Footer Widget') || is_active_sidebar('Third Footer Widget') || is_active_sidebar('Fourth Footer Widget')): ?>
			<div id="footer_columns">
				<div class="container">
					<div class="row">
						<div class="span3 clearfix">
							<?php dynamic_sidebar( __('First Footer Widget', 'ABdev_shard') );?>
						</div>
						<div class="span3 clearfix">
							<?php dynamic_sidebar( __('Second Footer Widget', 'ABdev_shard') );?>
						</div>
						<div class="span3 clearfix">
							<?php dynamic_sidebar( __('Third Footer Widget', 'ABdev_shard') );?>
						</div>
						<div class="span3 clearfix">
							<a href="/contact"><h4 class="footer-widget-heading">Contact</h4></a>
							<?php dynamic_sidebar( __('Fourth Footer Widget', 'ABdev_shard') );?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<div id="footer_copyright" class="clearfix">
			<div class="container">
			
				<!--edit
				<nav>
					<ul id="main_menu" class="" style="float: left !important; margin-top: 15px !important;"><li id="nav-menu-item-32" class="main-menu-item   menu-item-depth-0 menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-4 current_page_item normal_menu_item"><a  href="http://ie.shotgunflatdev.com/" class="menu-link main-menu-link"><span>Home</span></a></li>
						<li id="nav-menu-item-54" class="main-menu-item   menu-item-depth-0 menu-item menu-item-type-post_type menu-item-object-page normal_menu_item"><a  href="http://ie.shotgunflatdev.com/about/" class="menu-link main-menu-link"><span>About</span></a></li>
						<li id="nav-menu-item-53" class="main-menu-item   menu-item-depth-0 menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children has_children normal_menu_item"><a  href="http://ie.shotgunflatdev.com/privacy-policy/" class="menu-link main-menu-link"><span>Privacy Policy</span></a></li>
						<li id="nav-menu-item-52" class="main-menu-item   menu-item-depth-0 menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children has_children normal_menu_item"><a  href="http://ie.shotgunflatdev.com/site-map/" class="menu-link main-menu-link"><span>About</span></a></li>
						<li id="nav-menu-item-55" class="main-menu-item   menu-item-depth-0 menu-item menu-item-type-post_type menu-item-object-page normal_menu_item"><a  href="http://ie.shotgunflatdev.com/contact/" class="menu-link main-menu-link"><span>Contact</span></a></li>
					</ul>				
				</nav>		-->	
			
				<div id="footer_copyright_text">					
					© Copyright <?php echo date('Y'); ?> , <?php echo (isset($shard_options['copyright'])) ? $shard_options['copyright']: ''; ?>					
				</div>
				<div id="footer_logo">
					<div class="footer_logo_inner">
						<a href="<?php echo home_url(); ?>"><img src="<?php echo (isset($shard_options['footer_logo']['url']) && $shard_options['footer_logo']['url'] != '') ? $shard_options['footer_logo']['url'] : TEMPPATH.'/images/footer_logo.png';?>" alt="<?php bloginfo('name');?>"></a>
					</div>
				</div>
				<div id="footer_social">
					<?php 
					$target = (isset($shard_options['footer_social_target'])) ? $shard_options['footer_social_target'] : '_blank';
					?>
					<?php if(isset($shard_options['footer_facebook_url']) && $shard_options['footer_facebook_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_facebook_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Facebook', 'ABdev_shard') ?>" data-gravity="s"  target="<?php echo $target; ?>"><i class="icon-facebook"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_linkedin_url']) && $shard_options['footer_linkedin_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_linkedin_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Linkedin', 'ABdev_shard') ?>" data-gravity="s"  target="<?php echo $target; ?>"><i class="icon-linkedin"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_skype_url']) && $shard_options['footer_skype_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_skype_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Contact us on Skype', 'ABdev_shard') ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-skype"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_googleplus_url']) && $shard_options['footer_googleplus_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_googleplus_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Google+', 'ABdev_shard') ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-googleplus"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_twitter_url']) && $shard_options['footer_twitter_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_twitter_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Twitter', 'ABdev_shard') ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-twitter"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_youtube_url']) && $shard_options['footer_youtube_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_youtube_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Youtube','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-youtube"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_pinterest_url']) && $shard_options['footer_pinterest_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_pinterest_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Pinterest','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-pinterest"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_feed_url']) && $shard_options['footer_feed_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_feed_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Feed','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-rss"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_behance_url']) && $shard_options['footer_behance_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_behance_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Behance','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-behance"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_blogger_url']) && $shard_options['footer_blogger_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_blogger_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Blogger','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-blogger"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_delicious_url']) && $shard_options['footer_delicious_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_delicious_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Delicious','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-delicious"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_designContest_url']) && $shard_options['footer_designContest_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_designContest_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on DesignContest','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-designcontest"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_deviantART_url']) && $shard_options['footer_deviantART_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_deviantART_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on DeviantART','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-deviantart"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_digg_url']) && $shard_options['footer_digg_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_digg_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Digg','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-digg"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_dribbble_url']) && $shard_options['footer_dribbble_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_dribbble_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Dribbble','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-dribbble"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_dropbox_url']) && $shard_options['footer_dropbox_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_dropbox_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Dropbox','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-dropbox"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_email_url']) && $shard_options['footer_email_url'] != ''):?>
						<a href="mailto:<?php echo $shard_options['footer_email_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Send us Email','ABdev_shard'); ?>" data-gravity="s"><i class="icon-emailalt"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_flickr_url']) && $shard_options['footer_flickr_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_flickr_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Flickr','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-flickr"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_forrst_url']) && $shard_options['footer_forrst_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_forrst_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Forrst','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-forrst"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_instagram_url']) && $shard_options['footer_instagram_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_instagram_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Instagram','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-instagram"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_last.fm_url']) && $shard_options['footer_last.fm_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_last.fm_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Last.fm','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-lastfm"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_myspace_url']) && $shard_options['footer_myspace_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_myspace_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on MySpace','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-myspace"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_picasa_url']) && $shard_options['footer_picasa_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_picasa_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Picasa','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-picasa"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_stumbleUpon_url']) && $shard_options['footer_stumbleUpon_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_stumbleUpon_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on StumbleUpon','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-stumbleupon"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_vimeo_url']) && $shard_options['footer_vimeo_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_vimeo_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Vimeo','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-vimeo"></i></a>
					<?php endif;?>
					<?php if(isset($shard_options['footer_zerply_url']) && $shard_options['footer_zerply_url'] != ''):?>
						<a href="<?php echo $shard_options['footer_zerply_url'];?>" class="social_link dnd_tooltip" title="<?php _e('Follow us on Zerply','ABdev_shard'); ?>" data-gravity="s" target="<?php echo $target; ?>"><i class="icon-zerply"></i></a>
					<?php endif;?>
				</div>
			</div>
		</div>
	</footer>

	<?php echo (isset($shard_options['analytics_code'])) ? $shard_options['analytics_code'] : ''; ?>

	<?php wp_footer(); ?>
	
</body>
</html>