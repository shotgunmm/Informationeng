<?php 

add_action( 'admin_menu', 'dnd_add_admin_menu' );
add_action( 'admin_init', 'dnd_settings_init' );

function dnd_add_admin_menu(  ) { 
	add_options_page( __( 'Drag and Drop Shortcodes', 'dnd-shortcodes' ), __( 'Drag and Drop Shortcodes', 'dnd-shortcodes' ), 'manage_options', 'drag_and_drop_shortcodes', 'drag_and_drop_shortcodes_options_page' );
}

function dnd_settings_exist(  ) { 
	if( false == get_option( 'drag_and_drop_shortcodes_settings' ) ) { 
		add_option( 'drag_and_drop_shortcodes_settings' );
	}
}

function dnd_settings_init(  ) { 
	register_setting( 'dnd_options_page', 'dnd_settings' );
	add_settings_section(
		'dnd_shortcodes_settings', 
		__( 'General', 'dnd-shortcodes' ), 
		'', 
		'dnd_options_page'
	);
	add_settings_field( 
		'dnd_disable_on', 
		__( "Disable D'n'D Tab on", 'dnd-shortcodes' ), 
		'dnd_disable_on_render', 
		'dnd_options_page', 
		'dnd_shortcodes_settings' 
	);
	add_settings_field( 
		'dnd_excerpt', 
		__( 'Excerpt content', 'dnd-shortcodes' ), 
		'dnd_excerpt_render', 
		'dnd_options_page', 
		'dnd_shortcodes_settings' 
	);
	add_settings_field( 
		'dnd_sidebars', 
		__( 'Additional Sidebars', 'dnd-shortcodes' ), 
		'dnd_sidebars_render', 
		'dnd_options_page', 
		'dnd_shortcodes_settings' 
	);

	add_settings_field( 
		'dnd_tipsy_opacity', 
		__( 'Tooltip Opacity', 'dnd-shortcodes' ), 
		'dnd_tipsy_opacity_render', 
		'dnd_options_page', 
		'dnd_shortcodes_settings' 
	);

	add_settings_section(
		'dnd_shortcodes_icons', 
		__( 'Font Icons', 'dnd-shortcodes' ), 
		'dnd_icons_section_render', 
		'dnd_options_page'
	);
	add_settings_field( 
		'dnd_enable_fa', 
		__( 'FontAwesome', 'dnd-shortcodes' ), 
		'dnd_enable_fa_render', 
		'dnd_options_page', 
		'dnd_shortcodes_icons' 
	);
	add_settings_field( 
		'dnd_enable_whhg', 
		__( 'WebHostingHubGlyphs', 'dnd-shortcodes' ), 
		'dnd_enable_whhg_render', 
		'dnd_options_page', 
		'dnd_shortcodes_icons' 
	);
}

function dnd_disable_on_render(  ) { 
	$options = get_option( 'dnd_settings' );
	$dnd_disable_on = (isset($options['dnd_disable_on'])) ? $options['dnd_disable_on'] : '';
	?>
	<input type='text' name='dnd_settings[dnd_disable_on]' value='<?php echo $dnd_disable_on; ?>'>
	<p class="description"><?php _e( 'Coma-separated list of post types for which you want to disable Drag&amp;Drop tab<br><small>(e.g. post, page, forum)</small>', 'dnd-shortcodes' ) ?></p>
	<?php
}

function dnd_excerpt_render(  ) { 
	$options = get_option( 'dnd_settings' );
	$dnd_excerpt = (isset($options['dnd_excerpt'])) ? $options['dnd_excerpt'] : 0;
	?>
	<label for="dnd_settings[dnd_excerpt]">
		<input type='checkbox' name='dnd_settings[dnd_excerpt]' id='dnd_settings[dnd_excerpt]' <?php checked( $dnd_excerpt, 1 ); ?> value='1'>
		<?php _e( 'Show shortcode content in excerpt', 'dnd-shortcodes' ) ?>
	</label>
	<p class="description"><?php _e( 'Content inside shortcode is not visible in excerpt by default. To enable it use this option. It will use custom function for excerpt output.', 'dnd-shortcodes' ) ?></p>
	<?php
}

