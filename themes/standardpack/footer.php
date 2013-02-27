<?php //Retrieve Theme Options Data
global $sp_options;
$sp_options = get_option('sp_theme_options');?>
        </div><!-- #main -->
       
        <div id="footer">
		
					<div class="footleft">
		<ul>
			<?php if ( !dynamic_sidebar( 'footer_left' ) ) : ?>
			<li>
				<h3><?php _e('Blogroll', 'standardpack'); ?></h3>
				<ul>
				<?php wp_list_bookmarks( 'title_li=&categorize=0' ); ?>
				</ul>
			</li>
			<?php endif; ?>
		</ul>
	</div>

	<div class="footmiddle">
		<ul>
			<?php if ( !dynamic_sidebar( 'footer_middle' ) ) : ?>
			<li>
				<h3><?php _e('Pages', 'standardpack'); ?></h3>
				<ul>
				<?php wp_list_pages( 'title_li=' ); ?>
				</ul>
			</li>
			<?php endif; ?>
		</ul>
	</div>

	<div class="footright">
		<ul>
			<?php if ( !dynamic_sidebar( 'footer_right' ) ) : ?>
			<li>
				<h3><?php _e('Monthly archives', 'standardpack'); ?></h3>
				<ul>
				<?php wp_get_archives( 'type=monthly&limit=5' ); ?>
				</ul>
			</li>
			<?php endif; ?>
		</ul>
	</div>
				
				
                <div id="colophon">
               
                        <div id="site-info">
                                <p><?php echo(stripslashes ($sp_options['footer_text'])); ?><br /><?php _e( 'Powered by <span id="generator-link"><a href="http://wordpress.org" title="WordPress" rel="generator">WordPress</a></span>.', 'standardpack' ); ?> <?php _e( 'Designed by <span id="theme-link"><a href="http://tutskid.com/" rel="designer">TutsKid</a></span>', 'standardpack' ); ?></p>				
                        </div><!-- #site-info -->
                </div><!-- #colophon -->
        </div><!-- #footer -->
       
</div><!-- #wrapper -->

<?php wp_footer(); ?>
</body>
</html>
