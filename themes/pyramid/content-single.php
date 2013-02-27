<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <h1 class="entry-title entry-title-single"><?php the_title(); ?></h1>
  
  <div class="entry-meta">    
	<?php echo pyramid_post_date() . pyramid_post_comments() . pyramid_post_author() . pyramid_post_sticky() . pyramid_post_edit_link(); ?>
  </div><!-- .entry-meta -->
  
  <div class="entry-content clearfix">
  	<?php the_content(); ?>
  </div> <!-- end .entry-content -->
  
  <?php echo pyramid_link_pages(); ?>
  
  <div class="entry-meta-bottom">
  <?php echo pyramid_post_category() . pyramid_post_tags(); ?>
  </div><!-- .entry-meta -->

</div> <!-- end #post-<?php the_ID(); ?> .post_class -->

<?php pyramid_author(); ?> 

<?php comments_template( '', true ); ?>