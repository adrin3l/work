<?php

/*
  Plugin Name: Badges
  Description: Create a new custom post type named badges and widget for front-end
  Author: Daniel Andrei Adrian
  Version: 1.0
  */

define( 'BADGES_DIR', dirname( __FILE__ ) );
define( 'BADGES_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );

  class badges {

	function init (){

		//create badges
		add_action( 'init', array( __CLASS__, 'create_custom_posttype' ) );

		//extend badges
		add_action( 'add_meta_boxes', array(__CLASS__,'add_badges_metabox' ));

		//save aditional data
		add_action( 'save_post' , array(__CLASS__, 'save_badges'));
				
		//add scripts
		add_action('wp_enqueue_scripts', array(__CLASS__,'badges_scripts'));

	  //
	  	add_action( 'do_meta_boxes', array( __CLASS__, 'hide_unwanted_boxes' ), 10, 3 );
	


	}

	function hide_unwanted_boxes($post_type, $mode, $post ){

	global $wp_meta_boxes;

		if($post_type == badge){
			$meta_boxes_to_keep = array( 'url','Options','submitdiv','postimagediv' );		   
			foreach ( $wp_meta_boxes as $item ) {
				if($item[$mode]['default']){
					foreach($item[$mode]['default'] as $key => $value){

						if(!in_array($key, $meta_boxes_to_keep)){
							unset($wp_meta_boxes[$post_type][$mode]['default'][$key]);

						}
					}
				}
				if($item[$mode]['core']){
					foreach($item[$mode]['core'] as $key => $value){

						if(!in_array($key, $meta_boxes_to_keep)){
							unset($wp_meta_boxes[$post_type][$mode]['core'][$key]);

						}
					}
				}
				if($item[$mode]['low']){
					foreach($item[$mode]['low'] as $key => $value){

						if(!in_array($key, $meta_boxes_to_keep)){
							unset($wp_meta_boxes[$post_type][$mode]['low'][$key]);

						}
					}
				}
			}
		}
	}

		function badges_scripts(){

			wp_enqueue_script('jquery');
			wp_enqueue_script('zclip_script',plugins_url('/js/zclip.js', __FILE__));
			wp_enqueue_script('badges_script',plugins_url('/js/scripts.js', __FILE__));

			wp_enqueue_style('badges_style',plugins_url('/css/style.css', __FILE__));
		}

	function save_badges($post_id){


		global $post;
		// die($post);

		if($post->post_type == 'badge'){


			update_post_meta($post->ID, 'url_options' , $_POST['url_options']);

			if($_POST['url']){

				update_post_meta($post->ID, 'url' , $_POST['url']);

			}else{

				delete_post_meta($post->ID , 'url');
			}

			if($_POST['popup_text']){

				update_post_meta($post->ID, 'popup_text' , $_POST['popup_text']);

			}else{

				delete_post_meta($post->ID , 'popup_text');
			}

		}


	}

	function add_badges_metabox(){

		add_meta_box( 
		'url',
		__( 'URL', 'myplugin_textdomain' ),
		array(__CLASS__,'add_url'),
		'badge' 
		);
		 add_meta_box( 
		'Options',
		__( 'Options', 'myplugin_textdomain' ),
		array(__CLASS__,'add_options'),
		'badge' 
		);
	}

	function add_url(){

		global $post;

		$url = get_post_meta ($post->ID, 'url' , true);

		?>
			<input type="text" id="url" value="<?php echo $url ?>" name="url" class="large-text" />
			<p class="description">
				This is the that will be used on frontend !
			</p>
		<?php


	}

	function add_options(){

		global $post;
		$url_options = get_post_meta($post->ID, 'url_options',true);
		$popup_text = get_post_meta($post->ID, 'popup_text',true);


		if($url_options == 'follow'){

			$selected_follow = "selected";

		}else{

			$selected_nofollow = "selected";

		}
		?>
		
			<select name= "url_options">
				<option value="nofollow" <?php echo $selected_nofollow; ?>>
					NoFollow
				</option>
				<option value="follow" <?php echo $selected_follow; ?>> 
					Follow
				</option>
			</select>

			<p class="description">
				Please choose if the link will have follow or nofollow option !!!
			</p>

			<textarea name="popup_text" rows="8" cols="60"><?php echo stripslashes($popup_text);?></textarea>

			<p class="description">
				Please choose text that will show up on pop box !!!
			</p>
		
		<?php

	}


	function create_custom_posttype(){


	$labels = array(
		'name' => 'Badges',
		'singular_name' => 'Badges',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Badges',
		'edit_item' => 'Edit Badges',
		'new_item' => 'New Badges',
		'all_items' => 'All Badges',
		'view_item' => 'View Badges',
		'search_items' => 'Search Badges',
		'not_found' =>  'No badgess found',
		'not_found_in_trash' => 'No badges found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'Badges'
  	);

	 $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'badge' ),
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array( 'title', 'thumbnail',  )
	); 

  	register_post_type( 'badge', $args );

	}
  }

  badges::init();


