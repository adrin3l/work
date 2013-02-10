<?php
/*
  Plugin Name:  Popup Anything
  Description: Create popup options 
  Author: Daniel Andrei-Adrian
  Version: 1.0
  */

define( 'PA_DIR', dirname( __FILE__ ) );
define( 'PA_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );

class popup_anything{



	function init(){

		 add_filter('admin_menu', array(__CLASS__, 'popup_menu'));

		 add_action('wp_enqueue_scripts', array(__CLASS__,'popup_scripts'));

		 add_action ('popup_box',array(__CLASS__,'popup_box'));



	}


	function popup_box(){


	$popup_content = get_option('popup_content');

	//var_dump($popup_content);
	$content = '';
	 if($popup_content){
	 		$popup_delay = stripslashes(get_option('popup_delay')); 

	 		$popup_delay = $popup_delay*1000;

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
			"width"			:	400,
			"height"		:	400,
			"autoScale"		:	false,
			"autoDimensions":	false,
			"hideOnOverlayClick": false


			});

	
			setTimeout("$jpp.fancybox.close()", '.$popup_delay.');

			});</script>';

		echo $content;

		}
	}

  	function popup_scripts(){

  			wp_enqueue_script('jquery');
			wp_enqueue_script('popup_script',plugins_url('/js/scripts.js', __FILE__));

			wp_enqueue_style('popup_style',plugins_url('/css/fancy.css', __FILE__));
  	}


	function popup_menu(){

		add_options_page('Popup Anything', 'Popup Anything', 'manage_options', 'popup_anything', array(__CLASS__, 'popup_settings'));


	}

	function popup_settings(){



		if($_POST['save_popup']){

			if($_POST['popup_content']){

				update_option('popup_content',stripslashes($_POST['popup_content']));
			}else{


				delete_option('popup_content');
			}


			if($_POST['popup_delay']){

				update_option('popup_Delay',stripslashes($_POST['popup_delay']));
			}else{


				delete_option('popup_delay');
			}
		}

		$popup_content = stripslashes(get_option('popup_content'));
		$popup_delay = get_option('popup_delay');

		?>

		<h2>Popup Settings</h2>

		<form action="#" method="post">

		Delay Seconds: <input type="text" name="popup_delay" value="<?php echo $popup_delay ?>"/>	<br/>
		<textarea id="popup_content" name="popup_content"  cols="75" rows="8" ><?php echo $popup_content ?></textarea>
			<p class="description">
				If this box is not empty a popup box will appear in your post/page .
			</p>
			<p class="description">
				You can use HTML tags eg:(p,h1,ul, etc...).
			</p>

			<input type="submit" name="save_popup" value = "Save settings" />

		</form>
		<?php


	}

}


popup_anything::init();