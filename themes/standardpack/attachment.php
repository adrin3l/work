<?php get_header(); ?>
 
        <div id="container">
            <div id="content">
			
<?php the_post(); ?>			
 
				<h1 class="page-title"><a href="<?php echo get_permalink($post->post_parent) ?>" title="<?php printf( __( 'Return to %s', 'standardpack' ), esc_html( get_the_title($post->post_parent), 1 ) ) ?>" rev="attachment"><span class="meta-nav">&laquo; </span><?php echo get_the_title($post->post_parent) ?></a></h1>
 
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="entry-title"><?php the_title(); ?></h2>
					
                    <div class="entry-meta">
						<span class="meta-prep meta-prep-author"><?php _e('By ', 'standardpack'); ?></span>
                        <span class="author vcard"><a class="url fn n" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" title="<?php printf( __( 'View all posts by %s', 'standardpack' ), $authordata->display_name ); ?>"><?php the_author_meta('display_name'); ?></a></span>
                        <span class="meta-sep"> | </span>
                        <span class="meta-prep meta-prep-entry-date"><?php _e('Published ', 'standardpack'); ?></span>
                        <span class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr></span>
                        <?php edit_post_link( __( 'Edit', 'standardpack' ), "<span class=\"meta-sep\">|</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t" ) ?>                                               
                    </div><!-- .entry-meta -->

                    <div class="entry-content">
 <div class="entry-attachment"><?php the_attachment_link($post->ID, true) ?></div>

						
<?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'standardpack' )  ); ?>
<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'standardpack' ) . '&after=</div>') ?>
 						<div id="nav-below" class="navigation">
							<span class="previous-image"><?php previous_image_link( false, __( '&laquo; Previous', 'standardpack' ) ); ?></span>
							<span class="next-image"><?php next_image_link( false, __( 'Next &raquo;', 'standardpack' ) ); ?></span>
						</div><!-- #nav-below -->
                    </div><!-- .entry-content -->				
					
					<div class="entry-utility">
                    <?php printf( __( 'This entry was posted in %1$s%2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>. Follow any comments here with the <a href="%5$s" title="Comments RSS to %4$s" rel="alternate" type="application/rss+xml">RSS feed for this post</a>.', 'standardpack' ),
                        get_the_category_list(', '),
                        get_the_tag_list( __( ' and tagged ', 'standardpack' ), ', ', '' ),
                        get_permalink(),
                        the_title_attribute('echo=0'),
                        get_post_comments_feed_link() ) ?>

<?php if ( ('open' == $post->comment_status) && ('open' == $post->ping_status) ) : // Comments and trackbacks open ?>
                        <?php printf( __( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'standardpack' ), get_trackback_url() ) ?>
<?php elseif ( !('open' == $post->comment_status) && ('open' == $post->ping_status) ) : // Only trackbacks open ?>
                        <?php printf( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'standardpack' ), get_trackback_url() ) ?>
<?php elseif ( ('open' == $post->comment_status) && !('open' == $post->ping_status) ) : // Only comments open ?>
                        <?php _e( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', 'standardpack' ) ?>
<?php elseif ( !('open' == $post->comment_status) && !('open' == $post->ping_status) ) : // Comments and trackbacks closed ?>
                        <?php _e( 'Both comments and trackbacks are currently closed.', 'standardpack' ) ?>
<?php endif; ?>
<?php edit_post_link( __( 'Edit', 'standardpack' ), "\n\t\t\t\t\t<span class=\"edit-link\">", "</span>" ) ?>
                    </div><!-- .entry-utility -->		
                </div><!-- #post-<?php the_ID(); ?> -->                         
 
 <?php comments_template('', true); ?>
 
            </div><!-- #content -->
        </div><!-- #container -->
 
<?php get_sidebar(); ?>
<?php get_footer(); ?>