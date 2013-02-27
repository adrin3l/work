<div class="clear"></div>
<div class="footer-wrapper">
    <div class="footer">
        <?php
        /* A sidebar in the footer? Yep. You can can customize
         * your footer with four columns of widgets.
         */
        get_sidebar('footer');
        ?>
    </div>
</div>
</div>
</div>
</div>
</div>
<div class="container_24">
    <div class="grid_24 copyright">
        <div class="grid_12 alpha">
            <div class="copyright_left">
                <p><a href="<?php echo home_url(); ?>"><?php echo get_bloginfo('name'); ?> - <?php echo get_bloginfo('description'); ?></a></p>
            </div>
        </div>
        <div class="grid_12  omega">
            <div class="copyrightinfo">
                <p class="copyright"><a href="http://www.inkthemes.com">LocalBusiness Theme</a> powered by <a href="http://www.wordpress.org">WordPress</a></p>
            </div>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>