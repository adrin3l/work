<?php //Retrieve Theme Options Data
global $sp_options;
$sp_options = get_option('sp_theme_options');?>

<?php get_header(); ?>
 
        <div id="container">
            <div id="content">
			
<?php the_post(); ?>			
 
                <div id="nav-above" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&laquo;</span> %title' ) ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">&raquo;</span>' ) ?></div>
				</div><!-- #nav-above -->
 
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					
                    <div class="entry-meta">
						<span class="meta-prep meta-prep-author"><?php _e('By ', 'standardpack'); ?></span>
                        <span class="author vcard"><a class="url fn n" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" title="<?php printf( __( 'View all posts by %s', 'standardpack' ), $authordata->display_name ); ?>"><?php the_author_meta('display_name'); ?></a></span>
                        <span class="meta-sep"> | </span>
                        <span class="meta-prep meta-prep-entry-date"><?php _e('Published ', 'standardpack'); ?></span>
                        <span class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr></span>
                        <?php edit_post_link( __( 'Edit', 'standardpack' ), "<span class=\"meta-sep\">|</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t" ) ?>                                               
                    </div><!-- .entry-meta -->

		<div class="entry-content">		

<?php if ( has_post_thumbnail() ) { ?>
	<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft') ); ?>
<?php } ?>
<?php the_content(); ?>

<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'standardpack' ) . '&after=</div>') ?>
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