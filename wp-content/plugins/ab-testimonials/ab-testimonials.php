<?php
/*
Plugin Name: AB Testimonials
Plugin URI: http://themeforest.net/user/ABdev?ref=ABdev
Description: Testimonials Plugin with rotator and custom post type testimonial managment
Version: 1.0.1
Author: ABdev
Author URI: http://themeforest.net/user/ABdev?ref=ABdev
*/

include_once 'shortcode.php';


function ABt_add_remove_metaboxes_testimonials() {
	remove_action('edit_form_advanced', array('sidebar_generator', 'edit_form'));
    add_meta_box("testimonials-meta", "Client data", "ABt_testimonials_manager_meta_options", "testimonials", "normal", "high");   
}
 
function ABt_testimonials_register(){
	load_plugin_textdomain( 'ab-testimonials', false, dirname(plugin_basename(__FILE__)).'/languages/' );
	
    $args = array(  
        'label' => __('Testimonials', 'ab-testimonials'),
        'labels' => array(  
			'add_new_item' => __('New testimonial', 'ab-testimonials'),  
			'new_item' => __('New testimonial', 'ab-testimonials'),  
			'edit_item' => __('Edit testimonial', 'ab-testimonials'),  
			'view_item' => __('View testimonial', 'ab-testimonials'),  
		),  
        'singular_label' => __('Testimonial', 'ab-testimonials'),  
        'public' => false,
        'menu_icon' => 'dashicons-format-chat',
        'show_ui' => true,  
        'capability_type' => 'post',  
        'hierarchical' => true,  
        'has_archive' => true,
        'exclude_from_search' => true,
        'show_in_nav_menus' => false,
        'supports' => array('thumbnail'),
        'rewrite' => false,
        'register_meta_box_cb' => 'ABt_add_remove_metaboxes_testimonials',
       );  
    register_post_type( 'testimonials' , $args );  
    register_taxonomy("testimonials-type", array("testimonials"), array("hierarchical" => true, "label" => __('Categories', 'ab-testimonials'), "singular_label" => __('Category', 'ab-testimonials'), "rewrite" => false, "slug" => 'testimonials-type',"show_in_nav_menus"=>false)); 
} 
add_action('init', 'ABt_testimonials_register');  


function ABt_testimonials_manager_edit_columns($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"name" => __('Name', 'ab-testimonials'),
		"description" => __('Testimonial', 'ab-testimonials'),
		"cat" => __('Category', 'ab-testimonials'),
		"date" => __('Date', 'ab-testimonials'),
	); 
	return $columns;
} 
add_filter("manage_edit-testimonials_columns", "ABt_testimonials_manager_edit_columns");


function abdev_get_undelete_post_link( $post_id ) {
    if( !$post_id || !is_numeric( $post_id ) ) {
        return false;
    }
    $_wpnonce = wp_create_nonce( 'untrash-post_' . $post_id );
    $url = admin_url( 'post.php?post=' . $post_id . '&action=untrash&_wpnonce=' . $_wpnonce );
    return $url; 
}


function ABt_testimonials_manager_custom_columns($column){
	global $post;
	$custom = get_post_custom();
	switch ($column){
		case "description":
			echo $custom['ABt_testimonial_text'][0];
		break;
		case "name":
			if ( get_post_status () == 'trash' ) {
				echo '<strong>'.$custom['ABt_testimonial_client'][0]. '</strong><div class="row-actions"><span class="trash"><a href="'. abdev_get_undelete_post_link( $post->ID ) .'">'.__('Restore', 'ABt').'</a></span></div>';
			} else {
				echo '<a href="'. get_edit_post_link( $post->ID ) .'"><strong>'. $custom['ABt_testimonial_client'][0]. '</strong></a><div class="row-actions"><span class="edit"><a href="'. get_edit_post_link( $post->ID ) .'">'.__('Edit', 'ABt').'</a></span> | <span class="trash"><a href="'. get_delete_post_link( $post->ID ) .'">'.__('Trash', 'ABt').'</a></span></div>';
			}
		break;
		case "cat":
			echo get_the_term_list($post->ID, 'testimonials-type');
		break;
	}
}
add_action("manage_testimonials_posts_custom_column", "ABt_testimonials_manager_custom_columns"); 
 

