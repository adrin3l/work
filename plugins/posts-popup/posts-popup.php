<?php
/*
  Plugin Name: Posts Popup
  Description: Create popup options for posts
  Author: Daniel Andrei-Adrian
  Version: 1.0
  */

define( 'PP_DIR', dirname( __FILE__ ) );
define( 'PP_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );

  class postspopup {

  	function init (){

  		add_action( 'add_meta_boxes', array(__CLASS__,'add_popup_metabox' ));

  		add_action( 'save_post' , array(__CLASS__, 'save_popup_box'));

  		add_filter( 'the_content', array(__CLASS__,'activate_popup' ));

  		//add scripts
		add_action('wp_enqueue_scripts', array(__CLASS__,'popup_scripts'));
  	}

  	function popup_scripts(){

  			wp_enqueue_script('jquery');
			wp_enqueue_script('popup_script',plugins_url('/js/scripts.js', __FILE__));

			wp_enqueue_style('popup_style',plugins_url('/css/fancy.css', __FILE__));
  	}


  	function add_popup_metabox(){

		add_meta_box( 
		'Popup Settings',
		__( 'Popup Settings', 'myplugin_textdomain' ),
		array(__CLASS__,'add_popup_box'),
		'post' 
		);
		

		add_meta_box( 
		'Popup Settings',
		__( 'Popup Settings', 'myplugin_textdomain' ),
		array(__CLASS__,'add_popup_box'),
		'page' 
		);
		 	 
	}

	function add_popup_box(){



			global $post;

		$popup_content = get_post_meta ($post->ID, 'popup_content' , true);

		?>

		<textarea id="popup_content" name="popup_content"  cols="75" rows="8" ><?php echo $popup_content ?></textarea>
			<p class="description">
				If this box is not empty a popup box will appear in your post/page .
			</p>
			<p class="description">
				You can use HTML tags eg:(p,h1,ul, etc...).
			</p>
		<?php


	}

	function save_popup_box($post){
		global $post;

		if($_POST['popup_content']){

			update_post_meta($post->ID, 'popup_content' , $_POST['popup_content']);

		}else{

			delete_post_meta($post->ID , 'popup_content');
		}
	}

	function activate_popup($content){

		global $post;
		if(is_single()){

			$popup_content = get_post_meta($post->ID, 'popup_content', true);

			if($popup_content){

				$content .= "<div style='display:none;'><div id='popup_content'> $popup_content </div></div>";
				$content .= '<script>
				var $jpp = jQuery.noConflict();
$jpp (document).ready(function(){

	var popup_content = $jpp("#popup_content").html();
	//alert(popup_content);
	$jpp.fancybox(popup_content,{
		"transitionIn"	:	"elastic",
		"transitionOut"	:	"elastic",
		"speedIn"		:	600, 
		"speedOut"		:	200,
		"opacity"		:   true,
		"overlayOpacity":   0.9,
	

	});
});</script>';

			}

		}

		return $content;
	}

}

postspopup::init();
