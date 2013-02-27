<?php //Retrieve Theme Options Data
global $sp_options;
$sp_options = get_option('sp_theme_options');?>

<?php get_header(); ?>
        
                <div id="container">    
                        <div id="content">
                        
<?php the_post(); ?>
                                
                                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <h1 class="entry-title"><?php the_title(); ?></h1>
										<?php edit_post_link( __( 'Edit', 'standardpack' ), '<span class="edit-link">', '</span>' ) ?>
                                        <div class="entry-content">

<?php the_content(); ?>
<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'standardpack' ) . '&after=</div>') ?>  
                                        </div><!-- .entry-content -->
                                </div><!-- #post-<?php the_ID(); ?> -->                 
                        
<?php if ( isset($sp_options['page_comments']) && ($sp_options['page_comments']!="") ){ ?>
<?php } else { ?>
<?php comments_template('', true); ?>
<?php } ?>                    
                        
                        </div><!-- #content -->         
                </div><!-- #container -->
                
<?php get_sidebar(); ?> 
<?php get_footer(); ?>
