<?php
add_action( 'init', 'register_types',0);

 function register_types() {

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

		$prices = get_post_meta($post->ID, 'prices', true);
		if (!empty($prices))
            $prices = array_values($prices);
        $total_prices = count ($prices);

var_dump_pre($prices);
		?>

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
					<p id="price-<?php echo $key;?>"> 
					<span><a class="ntdelbutton" onclick="delete_price(<?php echo $key;?>)">X</a></span>
					<?php echo '<span>'.$price['quantity'].'</span><span>:'.$price['price'].'</span>';?> 
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

				alert(total_prices);
				$('#link_list').append("<p id='price-"+total_prices+"'><span><a class='ntdelbutton' onclick='delete_price("+total_prices+")'>X</a></span> <span>"+price+"</span><span>:"+quantity+"</span><input type='hidden' name='prices["+total_prices+"][price]' value='"+price+"'/> <input type='hidden' name='prices["+total_prices+"][quantity]' value='"+quantity+"'/></p>");
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

	add_action('wp_insert_post','yumm_save_meta');

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
		}
	}

?>