//create badges widget 
  class badges_widget extends WP_Widget
{
	//constructor
	function badges_widget()
	{

		$this->WP_Widget(false, $name = 'Badges Widget');	

	}

	//form creates in the backend the input mask, which in our case for the title of the widget and the displayed link text.
	function form($instance)
	{
		//error_reporting(E_ALL);
	   $dta = array(
			'badges' => '',
			'use_dropdown'=>'',
			'title_class'=>'',
			'image_class'=>'',
			'code_class'=>'',
			'button_class'=>'',
			'question_class'=>'',
			'popup_class'=>'',
			'dropdown_class'=>''
		);
		$instance = wp_parse_args($instance, $dta);
		extract($instance);

		$badges = htmlspecialchars($instance['badges']);
		$use_dropdown = htmlspecialchars($instance['use_dropdown']);
		$title_class = htmlspecialchars($instance['title_class']);
		$image_class = htmlspecialchars($instance['image_class']);
		$code_class = htmlspecialchars($instance['code_class']);
		$button_class = htmlspecialchars($instance['button_class']);
		$question_class = htmlspecialchars($instance['question_class']);
		$popup_class = htmlspecialchars($instance['popup_class']);
		$dropdown_class = htmlspecialchars($instance['dropdown_class']);
			
?>
<h3>Badge:</h3>
	<label>  
		   <select id="<?php echo $this->get_field_id('badges'); ?>" name="<?php echo $this->get_field_name('badges'); ?>">
				<?php
				$args = array ('post_type' => 'badge');
				$badge_arr = get_posts($args);
					foreach($badge_arr as $badge){
						$selected = '';
						if (isset($instance['badges']) && $instance['badges'] == $badge->ID )
						$selected = " selected='selected'";
				?>
				<option value='<?php echo $badge->ID; ?>' <?php echo $selected; ?>><?php echo $badge->post_title;  ?>
				</option>
		
				<?php 
					}	
	?>
			</select>
	</label>

<h3>Badges Dropdown:</h3>

	<p>
		<label> Use Dropdown:
		<input type="checkbox"  id="<?php echo $this->get_field_id('use_dropdown'); ?>" name="<?php echo $this->get_field_name('use_dropdown'); ?>" value="1" <?php if($use_dropdown==1) echo "checked=checked";?> />
		</label>    
	</p>

<h3>Classes:</h3>

	<p>
		<label> Title:</label>    
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('title_class'); ?>" name="<?php echo $this->get_field_name('title_class'); ?>" value="<?php echo $title_class; ?>" />
	</p>
	<p>
		<label> Image:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('image_class'); ?>" name="<?php echo $this->get_field_name('image_class'); ?>" value="<?php echo $image_class; ?>" />
	</p>  
	<p>
		<label> Code:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('code_class'); ?>" name="<?php echo $this->get_field_name('code_class'); ?>" value="<?php echo $code_class; ?>" />
	</p>
		<label> Button: </label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('button_class'); ?>" name="<?php echo $this->get_field_name('button_class'); ?>" value="<?php echo $button_class; ?>" />
	<p>
		<label> Question: </label>
		<input type="text"  class="widefat" id="<?php echo $this->get_field_id('question_class'); ?>" name="<?php echo $this->get_field_name('question_class'); ?>" value="<?php echo $question_class; ?>" />
	</p>
	<p>
		<label> Popup:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('popup_class'); ?>" name="<?php echo $this->get_field_name('popup_class'); ?>"  value="<?php echo $popup_class; ?>" />
	</p>
	<p>
		<label> Dropdown:  </label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('dropdown_class'); ?>" name="<?php echo $this->get_field_name('dropdown_class'); ?>" value="<?php echo $dropdown_class; ?>" />
	</p>
<?

	}

		
	//update examine the data and stores an instance of the widget
	function update($new_instance, $old_instance)
	{
		
		// var_dump($new_instance);die;
		//return $new_instance;
		$instance['badges'] = strip_tags($new_instance['badges']);
		$instance['use_dropdown'] = strip_tags($new_instance['use_dropdown']);
		$instance['title_class'] = strip_tags($new_instance['title_class']);
		$instance['image_class'] = strip_tags($new_instance['image_class']);
		$instance['code_class'] = strip_tags($new_instance['code_class']);
		$instance['button_class'] = strip_tags($new_instance['button_class']);
		$instance['question_class'] = strip_tags($new_instance['question_class']);
		$instance['popup_class'] = strip_tags($new_instance['popup_class']);
		$instance['dropdown_class'] = strip_tags($new_instance['dropdown_class']);

		return $instance;

	}
	
