<?php
/*
  Plugin Name: Simple IP BAN
  Description: Create new options where you choose what ips to be banned
  Author: Daniel Andrei-Adrian
  Version: 1.0
  */

define( 'IP_DIR', dirname( __FILE__ ) );
define( 'IP_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );


class ip_ban{

	function init (){

		 add_filter('admin_menu', array(__CLASS__, 'ip_ban_page'));

		 add_action('template_redirect', array(__CLASS__, 'redirect_baned_ips'));

	}

	function redirect_baned_ips(){

		$ban_ips = get_option('ban_ips');
		$ban_redirect_url = get_option('ban_redirect_url');

		$ip=$_SERVER['REMOTE_ADDR'];

		if(strpos($ban_ips,$ip)!== FALSE){

			wp_redirect($ban_redirect_url,301);
			die;

		}
	}

	function ip_ban_page(){


		add_options_page('IP BAN', 'IP BAN', 'manage_options', 'ip_ban', array(__CLASS__, 'ip_ban_options'));

	}

	function ip_ban_options(){


		if($_POST['save_ip_ban']){

			if($_POST['ban_ips']){

				update_option('ban_ips',stripslashes($_POST['ban_ips']));
			}else{


				delete_option('ban_ips');
			}


			if($_POST['ban_redirect_url']){

				update_option('ban_redirect_url',stripslashes($_POST['ban_redirect_url']));
			}else{


				delete_option('ban_redirect_url');
			}

		}

		$ban_ips = get_option('ban_ips');
		$ban_redirect_url = get_option('ban_redirect_url');


			?>

		<h2>IP BAN OPTIONS : </h2>

		<form action="#" method="post">

		
		<textarea id="ban_ips" name="ban_ips"  cols="75" rows="8" ><?php echo $ban_ips ?></textarea>
			<p class="description">
				Please input ips to ban comma separated (Eg. "127.0.0.1, 127.2.3.6")
			</p>
		
		Redirect URL: <input type="text" name="ban_redirect_url" value="<?php echo $ban_redirect_url ?>"  style="width:50em" class="regular-text"  />	<br/>
			<input type="submit" name="save_ip_ban" value = "Save settings" />

		</form>
		<?php
	}

}

ip_ban::init();