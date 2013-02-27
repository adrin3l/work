<?php get_header(); ?>
        
                <div id="container">    
                        <div id="content">
                        
<?php the_post(); ?>                    
                        
<?php if ( is_day() ) : ?>
                                <h1 class="page-title"><?php printf( __( 'Daily Archives: <span>%s</span>', 'standardpack' ), get_the_time(get_option('date_format')) ) ?></h1>
<?php elseif ( is_month() ) : ?>
                                <h1 class="page-title"><?php printf( __( 'Monthly Archives: <span>%s</span>', 'standardpack' ), get_the_time('F Y') ) ?></h1>
<?php elseif ( is_year() ) : ?>
                                <h1 class="page-title"><?php printf( __( 'Yearly Archives: <span>%s</span>', 'standardpack' ), get_the_time('Y') ) ?></h1>
<?php elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) : ?>
                                <h1 class="page-title"><?php _e( 'Blog Archives', 'standardpack' ) ?></h1>
<?php endif; ?>

<?php rewind_posts(); ?>
                        
<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
                                <div id="nav-above" class="navigation">
                                        <div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Older posts', 'standardpack' )) ?></div>
                                        <div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&raquo;</span>', 'standardpack' )) ?></div>
                                </div><!-- #nav-above -->
<?php } ?>                      

<?php while ( have_posts() ) : the_post(); ?>

                                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'standardpack'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

                                        <div class="entry-meta">
                                                <span class="meta-prep meta-prep-author"><?php _e('By ', 'standardpack'); ?></span>
                                                <span class="author vcard"><a class="url fn n" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" title="<?php printf( __( 'View all posts by %s', 'standardpack' ), $authordata->display_name ); ?>"><?php the_author(); ?></a></span>
                                                <span class="meta-sep"> | </span>
                                                <span class="meta-prep meta-prep-entry-date"><?php _e('Published ', 'standardpack'); ?></span>
                                                <span class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr></span>
                                                <?php edit_post_link( __( 'Edit', 'standardpack' ), "<span class=\"meta-sep\">|</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t" ) ?>
                                        </div><!-- .entry-meta -->
                                        
                                        <div class="entry-summary">     
<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'standardpack' )  ); ?>
                                        </div><!-- .entry-summary -->

                                        <div class="entry-utility">
                                                <span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'Posted in ', 'standardpack' ); ?></span><?php echo get_the_category_list(', '); ?></span>
                                                <span class="meta-sep"> | </span>
                                                <?php the_tags( '<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">' . __('Tagged ', 'standardpack' ) . '</span>', ", ", "</span>\n\t\t\t\t\t\t<span class=\"meta-sep\">|</span>\n" ) ?>
                                                <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'standardpack' ), __( '1 Comment', 'standardpack' ), __( '% Comments', 'standardpack' ) ) ?></span>
                                                <?php edit_post_link( __( 'Edit', 'standardpack' ), "<span class=\"meta-sep\">|</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t\n" ) ?>
                                        </div><!-- #entry-utility -->   
                                </div><!-- #post-<?php the_ID(); ?> -->

<?php endwhile; ?>                      

<?php /* Bottom post navigation */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<?php if (function_exists("sp_pagination")) {
						sp_pagination($wp_query->max_num_pages);
				} 
endif; ?>                    
                        
                        </div><!-- #content -->         
                </div><!-- #container -->
                
<?php get_sidebar(); ?> 
<?php get_footer(); ?>