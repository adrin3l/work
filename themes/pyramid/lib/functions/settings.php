<?php
/** Loads the Pyramid theme setting. */
function pyramid_get_settings() {
	global $pyramid;

	/* If the settings array hasn't been set, call get_option() to get an array of theme settings. */
	if ( !isset( $pyramid->settings ) ) {
		$pyramid->settings = get_option( 'pyramid_options' );
	}
	
	/** return settings. */
	return $pyramid->settings;
}
?>