<div class="grid_5">	
  <div id="headimg">

	<?php if ( get_header_image() ) : ?>
    
    <div id="logo-image">
      <a href="<?php echo home_url( '/' ); ?>"><img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
    </div><!-- end of #logo -->
    
    <?php else: // header image was removed ?>
    
    <div id="logo-text">
      <span class="site-name"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
      <span class="site-description"><?php bloginfo( 'description' ); ?></span>
    </div><!-- end of #logo -->
    
    <?php endif; // header image was removed (again) ?>
  
  </div>
</div> <!-- end .grid_5 -->