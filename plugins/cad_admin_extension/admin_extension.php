<?php
/*
Plugin Name: Admin Extension
Plugin URI: http://wordpress.org/extend/plugins/
Description: This plugins adds settings for title/description maximum size and filter them 
Author:Daniel Andrei Adrian 
Version: 1.0
*/

define( 'CAD_DIR', dirname( __FILE__ ) );
define( 'CAD_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );


class cad_admin_extension{

	function init(){

		// add custom field editor by default
		add_filter( 'hidden_meta_boxes', array(__CLASS__,'enable_custom_fields_per_default'), 20, 1 );

		//add settings for maximum lengt size title/description 
		add_action('admin_menu', array(__CLASS__,'add_new_option_page'));

		// filter title/description
		//add_action ('save_post' , array(__CLASS__,'filter_length'));

		// add error notice for title/description length
		//add_action( 'admin_notices', array(__CLASS__,'admin_notice_handler' ));

		// add jquery scripts
		add_action('admin_print_scripts-post.php', array(__CLASS__,'add_scripts'));
		
		// add hidden fields 
		add_action( 'post_submitbox_misc_actions', array(__CLASS__,'add_hidden_fields' ));

		// inject script in tinymcw
		add_filter('tiny_mce_before_init',array(__CLASS__,'tinymce_settings'));


	    // add_action('admin_init', array(__CLASS__, 'admin_init'));
	    // $taxonomy = $_GET['taxonomy'];
     //    add_action($taxonomy . '_add_form_fields', array(__CLASS__, 'meta_options_category'));
     //    add_action($taxonomy . '_edit_form', array(__CLASS__, 'meta_options_category'));

     //    add_action('created_term', array(__CLASS__, 'save_meta_tags'));
     //    add_action('edit_term', array(__CLASS__, 'save_meta_tags'));
     //    add_action('delete_term', array(__CLASS__, 'delete_meta_tags'));

     //    add_action('wp_insert_post', array(__CLASS__, 'save_meta_tags'), 10, 2);
     //    add_action('wp_insert_page', array(__CLASS__, 'save_meta_tags'), 10, 2);

	}


	

	function add_scripts(){

	wp_enqueue_script('restrict_length',plugins_url('/js/restrict_length.js', __FILE__));

	}


	function enable_custom_fields_per_default($hidden){
		
		foreach ( $hidden as $i => $metabox ){
	        if ( 'postcustom' == $metabox ){
	            unset ( $hidden[$i] );
	        }
   		}
    return $hidden;

	}

	function add_new_option_page(){


		add_options_page('Extensions', 'Admin Extension', 'manage_options', 'extension.php', array(__CLASS__,'sett_maximum_length'));
	}

	function sett_maximum_length(){

		if($_POST['submit']){

			$post_tl = $_POST['post_title'];
			$post_dl = $_POST['post_description'];
			$post_cl = $_POST['post_content'];

			$page_tl = $_POST['page_title'];
			$page_dl = $_POST['page_description'];
			$page_cl = $_POST['page_content'];


			if($post_tl){
				update_option('post_tl',$post_tl);
			}else{
				delete_option('post_tl');
			}
			if($post_dl){
				update_option('post_dl',$post_dl);
			}else{
				delete_option('post_dl');
			}

			if($page_tl){
				update_option('page_tl',$page_tl);
			}else{
				delete_option('page_tl');
			}
			if($page_dl){
				update_option('page_dl',$page_dl);
			}else{
				delete_option('page_dl');
			}

			if($page_cl){
				update_option('page_cl',$page_cl);
			}else{
				delete_option('page_cl');
			}
			if($post_cl){
				update_option('post_cl',$post_cl);
			}else{
				delete_option('post_cl');
			}

		}
		else{

			$post_tl  = get_option('post_tl');
			$post_dl  = get_option('post_dl');
			$page_tl  = get_option('page_tl');
			$page_dl  = get_option('page_dl');
			$post_cl  = get_option('post_cl');
			$page_cl  = get_option('page_cl');
		}
		

		require_once(CAD_DIR.'/templates/admin_extension.php');

	}

	function filter_length($post){

		if($_POST['post_type']=='post'){

			$post_tl  = get_option('post_tl');
			$post_dl  = get_option('post_dl');

			if($post_dl){

				if(strlen($_POST['post_excerpt'])>$post_dl){
					update_option('post_excerpt_notice', "<div class=\"error settings-error \" ><p>Your post excerpt length is  ".strlen($_POST['post_excerpt']).", maximum length for excerpt is : $post_dl</p></div>");	
				}
			}

			if($post_tl){

				if(strlen($_POST['post_title'])>$post_tl){
				
					update_option('post_title_notice', "<div class=\"error settings-error \"><p>Your post title length is  ".strlen($_POST['post_title']).", maximum length for title is : $post_tl</p></div>");	
					return false;
				}	
			}
		}
		if($_POST['post_type']=='page'){

			$page_tl  = get_option('page_tl');
			$page_dl  = get_option('page_dl');

			if($page_dl){

				if(strlen($_POST['post_excerpt'])>$page_dl)
					update_option('page_excerpt_notice', "<div class=\"error settings-error \"><p>Your post excerpt length is  ".strlen($_POST['post_excerpt']).", maximum length for excerpt is : $page_dl</p></div>");	
					
			}

			if($page_tl){

				if(strlen($_POST['post_title'])>$page_tl)
					update_option('post_title_notice', "<div class=\"error settings-error \"><p>Your page title length is  ".strlen($_POST['post_title']).", maximum length for title is : $page_tl</p></div>");	
			}

		}
	}
	function admin_notice_handler(){

		$error = get_option('post_excerpt_notice');

		if ($error){
			//add_action('post_updated_messages', array(__CLASS__,'post_meesages'));
			echo $error;
			
		}

		delete_option('post_excerpt_notice');

		$error = get_option('post_title_notice');

		if ($error){	
			
			//remove_action( 'admin_notices', 'update_nag', 3 );
			//add_action('post_updated_messages', array(__CLASS__,'post_meesages'));
			echo $error;
			
		}
		delete_option('post_title_notice');
	}

	function add_hidden_fields(){

		global $post;

		if($post->post_type == 'post'){
			$post_tl  = get_option('post_tl');
			$post_dl  = get_option('post_dl');
			if($post_tl){
			echo "<input type='hidden' id='post_tl' value='$post_tl' />";
			}
			if($post_dl){
				echo "<input type='hidden' id='post_dl' value='$post_dl' />";
			}
			if($post_cl){
				echo "<input type='hidden' id='post_cl' value='$post_cl' />";
			}
		}

		if($post->post_type == 'page'){
			$page_tl  = get_option('page_tl');
			$page_dl  = get_option('page_dl');

			
			if($page_tl){
				echo "<input type='hidden' id='page_tl' value='$page_tl' />";
			}
			if($page_dl){
				echo "<input type='hidden' id='page_dl' value='$page_dl' />";
			}
			if($page_cl){
				echo "<input type='hidden' id='page_cl' value='$page_cl' />";
			}
		}
		//var_dump('here');

	}

	function tinymce_settings($initArray){
		$post_cl =get_option('post_cl');
		$page_cl =get_option('page_cl');

		global $post;
		//var_dump($post);
		if($post -> post_type == 'post'){
			$clength = $post_cl;
		}
		if($post -> post_type == 'page'){

			$clength = $page_cl;
		}	

		if($clength){

		   $initArray['setup'] = <<<JS
[function(ed) {
    ed.onKeyUp.add(function(ed, e) {
        //your function goes here
        var text =tinyMCE.activeEditor.getContent({format : 'text'});

       	if(text.length > $clength ){



       		jQuery('#content_tbl').css('background-color', '#FFEBE8');
       		jQuery('#content_tbl').css('border-color', '#CC0000');

       		jQuery ("#publish").attr('disabled','disabled');
		    	

       		if(jQuery('#content_er').val() != ''){
       			jQuery ('<tr id="content_er"><td><p class="description" style="color:red;"  >Maximum field length is :'+ $clength+'</td></tr></p>').insertBefore('table#content_tbl > tbody >tr.mceLast');

       		}else{
			   jQuery ("#content_er").show();


       		}


       	}else{

       		jQuery ("#content_tbl").css('background-color', '#FFFFFF');

       		jQuery ("#publish").removeAttr('disabled');
		   jQuery ("#content_er").hide();
       	}



    });

}][0]
JS;

		}
    return $initArray;

	}

	function admin_init(){


		add_meta_box('seosettings', 'Seo Settings', array(__CLASS__, 'meta_options_post'), 'post', 'normal', 'high');
        add_meta_box('seosettings', 'Seo Settings', array(__CLASS__, 'meta_options_post'), 'page', 'normal', 'high');

	}

	function meta_options_post(){
		global $post;
		$post_id = $post->ID;

		var_dump($post);
	}
}
cad_admin_extension::init();
