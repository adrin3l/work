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

get_header();
//var_dump_pre($_SERVER);

$is_meniu = $wp_query->query_vars['meniu-oras'];
$oras = $wp_query->query_vars['oras'];
if(!$is_meniu){
	$meniuri = get_terms('meniu');
}else{

	$meniu_actual = get_term_by('slug', $is_meniu, 'meniu'); 
	$meniu_args = array(
			'taxonomy' => 'meniu',
			'field' => 'id',
			'terms' => $meniu_actual->term_id
		);

}
global $term, $wp, $wp_query;



$oras = get_term_by('slug', $oras, 'oras'); 


$args= array(

		'post_type'=>'restaurant',
		'post_status'=>'publish',
		'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'oras',
			'field' => 'id',
			'terms' => $oras->term_id
		),
		$meniu_args
	)

	);
$restaurants = get_posts($args);

// var_dump_pre($restaurants);
//var_dump_pre($oras);
// var_dump_pre($term);
// var_dump_pre($wp);
?>
<div id="content">
<?php
	if($meniuri){
		?>
	<div id="bucatarii">
        <h4 class="oras">BUCATARII</h4>
        <ul class='bucatarie'>
        <?php
        	$i=1 ;
			foreach($meniuri as $meniu){

				
				$link = site_url().$_SERVER['REQUEST_URI'].$meniu->slug;
				echo "<li><a href='$link'>$meniu->name</a></li>";
				if($i%5 == 0){
					echo "</ul><ul class='bucatarie'>";
				}
				$i++;
			}


        ?>
    	</ul>
    </div>
    <?php
	}
    ?>

    <div id="toate-meniurile">
    		<?php
    			if($is_meniu){
    		?>
                <h4 class="oras">Meniuri de comandat <?php echo $meniu_actual->name;?> in  <?php echo $oras->name;?></h4>
                <?php

            }else{
                ?>
                <h4 class="oras">Toate meniurile din <?php echo $oras->name;?></h4>
                <?php
            }
            ?>
                <?php

                foreach($restaurants as $restaurant){


                	$adress = get_post_meta($restaurant->ID, 'yumm-adress', true );		
					$email = get_post_meta($restaurant->ID, 'yumm-email', true );	
					$program = get_post_meta($restaurant->ID, 'yumm-program', true );		
					$price = get_post_meta($restaurant->ID, 'yumm-price', true );		
					$phone = get_post_meta($restaurant->ID, 'yumm-phone', true );		
					$link = get_permalink($restaurant->ID);

					$args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');

					$meniuri = wp_get_object_terms( $restaurant->ID, 'meniu', $args );
                	?>
    		     <div class="instance">
    		     	<div class ="img">
    		     		 <?php echo get_the_post_thumbnail($restaurant->ID, array(98,94)); ?>
    		     	</div>
    		     	 <div class="date-restaurant">
                        <h3><a href="<?php echo $link;?>"><?php echo $restaurant->post_title;?></a></h3>
                        <p><?php echo $adress;?></p>
                        <p><?php echo $email;?></p>
                        <p id="buc">Bucatarii:</p>
                        <?php
                        	foreach($meniuri as $meniu){
                        		?>

                       			 <img class="slice" width="29" height="29" alt="<?php echo $meniu->name;?>" src="<?php echo z_taxonomy_image_url($meniu->term_id);?>">

                        		<?php

                        	}
                        ?>

                               
                    </div><!--End date-restaurant-->

                     <div class="trio">
                        <div class="program">
                            <h3 class="white">Program</h3>
                            <p><?php echo $program;?></p>
                        </div>
                        <div class="cost">
                            <h3 class="white">Cost</h3>
                            <p><?php echo $price;?></p>
                        </div>
                        <div class="telefon">
                            <h3 class="white">Telefon</h3>
                            <?php echo $phone;?>
                        </div><!--End telefon-->
                    </div>  <!--End trio-->           

    		     </div>

                	<?php
                }
               ?>
            </div>


</div>

<?php

// var_dump_pre($meniuri);
get_footer();

?>