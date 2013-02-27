<?php
/** Primary Menu Callback */
function pyramid_primary_menu_cb() {
	wp_page_menu();		 
}
?>
<div class="grid_11">
  <div class="menu1">
    <div class="menu1-data">
      <?php
      if ( has_nav_menu( 'pyramid-primary-menu' ) ):
    
        $args = array(
        
            'container' => 'div', 
            'container_class' => 'primary-container', 
            'theme_location' => 'pyramid-primary-menu',
            'menu_class' => 'sf-menu1',
            'depth' => 0,
            'fallback_cb' => 'pyramid_primary_menu_cb'
                    
        );
    
        wp_nav_menu( $args );
    
      else:
    
        pyramid_primary_menu_cb();	
  
      endif;
      ?>
    </div>
  </div>
</div>