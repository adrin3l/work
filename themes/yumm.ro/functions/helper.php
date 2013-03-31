<?php
if (!function_exists('array_insert')) {
	function array_insert( $array, $pairs, $key, $position = 'after' ) {
		$key_pos = array_search( $key, array_keys( $array ) );

		if ( 'after' == $position )
			$key_pos++;

		if ( false !== $key_pos ) {
			$result = array_slice( $array, 0, $key_pos );
			$result = array_merge( $result, $pairs );
			$result = array_merge( $result, array_slice( $array, $key_pos ) );
		}
		else {
			$result = array_merge( $array, $pairs );
		}

		return $result;
	}
}

/*
 * name: var_dump_pre
 * description: formated var_dump
 * 
 * */
function var_dump_pre( $var, $title='', $color = 'white', $dump = FALSE ){
	?>

	<?php
	$style = 'clear:both;overflow:auto;border:1px solid #BFBFBF; margin-top:10px; padding-left:3px;padding-bottom:3px;background-color:'.$color;
	echo '<div class="debug" style="'. $style .'" >';
	$db = debug_backtrace();
	//echo 'function: '.$db[0]['file'].' @ line:['.$db[0]['line'].']';
	$file  = strrev(implode(strrev(' /<span style="color:black">'), explode("/", strrev($db[0]['file']), 2)));
	$file .= '</span>'; 
	echo '<div style="width:100%; margin-left:-3px; color:#969696;background-color:#F0F0F0;padding:3px 0px 3px 3px"><small><span style="color:black">file: </span>'.$file.' <br />@<br /><span style="color:black">line:['.$db[0]['line'].']</span></small></div>';
	echo '<pre>';

	if( $title !='' )
		echo '<div style="width:100%; margin-left:-3px; background-color:#E5E5F8;padding:3px 0px 3px 3px"><strong>'.$title.':</strong></div><br />';
	
	if( $dump || is_bool( $var )){
		if( is_bool( $var )){
					
			switch ( $var ){
				case TRUE:
					echo '<span style="color:green">'; var_dump( $var ); echo '</span>';
				break;
				
				case FALSE:
					echo '<span style="color:red">'; var_dump( $var );echo '</span>';
				break;
			}
		}
		else
			var_dump( $var );
	}
	else
		print_r( $var );
	echo '</pre>';
	echo '</div>';
	echo '<div style="clear:both"></div>';
}

add_action('wp_ajax_generate_produse_callback',  'generate_produse_callback');
add_action('wp_ajax_no_priv_generate_produse_callback',  'generate_produse_callback');

function generate_produse_callback(){

	__generate_produse_template($_POST['restaurant'], $_POST['meniu']);
	die;
}
function generate_produse_template($restaurant_id, $meniu_id){


	__generate_produse_template($restaurant_id, $meniu_id);
}

function __generate_produse_template($restaurant_id, $meniu_id){

$args =array(	'post_type'=>'produs',
			'post_status'=>'publish',
			'post_parent'=>$restaurant_id,
			'tax_query' => array(
				array(
					'taxonomy' => 'meniu',
					'field' => 'id',
					'terms' => $meniu_id
				),
			)
		);

$products = get_posts($args);

    foreach($products as $product){

    	$ingredients = get_post_meta($product->ID, 'ingredients', true);
		$prices = get_post_meta($product->ID, 'prices', true);
		if (!empty($prices))
            $prices = array_values($prices);

    	?>
    		<div class="produs">

    			<div class="imagine">

    				 <?php echo get_the_post_thumbnail($product->ID, array(159,145)); ?>
    			</div>
    			<div class="right-side">
    				<div class="nume">
    					<h3 class="nume-produs"><?php echo $product->post_title;?></h3>
    					<p class="descriere"><?php echo $ingredients;?></p>
    				</div>
    				<?php 
    				if($prices){
	    				foreach($prices as $price){
	    					?>
	    					<div class="pret">
							<?php
								echo $price['quantity']. " <br/>". $price['price'];
							?>
	    					</div>
	    					<?php
	    				}
    				}
    				?>
    			</div>
    		</div>
    	<?php
    }
}
add_action('wp_head','pluginname_ajaxurl');
function pluginname_ajaxurl() {
	?>
	<script type="text/javascript">
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	</script>
<?php
}


add_filter('manage_edit-meniu_columns','my_season_columns');
add_filter('manage_edit-oras_columns','my_season_columns');
function my_season_columns($columns){
    unset($columns['posts']);
    //$columns['cpt_count'] = 'Races';

    return $columns;
}

