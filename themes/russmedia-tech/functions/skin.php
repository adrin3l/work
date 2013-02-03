<?php


add_action('wp_enqueue_scripts', 'rm_tech_scripts');


function rm_tech_scripts(){

	wp_enqueue_script('jquery');
	wp_enqueue_script('rm_tech',get_template_directory_uri() . '/js/script.js');
	wp_enqueue_script('modernizr',get_template_directory_uri() . '/js/modernizr.js');
	wp_enqueue_script('flexslider',get_template_directory_uri() . '/js/flexslider.js');
	// wp_enqueue_script('rm_tech',get_template_directory_uri() . '/js/script.js');
}


?>