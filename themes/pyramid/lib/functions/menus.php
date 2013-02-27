<?php
/** Register nav menus. */
add_action( 'init', 'pyramid_register_menus' );

/** Registers the the core menus */
function pyramid_register_menus() {

	/* Register the 'primary' menu. */
	register_nav_menu( 'pyramid-primary-menu', __( 'Pyramid Primary Menu', 'pyramid' ) );
	
}
?>