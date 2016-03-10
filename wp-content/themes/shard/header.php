<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php global $shard_options; ?>
<title><?php bloginfo('name'); wp_title(' - ',true); ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="<?php bloginfo('description'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo (isset($shard_options['favicon']['url']) && $shard_options['favicon']['url'] != '') ? $shard_options['favicon']['url'] : TEMPPATH.'/images/favicon.png';?>" />
		
<!--[if lt IE 9]>
  <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php 
$classes='';

if(isset($shard_options['enable_preloader']) && $shard_options['enable_preloader']==1){
	$classes = 'preloader';
}

if ( is_singular() ){
	wp_enqueue_script( "comment-reply" );
}
wp_head();
?>
</head>

<body <?php body_class($classes); ?>>

<?php 
$layout_no = ($shard_options['header_layout']!='') ? $shard_options['header_layout'] : '1';
$header_classes[] = 'th_style_'.$layout_no;
$header_classes[] = ($shard_options['header_style_invert']==1) ? 'th_style_invert' : '';
$header_classes = implode(' ', $header_classes);
?>

<div id="topbar_and_header" class="<?php echo $header_classes;?>">
	<?php 
	get_template_part('partials/header_layout_'.$layout_no);
	?>
</div>

<?php  echo do_shortcode('[restricted no_message="Yes"]<input type="hidden" class="loggedin"/>[/restricted]');
//echo "<input type='hidden' class='loggedin'/>";
 //echo do_shortcode('[/restricted]'); ?>