	//The function widget is responsible for the output in the frontend .
	function widget($args, $instance)
	{
		global $wpdb, $post, $dta;
		extract($args);

		$use_dropdown = htmlspecialchars($instance['use_dropdown']);
		$title_class = htmlspecialchars($instance['title_class']);
		$image_class = htmlspecialchars($instance['image_class']);
		$code_class = htmlspecialchars($instance['code_class']);
		$button_class = htmlspecialchars($instance['button_class']);
		$question_class = htmlspecialchars($instance['question_class']);
		$popup_class = htmlspecialchars($instance['popup_class']);
		$dropdown_class = htmlspecialchars($instance['dropdown_class']);

		$cat=get_category($instance['category']);

		$badge_selected = $instance['badges'];


		// var_dump($badge_selected);

		$args = array ('post_type' => 'badge');
		$badges_arr = get_posts($args);

		echo $before_widget;
		foreach($badges_arr as $badge){	


			// echo '<pre>';var_dump($badge);

			$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($badge->ID) );

			//var_dump_pre($thumb_url);

			$url = get_post_meta($badge->ID,'url',true);
			$url_options = get_post_meta($badge->ID,'url_options',true);
			$popup_text = get_post_meta($badge->ID, 'popup_text',true);



			?>
				<div id="badge-<?php echo $badge->ID;?>" <?php if($badge->ID != $badge_selected) echo "style='display:none;'" ?> >

			<?php
			echo $before_title;
	  		echo "<span class='$title_class'>";
			//echo $badge->post_title;
	  			?>
	  				<select name="badges" id="badges" >
	  					<?php

	  						foreach($badges_arr as $sbadge){

	  							if($sbadge->ID == $badge_selected){
	  								$selected = 'selected="selected"';
	  							}else{
	  								$selected = '';
	  							}


	  							echo "<option value='$sbadge->ID' $selected > $sbadge->post_title </option>";
	  						}

	  					?>

	  				</select>

	  			<?php

	  		echo "</span>";
			echo $after_title;	

			echo "<img class='$image_class' src='$thumb_url' title='badge->post_title' alt='badge->post_title'/>";
				?>
	   
					<textarea class='<?php echo $code_class;?>' style="width:100%;" rows="5" id="copy_code" name="copy_code"> <a rel="<?php echo $url_options?>" href="<?php echo $url;?>"><img src="<?php echo $thumb_url;?>" /> </a> </textarea>
					<a class="button <?php echo $button_class;?>"  id="copy" name="copy" href="#copy_code" /><span>Click to copy code</span></a>
					<a href="#popup_text" id="activate_popup" name="activate_popup" class="<?php echo $question_class;?>"> Where to paste ? </a>
					<div id="popup_text" style="display:none;" class="<?php echo $popup_class;?>">
					 <?php echo $popup_text; ?> 
					</div>

				</div>
					

					
				<?php
			
		}
		?>

		 <script type="text/javascript">
		  				var templateDir = "<?php echo BADGES_URL; ?>";
		</script>
		<?php
		echo $after_widget;
	}
	
}//end class widget_w5*/

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("badges_widget");'));
