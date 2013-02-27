<?php
/** Register Pyramid Core scripts. */
add_action( 'wp_enqueue_scripts', 'pyramid_register_scripts', 1 );

/** Load Pyramid Core scripts. */
add_action( 'wp_enqueue_scripts', 'pyramid_enqueue_scripts' );

/** Register JavaScript and Stylesheet files for the framework. */
function pyramid_register_scripts() {

	/** Register the 'common' scripts. */
	wp_register_script( 'pyramid-js-common', esc_url( PYRAMID_JS_URI . 'common.js' ), array( 'jquery' ), '1.0', true );
	
	/** Register '960.css' for grid. */
	wp_register_style( 'pyramid-css-960', esc_url( PYRAMID_CSS_URI . '960.css' ) );
	
	/** Register Google Fonts. */
	$google_ssl = is_ssl()? 'https' : 'http';
	wp_register_style( 'pyramid-google-fonts', esc_url( $google_ssl . '://fonts.googleapis.com/css?family=Bitter|PT+Sans' ) );
}

/** Tells WordPress to load the scripts needed for the framework using the wp_enqueue_script() function. */
function pyramid_enqueue_scripts() {

	/** Load the comment reply script on singular posts with open comments if threaded comments are supported. */
	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/** Load the 'common' scripts. */
	wp_enqueue_script( 'pyramid-js-common' );
	
	/** Load '960.css' for grid. */
	wp_enqueue_style( 'pyramid-css-960' );
	
	/** Load Google Fonts. */
	wp_enqueue_style( 'pyramid-google-fonts' );
}

/** Analytic Code */
add_action( 'wp_footer', 'pyramid_analytic_code_init' );
function pyramid_analytic_code_init() {
	
	$pyramid_options = pyramid_get_settings();
	
	if( $pyramid_options['pyramid_analytic'] == 1 ) :	
	echo htmlspecialchars_decode ( $pyramid_options['pyramid_analytic_code'] );	
	echo '<!-- end analytic-code -->';	
	endif;

}
?>