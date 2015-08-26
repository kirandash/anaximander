<?php

if ( is_admin() ) : // Load only if we are viewing an admin page

function anaximander_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'anaximander_theme_options', 'anaximander_options', 'anaximander_validate_options' );
}

add_action( 'admin_init', 'anaximander_register_settings' );

function anaximander_theme_options() {
	// Add theme options page to the addmin menu
	add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'theme_options', 'anaximander_theme_options_page' );
}

add_action( 'admin_menu', 'anaximander_theme_options' );

// Function to generate options page
function anaximander_theme_options_page() {
	global $anaximander_options, $anaximander_polarities;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap">

	<?php screen_icon(); echo "<h2>" . wp_get_theme() . __( ' Theme Options' ) . "</h2>";
	// This shows the page's name and an icon if one has been provided ?>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php">

	<?php $settings = get_option( 'anaximander_options', $anaximander_options ); ?>
	
	<?php settings_fields( 'anaximander_theme_options' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>

	<h3>Social Icons (optional)</h3>
	<table class="form-table"><!-- Grab a hot cup of coffee, yes we're using tables! -->
	
		<tr valign="top">
			<th scope="row"><label for="twitter_handle">Twitter handle</label></th>
			<td>
				<input id="twitter_handle" name="anaximander_options[twitter_handle]" type="text" value="<?php  esc_attr_e($settings['twitter_handle']); ?>" />
			</td>
		</tr>
	
		<tr valign="top">
			<th scope="row"><label for="facebook_page">Facebook page</label></th>
			<td>
				<input id="facebook_page" name="anaximander_options[facebook_page]" type="text" value="<?php  esc_attr_e($settings['facebook_page']); ?>" />
			</td>
		</tr>

	</table>

	<h3>Alternate RSS Feed (optional)</h3>
	<label>Add alternate RSS feed URL (Feedburner etc). Defaults to standard WordPress RSS feed.</label>
	<table class="form-table">
		<tr valign="top">
			<th scope="row"><label for="RSS_feed">Alternate RSS Feed</label></th>
			<td>
				<input id="RSS_feed" name="anaximander_options[RSS_feed]" type="text" value="<?php  esc_attr_e($settings['RSS_feed']); ?>" />
			</td>
		</tr>

	</table>
	
	<h3>Theme Key Colour</h3>
	<label>The background colour of the main header and some link states.</label>
	<table class="form-table">
		<tr valign="top">
			<th scope="row"><label for="theme_colour">Theme Key Colour</label></th>
			<td>
				<input id="theme_colour" name="anaximander_options[theme_colour]" type="text" value="<?php  esc_attr_e($settings['theme_colour']); ?>" />
			</td>
		</tr>

	</table>


	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>

	</form>
	
	

	</div>

	<?php
}

function anaximander_validate_options( $input ) {
	global $anaximander_options, $anaximander_polarities;

	$settings = get_option( 'anaximander_options', $anaximander_options );
	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	$input['twitter_handle'] = wp_filter_post_kses( $input['twitter_handle'] );
	$input['facebook_page'] = wp_filter_post_kses( $input['facebook_page'] );
	$input['RSS_feed'] = wp_filter_post_kses( $input['RSS_feed'] );
	$input['theme_colour'] = wp_filter_post_kses( $input['theme_colour'] );

	
	return $input;
}

endif;  // EndIf is_admin()



// Add theme options to the Theme Customizer
add_action( 'customize_register', 'anaximander_customize_register' );
function anaximander_customize_register($wp_customize) {

	// SUPER-HEADER ICONS
	$wp_customize->add_section( 'anaximander_header_icons', array(
		'title'          => __( 'Super-header Icons', 'anaximander' ),
		'priority'       => 1,
	) );
	
	$wp_customize->add_setting( 'anaximander_options[twitter_handle]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	) );
	
	$wp_customize->add_setting( 'anaximander_options[facebook_page]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	) );
	
	$wp_customize->add_setting( 'anaximander_options[RSS_feed]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'anaximander_twitter_icon', array(
		'label'      => __( 'Twitter handle', 'anaximander' ),
		'section'    => 'anaximander_header_icons',
		'settings'   => 'anaximander_options[twitter_handle]',
		'type'       => 'text'
	) );

	$wp_customize->add_control( 'anaximander_facebook_icon', array(
		'label'      => __( 'Facebook page', 'anaximander' ),
		'section'    => 'anaximander_header_icons',
		'settings'   => 'anaximander_options[facebook_page]',
		'type'       => 'text'
	) );
	
	$wp_customize->add_control( 'anaximander_RSS_icon', array(
		'label'      => __( 'Alternate RSS feed', 'anaximander' ),
		'section'    => 'anaximander_header_icons',
		'settings'   => 'anaximander_options[RSS_feed]',
		'type'       => 'text'
	) );

	// THEME COLOUR SWITCHER
	$wp_customize->add_section( 'anaximander_theme_colour', array(
		'title'          => __( 'Header and Link Colour', 'anaximander' ),
		'priority'       => 20,
	) );
	
	$wp_customize->add_setting( 'anaximander_options[theme_colour]', array(
		'default'        => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'anaximander_theme_colour', array(
		'label'   => __( 'Background Colour', 'anaximander' ),
		'section' => 'anaximander_theme_colour',
		'settings'   => 'anaximander_options[theme_colour]',
	) ) 
	);



}


