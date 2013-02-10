<?php
/*
  Plugin Name: Exclude posts from search results
  Description: Create new options where you can choose waht posts to exclude from search
  Author: Daniel Andrei-Adrian
  Version: 1.0
  */

define( 'EXP_DIR', dirname( __FILE__ ) );
define( 'EXP_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );

class exclude_post{

	function init (){
		
		add_filter('admin_menu', array(__CLASS__, 'exp_options'));

		add_filter('posts_where', array(__CLASS__,'filter_where'));

	}

	function filter_where($where=''){
		if ( is_search() ) {

		$exclude_posts = explode(',',get_option('exclude_posts'));

			if($exclude_posts){

				foreach($exclude_posts as $exclude_post){

					$where .= " AND ID != $exclude_post";

				}
			}
		}
	
		return $where;

	}

	function exp_options(){

		add_options_page('Exclude Posts', 'Exclude Posts', 'manage_options', 'exclude_posts', array(__CLASS__, 'exclude_posts'));
	}


	function exclude_posts(){



		if($_POST['save_posts']){

			if($_POST['exclude_posts'])
				update_option('exclude_posts', $_POST['exclude_posts'] );
			else
				delete_option('exclude_posts');
		}

		$exclude_posts = get_option('exclude_posts');
	
		?>
		<h2>
				Exclude posts from search :
			</h2>
			<form action="#" method="post">
				Post ids : <input type="text" name="exclude_posts" id="exclude_posts" value = "<?php echo $exclude_posts;?>" />
				<p class="description"> Add post ids comma separated that you want to exclude from search results (Eg:3,6,67,3)  <p>

				<input type ="submit" id="save_posts" name="save_posts" value = "Save">
			</form>
		<?php


	}

}

exclude_post::init();