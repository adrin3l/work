<?php
/**
 * The Template for displaying all single posts.
 *
 */
?>
<?php get_header(); ?>
<div class="clear"></div>
<div class="page-content">
    <div class="page-content">
        <div class="grid_16 alpha">
            <div class="content-bar">
                <!-- Start the Loop. -->
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <!--post start-->
                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <h1 class="post_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                            <ul class="post_meta clearfix">
                                <li class="post_date">&nbsp;&nbsp;<?php echo get_the_time('M, d, Y') ?></li>
                                <li class="posted_by">&nbsp;&nbsp; <?php the_author_posts_link(); ?></li>
                                <li class="post_category">&nbsp;&nbsp; <?php the_category(', '); ?></li>
                                <li class="post_comment">&nbsp;&nbsp;<span></span><?php comments_popup_link('No Comments.', '1 Comment.', '% Comments.'); ?></li>
                            </ul>
                            <div class="post_content">
                                <?php the_content(); ?>
                                <div class="clear"></div>
                                <?php wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages:', 'local-business') . '</span>', 'after' => '</div>')); ?>
                                <?php if (has_tag()) { ?>
                                    <div class="tag">
                                        <?php the_tags(__('Post Tagged with ', ', ', '')); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!--End post-->
                    <?php endwhile;
                else:
                    ?>
                    <div id="post-0" class="post no-results not-found">
                        <p>
                    <?php _e('Sorry, no posts matched your criteria.', 'local-business'); ?>
                        </p>
                    </div>
                    <?php endif; ?>
                <!--End Loop-->
                <nav id="nav-single"> <span class="nav-previous">
                        <?php previous_post_link('%link', __('<span class="meta-nav">&larr;</span> Previous Post ', 'local-business')); ?>
                    </span> <span class="nav-next">
                    <?php next_post_link('%link', __('Next Post <span class="meta-nav">&rarr;</span>', 'local-business')); ?>
                    </span> </nav>
                <!--Start Comment box-->
                <?php comments_template(); ?>
                <!--End Comment box--> 
            </div>
        </div>
        <div class="grid_8 omega">
            <!--Start Sidebar-->
            <?php get_sidebar(); ?>
            <!--End Sidebar-->
        </div>
    </div>
</div>
<?php get_footer(); ?>