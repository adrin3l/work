<div class="wrap pyramid-settings">
  
  <?php 
  /** Get the parent theme data. */
  $pyramid_theme_data = pyramid_theme_data();
  screen_icon();
  ?>
  
  <h2><?php echo sprintf( __( '%1$s Theme Settings', 'pyramid' ), $pyramid_theme_data['Name'] ); ?></h2>    
  
  <?php settings_errors( 'pyramid_options' ); ?>
  
  <form action="options.php" method="post">
    
    <?php settings_fields('pyramid_options_group'); ?>
    
    <div id="pyramid_tabs">
    
      <ul>
        <li><a href="#pyramid_section_blog_tab"><?php _e( 'Blog Options', 'pyramid' ); ?></a></li>
        <li><a href="#pyramid_section_general_tab"><?php _e( 'General Options', 'pyramid' ); ?></a></li>        
      </ul>
      
      <div id="pyramid_section_blog_tab"><?php do_settings_sections( 'pyramid_section_blog_page' ); ?></div>
      <div id="pyramid_section_general_tab"><?php do_settings_sections( 'pyramid_section_general_page' ); ?></div>      
    
    </div>
    
    <p class="submit">
      <input name="Submit" type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'pyramid' ); ?>" />
    </p>
  
  </form>

</div>