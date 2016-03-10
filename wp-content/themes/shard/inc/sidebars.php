<?php
if ( function_exists( 'register_sidebar' ) ) {

	register_sidebar( array (
		'name' => __( 'Primary Sidebar', 'ABdev_shard'),
		'id' => 'primary-widget-area',
		'description' => __( 'The Primary Widget Area', 'ABdev_shard'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<div class="sidebar-widget-heading"><h5>',
		'after_title' => '</h5></div>',
	) );


	register_sidebar( array (
		'name' => __( 'Search Results Sidebar', 'ABdev_shard' ),
		'id' => 'search-results-widget-area',
		'description' => __( 'Search Results Sidebar', 'ABdev_shard'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class=sidebar-widget-heading>',
		'after_title' => '</h3>',
	) );

	
	register_sidebar( array (
		'name' => __( 'First Footer Widget', 'ABdev_shard' ),
		'id' => 'first-footer-widget',
		'description' => __( 'First Footer Widget Area', 'ABdev_shard' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class=footer-widget-heading>',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array (
		'name' => __( 'Second Footer Widget', 'ABdev_shard'),
		'id' => 'second-footer-widget',
		'description' => __( 'Second Footer Widget Area', 'ABdev_shard' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class=footer-widget-heading>',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array (
		'name' => __( 'Third Footer Widget', 'ABdev_shard' ),
		'id' => 'third-footer-widget',
		'description' => __( 'Third Footer Widget Area', 'ABdev_shard' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class=footer-widget-heading>',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array (
		'name' => __( 'Fourth Footer Widget', 'ABdev_shard' ),
		'id' => 'fourth-footer-widget',
		'description' => __( 'Fourth Footer Widget Area', 'ABdev_shard'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class=footer-widget-heading>',
		'after_title' => '</h4>',
	) );
	
	
}