<?php

function ABt_testimonials_shortcode($atts, $content){
	extract(shortcode_atts(array( 
		'category' 			=> '',
		'count' 			=> '8',
		'show_arrows'		=> false,
		'show_pagination'	=> false,
		'style' 			=> '1',
		'delimiter' 		=> '',
		'fx' 				=> 'crossfade',
		'easing' 			=> 'quadratic',
		'duration' 			=> '1000',
		'pauseOnHover' 		=> 'immediate',
		'timeoutduration' 	=> '5000',
		'direction' 		=> 'left',
		'play' 				=> 'true',
		'class' 			=> '',
	), $atts));

	$cat = ($category!='') ? '&testimonials-type='.$category : '';
	$query='post_type=testimonials&posts_per_page='.$count.$cat;
	$post = new WP_Query( $query );
	$out = $error = '';
	$posts_no = 0;
	if ($post->have_posts()){
		while ($post->have_posts()){
			$post->the_post();
			$postid = get_the_ID();
			$posts_no++;

			$testimonial_data = get_post_custom();
			$ABt_testimonial_client = isset($testimonial_data["ABt_testimonial_client"][0]) ? $testimonial_data["ABt_testimonial_client"][0] : ''; 
			$ABt_testimonial_client_url = isset($testimonial_data["ABt_testimonial_client_url"][0]) ? $testimonial_data["ABt_testimonial_client_url"][0] : ''; 
			$ABt_testimonial_client_url_target = isset($testimonial_data["ABt_testimonial_client_url_target"][0]) ? $testimonial_data["ABt_testimonial_client_url_target"][0] : '_blank'; 
			$ABt_testimonial_company = isset($testimonial_data["ABt_testimonial_company"][0]) ? $testimonial_data["ABt_testimonial_company"][0] : ''; 
			$ABt_testimonial_company_url = isset($testimonial_data["ABt_testimonial_company_url"][0]) ? $testimonial_data["ABt_testimonial_company_url"][0] : ''; 
			$ABt_testimonial_company_url_target = isset($testimonial_data["ABt_testimonial_company_url_target"][0]) ? $testimonial_data["ABt_testimonial_company_url_target"][0] : '_blank'; 
			$ABt_testimonial_text = isset($testimonial_data["ABt_testimonial_text"][0]) ? $testimonial_data["ABt_testimonial_text"][0] : ''; 

			$type_class = ($style == 1) ? 'testimonial_big' : 'testimonial_small';
			$picture_out = ($style == 2) ? get_the_post_thumbnail($postid, 'full') : '';
			$author_out = $company_out = '';
			if($ABt_testimonial_client!=''){
				$author_out = ($ABt_testimonial_client_url != '') ? '<a class="ABt_author" href="'.$ABt_testimonial_client_url.'" target="'.$ABt_testimonial_client_url_target.'">'.$ABt_testimonial_client.'</a>' : '<span class="ABt_author">'.$ABt_testimonial_client.'</span>';
			}
			if($ABt_testimonial_company!=''){
				$company_out = ($ABt_testimonial_company_url != '') ? '<a class="ABt_company" href="'.$ABt_testimonial_company_url.'" target="'.$ABt_testimonial_company_url_target.'">'.$ABt_testimonial_company.'</a>' : '<span class="ABt_company">'.$ABt_testimonial_company.'</span>';
			}
			$out.= '
				<li class="testimonials_item">
					<div class="'.$type_class.'">
						<p>' . $ABt_testimonial_text . '</p>
						'.$picture_out.'
						<span class="source">' . $author_out . ' ' . $delimiter . ' ' . $company_out . '</span>
					</div>
				</li>';
		}
	}
	wp_reset_postdata();

	$wrapper_class = ($posts_no>1) ? 'ABt_testimonials_wrapper' : 'ABt_testimonials_wrapper_static';
	$show_arrows_out  = ($show_arrows && $posts_no>1) ? '<div class="ABt_navigation"><a href="#" class="ABt_prev">&lt;</a> <a href="#" class="ABt_next">&gt;</a></div>' : '';
	$show_pagination_out  = ($show_pagination && $posts_no>1) ? '<div class="ABt_pagination"></div>' : '';

	return '
		<div class="'. $wrapper_class .' '. $class .'">
			'. $show_arrows_out .'
			<ul class="ABt_testimonials_slide" data-play="'. $play .'" data-fx="'. $fx .'" data-easing="'. $easing .'" data-direction="'. $direction .'" data-duration="'. $duration .'" data-pauseonhover="'. $pauseOnHover .'" data-timeoutduration="'. $timeoutduration .'">
				'. $out .'
			</ul>
			'.$show_pagination_out.'
		</div>';
}
add_shortcode( 'AB_testimonials', 'ABt_testimonials_shortcode');


