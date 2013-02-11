<?php
/*
  Plugin Name: Tags Shortcode
  Description: Create a shortcode to display all tags of current post
  Author: Daniel Andrei-Adrian
  Version: 1.0
  */

define( 'TS_DIR', dirname( __FILE__ ) );
define( 'TS_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );

	add_shortcode ('tags', 'tags_shortcode');


function tags_shortcode(){

	ob_start();
	the_tags();
	$content = ob_get_clean();

	return $content;

}