<?php
/** Function for setting the content width of a theme. */
function pyramid_set_content_width( $width = '' ) {
	global $content_width;
	$content_width = absint( $width );
}

/** Function for getting the theme's content width. */
function pyramid_get_content_width() {
	global $content_width;
	return $content_width;
}

/** Function for getting the theme's data */
function pyramid_theme_data() {
	global $pyramid;
	
	/** If the parent theme data isn't set, let grab it. */
	if ( empty( $pyramid->theme_data ) ) {
		
		$pyramid_theme_data = array();
		$theme_data = wp_get_theme();
		$pyramid_theme_data['Name'] = $theme_data->get( 'Name' );
		$pyramid_theme_data['ThemeURI'] = $theme_data->get( 'ThemeURI' );
		$pyramid_theme_data['AuthorURI'] = $theme_data->get( 'AuthorURI' );
		$pyramid_theme_data['Description'] = $theme_data->get( 'Description' );
		
		$pyramid->theme_data = $pyramid_theme_data;
	
	}

	/** Return the parent theme data. */
	return $pyramid->theme_data;
}
?>