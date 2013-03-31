<?php
/*
// info apears on plugins admin page
Plugin Name: w5
Plugin URI: http://
Description: widget test 5. Widget with a checkbox
Author: bo lipai
Version: 1.0
Author URI: http://
*/

//class widget_w5 extends WP_Widget
class slider extends WP_Widget
{
	//constructor
	function slider()
	{

		//$widget_options = array('classname' => 'widget_rss_links', 'description' => 'A list with your feeds links' );
		//$widget_options = array('classname' => 'Mayra widget', 'description' => 'Mayra Widget' );

		//$control_options = array('width' => 'required if more than 250px', 'height' => 'currently not used but may be needed in the future' );
		//$control_options = array('width' => '250px', 'height' => '' );

		//function WP_Widget( 	$id_base = false, $name, $widget_options = array(), $control_options = array()) 
		//$name = 'w3' - apears on widget header bar, on Widget page
		$this->WP_Widget(false, $name = 'Slider');	

	}

	//form creates in the backend the input mask, which in our case for the title of the widget and the displayed link text.
	function form($instance)
	{
	   $dta = array(
            'title' => '',
			'items'=>''
        );
        $instance = wp_parse_args($instance, $dta);
        extract($instance);

       
//  		var_dump_pre($instance);
?>
			
	
	<p>Title:</p>
	<label>
			<input type="textbox" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title;?>" />
	
	<p>Items Nr:</p>
	<label>
			<input type="textbox" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" value="<?php echo $items;?>" />
	</label>

<?
//  var_dump_pre($instance);
	}

		
	//update examine the data and stores an instance of the widget
	function update($new_instance, $old_instance)
	{
		
		//return $new_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['items'] = strip_tags($new_instance['items']);
		return $instance;

	}
	
	//The function widget is responsible for the output in the frontend .
	function widget($args, $instance)
	{
			global $wpdb, $post, $dta;
			extract($instance);
			$template_url = get_bloginfo('template_url');

            if(!$items)
                $items=6;

            $args = array(
                'post_type' => 'oferta',
                'posts_per_page'=> $items,
            );
            $query = new WP_Query( $args );
          //  $offers = get_post();
            
?>	


			<div id="slider">
                <h2 id="slid"><?php echo $title;?></h2>
               
                    <div id="slideshow">
                        <img src="<?php echo $template_url;?>/images/control_left.jpg" class="leftControl" style="float:left;">
                        <div id="slidesContainer">
                            <div class="slide">

                        <?php 

                        foreach($query->posts as $key => $produs){

                            $restaurant = get_the_title($produs->post_parent);
                            $info = $produs->post_content;
                            $valability = get_post_meta($produs->ID,'valability',true);
                            ?>
                                <div class="oferta margin <?php if($key==0) echo 'first';?>">
                                  <?php echo get_the_post_thumbnail($produs->ID, 'thumbnail'); ?>
                                     <h2><?php echo $restaurant;?></h2>
                                     <p><?php echo $info;?></p>
                                    <p class="valabil"><?php echo $valability;?></p>
                                     </div>
                            <?php


                            }
                        ?>

                            </div>
                        </div>
                    <img src="<?php echo $template_url;?>/images/control_right.jpg" class="rightControl">
                  </div>
            </div>


            <?php

	}

	
}//end class widget_w5*/

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("slider");'));

?>