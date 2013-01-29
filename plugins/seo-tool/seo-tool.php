<?php
/*
Plugin Name: Seo Tool
Plugin URI: http://wordpress.org/extend/plugins/
Description: This plugins adds settings for meta title/description/keywords maximum size and filter them 
Author:Daniel Andrei Adrian 
Version: 1.0
*/

define( 'CAD_DIR', dirname( __FILE__ ) );
define( 'CAD_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );

class cad_seo_tool{


	function init (){


		//add settings for maximum lengt size title/description 
		add_action('admin_menu', array(__CLASS__,'add_new_option_page'));

		// add hidden fields 
		add_action( 'post_submitbox_misc_actions', array(__CLASS__,'add_hidden_fields' ));

		// add jquery scripts
		add_action('admin_print_scripts-post.php', array(__CLASS__,'add_scripts'));

		//add Metaboxes 
		add_action( 'add_meta_boxes', array(__CLASS__, 'generate_boxes' ));

		//save_metadata
		add_action( 'save_post', array(__CLASS__,'save_seo_settings' ));

	}


	function add_new_option_page(){


		add_options_page('Extensions', 'Seo Settings', 'manage_options', 'extension.php', array(__CLASS__,'sett_maximum_length'));
	}

	function sett_maximum_length(){

		if($_POST['submit']){

			$post_mtl = $_POST['post_title'];
			$post_mdl = $_POST['post_description'];
			$post_mkl = $_POST['post_keywords'];

			$page_mtl = $_POST['page_title'];
			$page_mdl = $_POST['page_description'];
			$page_mkl = $_POST['page_keywords'];


			if($post_mtl){
				update_option('post_mtl',$post_mtl);
			}else{
				delete_option('post_mtl');
			}
			if($post_mdl){
				update_option('post_mdl',$post_mdl);
			}else{
				delete_option('post_mdl');
			}

			if($page_mtl){
				update_option('page_mtl',$page_mtl);
			}else{
				delete_option('page_mtl');
			}
			if($page_mdl){
				update_option('page_mdl',$page_mdl);
			}else{
				delete_option('page_mdl');
			}

			if($page_mkl){
				update_option('page_mkl',$page_mkl);
			}else{
				delete_option('page_mkl');
			}
			if($post_mkl){
				update_option('post_mkl',$post_mkl);
			}else{
				delete_option('post_mkl');
			}

		}
		else{

			$post_mtl  = get_option('post_mtl');
			$post_mdl  = get_option('post_mdl');
			$page_mtl  = get_option('page_mtl');
			$page_mdl  = get_option('page_mdl');
			$post_mkl  = get_option('post_mkl');
			$page_mkl  = get_option('page_mkl');
		}
		

		require_once(CAD_DIR.'/templates/admin-settings.php');

	}


	function add_hidden_fields(){

		global $post;

		if($post->post_type == 'post'){
			$post_mtl  = get_option('post_mtl');
			$post_mdl  = get_option('post_mdl');
			$post_mkl  = get_option('post_mkl');
			if($post_mtl){
			echo "<input type='hidden' id='post_mtl' value='$post_mtl' />";
			}
			if($post_mdl){
				echo "<input type='hidden' id='post_mdl' value='$post_mdl' />";
			}
			if($post_mkl){
				echo "<input type='hidden' id='post_mkl' value='$post_mkl' />";
			}
		}

		if($post->post_type == 'page'){
			$page_tl  = get_option('page_tl');
			$page_dl  = get_option('page_dl');
			$page_mkl  = get_option('page_mkl');
			
			if($page_tl){
				echo "<input type='hidden' id='page_tl' value='$page_tl' />";
			}
			if($page_dl){
				echo "<input type='hidden' id='page_dl' value='$page_dl' />";
			}
			if($page_mkl){
				echo "<input type='hidden' id='page_mkl' value='$page_mkl' />";
			}
		}
		//var_dump('here');

	}

	function add_scripts(){

		wp_enqueue_script('restrict_length',plugins_url('/js/restricts.js', __FILE__));

	}

	function generate_boxes(){

		add_meta_box( 'seo_settings','Seo Settings',array(__CLASS__,'seo_metabox'),'post' );
    	add_meta_box( 'seo_settings','Seo Settings',array(__CLASS__,'seo_metabox'),'page' );
	}


	function seo_metabox($post){

		$post_type = $post->post_type;

		$meta_title_length = get_option($post_type.'_mtl');
		$meta_desc_length  =get_option($post_type.'_mdl');
		$meta_key_length   =get_option($post_type.'_mkl');


		

		$seo_setts = get_post_meta($post->ID,'seo_settings',true);

		require_once(CAD_DIR.'/templates/seo-settings.php');

	}

	function save_seo_settings($post_id){


		//echo '<pre>';var_dump($_POST['seo_settings']);die;

		$seo_settings['meta_title'] = $_POST['meta_title'];
		$seo_settings['meta_description'] = $_POST['meta_description'];
		$seo_settings['meta_keywords'] = $_POST['meta_keywords'];


 		update_post_meta($post_id, 'seo_settings', $seo_settings);

	}

}

cad_seo_tool::init();
