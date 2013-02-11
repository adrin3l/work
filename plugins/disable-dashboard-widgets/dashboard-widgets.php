<?php
/*
  Plugin Name: Disable Dashboard Widgets
  Description: Create new options where you choose what widgets to display in dashboard
  Author: Daniel Andrei-Adrian
  Version: 1.0
  */

define( 'DDW_DIR', dirname( __FILE__ ) );
define( 'DDW_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );

class disable_widgets{
	
	function init(){

		add_filter('admin_menu', array(__CLASS__, 'ddw_options'));
		add_action('wp_dashboard_setup', array(__CLASS__,'remove_dashboard_widgets' ));

	}

	function remove_dashboard_widgets(){


		$disable_widgets = get_option('disable_widgets');

		if($disable_widgets){

			foreach ($disable_widgets as $key => $value) {
				

				if($value == 1){

					remove_meta_box( $key, 'dashboard', 'side' );
					remove_meta_box( $key, 'dashboard', 'normal' );
				}
			}
		}

	}

	function ddw_options(){

		add_options_page('Dashboard Widgets', 'Dashboard Widgets', 'manage_options', 'dashboard-widgets', array(__CLASS__, 'dashboard_widgets'));
	}

	function dashboard_widgets(){

		$widgets = array("dashboard_browser_nag","dashboard_right_now","dashboard_recent_comments","dashboard_incoming_links","dashboard_plugins","dashboard_quick_press","dashboard_recent_drafts","dashboard_primary","dashboard_secondary");


		if($_POST['save_widgets']){

			if($_POST['disable_widgets'])
				update_option('disable_widgets', $_POST['disable_widgets'] );
			else
				delete_option('disable_widgets');
		}

		$disable_widgets = get_option('disable_widgets');

		?>
			<h2>
				Disable Dashboard widgets :
			</h2>
			<form action="#" method="post">


		<?php

			foreach ($widgets as $widget){

				?>


				<label><input type ="checkbox" value="1" name="disable_widgets[<?php echo $widget;?>]" <?php if($disable_widgets[$widget]==1) echo "checked = checked"; ?>  /> <?php echo $widget;?>  </label><br>
				<?php

			}

			?>
		<input type ="submit" id="save_widgets" name="save_widgets" value = "Save">

		</form>
			<?php
		}
	
}

disable_widgets::init();