<?php
/*
  Plugin Name: Redirect Anything
  Description: Create new options where you choose what link to be rediected
  Author: Daniel Andrei-Adrian
  Version: 1.0
  */

define( 'BDP_DIR', dirname( __FILE__ ) );
define( 'BDP_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );

class redirect_anything{


	function init(){


		 add_filter('admin_menu', array(__CLASS__, 'redirect_page'));

		 add_action('init', array(__CLASS__,'procede_redicts')); 
	}

	function procede_redicts(){

		 $mystring = $_SERVER['REQUEST_URI'];
		 $redirects = get_option('redirect_array');

		 if($redirects){
			 foreach($redirects as $redirect){

			 	if(strpos($mystring,$redirect['a'])){

			 		wp_redirect($redirect['b'], 301);
	                die();
			 	}

			 }
		}

	}

	function redirect_page(){

		add_options_page('Redirect Anything', 'Redirect Anything', 'manage_options', 'redirect-anything', array(__CLASS__, 'redirect_options'));
	}

	function redirect_options(){

		if($_POST['delete_redirects']){

			delete_option('redirect_array');

		}



		if($_POST['save_redirects']){

			foreach($_POST['redirect'] as $key => $value ){

				if($value['a']=='' ){
					unset($_POST['redirect'][$key]);
				}
			}

			update_option('redirect_array',$_POST['redirect']);


		}

		$redirect_array = get_option ('redirect_array');

		//echo '<pre>';var_dump($_POST);

		$count =0;
		?>
		 <script>
                        jQuery(document).ready(function($){
                               
                               	 $('#save_redirects').click( function() {

                               	 	var columnA = $('#columnA').val();
                               	 	var columnB = $('#columnB').val();

                               	 	if(!columnA || columnB == 'http://' || columnB == 'https://' ){

                               	 		alert("Complete both Colums!");
                               	 		return false;
                               	 	}

                               	 });

                               });
         </script>

			<h2>Redirect Options</h2>
			<p class description> if your url contains column A will be redirected to column B .  </p>
			<form action="#" method="post">

		<?php

		if($redirect_array){

			foreach ($redirect_array as $redirects){

				//var_dump_pre($redirects);
				echo "<label>A : <input type = 'text' value='".$redirects['a']."' name=redirect[$count][a] /> </label>";

				echo "<label>B : <input type = 'text' value='".$redirects['b']."' name=redirect[$count][b] /> </label><br/>";

				$count++;
			}
		}
		echo '<p class="description">ADD NEW RULE :<p>';
		echo "<label>A : <input type = 'text' id='columnA' value='' name=redirect[$count][a] /> </label>";

		echo "<label>B : <input type = 'text' id='columnB' value='http://' name=redirect[$count][b] /> </label>";


		?>
			<br/>
			
			<input type ="submit" id="save_redirects" name="save_redirects" value = "Save rules">
			<input type ="submit" id="delete_redirects" name="delete_redirects" value = "Delete rules">
			</form>
		<?php
	}
}

redirect_anything::init();
function var_dump_pre( $var, $title='', $color = 'white', $dump = FALSE ){
	?>

	<?php
	$style = 'clear:both;overflow:auto;border:1px solid #BFBFBF; margin-top:10px; padding-left:3px;padding-bottom:3px;background-color:'.$color;
	echo '<div class="debug" style="'. $style .'" >';
	$db = debug_backtrace();
	//echo 'function: '.$db[0]['file'].' @ line:['.$db[0]['line'].']';
	$file  = strrev(implode(strrev(' /<span style="color:black">'), explode("/", strrev($db[0]['file']), 2)));
	$file .= '</span>'; 
	echo '<div style="width:100%; margin-left:-3px; color:#969696;background-color:#F0F0F0;padding:3px 0px 3px 3px"><small><span style="color:black">file: </span>'.$file.' <br />@<br /><span style="color:black">line:['.$db[0]['line'].']</span></small></div>';
	echo '<pre>';

	if( $title !='' )
		echo '<div style="width:100%; margin-left:-3px; background-color:#E5E5F8;padding:3px 0px 3px 3px"><strong>'.$title.':</strong></div><br />';
	
	if( $dump || is_bool( $var )){
		if( is_bool( $var )){
					
			switch ( $var ){
				case TRUE:
					echo '<span style="color:green">'; var_dump( $var ); echo '</span>';
				break;
				
				case FALSE:
					echo '<span style="color:red">'; var_dump( $var );echo '</span>';
				break;
			}
		}
		else
			var_dump( $var );
	}
	else
		print_r( $var );
	echo '</pre>';
	echo '</div>';
	echo '<div style="clear:both"></div>';
}