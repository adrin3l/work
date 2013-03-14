<?php


add_action( 'init', 'register_types',0);

 function register_types() {

 		global $wp;

		//add_rewrite_rule( '(.*)/(.*)/?', 'index.php?oras=$matches[1]&$matches[2]', 'top' );

		// Register custom post types
		register_post_type( 'restaurant', array(
			'labels' => array(
				"name" => __( 'Restaurante'),
				"singular_name" => __( 'Restaurant'),
				"add_new" => __( 'Add new'),
				"add_new_item" => __( 'New Restaurant'),
				"not_found" => __( 'No Restaurant defined yet'),
				"new_item" => __( 'New Restaurant' ),
				"edit_item" => __( 'Edit Restaurant' ),
				"view_item" => __( 'View Restaurant' ),

			),
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'restaurant' ),
			'query_var' => true,
			'supports' => array('title','thumbnail'),
			'taxonomies' => array('meniu'),
		) );
		
		// Register custom post types
		register_post_type( 'produs', array(
			'labels' => array(
				"name" => __( 'Produse'),
				"singular_name" => __( 'Produs'),
				"add_new" => __( 'Add new'),
				"add_new_item" => __( 'New Produs'),
				"not_found" => __( 'No Produs defined yet'),
				"new_item" => __( 'New Produs' ),
				"edit_item" => __( 'Edit Produs' ),
				"view_item" => __( 'View Produs' ),

			),
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'produs' ),
			'query_var' => true,
			'supports' => array('title','thumbnail'),
			'taxonomies' => array('meniu'),
		) );

		$labels = array(
			'name' => _x( 'Meniu', 'taxonomy general name' ),
 			'singular_name' => _x( 'Meniu', 'taxonomy singular name' ),
 			'search_items' =>  __( 'Search Meniu' ),
 			'all_items' => __( 'All Meniu' ),
 			'parent_item' => __( 'Parent Meniu ' ),
			'parent_item_colon' => __( 'Parent Meniu:' ),
 			'edit_item' => __( 'Edit Meniu' ), 
 			'update_item' => __( 'Update Meniu' ),
 			'add_new_item' => __( 'Add New Meniu' ),
 			'new_item_name' => __( 'New Meniu Name' ),
 			'menu_name' => __( 'Meniu' ),
		); 	

 		register_taxonomy('meniu',array('restaurant','produs'), array(
 			'hierarchical' => true,
 			'labels' => $labels,
 			'show_ui' => true,
 			'query_var' => true,
 			'rewrite' => true,
	));

 	// add_rewrite_rule( '(.*)/', 'index.php?oras=$matches[1]', 'top' );
 	// add_rewrite_rule( '(.*)/(.*)/', 'index.php?oras=$matches[1]&pagename=$matches[2]', 'top' );
}
add_action( 'init', 'register_one',0);

 	function register_one() {
		$labels = array(
			'name' => _x( 'Orase', 'taxonomy general name' ),
 			'singular_name' => _x( 'Oras', 'taxonomy singular name' ),
 			'search_items' =>  __( 'Search Oras' ),
 			'all_items' => __( 'All Oras' ),
 			'parent_item' => __( 'Parent Oras ' ),
			'parent_item_colon' => __( 'Parent Oras:' ),
 			'edit_item' => __( 'Edit Oras' ), 
 			'update_item' => __( 'Update Oras' ),
 			'add_new_item' => __( 'Add New Oras' ),
 			'new_item_name' => __( 'New Oras Name' ),
 			'menu_name' => __( 'Oras' ),
		); 	

 		register_taxonomy('oras',array('restaurant'), array(
 			'hierarchical' => true,
 			'labels' => $labels,
 			'show_ui' => true,
 			'query_var' => true,
 			'rewrite' => true,
	));	
	}

	add_action('add_meta_boxes','yumm_metaboxes');

	function yumm_metaboxes(){

		add_meta_box( 
				'Restaurant Info',
				'Restaurant Info' ,
				'restaurant_metabox',
				'restaurant' ,
				'normal',
				'low'
				);		
		add_meta_box( 
				'Produs Info',
				'Produs Info' ,
				'produs_metabox',
				'produs' ,
				'normal',
				'low'
				);		
		add_meta_box( 
				'Restaurant & Meniu',
				'Restaurant & Meniu' ,
				'produs_taxonomies',
				'produs' ,
				'side',
				'low'
				);		

	}

	function restaurant_metabox(){

		global $post;
		//var_dump_pre($post);


		$adress = get_post_meta($post->ID, 'yumm-adress', true );		
		$email = get_post_meta($post->ID, 'yumm-email', true );		
		$program = get_post_meta($post->ID, 'yumm-program', true );		
		$price = get_post_meta($post->ID, 'yumm-price', true );		
		$phone = get_post_meta($post->ID, 'yumm-phone', true );		

		?>

		<label>Adress : </label>
		<input type="text" id="yumm-adress" value="<?php echo $adress ?>" name="yumm-adress" class="large-text" />
			<p class="description">
				<?php _e( 'This adress will appear automatically on restaurant details', 'carrington-jam' ) ?>
			</p>

		<label>Email : </label>
		<input type="text" id="yumm-email" value="<?php echo $email ?>" name="yumm-email" class="large-text" />
			<p class="description">
				<?php _e( 'This email will appear automatically on restaurant details', 'carrington-jam' ) ?>
			</p>

		<label>Program : </label>
		<textarea  name="yumm-program" class="large-text" ><?php echo $program ?></textarea>
			<p class="description">
				<?php _e( 'This program will appear automatically on restaurant details', 'carrington-jam' ) ?>
			</p>

		<label>Price : </label>
		<textarea  name="yumm-price" class="large-text" ><?php echo $price ?></textarea>
				<?php _e( 'This price will appear automatically on restaurant details', 'carrington-jam' ) ?>
			</p>

		<label>Phone : </label>
		<textarea  name="yumm-phone" class="large-text" ><?php echo $phone ?></textarea>
			<p class="description">
				<?php _e( 'This phone will appear automatically on restaurant details', 'carrington-jam' ) ?>
			</p>

		<?php
	}

	function produs_metabox(){

		global $post;

		$ingredients = get_post_meta($post->ID, 'ingredients', true);
		$prices = get_post_meta($post->ID, 'prices', true);
		if (!empty($prices))
            $prices = array_values($prices);
        $total_prices = count ($prices);

// var_dump_pre($prices);
		?>
		<style>
			.price span{

				margin-right:10px;
				margin-left:10px;
			}
			p.price{

				clear:both;

			}
		</style>

		<label>Ingredients : </label>

		<textarea  name="yumm-ingredients" class="large-text" ><?php echo $ingredients ?></textarea>
			<p class="description">
				<?php _e( 'This ingredients will appear automatically on restaurant details', 'carrington-jam' ) ?>
			</p>


			<p>Prices :</p>
		<p>
			Price	<input type="text" id="price" name="price" size="30" />
		</p>
		<p>
			Quantity	<input type="text" id="quantity" name="quantity" size="30" />  
		</p>
		<input type="button" id="Add_price" value="Add price" />

		<p id="price_error">
	
		<div id="link_list" class="tagchecklist">
			<input type="hidden" name="total_prices" id="total_prices" value="<?php echo $total_prices; ?>" />
			<?php 
 				if(!empty($prices))
					foreach ($prices as $key=>$price){
				?>
					<p id="price-<?php echo $key;?>" class="price"> 
					<span><a class="ntdelbutton" onclick="delete_price(<?php echo $key;?>)">X</a></span>
					<?php echo '<span>'.$price['quantity'].'</span> <span> | '.$price['price'].'</span>';?> 
					<input type="hidden" name="prices[<?php echo $key;?>][quantity]" value="<?php echo $price['quantity']?>" />
					<input type="hidden" name="prices[<?php echo $key;?>][price]" value="<?php echo $price['price']?>" />
					</p>
				<?php
					}
		?>
		</div>
		<script>
jQuery( document ).ready( function($) {
	$('#Add_price').click(function(){

		var price		=	$("#price").val();
		var quantity		=	$("#quantity").val();
			if( price.length ==0 || quantity.length ==0 ){
				$("#price_error").html('Complete all fields.');
			}
			else{
				$("#price_error").html("");
				var total_prices	=	$("#total_prices").val();

				// alert(total_prices);
				$('#link_list').append("<p id='price-"+total_prices+"' class='price'><span><a class='ntdelbutton' onclick='delete_price("+total_prices+")'>X</a></span> <span>"+price+"</span>  <span> | "+quantity+"</span><input type='hidden' name='prices["+total_prices+"][price]' value='"+price+"'/> <input type='hidden' name='prices["+total_prices+"][quantity]' value='"+quantity+"'/></p>");
// 		alert('here');
				total_prices=parseInt(total_prices)+1;
				$("#total_prices").val(total_prices);
				var price=$("#price").val('');
				var quantity=$("#quantity").val('');
			}
	});

});

function delete_price(link_nr){

	jQuery('#price-'+link_nr).remove();
}			
</script>
		<?php

	}

	function produs_taxonomies(){

		global $post;
		// var_dump_pre($post);
		$args=array(
				  'post_type' => 'restaurant',
				  'post_status' => 'publish',
				  'numberposts' => -1
				);
		$restaurants = get_posts($args);
?>
<script>
    jQuery(document).ready(function($){
    	$('#restaurant').change( function() {
			var data = {
	                                                                                                                                                            
		        action: 'get_terms_callback',
		        id : $('#restaurant').val(),      
		        produs : $('#post_ID').val()                                                                                                                                                                                                                               
			}

			$.post( ajaxurl, data, function( response ) {
	        	$('#meniu_select').html('');
	        	$('#meniu_select').html(response);
			});
		});
    });

</script>
		<label>Restaurant :</label><br/>
		<select id="restaurant" name="restaurant">
			<option value="">Select Restaurant</option>

<?php
		foreach ($restaurants as $restaurant) {

			if($restaurant->ID == $post->post_parent){

				$selected = "selected";
			}else{

				$selected = '';
			}
			
			echo "<option value='$restaurant->ID' $selected> $restaurant->post_title</option>";

		}

?>
	</select>
		<div id="meniu_select">
<?php
		if($post->post_parent != 0 ){
			

			$output = generate_terms_select($post->post_parent,$post->ID);
			echo $output;
			
		}
?>
				</div>
			<?php
	}

	add_action('wp_ajax_get_terms_callback',  'get_terms_callback');

	function get_terms_callback(){

		$output = generate_terms_select($_POST['id'], $_POST['produs']);
		echo $output;
		die();

	}

	function generate_terms_select($restaurant_id, $produs){




			$args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
			$terms = wp_get_object_terms($restaurant_id, 'meniu', $args);
			//$terms = wp_get_object_terms(array('89'), 'meniu', $args);

			$args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'ids');
			$menus = wp_get_object_terms($produs, 'meniu', $args);

			?>
				<label>Meniu :</label><br/>
				<select id="meniu" name="meniu">
					<option value="">Select Meniu</option>

			<?php
			foreach($terms as $term){

				if($term->term_id == $menus[0]){
					$selected = "selected ";
				}
				else{
					$selected = '';
				}

				echo "<option value='$term->term_id' $selected> $term->name</option>";

			}


			?>
				</select>
			<?php

	}


	add_action('save_post','yumm_save_meta');

	function yumm_save_meta($post_id){

		if ( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST ) {
					return;
		}

		if($_POST['post_type'] == 'restaurant'){

			if (!empty($_POST['yumm-adress'])){
                update_post_meta($post_id, 'yumm-adress', $_POST['yumm-adress']);
            }
            else {
                if ($_POST['action'] == 'autosave') {
                        return $post_id;
                }
                delete_post_meta($post_id, 'yumm-adress');
            }
            if (!empty($_POST['yumm-email'])){
                update_post_meta($post_id, 'yumm-email', $_POST['yumm-email']);
            }
            else {
                if ($_POST['action'] == 'autosave') {
                        return $post_id;
                }
                delete_post_meta($post_id, 'yumm-email');
            }
            if (!empty($_POST['yumm-program'])){
                update_post_meta($post_id, 'yumm-program', $_POST['yumm-program']);
            }
            else {
                if ($_POST['action'] == 'autosave') {
                        return $post_id;
                }
                delete_post_meta($post_id, 'yumm-program');
            }
            if (!empty($_POST['yumm-price'])){
                update_post_meta($post_id, 'yumm-price', $_POST['yumm-price']);
            }
            else {
                if ($_POST['action'] == 'autosave') {
                        return $post_id;
                }
                delete_post_meta($post_id, 'yumm-price');
            }
            if (!empty($_POST['yumm-phone'])){
                update_post_meta($post_id, 'yumm-phone', $_POST['yumm-phone']);
            }
            else {
                if ($_POST['action'] == 'autosave') {
                        return $post_id;
                }
                delete_post_meta($post_id, 'yumm-phone');
            }
		}


		if($_POST['post_type'] == 'produs'){

			if (!empty($_POST['prices'])) {
                    update_post_meta($post_id, 'prices', $_POST['prices']);
            } else {
                    if ($_POST['action'] == 'autosave') {
                            return $post_id;
                    }
                    delete_post_meta($post_id, 'prices');
            }
            if (!empty($_POST['yumm-ingredients'])) {
                    update_post_meta($post_id, 'ingredients', $_POST['yumm-ingredients']);
            } else {
                    if ($_POST['action'] == 'autosave') {
                            return $post_id;
                    }
                    delete_post_meta($post_id, 'yumm-ingredients');
            }

            if ($_POST['restaurant']) {
            		$args = array('ID'=> $_POST['post_ID'],
            						'post_parent'=>$_POST['restaurant']
            			);
            		remove_action('save_post', 'yumm_save_meta');
            		wp_update_post($args);
            		add_action('save_post', 'yumm_save_meta');

            } else {
                    if ($_POST['action'] == 'autosave') {
                            return $post_id;
                    }
                   $args = array('ID'=> $_POST['post_ID'],
            						'post_parent'=>0
            			);

            		remove_action('save_post', 'yumm_save_meta');
            		wp_update_post($args);
            		add_action('save_post', 'yumm_save_meta');

            }
            if ($_POST['meniu']) {
            		$args = array(
            			$_POST['meniu']
            			);
            		$args = array_map('intval', $args);
            		wp_set_object_terms($post_id, $args, 'meniu');

            } else {
                    if ($_POST['action'] == 'autosave') {
                            return $post_id;
                    }
                   $args = NULL;
            		//$args = array_map('intval', $args);
            		wp_set_object_terms($post_id, $args, 'meniu');
            }
		}
	}

	add_filter('term_link', 'yum_taxonomies_link',10,3);
	function yum_taxonomies_link($link, $term, $taxonomy ){

		if($taxonomy == 'oras'){

			$link = str_replace('oras/', '', $link );			

		}
		return $link;

	}

 	add_filter('post_type_link','yum_post_types_link',10,3);

 	function yum_post_types_link($link,$post_id, $leavename){
 		$parts=explode('/',$link);
		if($parts[3]=='restaurant'){

			$term=wp_get_object_terms($post_id->ID,'oras');
				if(empty($term))
					$replace_link='/';
				else{

					$replace_link='/'.$term[0]->slug.'/';	
				}
		}
		$link=str_replace('/restaurant/', $replace_link, $link);
 		//var_dump_pre($link);

		return $link;


 	}
	
	add_filter('request', 'yumm_handle_request' );

	function yumm_handle_request($request){

		global $wp_rewrite, $wp;
		
		if ( isset( $request['pagename'] ) ) {

			$term = term_exists($request['pagename'],'oras');
			if ($term !== 0 && $term !== null) {

				$request['oras']=$request['pagename'];
				unset($request['pagename']);
				unset($request['page']);
			}
			// var_dump_pre($term);
		}

		if ( isset( $request['pagename'] ) ) {

			$parts = explode('/',$request['pagename']);
			if(count($parts) == 2){
				$args=array(
				  'name' => $parts[1],
				  'post_type' => 'restaurant',
				  'post_status' => 'publish',
				  'numberposts' => 1
				);
				$restaurant = get_posts($args);
				if($restaurant){

					$request['post_type'] = 'restaurant';
					$request['name']= $parts[1];
					unset($request['pagename']);
				}
			}

		}

		// var_dump_pre($request);
		return $request;
	}


	add_action( 'admin_menu', 'yumm_remove_meta_boxes' );

	function yumm_remove_meta_boxes(){


		remove_meta_box('meniudiv', 'produs', 'normal');
	}

	// add_action ('template_redirect', "debug_redirect");

	function debug_redirect(){


	global $wp, $wp_rewrite;

	var_dump_pre($wp->matched_rule);
	var_dump_pre($wp->request);
}

?>