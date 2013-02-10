<?php
/*
  Plugin Name: Posts Views
  Description: This plugin will count every post view and display it in backend.
  Author: Daniel Andrei-Adrian
  Version: 1.0
  */

define( 'PV_DIR', dirname( __FILE__ ) );
define( 'PV_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );


class posts_views{


	function init (){

		add_filter( 'posts_views', array(__CLASS__,'my_posts_request_filter' ));

		add_action ('post_submitbox_misc_actions',array(__CLASS__,'posts_views_display'));
	}

	function my_posts_request_filter(){
		global $post;
	
		$posts_views =get_post_meta($post->ID,'posts_views',true);

		if(!$posts_views){

			$posts_views = 1;
		}else{

			$posts_views ++;
		}
		update_post_meta($post->ID,'posts_views',$posts_views);

		
	}

	function posts_views_display(){

		global $post;

		if($post->post_type == 'post'){

			$posts_views=get_post_meta($post->ID, 'posts_views',true);

			if(!$posts_views){
				$posts_views = 0;
			}

			echo '<div class="misc-pub-section misc-pub-section-last" style="border-top: 1px solid #eee;">';
       		echo '<label > Post Views : </label>'.$posts_views;
       		echo '</div>';
		}
	}


}

posts_views::init();