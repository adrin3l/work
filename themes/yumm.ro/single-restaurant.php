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

global $post;
$adress = get_post_meta($post->ID, 'yumm-adress', true );		
$email = get_post_meta($post->ID, 'yumm-email', true );	
$program = get_post_meta($post->ID, 'yumm-program', true );		
$price = get_post_meta($post->ID, 'yumm-price', true );		
$phone = get_post_meta($post->ID, 'yumm-phone', true );		
$link = get_permalink($post->ID);

$args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');

$meniuri = wp_get_object_terms( $post->ID, 'meniu', $args );

?>
<div id="wrapp2">
<div id="local">
<!-- ********** RESTAURANT DESCIPTION ***************** -->
<div id="despre">
 <div class="instance">
 	<div class ="img">
 		 <?php echo get_the_post_thumbnail($post->ID, array(98,94)); ?>
 	</div>
 	 <div class="date-restaurant">
        <h3><a href="<?php echo $link;?>"><?php echo $post->post_title;?></a></h3>
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
</div>

<div id="description">
    <?php the_content(); ?>
</div>


<h3 id="local">Meniu <?php echo $post->post_title;?></h3>


<!-- *********** TAB MENIURI *************** -->
<div id="meniu-delivery">
    <ul>
<?php
    	foreach ($meniuri as $meniu){

    			?>
    			<li>
    				<input type="hidden" id="restaurant_id" restaurant="<?php echo $post->ID; ?>" />
    				<a href= '#' class="m_link" meniu="<?php echo $meniu->term_id?>" >
    					<img  width="29" height="29" alt="<?php echo $meniu->name;?>" src="<?php echo z_taxonomy_image_url($meniu->term_id);?>">
    					<?php echo $meniu->name;?>
    				</a>

    			</li>

    			<?php

    }
?>

    </ul>
</div>


<!-- *************** MENIURI ************************ -->
    <div id="content-produs">
    <?php
    	generate_produse_template($post->ID, $meniuri[0]->term_id);
	?>
	</div>

    <div id ="comments">
<?php
        wp_reset_query();
        comments_template();
?>
    </div>
</div>
</div>
<?php
get_footer();

?>