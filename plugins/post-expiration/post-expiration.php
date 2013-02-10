<?php
/*
  Plugin Name: Posts Expiration
  Description: Create a new metabox where you can sett post expiration
  Author: Daniel Andrei-Adrian
  Version: 1.0
  */

define( 'LS_DIR', dirname( __FILE__ ) );
define( 'LS_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );

class post_expiration{

	function init (){

		add_action ('post_submitbox_misc_actions',array(__CLASS__,'posts_calendar'));

		add_action( 'admin_enqueue_scripts', array(__CLASS__,'my_enqueue' ));

		add_action('save_post', array(__CLASS__, 'save_post'), 10, 2);

		add_action('template_redirect', array(__CLASS__, 'expire_redirect'), 10, 2);
	}

	function expire_redirect()
	{

		global $post;

		$home_url = get_bloginfo('home_url');
		if(is_single()){

			if($post->post_type == 'post'){


				$expiration_date=get_post_meta($post->ID, 'expiration_date',true);
				$current_date = date("Y-m-d");

				if(strtotime($expiration_date) <= strtotime($current_date)) {

					wp_redirect($home_url,301);
					die();


				}
			}
		}

		$expiration_date=get_post_meta($post->ID, 'expiration_date',true);

	}
	function save_post($post_id, $post){


        if ($_POST['post_type'] == 'post') {
                //var_dump_pre($_POST);

            if (!empty($_POST['expiration_date']))
                    update_post_meta($post_id, 'expiration_date', $_POST['expiration_date']);
            else {
                if ($_POST['action'] == 'autosave') {
                        return $post_id;
                }
                delete_post_meta($post_id, 'expiration_date');
            }
        }
	}


	function my_enqueue($hook) {
   
		// date picker plugin enqueue
        wp_enqueue_style('themedatepicker.css', LS_URL . '/css/jquery.ui.theme.css');
        wp_enqueue_script('datepicker.js', LS_URL . '/js/jquery.ui.datepicker.js');
        wp_enqueue_style('datepicker.css', LS_URL . '/css/jquery.ui.datepicker.css');

	}



	function posts_calendar(){


		global $post;

		if($post->post_type == 'post'){

			$expiration_date=get_post_meta($post->ID, 'expiration_date',true);

			echo '<div class="misc-pub-section misc-pub-section-last" style="border-top: 1px solid #eee;">';

			echo "Expire on : ";

			?>
			<script>
				jQuery(function() {
					jQuery( "#expiration_date" ).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,
changeYear: true});
				});
			</script>
			<input type="text" id="expiration_date" name="expiration_date" size="15" value="<?php echo $expiration_date;?>"> 

			<?php

       		echo '</div>';
		}
	}


}

post_expiration::init();