function dnd_sidebars_render(  ) { 
	$options = get_option( 'dnd_settings' );
	$dnd_sidebars = (isset($options['dnd_sidebars'])) ? $options['dnd_sidebars'] : '';
	?>
	<input type='text' name='dnd_settings[dnd_sidebars]' value='<?php echo $dnd_sidebars; ?>'>
	<p class="description"><?php _e( 'Coma-separated list of sidebars to add. You can add widgets in created sidebars and use sidebars in Sidebar shortcode - this way all widgets are supported by Drag and Drop Shortcodes plugin.<br><small>(e.g. My First Sidebar, My Second Sidebar)</small>', 'dnd-shortcodes' ) ?></p>
	<?php
}

function dnd_tipsy_opacity_render(  ) { 
	$options = get_option( 'dnd_settings' );
	$dnd_tipsy_opacity = (isset($options['dnd_tipsy_opacity'])) ? $options['dnd_tipsy_opacity'] : '0.8';
	?>
	<input type='text' name='dnd_settings[dnd_tipsy_opacity]' value='<?php echo $dnd_tipsy_opacity; ?>'>
	<p class="description"><?php _e( 'Balloon tooltip opacity. Values from 0.0 to 1.0, default is 0.8.', 'dnd-shortcodes' ) ?></p>
	<?php
}

function dnd_icons_section_render(  ) { 
	_e('Here you can enable font icon packs that you wish to use and see complete list of icons with their names. You can also use icon name of any similar icon pack that is bundled with theme.', 'dnd-shortcodes' );
}


function dnd_enable_fa_render(  ) { 
	$options = get_option( 'dnd_settings' );
	$dnd_enable_fa = (isset($options['dnd_enable_fa'])) ? $options['dnd_enable_fa'] : 0;
	?>
	<label for="dnd_settings[dnd_enable_fa]">
		<input type='checkbox' name='dnd_settings[dnd_enable_fa]' id='dnd_settings[dnd_enable_fa]' <?php checked( $dnd_enable_fa, 1 ); ?> value='1'>
		<?php _e( 'Enable FontAwesome Icons', 'dnd-shortcodes' ) ?>
	</label>
	<?php add_thickbox(); ?>
	<p class="description"><?php _e( 'Check this to enable FontAwesome icons. Complete list of icons and their names can be found', 'dnd-shortcodes' ) ?> <a href="<?php echo DND_SHORTCODES_DIR.'css/fonts/fontawesome-webfont.html?TB_iframe=true&width=650&height=550' ?>" class="thickbox" ><?php _e( 'here', 'dnd-shortcodes' ) ?></a>.</p>
	<?php
}

function dnd_enable_whhg_render(  ) { 
	$options = get_option( 'dnd_settings' );
	$dnd_enable_whhg = (isset($options['dnd_enable_whhg'])) ? $options['dnd_enable_whhg'] : 0;
	?>
	<label for="dnd_settings[dnd_enable_whhg]">
		<input type='checkbox' name='dnd_settings[dnd_enable_whhg]' id='dnd_settings[dnd_enable_whhg]' <?php checked( $dnd_enable_whhg, 1 ); ?> value='1'>
		<?php _e( 'Enable WebHostingHubGlyphs Icons', 'dnd-shortcodes' ) ?>
	</label>
	<?php add_thickbox(); ?>
	<p class="description"><?php _e( 'Check this to enable WebHostingHubGlyphs icons. Complete list of icons and their names can be found', 'dnd-shortcodes' ) ?> <a href="<?php echo DND_SHORTCODES_DIR.'css/fonts/webhostinghub-glyphs.html?TB_iframe=true&width=650&height=550' ?>" class="thickbox" ><?php _e( 'here', 'dnd-shortcodes' ) ?></a>.</p>
	<?php
}

function drag_and_drop_shortcodes_options_page(  ) { 
	?>
	<div class="wrap">
		<h2><?php _e( 'Drag and Drop Shortcodes', 'dnd-shortcodes' ) ?></h2>
		<form action='options.php' method='post'>
			<?php
			settings_fields( 'dnd_options_page' );
			do_settings_sections( 'dnd_options_page' );
			submit_button();
			?>
		</form>
	</div>
	<?php
}