function ABt_testimonials_manager_meta_options(){  
	global $post;  
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post_id;
	}
	$custom = get_post_custom($post->ID);
	$ABt_testimonial_client = isset($custom["ABt_testimonial_client"][0]) ? $custom["ABt_testimonial_client"][0] : ''; 
	$ABt_testimonial_client_url = isset($custom["ABt_testimonial_client_url"][0]) ? $custom["ABt_testimonial_client_url"][0] : ''; 
	$ABt_testimonial_client_url_target = isset($custom["ABt_testimonial_client_url_target"][0]) ? $custom["ABt_testimonial_client_url_target"][0] : '_blank'; 
	$ABt_testimonial_company = isset($custom["ABt_testimonial_company"][0]) ? $custom["ABt_testimonial_company"][0] : ''; 
	$ABt_testimonial_company_url = isset($custom["ABt_testimonial_company_url"][0]) ? $custom["ABt_testimonial_company_url"][0] : ''; 
	$ABt_testimonial_company_url_target = isset($custom["ABt_testimonial_company_url_target"][0]) ? $custom["ABt_testimonial_company_url_target"][0] : '_blank'; 
	$ABt_testimonial_text = isset($custom["ABt_testimonial_text"][0]) ? $custom["ABt_testimonial_text"][0] : ''; 
	?>  
	<style type="text/css">
		.testimonials_manager_extras{margin-right: 10px;}
		.testimonials_manager_extras label{display: block;}
		.testimonials_manager_extras input{width: 50%;border: 1px solid #dfdfdf;}
		.testimonials_manager_extras textarea{width: 100%;height: 300px;}
	</style>

	<div class="testimonials_manager_extras">
		<p>
			<label><?php _e('Client Name:', 'ab-testimonials');?></label>
			<input name="ABt_testimonial_client" value="<?php echo $ABt_testimonial_client; ?>" />
		</p>
		<p>
			<label><?php _e('Client URL:', 'ab-testimonials');?></label>
			<input name="ABt_testimonial_client_url" value="<?php echo $ABt_testimonial_client_url; ?>" />
			<select name="ABt_testimonial_client_url_target" id="ABt_testimonial_client_url_target">
				<option value="_blank" <?php selected( $ABt_testimonial_client_url_target, '_blank' ); ?>>_blank</option>
				<option value="_self" <?php selected( $ABt_testimonial_client_url_target, '_self' ); ?>>_self</option>
			</select>
		</p>
		<p>
			<label><?php _e('Company:', 'ab-testimonials');?></label>
			<input name="ABt_testimonial_company" value="<?php echo $ABt_testimonial_company; ?>" />
		</p>
		<p>
			<label><?php _e('Company URL:', 'ab-testimonials');?></label>
			<input name="ABt_testimonial_company_url" value="<?php echo $ABt_testimonial_company_url; ?>" />
			<select name="ABt_testimonial_company_url_target" id="ABt_testimonial_company_url_target">
				<option value="_blank" <?php selected( $ABt_testimonial_company_url_target, '_blank' ); ?>>_blank</option>
				<option value="_self" <?php selected( $ABt_testimonial_company_url_target, '_self' ); ?>>_self</option>
			</select>
		</p>
		<p>
			<label><?php _e('Testimonial Text:', 'ab-testimonials');?></label>
			<textarea name="ABt_testimonial_text"><?php echo $ABt_testimonial_text; ?></textarea>
		</p>
		<input type="hidden" name="nonce" id="nonce" value="<?php echo wp_create_nonce(plugin_basename(__FILE__).$post->ID); ?>" />
	</div>   
	<?php  
} 
    
  
function ABt_testimonials_manager_save_extras($post_id){  
    global $post;  
    $nonce = (isset($_POST['nonce'])) ? $_POST['nonce'] : '';
    if (!wp_verify_nonce($nonce, plugin_basename(__FILE__).$post_id)) { 
    	return; 
    }
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){ 
		return $post_id;
	} elseif(is_object($post)) {
		$ABt_testimonial_client = isset($_POST["ABt_testimonial_client"]) ? $_POST["ABt_testimonial_client"] : ''; 
		$ABt_testimonial_client_url = isset($_POST["ABt_testimonial_client_url"]) ? $_POST["ABt_testimonial_client_url"] : ''; 
		$ABt_testimonial_client_url_target = isset($_POST["ABt_testimonial_client_url_target"]) ? $_POST["ABt_testimonial_client_url_target"] : '_blank'; 
		$ABt_testimonial_company = isset($_POST["ABt_testimonial_company"]) ? $_POST["ABt_testimonial_company"] : ''; 
		$ABt_testimonial_company_url = isset($_POST["ABt_testimonial_company_url"]) ? $_POST["ABt_testimonial_company_url"] : ''; 
		$ABt_testimonial_company_url_target = isset($_POST["ABt_testimonial_company_url_target"]) ? $_POST["ABt_testimonial_company_url_target"] : '_blank'; 
		$ABt_testimonial_text = isset($_POST["ABt_testimonial_text"]) ? $_POST["ABt_testimonial_text"] : ''; 

    	update_post_meta($post->ID, "ABt_testimonial_client", $ABt_testimonial_client); 
    	update_post_meta($post->ID, "ABt_testimonial_client_url", $ABt_testimonial_client_url); 
    	update_post_meta($post->ID, "ABt_testimonial_client_url_target", $ABt_testimonial_client_url_target); 
    	update_post_meta($post->ID, "ABt_testimonial_company", $ABt_testimonial_company); 
    	update_post_meta($post->ID, "ABt_testimonial_company_url", $ABt_testimonial_company_url); 
    	update_post_meta($post->ID, "ABt_testimonial_company_url_target", $ABt_testimonial_company_url_target); 
    	update_post_meta($post->ID, "ABt_testimonial_text", $ABt_testimonial_text); 
    } 
}  
add_action('save_post', 'ABt_testimonials_manager_save_extras'); 


