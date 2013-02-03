<?php
/*
  Plugin Name: Posts Moving
  Description: Create options to  move articles from one category to other .
  Author: Daniel Andrei-Adrian
  Version: 1.0
  */

define( 'PP_DIR', dirname( __FILE__ ) );
define( 'PP_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );

class move_posts{

	function init (){

        add_filter('admin_menu', array(__CLASS__, 'category_matching_page'));
        add_action('wp_ajax_move_posts_callback', array(__CLASS__, 'move_posts_callback'));

	}


	 function category_matching_page() {

    add_options_page('Category Matching', 'Category Matching', 'manage_options', 'category-matching', array(__CLASS__, 'category_matching_settings'));
    }

     function category_matching_settings() {
              //  $taxonomies = get_taxonomies();
                ?>
                <script>
                        jQuery(document).ready(function($){
                               
                                $('#move_posts').click( function() {
                                                                                                                                                        
                                        // var taxonomy_to_move = $('#taxonomy_to_move').val();
                                        // var taxonomy_to_move_in = $('#taxonomy_to_move_in').val();
                                        var term_to_move = $('#term_to_move').val();
                                        var term_to_move_in = $('#term_to_move_in').val();
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
                                        if(!term_to_move_in){
                                                alert('Chose term to move in !');
                                                err =1
                                        }
                                        if(err == 1){
                                                return false;
                                        }
                                        var data = {
                                                                                                                                                                                
                                                action: 'move_posts_callback',
                                                taxonomy_to_move:'category',
                                                taxonomy_to_move_in:'category',
                                                term_to_move:term_to_move,
                                                term_to_move_in:term_to_move_in
                                                                                                                                                                
                                                                                                                                                                
                                        }
                                        $.post( ajaxurl, data, function( response ) {
                                                $('#move_details').html(response);
                                        });
                                                                                                                                                       
                                });
                                                                                                                                           
                                                                                                                                                                                        
                        });

                </script>

                <div id ="to_move" style="width:200px;float:left;padding-top: 50px;">
                        <p>
                                Move Posts from category:<br/>
                   
                        </p>           
                        <p id="select_term_to_move"><?php move_posts::get_terms_callback('term_to_move'); ?></p>
                </div>
                <div style="float:left;width:200px;font-size: 100px;padding-top: 50px;display:block;">

                        <a href="#" id="move_posts"> --></a>
                </div>


                <div id ="to_move_in" style="width:200px;float:left;padding-top: 50px;">
                        <p>
                             Move Posts to category:<br/>
                        </p>           
                        <p id="select_term_to_move_in"><?php move_posts::get_terms_callback('term_to_move_in'); ?></p>
                </div>
                <div id="move_details" style="clear: both;"></div>
                <?php
        }

         function move_posts_callback() {


                $args = array(
                    'post_type' => 'post',
                    'fields' => 'ids',
                    'numberposts' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => $_POST['taxonomy_to_move'],
                            'field' => 'id',
                            'terms' => $_POST['term_to_move']
                        )
                    )
                );
                $posts = get_posts($args);
                $count = 0;
                foreach ($posts as $post) {
                        if (wp_set_post_terms($post, $_POST['term_to_move_in'], $_POST['taxonomy_to_move_in'], true)) {
                                $count++;
                        } else {
                                var_dump(wp_set_post_terms($post, $_POST['term_to_move_in'], $_POST['taxonomy_to_move_in'], true), 'ERROR ON POST ID' . $post);
                        }
                }
                echo "<pre>POSTS TO MOVE :";var_dump(count($posts));
                echo "<pre>POSTS MOVED: ";var_dump($count);

                die();
        }

        function get_terms_callback($select_id) {
                $taxonomy = 'category';
                // $select_id = $_POST['select_id'];
                $args = array('hide_empty' => false);
                $terms = get_terms($taxonomy, $args);
                ?>Chose Term:
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

move_posts::init();