<?php

/*
  Plugin Name: Post to page
  Description: Create options to convert posts in pages.
  Author: Daniel Andrei-Adrian
  Version: 1.0
  */

define( 'PP_DIR', dirname( __FILE__ ) );
define( 'PP_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );

class posts_to_pages{

	function init(){


		add_action ('post_submitbox_misc_actions',array(__CLASS__,'posts_to_page_link'));
		add_action('wp_ajax_post_to_page', array(__CLASS__, 'post_to_page'));
	}

	function post_to_page(){

		global $wpdb;
		$post_id = $_POST['post_id'];

		$query = "update $wpdb->posts set post_type = 'page' where ID = $post_id";

		$results  =	$wpdb->query($query);

		return $results;
		die;
	}

	function posts_to_page_link(){

		global $post;

		if($post->post_type != 'post')
			return;

		?>

  	<script>

		jQuery(document).ready(function($){

			$('#convert_to_page').click( function() {

				var post_id = $('#post_ID').val();


					 var data = {
	                                                                                                                                                        
	                    action: 'post_to_page',
	                    post_id : post_id  
	                                                                                                                                        
	                                                                                                                                        
	                }
	                $.post( ajaxurl, data, function( response ) {

	                		location.reload();
	                });

			});
		});
		
	</script>

<div class="misc-pub-section misc-pub-section-last" style="border-top: 1px solid #eee;">
		<label><a href="#"  id="convert_to_page">Convert to page</a></label>
</div>
		<?php


	}


}
posts_to_pages::init();