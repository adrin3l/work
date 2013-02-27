<?php /* The Comments Template */ ?>
<div id="comments">
	<?php if ( post_password_required() ) : ?>
		 <div class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.', 'standardpack') ?></div>
            </div><!-- #comments -->
	<?php
		return;
		endif;
	?>
 
<?php /* See IF there are comments and do the comments stuff! */ ?>
<?php if ( have_comments() ) : ?>
 
<?php /* Count the number of comments and trackbacks (or pings) */
$ping_count = $comment_count = 0;
foreach ( $comments as $comment )
    get_comment_type() == "comment" ? ++$comment_count : ++$ping_count;
?>
 
<?php /* IF there are comments, show the comments */ ?>
<?php if ( ! empty($comments_by_type['comment']) ) : ?>
 
                <div id="comments-list" class="comments">
                    <h3><?php printf($comment_count > 1 ? __('<span>%d</span> Comments', 'standardpack') : __('<span>One</span> Comment', 'standardpack'), $comment_count) ?></h3>
 
<?php /* If there are enough comments, build the comment navigation  */ ?>
<?php $total_pages = get_comment_pages_count(); if ( $total_pages > 1 ) : ?>
                    <div id="comments-nav-above" class="comments-navigation">
                                <div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
                    </div><!-- #comments-nav-above -->
<?php endif; ?>                  
 
<?php /* An ordered list of our custom comments callback, custom_comments(), in functions.php   */ ?>
                    <ol class="commentsol">
<?php wp_list_comments('type=comment&callback=sp_custom_comments'); ?>
                    </ol>
 
<?php /* If there are enough comments, build the comment navigation */ ?>
<?php $total_pages = get_comment_pages_count(); if ( $total_pages > 1 ) : ?>
                <div id="comments-nav-below" class="comments-navigation">
                        <div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
            </div><!-- #comments-nav-below -->
<?php endif; ?>                  
 
                </div><!-- #comments-list .comments -->
 
<?php endif; /* if ( $comment_count ) */ ?>
 
<?php /* If there are trackbacks(pings), show the trackbacks  */ ?>
<?php if ( ! empty($comments_by_type['pings']) ) : ?>
 
                <div id="trackbacks-list" class="comments">
                    <h3><?php printf($ping_count > 1 ? __('<span>%d</span> Trackbacks', 'standardpack') : __('<span>One</span> Trackback', 'standardpack'), $ping_count) ?></h3>
 
<?php /* An ordered list of our custom trackbacks callback, custom_pings(), in functions.php   */ ?>
                    <ol class="commentsol">
<?php wp_list_comments('type=pings&callback=sp_custom_pings'); ?>
                    </ol>            
 
                </div><!-- #trackbacks-list .comments -->          
 
<?php endif /* if ( $ping_count ) */ ?>
<?php endif /* if ( $comments ) */ ?>
 
<?php comment_form(); ?>
            </div><!-- #comments -->