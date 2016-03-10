<?php  
$post_id_post = isset($_POST['post_ID']) ? $_POST['post_ID'] : '' ;
$post_id = isset($_GET['post']) ? $_GET['post'] : $post_id_post ;

$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);

if ( ! function_exists( 'ABdev_showhide_metabox_script_enqueuer' ) ){
function ABdev_showhide_metabox_script_enqueuer() {
	global $current_screen;
	if('page' != $current_screen->id){
		return;
	}

	echo <<<HTML
		<script type="text/javascript">
		jQuery(document).ready( function($) {
			if($('#page_template').val() == 'page-front-page-revolution.php') {
				$('#front-page-metabox-options').show();
			} else {
				$('#front-page-metabox-options').hide();
			}
			$('#page_template').live('change', function(){
				if($(this).val() == 'page-front-page-revolution.php') {
					$('#front-page-metabox-options').show();
				} else {
					$('#front-page-metabox-options').hide();
				}
			}); 

			if($('#page_template').val() != 'page-front-page-revolution.php') {
				$('#page-subtitle-metabox-options').show();
			} else {
				$('#page-subtitle-metabox-options').hide();
			}
			$('#page_template').live('change', function(){
				if($(this).val() != 'page-front-page-revolution.php') {
					$('#page-subtitle-metabox-options').show();
				} else {
					$('#page-subtitle-metabox-options').hide();
				}
			}); 

			if($('#page_template').val() == 'page-portfolio.php' || $('#page_template').val() == 'page-portfolio-3columns.php' || $('#page_template').val() == 'page-portfolio-4columns.php') {
				$('#portfolio-page-metabox-options').show();
			} else {
				$('#portfolio-page-metabox-options').hide();
			}
			$('#page_template').live('change', function(){
				if($(this).val() == 'page-portfolio.php' || $(this).val() == 'page-portfolio-3columns.php' || $(this).val() == 'page-portfolio-4columns.php') {
					$('#portfolio-page-metabox-options').show();
				} else {
					$('#portfolio-page-metabox-options').hide();
				}
			});                 
			

			if($('#page_template').val() == 'default' || $('#page_template').val() == 'page-left-sidebar.php') {
				$('#sidebar-page-metabox-options').show();
			} else {
				$('#sidebar-page-metabox-options').hide();
			}
			$('#page_template').live('change', function(){
				if($(this).val() == 'default' || $(this).val() == 'page-left-sidebar.php') {
					$('#sidebar-page-metabox-options').show();
				} else {
					$('#sidebar-page-metabox-options').hide();
				}
			});                 
			
		});    
		</script>
HTML;
}
}
add_action('admin_head', 'ABdev_showhide_metabox_script_enqueuer');

if ( ! function_exists( 'ABdevFW_add_meta_box' ) ){
	function ABdevFW_add_meta_box(){  
		add_meta_box( 'front-page-metabox-options', __('Frontpage options', 'ABdev_shard' ), 'ABdevFW_construct_frontpage_meta_box', 'page', 'normal', 'high' );  
		add_meta_box( 'page-subtitle-metabox-options', __('Subtitle', 'ABdev_shard' ), 'ABdevFW_construct_subtitle_meta_box', 'page', 'normal', 'high' );  
		add_meta_box( 'portfolio-page-metabox-options', __('Display categories', 'ABdev_shard' ), 'ABdevFW_construct_portfolio_meta_box', 'page', 'normal', 'high' );  
		add_meta_box( 'sidebar-page-metabox-options', __('Select Sidebar', 'ABdev_shard' ), 'ABdevFW_construct_sidebar_meta_box', 'page', 'normal', 'high' );  
	}
}
add_action( 'add_meta_boxes', 'ABdevFW_add_meta_box' );  



