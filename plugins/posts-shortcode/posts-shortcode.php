<?php
/*
  Plugin Name: Posts Shortcode
  Description: Create a shortcode to display all posts from a category
  Author: Daniel Andrei-Adrian
  Version: 1.0
  */

define( 'LS_DIR', dirname( __FILE__ ) );
define( 'LS_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );



	add_shortcode ('categoryposts', 'posts_links');

	function posts_links($atts){

		extract( shortcode_atts( array(
		'category' => '',
			), $atts ) );

		$args = array(
			'posts_per_page'  => 5,
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => $category
				)
			)
		);


		$posts = get_posts($args);

		ob_start();

		?>

		<ul>
		<?php
			if($posts){
				foreach($posts as $post){

					$permalink = get_permalink($post->ID);

					echo "<li><a title='$post->post_title' alt='$post->post_title' href='$permalink'> $post->post_title </a></li>";

				}
			}

		?>

		</ul>
		<?php

		$output = ob_get_clean();
		return $output;

	}
