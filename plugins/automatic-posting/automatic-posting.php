<?php
/*
Plugin Name: Automatic Posting
Plugin URI: http://wordpress.org/extend/plugins/
Description: This plugins adds settings for automatic posting in all categories 
Author:Daniel Andrei Adrian 
Version: 1.0
*/


define( 'AP_DIR', dirname( __FILE__ ) );
define( 'AP_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );

class automatic_posting{


	function init (){

		//add settings page
		add_action('admin_menu', array(__CLASS__,'add_new_option_page'));
	}

	function add_new_option_page(){


		add_options_page('Automatic Posting', 'Automatic Posting', 'manage_options', 'automatic_posting.php', array(__CLASS__,'automatic_posting_settings'));
	}

	function automatic_posting_settings(){


		//echo'<pre>';var_dump($_POST);

		$taxonomies = get_object_taxonomies( 'post' );
	
		if($_POST['generate_posts']){


		$taxonomy = $_POST['post_taxonomy'];
		$exclude_terms = $_POST['post_categories'];
			$args = array(
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 0,
				'hierarchical'             => 1,
				'exclude'                  => $exclude_terms,
				'taxonomy'                 => $taxonomy,
				);
			$categories = get_categories( $args );

			//echo '<hr/><pre>';var_dump($categories);die;

			$status = $_POST['post_status'];

			$post_title = str_replace('%termname%', $category->name , $_POST['post_title']);
			$post_content = str_replace('%termname%', $category->name , $_POST['post_content']);
			$post_description = str_replace('%termname%', $category->name , $_POST['post_description']);
			$post_tags = str_replace('%termname%', $category->name , $_POST['post_tags']);
			$post_link = str_replace('%termname%', $category->name , $_POST['post_link']);
			$post_url = str_replace('%termname%', $category->name , $_POST['post_url']);
			$post_tagline = str_replace('%termname%', $category->name , $_POST['post_tagline']);


			if(empty($post_title)||empty($post_content)||empty($post_description)){

				echo "<div id='message' class='error'><p>Please complete fields that are required! </p></div>";

			}else{

				foreach ($categories as $category){

					$post_title = str_replace('%category%', $category->name , $_POST['post_title']);
					$post_content = str_replace('%category%', $category->name , $_POST['post_content']);
					$post_description = str_replace('%category%', $category->name , $_POST['post_description']);
					$post_tags = str_replace('%category%', $category->name , $_POST['post_tags']);
					$post_link = str_replace('%termname%', $category->name , $_POST['post_link']);
					$post_url = str_replace('%termname%', $category->name , $_POST['post_url']);
					$post_tagline = str_replace('%termname%', $category->name , $_POST['post_tagline']);



					unset($post);

					  $post = array(
					  'post_title'    => $post_title,
					  'post_content'  => $post_content,
					  'post_excerpt'  => $post_description,
					  'post_status'   => $status,
					  'post_author'   => 1,
					  'post_category' => array($category->term_id)
					);

					$post_id = wp_insert_post($post,$wp_error);

					if(is_wp_error($post_id)){

						$error_string = $result->get_error_message();
	   					echo '<div id="message" class="error"><p>' . $error_string . '</p></div>';
					}
					else{

						wp_set_post_tags( $post_id, $post_tags, true );
						update_post_meta($post_id ,'url',$url);
						update_post_meta($post_id ,'link',$link);
						update_post_meta($post_id ,'tagline',$tagline);
						echo "<br/> Post whit id : $post_id added for category : ".$category->name;

					}

				}
			}

		}

		require_once(AP_DIR.'/templates/page-settings.php');
	}





}

automatic_posting::init();