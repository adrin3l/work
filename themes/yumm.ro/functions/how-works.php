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
class how_works extends WP_Widget
{
	//constructor
	function how_works()
	{

		//$widget_options = array('classname' => 'widget_rss_links', 'description' => 'A list with your feeds links' );
		//$widget_options = array('classname' => 'Mayra widget', 'description' => 'Mayra Widget' );

		//$control_options = array('width' => 'required if more than 250px', 'height' => 'currently not used but may be needed in the future' );
		//$control_options = array('width' => '250px', 'height' => '' );

		//function WP_Widget( 	$id_base = false, $name, $widget_options = array(), $control_options = array()) 
		//$name = 'w3' - apears on widget header bar, on Widget page
		$this->WP_Widget(false, $name = 'How works');	

	}

	//form creates in the backend the input mask, which in our case for the title of the widget and the displayed link text.
	function form($instance)
	{
	   $dta = array(
            'title' => '',
			'step1'=>'',
			'step2'=>'',
			'step3'=>'',
			'thanks'=>''
        );
        $instance = wp_parse_args($instance, $dta);
        extract($instance);

        $category = htmlspecialchars($instance['category']);
		$title = htmlspecialchars($instance['title']);
		$template = htmlspecialchars($instance['template']);
//  		var_dump_pre($instance);
?>
			
	
	<p>Title:</p>
	<label>
			<input type="textbox" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title;?>" />
	</label>
		<p>Step1:</p>
	<label>
			<input type="textbox" id="<?php echo $this->get_field_id('step1'); ?>" name="<?php echo $this->get_field_name('step1'); ?>" value="<?php echo $step1;?>" />
	</label>
		<p>Step2:</p>
	<label>
			<input type="textbox" id="<?php echo $this->get_field_id('step2'); ?>" name="<?php echo $this->get_field_name('step2'); ?>" value="<?php echo $step2;?>" />
	</label>
		<p>Step3:</p>
	<label>
			<input type="textbox" id="<?php echo $this->get_field_id('step3'); ?>" name="<?php echo $this->get_field_name('step3'); ?>" value="<?php echo $step3;?>" />
	</label>
		<p>Thanks:</p>
	<label>
			<input type="textbox" id="<?php echo $this->get_field_id('thanks'); ?>" name="<?php echo $this->get_field_name('thanks'); ?>" value="<?php echo $thanks;?>" />
	</label>

<?
//  var_dump_pre($instance);
	}

		
	//update examine the data and stores an instance of the widget
	function update($new_instance, $old_instance)
	{
		
		//return $new_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['step1'] = strip_tags($new_instance['step1']);
		$instance['step2'] = strip_tags($new_instance['step2']);
		$instance['step3'] = strip_tags($new_instance['step3']);
		$instance['thanks'] = strip_tags($new_instance['thanks']);
		return $instance;

	}
	
	//The function widget is responsible for the output in the frontend .
	function widget($args, $instance)
	{
			global $wpdb, $post, $dta;
			extract($instance);
			$template_url = get_bloginfo('template_url');
?>	
<div id="cum-functioneaza">
                <h2 id="functioneaza"><?php echo $title;?></h2>
                <img id="fundal" alt="cum functioneaza imagine de fundal" src="<?php echo $template_url;?>/images/cum-functioneaza-bg.png">
                <div id="number">
                    <ul>
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                    </ul>
                </div>
                <div id="text">
                        <li><?php echo $step1;?></li>
                        <li><?php echo $step2;?></li>
                        <li><?php echo $step3;?></li>
                </div>
                <h2 id="pofta-buna"><?php echo $thanks;?></h2>
            </div>
            <?php

	}

	
}//end class widget_w5*/

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("how_works");'));

?>