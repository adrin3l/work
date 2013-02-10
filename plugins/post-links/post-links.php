<?php
/*
  Plugin Name: Related Links
  Description: Create a metabox in post edit for adding related links
  Author: Daniel Andrei-Adrian
  Version: 1.0
  */

define( 'RL_DIR', dirname( __FILE__ ) );
define( 'RL_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );

class related_links{

	function init (){


		add_action( 'add_meta_boxes', array(__CLASS__,'add_related_links_box' ));
        add_action('save_post', array(__CLASS__, 'save_post'), 10, 2);

        add_filter( 'the_content', array(__CLASS__,'add_links' ));


	}

	function add_links($content){


		global $post;
		if(is_single()){

			$related_links = get_post_meta($post->ID, 'related_links', true);

			if($related_links){

				ob_start();
				echo "<ul class='related_links'>";

				foreach($related_links as $related_link){


					echo "<li><a href='".$related_link['link']."''>  ".$related_link['title']."</a></li>";

				}

				echo "</ul>";

				$output = ob_get_clean();
			}


		}

		return $content.$output;
	}


	function add_related_links_box(){

        add_meta_box('related_links', __('Related Links', 'carrington-jam'), array(__CLASS__, 'related_links_metabox'), 'post', 'side', 'low');

         wp_enqueue_script('link-js', RL_URL . '/js/related-links.js');

	}
	function related_links_metabox(){

		global $post;
	    $related_links = get_post_meta($post->ID, 'related_links', true);

	    if (!empty($related_links))
	        $related_links = array_values($related_links);
	    $total_links = count($related_links);
	    include(RL_DIR . '/templates/related-links.php');

	}

	function save_post($post_id, $post){

		if ($_POST['post_type'] == 'post') {

			if (!empty($_POST['links'])) {
                update_post_meta($post_id, 'related_links', $_POST['links']);
            } else {
                if ($_POST['action'] == 'autosave') {
                    return $post_id;
                }
                delete_post_meta($post_id, 'related_links');
            }

		}
	}

}

related_links::init();