function ABt_submit_form($atts, $content){
	extract(shortcode_atts(array( 
		'client_placeholder' => __('Your Name', 'ab-testimonials'),
		'client_url_placeholder' => __('Your Profile Link', 'ab-testimonials'),
		'client_image_placeholder' => __('Your Image', 'ab-testimonials'),
		'company_placeholder' => __('Your Company', 'ab-testimonials'),
		'company_url_placeholder' => __('Your Company Link', 'ab-testimonials'),
		'text_placeholder' => __('Your Testimonial', 'ab-testimonials'),
		'button_text_placeholder' => __('Submit Testimonial', 'ab-testimonials'),
		'class' => '',
	), $atts));

		static $form_number = 0;
		$form_number++;
		$form_id = 'ABt_form_' . $form_number;

		return '
			<div class="ABt_form_wrapper '.$class.'">
				<form id="' . $form_id . '" class="ABt_form" action="#" method="post">
					<input type="text" name="ABt_client" class="ABt_client" placeholder="'.$client_placeholder.'">
					<input type="text" name="ABt_client_url" class="ABt_client_url" placeholder="'.$client_url_placeholder.'">
					<input type="text" name="ABt_company" class="ABt_company" placeholder="'.$company_placeholder.'">
					<input type="text" name="ABt_company_url" class="ABt_company_url" placeholder="'.$company_url_placeholder.'">
					<textarea name="ABt_text" class="ABt_text" placeholder="'.$text_placeholder.'"></textarea>
					<label>'.$client_image_placeholder.'</label>
					<input type="file" name="ABt_client_image" class="ABt_client_image">
					<p><input type="submit" value="'.$button_text_placeholder.'"></p>
					<input type="hidden" name="ajaxnonce" value="' . wp_create_nonce( $form_id ) . '">
					<input type="hidden" name="formno" value="' . $form_number . '">
					<input type="hidden" name="action" value="ABt_save_testimonial">
				</form>
				<div class="ABt_success_message"></div>
			</div>';
}
add_shortcode( 'AB_testimonials_submit_form', 'ABt_submit_form');



function ABt_scripts() {
	wp_enqueue_style('ABt_testimonials_shortcode', plugins_url().'/ab-testimonials/css/testimonials_shortcode.css', false, '1.0.1');

	wp_enqueue_script( 'ABt_placeholder', plugins_url().'/ab-testimonials/js/jquery.placeholder.js', array('jquery'), '2.0.7', true);
	wp_enqueue_script( 'carouFredSel', plugins_url().'/ab-testimonials/js/jquery.carouFredSel-6.2.1.js', array('jquery'), '6.2.1', true);
	wp_enqueue_script( 'ABt_init', plugins_url().'/ab-testimonials/js/init.js', array('jquery-form','carouFredSel','ABt_placeholder'), '1.0.1', true);
	wp_localize_script( 'ABt_init', 'ABt_custom', array( 
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'success' => __('You testimonial has been sent successfully! It will be reviewed by administrator before publishing. Thank you!', 'ab-testimonials'),
		'error' => __('All fields except image are required!', 'ab-testimonials'),
		'sending' => __('Sending...', 'ab-testimonials'),
	));
}
add_action( 'wp_enqueue_scripts', 'ABt_scripts' );