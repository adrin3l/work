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
            <div class="post_content"><?php
                        if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
                            the_post_thumbnail('thumbnail', array('class' => 'postimg'));
                        }
                        ?>
                <?php the_excerpt(); ?>
                <div class="clear"></div>
                <?php wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages:', 'local-business') . '</span>', 'after' => '</div>')); ?>
                    <?php if (has_tag()) { ?>
                    <div class="tag">
                    <?php the_tags('Post Tagged with ', ', ', ''); ?>
                    </div>
        <?php } ?>
                <a class="read_more" href="<?php the_permalink(); ?>"><?php _e('Read More', 'local-business'); ?></a> </div>
        </div>
        <!--End post-->
    <?php
    endwhile;
else:
    ?>
    <div id="post-0" class="post no-results not-found">
        <p>
    <?php _e('Sorry, no posts matched your criteria.', 'local-business'); ?>
        </p>
    </div>
<?php endif; ?>
<!--End Loop-->