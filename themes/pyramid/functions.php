<?php
/** Load the Core Files */
require_once( trailingslashit( get_template_directory() ) . 'lib/init.php' );
new Pyramid();

/** Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'pyramid_theme_setup' );

/** Theme setup function. */
function pyramid_theme_setup() {
	
	/** Add theme support for Feed Links. */
	add_theme_support( 'automatic-feed-links' );
	
	/** Add theme support for Custom Background. */
	add_theme_support( 'custom-background', array( 'default-color' => 'fafafa' ) );
	
	/** Set content width. */
	pyramid_set_content_width( 640 );
	
	/** Add custom image sizes. */
	add_action( 'init', 'pyramid_add_image_sizes' );	

}

/** Adds custom image sizes */
function pyramid_add_image_sizes() {
	add_image_size( 'featured', 350, 250, true );
}
?>