if ( ! function_exists( 'ABdevFW_construct_sidebar_meta_box' ) ){
	function ABdevFW_construct_sidebar_meta_box( $post ){ 
		global $shard_options;
		$shard_user_sidebars = isset($shard_options['sidebars'])?$shard_options['sidebars'] : '';
		$values = get_post_custom( $post->ID );
		$custom_sidebar = (isset($values['custom_sidebar'][0])) ? $values['custom_sidebar'][0] : '';
		wp_nonce_field( 'my_meta_box_sidebar_nonce', 'meta_box_sidebar_nonce' );
		?>  
		<p>  
			<select name="custom_sidebar" id="custom_sidebar">  
					<option value=""><?php _e('Default', 'ABdev_shard') ?></option> ';
				<?php foreach ($shard_user_sidebars as $sidebar) {
					echo '<option value="'.$sidebar.'" '. selected( $custom_sidebar, $sidebar, false ) . '>' . $sidebar . '</option> ';
				}
				?>
			</select>  
		</p>
		<?php
	}
}

if ( ! function_exists( 'ABdevFW_save_sidebar_meta_box' ) ){
	function ABdevFW_save_sidebar_meta_box( $post_id ){ 
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){ 
			return; 
		}
		if( !isset( $_POST['custom_sidebar'] ) || !wp_verify_nonce( $_POST['meta_box_sidebar_nonce'], 'my_meta_box_sidebar_nonce' ) ) {
			return; 
		}
		if( !current_user_can( 'edit_pages' ) ) {
			return;  
		}
		if( isset( $_POST['custom_sidebar'] ) ){
			update_post_meta( $post_id, 'custom_sidebar', wp_kses( $_POST['custom_sidebar'] ,'') );  
		}
	}
}
if ($template_file == 'page.php' || $template_file == 'page-left-sidebar.php'){
	add_action( 'save_post', 'ABdevFW_save_sidebar_meta_box' );  
}



if ( ! function_exists( 'ABdevFW_construct_portfolio_meta_box' ) ){
	function ABdevFW_construct_portfolio_meta_box( $post ){ 
		$tax_terms = get_terms('portfolio-category');
		if(is_array($tax_terms)){
			foreach ($tax_terms as $tax_term) {
				$slugs[] = $tax_term->slug;
			}
			$values = get_post_custom( $post->ID ); 
			$categories = isset( $values['categories'] ) ? esc_attr( $values['categories'][0] ) : '';
			$categories = explode(',',$categories);
			if(empty($categories[0])){
				$categories=$slugs;
			}
			wp_nonce_field( 'my_meta_box_portfolio_nonce', 'meta_box_portfolio_nonce' );
			?>  
			<p>
				<?php
				foreach ($tax_terms as $tax_term) {
					echo '<label for="categories['.$tax_term->slug.']"><input type="checkbox" id="categories['.$tax_term->slug.']" name="categories['.$tax_term->slug.']" value="'.$tax_term->slug.'" '; 
					if(in_array($tax_term->slug , $categories)){
						echo 'checked';
					}
					echo'> '.$tax_term->name .' ('.$tax_term->count.')</label><br>';
				}
				?>
			</p><?php
		}
		else{
			_e('Portfolio plugin must be installed and at least one portfolio category created', 'ABdev_shard');
		}
	}
}

if ( ! function_exists( 'ABdevFW_save_portfolio_meta_box' ) ){
	function ABdevFW_save_portfolio_meta_box( $post_id ){ 
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){ 
			return; 
		}
		if( !isset( $_POST['categories'] ) || !wp_verify_nonce( $_POST['meta_box_portfolio_nonce'], 'my_meta_box_portfolio_nonce' ) ) {
			return; 
		}
		if( !current_user_can( 'edit_pages' ) ) {
			return;  
		}
		if( isset( $_POST['categories'] ) ){
			$categories=implode(',',$_POST['categories']);
			update_post_meta( $post_id, 'categories', wp_kses( $categories ,'') );  
		}
	}
}
if ($template_file == 'page-portfolio.php' || $template_file == 'page-portfolio-3columns.php' || $template_file == 'page-portfolio-4columns.php'){
	add_action( 'save_post', 'ABdevFW_save_portfolio_meta_box' );  
}





