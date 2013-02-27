<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
  
  <div class="entry-meta">    
	<?php echo pyramid_post_date() . pyramid_post_comments() . pyramid_post_author() . pyramid_post_sticky() . pyramid_post_edit_link(); ?>
  </div><!-- .entry-meta -->
  
  <div class="entry-content clearfix">
	<?php pyramid_featured_image(); ?>
	<?php pyramid_post_style(); ?>
  </div> <!-- end .entry-content -->
  
  <?php echo pyramid_link_pages(); ?>
  
  <div class="entry-meta-bottom">    
  <?php echo pyramid_post_category() . pyramid_post_tags(); ?>    
  </div><!-- .entry-meta-bottom -->

</div> <!-- end #post-<?php the_ID(); ?> .post_class -->