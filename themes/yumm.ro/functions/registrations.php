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
		<input type="text" id="yumm-program" value="<?php echo $program ?>" name="yumm-program" class="large-text" />
			<p class="description">
				<?php _e( 'This program will appear automatically on restaurant details', 'carrington-jam' ) ?>
			</p>

		<label>Price : </label>
		<input type="text" id="yumm-price" value="<?php echo $price ?>" name="yumm-price" class="large-text" />
			<p class="description">
				<?php _e( 'This price will appear automatically on restaurant details', 'carrington-jam' ) ?>
			</p>

		<label>Phone : </label>
		<input type="text" id="yumm-phone" value="<?php echo $phone ?>" name="yumm-phone" class="large-text" />
			<p class="description">
				<?php _e( 'This phone will appear automatically on restaurant details', 'carrington-jam' ) ?>
			</p>

		<?php
	}

	function produs_metabox(){

		?>

		<label>Ingredients : </label>

		<textarea  name="yumm-ingredients" class="large-text" ><?php echo $ingredients ?></textarea>
			<p class="description">
				<?php _e( 'This ingredients will appear automatically on restaurant details', 'carrington-jam' ) ?>
			</p>

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
	}

?>