if ( ! function_exists( 'ABdevFW_construct_frontpage_meta_box' ) ){
	function ABdevFW_construct_frontpage_meta_box( $post ){  
		$values = get_post_custom( $post->ID );  
		$revslider_alias = isset( $values['revslider_alias'] ) ? esc_attr( $values['revslider_alias'][0] ) : ''; 
		
		// We'll use this nonce field later on when saving.  
		wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
		?>  
		
		<div id='revslider_options'>
			<h4><?php _e('Revolution Slider Options', 'ABdev_shard' ); ?></h4>
			<?php 
			if(class_exists('RevSlider')){
				$slider = new RevSlider();
				$arrSliders = $slider->getArrSlidersShort();
						
				if(empty($arrSliders)){
					_e('No sliders found, Please create a slider', 'ABdev_shard');
				}
				else{
					$select = UniteFunctionsRev::getHTMLSelect($arrSliders,$revslider_alias,'name="revslider_alias" id="revslider_alias"',true);
					?>
					<p>
					<label for="revslider_alias"><?php _e('Choose Slider', 'ABdev_shard' ); ?></label> 
					<?php echo $select; ?>
					</p>
					<?php
				}
			}
			else{
				_e('Slider Revolution plugin not installed', 'ABdev_shard');
			}
				?>
		</div>
		<?php 
	}
}
if ( ! function_exists( 'ABdevFW_save_frontpage_meta_box' ) ){
	function ABdevFW_save_frontpage_meta_box( $post_id ){  
		// Bail if we're doing an auto save  
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return; 
		}
		// if our nonce isn't there, or we can't verify it, bail 
		if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) {
			return; 
		}
		// if our current user can't edit this post, bail  
		if( !current_user_can( 'edit_pages' ) ) {
			return;  
		}
		// now we can actually save the data  
		
		if( isset( $_POST['revslider_alias'] ) )  {
			update_post_meta( $post_id, 'revslider_alias', esc_attr( $_POST['revslider_alias'] ) ); 
		}
	}
}
if ($template_file == 'page-front-page-revolution.php'){
	add_action( 'save_post', 'ABdevFW_save_frontpage_meta_box' );  
}




if ( ! function_exists( 'ABdevFW_construct_subtitle_meta_box' ) ){
	function ABdevFW_construct_subtitle_meta_box( $post ){  
		$values = get_post_custom( $post->ID );  
		$page_subtitle = isset( $values['page_subtitle'] ) ? esc_attr( $values['page_subtitle'][0] ) : ''; 
		
		// We'll use this nonce field later on when saving.  
		wp_nonce_field( 'my_meta_box_subtitle_nonce', 'meta_box_subtitle_nonce' );
		?>  
		
		<div id='subtitle_options'>
			<?php _e('Page Subtitle', 'ABdev_shard' ); ?> <input name="page_subtitle" id="page_subtitle" value="<?php echo $page_subtitle; ?>" style="width:50%">
		</div>
		<?php 
	}
}
if ( ! function_exists( 'ABdevFW_save_subtitle_meta_box' ) ){
	function ABdevFW_save_subtitle_meta_box( $post_id ){  
		// Bail if we're doing an auto save  
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return; 
		}
		// if our nonce isn't there, or we can't verify it, bail 
		if( !isset( $_POST['meta_box_subtitle_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_subtitle_nonce'], 'my_meta_box_subtitle_nonce' ) ) {
			return; 
		}
		// if our current user can't edit this post, bail  
		if( !current_user_can( 'edit_pages' ) ) {
			return;  
		}
		// now we can actually save the data  
		
		if( isset( $_POST['page_subtitle'] ) )  {
			update_post_meta( $post_id, 'page_subtitle', esc_attr( $_POST['page_subtitle'] ) ); 
		}
	}
}
if ($template_file != 'page-front-page-revolution.php'){
	add_action( 'save_post', 'ABdevFW_save_subtitle_meta_box' );  
}
