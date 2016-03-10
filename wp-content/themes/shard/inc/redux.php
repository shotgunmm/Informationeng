<?php
/**
	ReduxFramework Sample Config File
	For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
**/

if ( !class_exists( "ReduxFramework" ) ) {
	return;
} 


if ( !class_exists( "Shard_Redux_Framework_config" ) ) {
	class Shard_Redux_Framework_config {

		public $args = array();
		public $sections = array();
		public $theme;
		public $ReduxFramework;

		public function __construct( ) {
			$this->theme = wp_get_theme();
			$this->setArguments();
			$this->setSections();
			if ( !isset( $this->args['opt_name'] ) ) { // No errors please
				return;
			}
			$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
		}


		/**
			All the possible arguments for Redux.
			For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
		 **/
		public function setArguments() {
			$theme = wp_get_theme(); // For use with some settings. Not necessary.
			$this->args = array(
	            // TYPICAL -> Change these values as you need/desire
				'opt_name'          	=> 'shard_options', // This is where your data is stored in the database and also becomes your global variable name.
				'display_name'			=> $theme->get('Name'), // Name that appears at the top of your panel
				'display_version'		=> $theme->get('Version'), // Version that appears at the top of your panel
				'menu_type'          	=> 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'     	=> true, // Show the sections below the admin menu item or not
				'menu_title'			=> __( 'Shard Options', 'redux-framework-demo' ),
	            'page'		 	 		=> __( 'Shard Options', 'redux-framework-demo' ),
	            'google_api_key'   	 	=> '', // Must be defined to add google fonts to the typography module
	            'global_variable'    	=> '', // Set a different name for your global variable other than the opt_name
	            'dev_mode'           	=> false, // Show the time the page took to load, etc
	            'customizer'         	=> true, // Enable basic customizer support
	            // OPTIONAL -> Give you extra features
	            'page_priority'      	=> null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	            'page_parent'        	=> 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	            'page_permissions'   	=> 'manage_options', // Permissions needed to access the options panel.
	            'menu_icon'          	=> '', // Specify a custom URL to an icon
	            'last_tab'           	=> '', // Force your panel to always open to a specific tab (by id)
	            'page_icon'          	=> 'icon-themes', // Icon displayed in the admin panel next to your menu_title
	            'page_slug'          	=> '_options', // Page slug used to denote the panel
	            'save_defaults'      	=> true, // On load save the defaults to DB before user clicks save or not
	            'default_show'       	=> false, // If true, shows the default value next to each field that is not the default value.
	            'default_mark'       	=> '', // What to print by the field's title if the value shown is default. Suggested: *
	            // CAREFUL -> These options are for advanced use only
	            'transient_time' 	 	=> 60 * MINUTE_IN_SECONDS,
	            'output'            	=> true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	            'output_tab'            => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	            //'domain'             	=> 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
	            'footer_credit'      	=> ' ', // Disable the footer credit of Redux. Please leave if you can help it.
	            // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	            'database'           	=> '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	            'show_import_export' 	=> true, // REMOVE
	            'system_info'        	=> false, // REMOVE
	            'allow_tracking'        => false, // REMOVE
	            'help_tabs'          	=> array(),
	            'help_sidebar'       	=> '', // __( '', $this->args['domain'] );            
				);
			// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.		
			$this->args['share_icons'][] = array(
			    'url' => 'http://themeforest.net/user/ab-themes',
			    'title' => 'Visit us on TeamForest', 
			    'icon' => 'el-icon-leaf'
			    // 'img' => '', // You can use icon OR img. IMG needs to be a full URL.
			);		
			$this->args['share_icons'][] = array(
			    'url' => 'http://twitter.com/ab_themes_com',
			    'title' => 'Follow us on Twitter', 
			    'icon' => 'el-icon-twitter'
			);
		}


		/**
			Sections and fields declaration
		 **/
		public function setSections() {

			$this->sections[] = array(
				'title' => __('General', 'ABdev_shard'),
				'icon' => 'el-icon-cogs',
				'fields' => array(
					array(
						'id'          => 'disable_responsiveness',
						'title'       => __('Disable Responsiveness', 'ABdev_shard'),
						'desc'        => '',
						'type'        => 'checkbox',
					),
					array(
						'id'          => 'favicon',
						'title'       => __('Favicon', 'ABdev_shard'),
						'desc'        => '',
						'type'        => 'media',
					),
					array(
						'id'          => 'hide_comments',
						'title'       => __('Hide Comments', 'ABdev_shard'),
						'desc'        => __('Check this to hide WordPress commenting system', 'ABdev_shard'),
						'type'        => 'checkbox',
					),
					array(
						'id'          => 'enable_preloader',
						'title'       => __('Use Preloader', 'ABdev_shard'),
						'type'        => 'checkbox',
					),
					array(
						'id'          => 'custom_css',
						'title'       => __('Custom CSS', 'ABdev_shard'),
						'desc'        => __('Here you can place additional CSS or CSS to override theme\'s styles', 'ABdev_shard'),
						'type'        => 'textarea',
						'validate' => 'css',
						'type' => 'ace_editor',
						'mode' => 'css',
			            'theme' => 'monokai',
					),
					array(
						'id'          => 'analytics_code',
						'title'       => __('Analytics Code', 'ABdev_shard'),
						'desc'        => __('Here you can paste Google Analytics (or similar, html valid) code to be printed out on every page just before closing body tag', 'ABdev_shard'),
						'type'        => 'textarea',
						'type' => 'ace_editor',
						'mode' => 'javascript',
			            'theme' => 'monokai',
					),
				)
			);



			$this->sections[] = array(
				'title' => __('Header', 'ABdev_shard'),
				'icon' => 'el-icon-credit-card',
				'fields' => array(
					array(
						'id'=>'header_layout',
						'type' => 'select',
						'title' => __('Header Layout', 'ABdev_shard'), 
						'options' => array(
							'1' => __('Header Layout 1', 'ABdev_shard'),
							'2' => __('Header Layout 2', 'ABdev_shard'),
							'3' => __('Header Layout 3', 'ABdev_shard'),
						),
						'default' => '1'
					),
					array(
						'id'          => 'header_style_invert',
						'title'       => __('Header Backgrounds Invert', 'ABdev_shard'),
						'desc'        => '',
						'type'        => 'checkbox',
					),
					array(
						'id'          => 'header_logo',
						'title'       => __('Header Logo', 'ABdev_shard'),
						'desc'        => __('Upload header logo', 'ABdev_shard'),
						'type'        => 'media',
					),
					array(
						'id'          => 'header_freetext',
						'title'       => __('Info Message', 'ABdev_shard'),
						'desc'        => __('Enter info message to be shown in header', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'header_phone',
						'title'       => __('Phone Info', 'ABdev_shard'),
						'desc'        => __('Enter phone number for quick contact', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'header_email',
						'title'       => __('Email Info', 'ABdev_shard'),
						'desc'        => __('Enter email address for quick contact', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'linkedin_url',
						'title'       => __('Linkedin Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'facebook_url',
						'title'       => __('Facebook Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'skype_url',
						'title'       => __('Skype Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'googleplus_url',
						'title'       => __('Google+ Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'twitter_url',
						'title'       => __('Twitter Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'youtube_url',
						'title'       => __('Youtube Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'pinterest_url',
						'title'       => __('Pinterest Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'github_url',
						'title'       => __('Github Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'feed_url',
						'title'       => __('Feed Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'behance_url',
						'title'       => __('Behance Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'blogger_url',
						'title'       => __('Blogger Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'delicious_url',
						'title'       => __('Delicious Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'designContest_url',
						'title'       => __('DesignContest Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'deviantART_url',
						'title'       => __('DeviantART Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'digg_url',
						'title'       => __('Digg Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'dribbble_url',
						'title'       => __('Dribbble Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'dropbox_url',
						'title'       => __('Dropbox Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'email_url',
						'title'       => __('Email Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'flickr_url',
						'title'       => __('Flickr Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'forrst_url',
						'title'       => __('Forrst Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'instagram_url',
						'title'       => __('Instagram Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'last.fm_url',
						'title'       => __('Last.fm Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'myspace_url',
						'title'       => __('Myspace Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'picasa_url',
						'title'       => __('Picasa Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'stumbleUpon_url',
						'title'       => __('StumbleUpon Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'vimeo_url',
						'title'       => __('Vimeo Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'zerply_url',
						'title'       => __('Zerply Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'=>'header_social_target',
						'type' => 'select',
						'title' => __('Links Target', 'ABdev_shard'), 
						'options' => array('_self' => '_self','_blank' => '_blank'),
						'default' => '_blank'
					),
					array(
						'id'          => 'hide_title_breadcrumbs_bar',
						'title'       => __('Hide Title/Breadcrumbs Bar', 'ABdev_shard'),
						'type'        => 'checkbox',
					),
					array(
						'id'          => 'hide_title_from_bar',
						'title'       => __('Hide Title From Bar', 'ABdev_shard'),
						'type'        => 'checkbox',
					),
					array(
						'id'          => 'hide_breadcrumbs_from_bar',
						'title'       => __('Hide Breadcrumbs From Bar', 'ABdev_shard'),
						'type'        => 'checkbox',
					),
					array(
					    'id' => 'title_breadcrumbs_bar_background',
					    'type' => 'background',
					    'default' => array(
					    	'background-color' => '#777e8e',
					    	),
					    'output' => array('#title_breadcrumbs_bar'),
					    'title' => __('Title/Breadcrumbs Bar Background', 'redux-framework-demo'),
					),
					array(
						'id'          => 'show_bokah_breadcrumbs_bar',
						'title'       => __('Show animated bokah over background image', 'ABdev_shard'),
						'type'        => 'checkbox',
					),

				)
			);



			$this->sections[] = array(
				'title' => __('Sidebars', 'ABdev_shard'),
				'icon' => 'el-icon-lines',
				'fields' => array(
					array(
						'id'          => 'sidebars',
						'title'       => 'Sidebars',
						'desc'        => __('Add as many custom sidebars as you need', 'ABdev_shard'),
						'type' => 'multi_text',
					)
				)
			);




			$this->sections[] = array(
				'title' => __('Colors', 'ABdev_shard'),
				'icon' => 'el-icon-brush',
				'fields' => array(
					array(
						'id'          => 'main_color',
						'title'       => __('Main Color', 'ABdev_shard'),
						'default' => '#ff3b30',
						'type' => 'color',
						'validate' => 'color'
					),
				)
			);


			$this->sections[] = array(
				'title' => __('Portfolio', 'ABdev_shard'),
				'icon' => 'el-icon-book',
				'fields' => array(
					array(
						'id'          => 'content_after_portfolio_column_3',
						'title'       => __('Additional Content After Portfolio Column 3', 'ABdev_shard'),
						'desc'        => __('Enter content to be shown at the bottom of Portfolio Column 3 page, before footer.', 'ABdev_shard'),
						'type'        => 'editor',
					),
					array(
						'id'          => 'content_after_portfolio_column_4',
						'title'       => __('Additional Content After Portfolio Column 4', 'ABdev_shard'),
						'desc'        => __('Enter content to be shown at the bottom of Portfolio Column 4 page, before footer.', 'ABdev_shard'),
						'type'        => 'editor',
					),
					array(
						'id'          => 'content_after_portfolio_column_single',
						'title'       => __('Additional Content After Portfolio Column Single', 'ABdev_shard'),
						'desc'        => __('Enter content to be shown at the bottom of Portfolio Column Single page, before footer.', 'ABdev_shard'),
						'type'        => 'editor',
					),
					array(
						'id'          => 'content_after_portfolio_single',
						'title'       => __('Additional Content After Portfolio Single', 'ABdev_shard'),
						'desc'        => __('Enter content to be shown at the bottom of Portfolio Single page, before footer.', 'ABdev_shard'),
						'type'        => 'editor',
					),
					array(
						'id'          => 'portfolio_single_background_image',
						'title'       => __('Portfolio Single Background Image', 'ABdev_shard'),
						'desc'        => __('Upload Portfolio Single Background Image', 'ABdev_shard'),
						'type'        => 'media',
					),
				)
			);


			$this->sections[] = array(
				'title' => __('Footer', 'ABdev_shard'),
				'icon' => 'el-icon-credit-card',
				'fields' => array(
					array(
						'id'          => 'copyright',
						'title'       => __('Copyright Notice', 'ABdev_shard'),
						'desc'        => __('Enter copyright notice to be shown in footer', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_logo',
						'title'       => __('Footer Logo', 'ABdev_shard'),
						'desc'        => __('Upload footer logo', 'ABdev_shard'),
						'type'        => 'media',
					),
					array(
						'id'          => 'footer_linkedin_url',
						'title'       => __('Linkedin Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_facebook_url',
						'title'       => __('Facebook Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_skype_url',
						'title'       => __('Skype Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_googleplus_url',
						'title'       => __('Google+ Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_twitter_url',
						'title'       => __('Twitter Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_youtube_url',
						'title'       => __('Youtube Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_pinterest_url',
						'title'       => __('Pinterest Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_github_url',
						'title'       => __('Github Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_feed_url',
						'title'       => __('Feed Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_behance_url',
						'title'       => __('Behance Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_blogger_url',
						'title'       => __('Blogger Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_delicious_url',
						'title'       => __('Delicious Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_designContest_url',
						'title'       => __('DesignContest Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_deviantART_url',
						'title'       => __('DeviantART Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_digg_url',
						'title'       => __('Digg Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_dribbble_url',
						'title'       => __('Dribbble Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_dropbox_url',
						'title'       => __('Dropbox Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_email_url',
						'title'       => __('Email Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_flickr_url',
						'title'       => __('Flickr Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_forrst_url',
						'title'       => __('Forrst Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_instagram_url',
						'title'       => __('Instagram Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_last.fm_url',
						'title'       => __('Last.fm Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_myspace_url',
						'title'       => __('Myspace Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_picasa_url',
						'title'       => __('Picasa Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_stumbleUpon_url',
						'title'       => __('StumbleUpon Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_vimeo_url',
						'title'       => __('Vimeo Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'          => 'footer_zerply_url',
						'title'       => __('Zerply Profile', 'ABdev_shard'),
						'type'        => 'text',
					),
					array(
						'id'=>'footer_social_target',
						'type' => 'select',
						'title' => __('Links Target', 'ABdev_shard'), 
						'options' => array('_self' => '_self','_blank' => '_blank'),
						'default' => '_blank'
					),

				)
			);

  
		}	


	}
	new Shard_Redux_Framework_config();
}

