<?php
/*
  Plugin Name: Simple Related Posts
  Description: Create related posts metabox in each post editor
  Author: Daniel Andrei-Adrian
  Version: 1.0
  */

define( 'SRP_DIR', dirname( __FILE__ ) );
define( 'SRP_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );

  class SRP {


  	function init (){

		add_action( 'add_meta_boxes', array(__CLASS__,'add_srp_metabox' ));
	
  		add_action( 'save_post' , array(__CLASS__, 'save_srp_box'));

  		add_filter( 'the_content', array(__CLASS__,'activate_srp' ));

  	}


  	function activate_srp($content){

  		global $post;
		if(is_single()){

			$show_related = get_post_meta($post->ID, 'show_related', true);

			if($show_related){
				ob_start();
				$related_taxonomy=get_post_meta($post->ID, 'related_taxonomy', true);
				if(!$related_taxonomy){
					$related_taxonomy='category';
				}
				$rpl_title=get_post_meta($post->ID, 'rpl_title', true);
				$rp_count =get_post_meta($post->ID, 'rp_count', true);
				$terms =wp_get_object_terms( $post->ID, $related_taxonomy , array('fields' => 'ids') );

				// var_dump(implode(',',$terms));

				if(!$rp_count){
					$rp_count = 5;
				}

				$args = array(
						'post_type' => 'post',
						'post__not_in' =>array( $post->ID),
						'posts_per_page' => $rp_count,
						'tax_query' => array(
							array(

								'taxonomy' => $related_taxonomy,
								'field' => 'id',
								'terms' => $terms,
								'operator'=> 'IN'
							)
						)
					);
				//echo '<pre>';var_dump($args);

				echo "<h2>$rpl_title</h2>";
				$the_query = new WP_Query( $args );
					echo '<ul>';
					while ( $the_query->have_posts() ) :
						$the_query->the_post();
						echo "<li><a href='".get_permalink()."'>" . get_the_title() . '</a></li>';
					endwhile;
					echo '</ul>';
					wp_reset_postdata();
					wp_reset_query();
				$related_content = ob_get_clean();	

			}
		}
		return $content.$related_content;
  	}

  	function save_srp_box(){

  		global $post;

  		if($_POST['show_related']){

			update_post_meta($post->ID, 'show_related' , $_POST['show_related']);
			update_post_meta($post->ID, 'related_taxonomy' , $_POST['related_taxonomy']);

		}else{

			delete_post_meta($post->ID , 'show_related');
			delete_post_meta($post->ID , 'related_taxonomy');
		}

		if($_POST['rpl_title']){

			update_post_meta($post->ID, 'rpl_title' , $_POST['rpl_title']);
			

		}else{

			delete_post_meta($post->ID , 'rpl_title');
			
		}
		if($_POST['rp_count']){

			update_post_meta($post->ID, 'rp_count' , $_POST['rp_count']);
			

		}else{

			delete_post_meta($post->ID , 'rp_count');
			
		}

  	}

  	function add_srp_metabox(){

		add_meta_box( 
		'Simple Related Posts Settings',
		__( 'Simple Related Posts Settings', 'myplugin_textdomain' ),
		array(__CLASS__,'add_srp_box'),
		'post',
		'side',
        'high' 
		); 	 
	}

	function add_srp_box(){

			global $post;
			$taxonomies = get_object_taxonomies('post');	

			$show_related = get_post_meta($post->ID,'show_related',true);
			$related_taxonomy = get_post_meta($post->ID,'related_taxonomy',true);
			$rpl_title  = get_post_meta($post->ID,'rpl_title',true);

			$rp_count  = get_post_meta($post->ID,'rp_count',true);
			if(!$rpl_title){
				$rpl_title = 'Related Posts'; 
			}
		?>

		<script>
				var $jsrp = jQuery.noConflict();
				$jsrp (document).ready(function(){

					$jsrp('#show_related').click(function(){

						$jsrp('#activate_related').toggle('slow');

					});

				});
		</script>


		<label for="show_related" >	<input <?php if($show_related == 1) echo "checked=checked";?>  name="show_related" id="show_related" type="checkbox" value="1" /> Show Related Posts </label>
		
		<div <?php if($show_related != 1) echo "style='display:none;'";?> id="activate_related">
			
			<h4>Get posts by :</h4>

			<?php

				foreach ($taxonomies as $taxonomy){
					if($taxonomy == $related_taxonomy){
						$checked = 'checked=checked';
					}
					else{
						$checked ='';
					}
					echo "<p><label> <input $checked type='radio' name='related_taxonomy' id='related_taxonomy' value='$taxonomy'> $taxonomy</label></p>";
				}

			?>
			<label >Related Posts List Title : </label>
			<input type="text" name="rpl_title" id="rpl_title" value="<?php echo $rpl_title; ?>" />
			<p class="description">List title to display.</p>
			
			<label >Related Posts Count : </label>
			<input type="text" name="rp_count" id="rp_count" value="<?php echo $rp_count; ?>" />
			<p class="description">Number of posts to show.</p>
		</div>


		<?php



	}
}

SRP::init();
