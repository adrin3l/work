<?php
/*
  Plugin Name: Bulk Delete Posts
  Description: Create new options where you can bulk delete posts
  Author: Daniel Andrei-Adrian
  Version: 1.0
  */

define( 'BDP_DIR', dirname( __FILE__ ) );
define( 'BDP_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );


class bulk_delete{

	function init(){
			 add_filter('admin_menu', array(__CLASS__, 'bulk_delete_page'));
			 add_action('wp_ajax_delete_posts_callback', array(__CLASS__, 'delete_posts_callback'));

	}

	function delete_posts_callback(){


                $args = array(
                    'post_type' => 'post',
                    'fields' => 'ids',
                    'numberposts' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'id',
                            'terms' => $_POST['category']
                        )
                    )
                );
                $posts = get_posts($args);
                $count = 0;

                foreach ($posts as $post) {
                	
                	wp_delete_post($post,TRUE);
					$count++;

                }

                echo '<pre> POSTS DELETED : ';var_dump($count);
                die;

	}

	function bulk_delete_page(){

		add_options_page('Bulk Posts Delete', 'Bulk Posts Delete', 'manage_options', 'bulk-delete', array(__CLASS__, 'bulk_delete_options'));
	}

	function bulk_delete_options(){



		?>

		    <script>
                        jQuery(document).ready(function($){
                               
                                $('#delete_posts').click( function() {
                                                                                                                                                        
                                        // var taxonomy_to_move = $('#taxonomy_to_move').val();
                                        // var taxonomy_to_move_in = $('#taxonomy_to_move_in').val();
                                        var term_to_move = $('#delete_category').val();
                                       // var term_to_move_in = $('#term_to_move_in').val();
                                        var err=0;
                                        // if(!taxonomy_to_move){
                                        //         alert('Chose taxonomy to move from !');
                                        //         err=1
                                        // }
                                        // if(!taxonomy_to_move_in){
                                        //         alert('Chose taxonomy to move in !');
                                        //         err=1
                                        // }
                                                                                                                                                       
                                        if(!term_to_move){
                                                alert('Chose term to move from !');
                                                err=1
                                        }
                                        
                                        if(err == 1){
                                                return false;
                                        }
                                        var data = {
                                                                                                                                                                                
                                                action: 'delete_posts_callback',
                                                
                                                category:term_to_move,
                                                                                                                                                                
                                                                                                                                                                
                                        }
                                        $.post( ajaxurl, data, function( response ) {
                                                $('#move_details').html(response);
                                        });
                                                                                                                                                       
                                });
                                                                                                                                           
                                                                                                                                                                                        
                        });

                </script>



		<div id ="to_move" style="width:200px;float:left;padding-top: 50px;">
            <h2>
                    Delete Posts from category:<br/>
       
            </h2>           
            <p id="select_term_to_move"><?php bulk_delete::get_terms_callback('delete_category'); ?></p>

            <a href="#"  class="button" id="delete_posts">Delete Posts</a>
        </div><br/>
         <div id="move_details" style="clear: both;"></div>

		<?php

	}

	function get_terms_callback($select_id) {
                $taxonomy = 'category';
                // $select_id = $_POST['select_id'];
                $args = array('hide_empty' => false);
                $terms = get_terms($taxonomy, $args);
                ?>Choose category:
                <select id="<?php echo $select_id;?>" >
                <?php
                foreach ($terms as $term) {
                        ?>
                                <option value ="<?php echo $term->term_id; ?>">
                                <?php echo $term->name; ?>
                                </option>

                        <?php
                }
                ?>
                </select>

                <?php
               // die();
        }

}

bulk_delete::init();