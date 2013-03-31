<?php

// This file is part of the Carrington JAM Theme for WordPress
// http://carringtontheme.com
//
// Copyright (c) 2008-2010 Crowd Favorite, Ltd. All rights reserved.
// http://crowdfavorite.com
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// **********************************************************************

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }
global $wp_query;
// var_dump($wp_query->query_vars);
get_header();
$template_url = get_bloginfo('template_url');
$oras_curent = $wp_query->query_vars['oferta-oras'];
$orase = get_terms('oras');
?>
<div id="oferta">
<img id="porcusor" alt="pusculita cu bani" src="<?php echo $template_url;?>/images/porc.png">
<h2 id="slid" class="title2">Economiseste cu Yumm!</h2>
<ul>
<?php
// var_dump($orase);
foreach($orase as $oras){

	// var_dump($oras->slug);
	$link = get_term_link($oras, 'oras'); 
	$link = str_replace($oras->slug, "oferte/".$oras->slug, $link);
	// var_dump($link);
	echo "<li><a href='$link'>$oras->name</a></li>";
}

?>
</ul>
<?php
// var_dump($oras_curent);
$items = 8;
if($oras_curent){
	global $wpdb;

	$oras_curent = get_term_by('slug', $oras_curent, 'oras');	
	$query = "Select * from $wpdb->posts p
	join $wpdb->term_relationships tr on tr.object_id = p.post_parent
	join $wpdb->term_taxonomy tt on tt.term_taxonomy_id = tr.term_taxonomy_id
	join $wpdb->terms t on t.term_id = tt.term_id
	where t.term_id = $oras_curent->term_id and tt.taxonomy = 'oras' and p.post_type='oferta' and p.post_status='publish'
	";

	// var_dump($query);
	$oferte = $wpdb ->get_results($query);
	// var_dump($oferte);
	echo "<p id='oferte'>Avem ".count($oferte)." oferte in ".$oras_curent->name.".</p>";
	
}else{

	$args = array(
		'post_type' => 'oferta',
		'posts_per_page'=> $items,

		);
	$query = new WP_Query( $args );
		$oferte = $query->posts;
	// var_dump($oferte);

	echo "<p id='oferte'>Ultimele oferte publicate!</p>";

}

$i =1 ;
foreach($oferte as  $oferta){


	$restaurant = get_the_title($oferta->post_parent);
	$restaurant_link = get_permalink($oferta->post_parent);
	$info = $oferta->post_content;
	$phone = get_post_meta($oferta->post_parent, 'yumm-phone', true );	
	$valability = get_post_meta($oferta->ID,'valability',true);
	if($i%2 == 0) {$class = "second_col";}
	else{ $class = '';}

	?>
		<div class = "item <?php echo $class;?>">
			<a href = '<?php echo $restaurant_link?>' class = "imagine_oferta">
				<?php echo get_the_post_thumbnail($oferta->ID, 'medium'); ?>
			</a>
			<p class="oferta-text"><?php echo $oferta->post_title;?></p>
			<p class="telefon"> <?php echo $phone;?> </p>

		</div>

	<?php

	$i++;

}

?>
</div>
<?php
get_footer();

?>