function ABt_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['testimonials'] = array( 
		1 => __('Testimonial updated.', 'ab-testimonials'),
		2 => $messages['post'][2], 
		3 => $messages['post'][3], 
		4 => __('Testimonial updated.', 'ab-testimonials'), 
		5 => isset($_GET['revision']) ? sprintf( __('Testimonial restored to revision from %s', 'ab-testimonials'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => __('Testimonial published.', 'ab-testimonials'),
		7 => __('Testimonial saved.', 'ab-testimonials'),
		8 => __('Testimonial submitted.', 'ab-testimonials'),
		9 => sprintf( __('Testimonial scheduled for: <strong>%1$s</strong>.', 'ab-testimonials'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) )),
		10 => __('Testimonial draft updated.', 'ab-testimonials'),
	);
	return $messages;
}
add_filter( 'post_updated_messages', 'ABt_updated_messages' );


function ABt_save_testimonial(){
	$nonce = $_POST['ajaxnonce'];
	$form_id = 'ABt_form_' . $_POST['formno'];

	if ( ! wp_verify_nonce( $nonce, $form_id ) ){
		die ( 'BUSTED');
	}

	$ABt_client = (isset($_POST['ABt_client']) && $_POST['ABt_client'] != '') ? wp_filter_nohtml_kses($_POST['ABt_client']) : '';
	$ABt_client_url = (isset($_POST['ABt_client_url']) && $_POST['ABt_client_url'] != '') ? wp_filter_nohtml_kses($_POST['ABt_client_url']) : '';
	$ABt_company = (isset($_POST['ABt_company']) && $_POST['ABt_company'] != '') ? wp_filter_nohtml_kses($_POST['ABt_company']) : '';
	$ABt_company_url = (isset($_POST['ABt_company_url']) && $_POST['ABt_company_url'] != '') ? wp_filter_nohtml_kses($_POST['ABt_company_url']) : '';
	$ABt_text = (isset($_POST['ABt_text']) && $_POST['ABt_text'] != '') ? wp_filter_nohtml_kses($_POST['ABt_text']) : '';

	if ($ABt_client!='' && $ABt_client_url!='' && $ABt_company!='' && $ABt_company_url!='' && $ABt_text!='') {
		$uploaddir = wp_upload_dir();
		$file = (isset($_FILES['ABt_client_image'])) ? $_FILES['ABt_client_image'] : '';
		$uploadfile = $uploaddir['path'] . '/' . time() . basename( $file['name'] );
		move_uploaded_file( $file['tmp_name'] , $uploadfile );
		$filename = basename( $uploadfile );
		$wp_filetype = wp_check_filetype(basename($filename), null );
		$attachment = array(
		    'post_mime_type' => $wp_filetype['type'],
		    'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
		    'post_content' => '',
		    'post_status' => 'inherit',
		);
		$attach_id = wp_insert_attachment( $attachment, $uploadfile );
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		$attach_data = wp_generate_attachment_metadata( $attach_id, $uploadfile );
		wp_update_attachment_metadata( $attach_id,  $attach_data );

		global $wpdb;
		$post_data = array(
			'post_type' => 'testimonials',
			'post_status' => 'pending'
		);
		$published_id = wp_insert_post( $post_data );
		set_post_thumbnail( $published_id, $attach_id );
		add_post_meta($published_id, 'ABt_testimonial_client', $ABt_client);
		add_post_meta($published_id, 'ABt_testimonial_client_url', $ABt_client_url);
		add_post_meta($published_id, 'ABt_testimonial_client_url_target', '_blank');
		add_post_meta($published_id, 'ABt_testimonial_company', $ABt_company);
		add_post_meta($published_id, 'ABt_testimonial_company_url', $ABt_company_url);
		add_post_meta($published_id, 'ABt_testimonial_company_url_target', '_blank');
		add_post_meta($published_id, 'ABt_testimonial_text', $ABt_text);
		$out = 'OK';
	}
	else{
		$out = 'ERROR';
	}
	die($out);
}
add_action('wp_ajax_ABt_save_testimonial', 'ABt_save_testimonial');
add_action('wp_ajax_nopriv_ABt_save_testimonial', 'ABt_save_testimonial');