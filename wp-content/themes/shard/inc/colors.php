<?php 

if ( ! function_exists( 'ABdev_colors_css_hex2rgb' ) ){
	function ABdev_colors_css_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return implode(",", $rgb); 
	} 
}

if ( ! function_exists( 'ABdev_colors_css_adjustBrightness' ) ){
	function ABdev_colors_css_adjustBrightness($hex, $steps) {
		// Steps should be between -255 and 255. Negative = darker, positive = lighter
		$steps = max(-255, min(255, $steps));
		$hex = str_replace('#', '', $hex);
		if (strlen($hex) == 3) {
			$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
		}
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
		$r = max(0,min(255,$r + $steps));
		$g = max(0,min(255,$g + $steps));  
		$b = max(0,min(255,$b + $steps));
		$r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
		$g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
		$b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
		return '#'.$r_hex.$g_hex.$b_hex;
	}
}



if(isset($shard_options['main_color']) && $shard_options['main_color'] != ''){ 
	$main_color = $shard_options['main_color'];
	$hover_shadow = ABdev_colors_css_adjustBrightness($main_color, '-20');
	$custom_css.= '
		.dnd_section_dd.we_love_our_works.section_with_header header i{color: '.$main_color.';}
		.dnd-tabs .ui-tabs-nav li.ui-tabs-active a{color: '.$main_color.';}
		.dnd-accordion .ui-accordion-header:hover{color:'.$main_color.';}
		.dnd-accordion .ui-accordion-header-active { color:'.$main_color.';}
		.dnd-table.dnd-table-alternative th{color: #fff;background: '.$main_color.';}
		.dnd_blockquote{border-left: 3px solid '.$main_color.';}
		.dnd_stats_excerpt i{color: '.$main_color.';}
		.dnd_team_member .dnd-button{border: 1px solid '.$main_color.';color: #fff;}
		.dnd_team_member .dnd-button:after{background: '.$main_color.';}
		.dnd_team_member .dnd_overlayed .dnd_overlay .dnd_team_member_modal_link:hover{color: '.$main_color.';}
		.dnd_team_member_modal .dnd_team_member_position{color:  '.$main_color.';}
		.dnd_team_member_social_under a:hover i{color: '.$main_color.';}
		.dnd_latest_news_time{color: #fff;background: '.$main_color.';}
		.dnd_posts_shortcode_style1 .dnd_post_single.has_thumbnail .dnd_latest_news_shortcode_content h5 a:hover,.dnd_posts_shortcode_style2 .dnd_post_single.has_thumbnail .dnd_latest_news_shortcode_content h5 a:hover,.dnd_posts_shortcode_style3 .dnd_post_single.has_thumbnail .dnd_latest_news_shortcode_content h5 a:hover{color:  '.$main_color.';}
		.dnd_pricing-table-1 .dnd_pricebox_header{background: #cee6e6;color: '.$main_color.';}
		.dnd_pricing-table-2 .dnd_pricebox_header{background: #202024;color: '.$main_color.';}
		.dnd_pricing-table-2 .dnd_popular-plan .dnd_pricebox_monthly{color:  '.$main_color.';}
		.dnd_pricing-table-2 .dnd_popular-plan .dnd_pricebox_name{background: '.$main_color.';color: #f7f7f7;}
		.dnd_pricebox_feature .ABdev_icon-remove{color:'.$main_color.';}
		.dnd_service_box_round h3:hover{color:  '.$main_color.';}
		.process_section .dnd_service_box .dnd_icon_boxed{background: '.$main_color.';}
		.dnd_service_box .dnd_icon_boxed i{color: '.$main_color.';}
		.dnd_service_box.dnd_service_box_round_stroke .dnd_icon_boxed{border: 3px solid '.$main_color.';}
		.dnd_service_box.dnd_service_box_round_stroke .dnd_icon_boxed i{color: '.$main_color.';}
		.dnd_service_box.dnd_service_box_round_aside h3:hover a,.dnd_service_box.dnd_service_box_round_aside2 h3:hover{color: '.$main_color.';}
		.dnd_service_box.dnd_service_box_round_aside .dnd_icon_boxed,.dnd_service_box.dnd_service_box_round_aside2 .dnd_icon_boxed{background: '.$main_color.';}
		.dnd_service_box .dnd_icon_boxed:hover:after{border-top: 9px solid '.$main_color.';}
		.dnd_service_box .service_box_subtitle{color:  '.$main_color.';}
		.dnd_pullquote{border-left: 3px solid '.$main_color.';}
		.dnd_dropcap{color: '.$main_color.';}
		.dnd-button_dark{background: #202024;border: 1px solid '.$main_color.';color: #fff !important;}
		.dnd-button_dark:hover{border: 1px solid '.$main_color.';color: #fff !important;}
		.dnd-button_dark:after{background: '.$main_color.';}
		.dnd-button_red{background: #fff;border: 1px solid '.$main_color.';color: #202024 !important;}
		.dnd-button_red:hover{border: 1px solid '.$main_color.';color: #fff !important;}
		.dnd-button_red:after{background: '.$main_color.';}
		.dnd-button_light{border: 1px solid '.$main_color.';color: #202024 !important;}
		.dnd-button_light:hover{border: 1px solid '.$main_color.';color: #202024 !important;}
		.dnd-button_rounded.dnd-button_large{background-color:  '.$main_color.';color: #fff !important;}
		.dnd-button_rounded.dnd-button_large:hover{background: #fff;border: 1px solid '.$main_color.';}
		a{color: '.$main_color.';}
		.dnd_section_dd.typo_shortcodes i{color: '.$main_color.';}
		button,input[type="submit"] {border: 1px solid '.$main_color.';background: '.$main_color.';color: #fff;}
		.color_highlight{color: '.$main_color.';}
		.section_color_background{background: '.$main_color.';}
		.leading_line:after{background: '.$main_color.';}
		#ABdev_menu_search .submit i{color: '.$main_color.';}
		#logo:before{background-color: '.$main_color.';}
		nav > ul ul{background: #ececec;box-shadow: 0px 0px 20px 0px rgba( 0, 0, 0, 0.1 );border-top: 2px solid '.$main_color.';}
		#portfolio_magic-line{border: 1px solid '.$main_color.';}
		#topbar_and_header.th_style_2 #header_phone_email_info a:hover{color: '.$main_color.';}
		#topbar_and_header.th_style_2 #header_social_search .social_link:hover i{color: '.$main_color.';}
		#topbar_and_header.th_style_2.th_style_invert #header_phone_email_info a:hover,#topbar_and_header.th_style_2.th_style_invert #header_social_search .social_link i:hover{color: '.$main_color.';}
		#topbar_and_header.th_style_1 #header_social_search .social_link:hover i,#topbar_and_header.th_style_1 #header_phone_email_info a:hover{color: '.$main_color.';}
		#topbar_and_header.th_style_3 #magic-line{background: '.$main_color.';}
		#topbar_and_header.th_style_3 #header_social_search span:hover a,#topbar_and_header.th_style_3 #header_social_search .social_link i:hover{color: '.$main_color.';}
		.sf-mega-inner{border-top: 2px solid '.$main_color.';background: #ececec;}
		nav > ul .sf-mega-inner .description_menu_item a{color: '.$main_color.';}
		#title_breadcrumbs_bar .breadcrumbs:before{background-color: '.$main_color.';}
		.tp-leftarrow.default:hover,.tp-rightarrow.default:hover {background: '.$main_color.' !important;}
		.timeline_post h3 a:hover{color:  '.$main_color.';}
		.timeline_postmeta a:hover{color:  '.$main_color.';}
		.timeline_post_left:after,.timeline_post_right:after{background: '.$main_color.';}
		.post_content .author_and_categories_badges .categories ul li:hover a{color: '.$main_color.';}
		.post_content .post_main h3.post_main_title a:hover{color: '.$main_color.';}
		.post_content .post_badges i{color: #fff;background: '.$main_color.';}
		.post_content .post_badges_single i{color: #fff;background: '.$main_color.';}
		.post_meta_tags a:hover{color: '.$main_color.';}
		.post_main .postmeta-above a:hover,.post_main .post-readmore a:hover{color: '.$main_color.';}
		.comment .comment-text .reply,.comment .comment-text .reply a{color: '.$main_color.';}
		.comment .reply a:hover,.comment .edit-link a:hover{color: '.$main_color.';}
		#respond #comment-submit{background: '.$main_color.';}
		#blog_pagination .page-numbers.current,#blog_pagination .page-numbers:hover{color: '.$main_color.';}
		#inner_post_pagination > a:hover{background: #505558;color: '.$main_color.';}
		#dz_contact_form_submit{background: '.$main_color.' !important;}
		.dnd_section_dd.contact_section_alternative .wpcf7-submit{background: '.$main_color.' !important;color: #fff;}
		aside .widget a:hover{color: '.$main_color.';}
		.widget_categories ul li a:before,.widget_pages ul li a:before,.widget_nav_menu ul li a:before{border-left: 3px solid '.$main_color.';}
		.widget_search i{color: '.$main_color.';}
		.tagcloud a:hover{background: '.$main_color.';color: #fff !important;}
		.portfolio_item h4 a:hover{color: '.$main_color.';}
		.portfolio_item .dnd-button{border: 1px solid '.$main_color.';color: #fff;}
		.portfolio_item .dnd-button:after{background: '.$main_color.';}
		.portfolio_item_view_link a{background: #fff;border: 1px solid '.$main_color.';color: #202024;}
		.portfolio_item_view_link a:hover,.portfolio_item_view_link a:hover i{color: '.$main_color.';}
		.portfolio_single_column_item h2:hover a{color: '.$main_color.';}
		.home_version_2_recent_works .more_portfolio_link a{border: 1px solid '.$main_color.';}
		.home_version_2_recent_works .more_portfolio_link a:hover{background: '.$main_color.';}
		#main_footer .widget_pages li a:hover,#main_footer .widget_recent_entries li a:hover,#main_footer .widget_archive li a:hover,#main_footer .widget_nav_menu li a:hover,#main_footer .widget_meta li a:hover,#main_footer .widget_rss li a:hover,#main_footer .widget_categories li a:hover{color:'.$main_color.';}
		#footer_social i:hover{color: '.$main_color.';}
		#footer_logo:before{background-color: '.$main_color.';}
	';
}

