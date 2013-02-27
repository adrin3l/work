<?php //Retrieve Theme Options Data
global $sp_options;
$sp_options = get_option('sp_theme_options');?>

<div id="socials" class="widget-area">
<div class="xoxo">
<?php if($sp_options['facebook'] != '') : ?>
<a target="_blank" href="<?php echo $sp_options['facebook']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" title="<?php _e('Follow us on Facebook', 'standardpack'); ?>" alt="<?php _e('Follow us on Facebook', 'standardpack'); ?>" /></a>
<?php else : ?>
<img src="<?php echo get_template_directory_uri(); ?>/images/socialstrans.png" alt="<?php _e('Transparent', 'standardpack'); ?>" />
<?php endif; ?>
<a href="<?php if($sp_options['feedburner'] != '') { echo $sp_options['feedburner']; } else { bloginfo('rss2_url'); } ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/rss.png" title="<?php _e('RSS Feed', 'standardpack'); ?>" alt="<?php _e('RSS Feed', 'standardpack'); ?>" /></a>
<?php if($sp_options['twitter'] != '') : ?>
<a target="_blank" href="<?php echo $sp_options['twitter']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" title="<?php _e('Follow us on Twitter', 'standardpack'); ?>" alt="<?php _e('Follow us on Twitter', 'standardpack'); ?>" /></a>
<?php else : ?>
<img src="<?php echo get_template_directory_uri(); ?>/images/socialstrans.png" alt="<?php _e('Transparent', 'standardpack'); ?>" />
<?php endif; ?>
</div>
		</div><!-- #socials .widget-area -->

<div id="primary" class="widget-area">
	<ul class="xoxo">
		<?php if ( !dynamic_sidebar( 'primary_widget_area' ) ) : ?>
			<li class="widget-container">
				<h3 class="widget-title"><?php _e('Recent Entries', 'standardpack'); ?></h3>
					<ul>
						<?php wp_get_archives( 'type=postbypost&limit=10' ); ?>
					</ul>
			</li>
			
			<li class="widget-container">
				<h3 class="widget-title"><?php _e('Tags', 'standardpack'); ?></h3>
					<ul>
						<?php wp_tag_cloud( 'smallest=8&largest=15&number=30' ); ?>
					</ul>
			</li>
	</ul>
		<?php endif; ?>
</div><!-- #primary .widget-area -->					
					
<div id="secondary" class="widget-area">
     <ul class="xoxo">
         <?php if ( !dynamic_sidebar( 'secondary_widget_area' ) ) : ?>
			<li class="widget-container">
				<h3 class="widget-title"><?php _e('Meta', 'standardpack'); ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<li><a href="<?php if($sp_options['feedburner'] != '') { echo $sp_options['feedburner']; } else { bloginfo('rss2_url'); } ?>"><?php _e('Entries RSS', 'standardpack'); ?></a></li>
						<li><a href="<?php bloginfo( 'comments_rss2_url' ); ?>"><?php _e('Comments RSS', 'standardpack'); ?></a></li>
						<?php wp_meta(); ?>
					</ul>
			</li>
	</ul>
		<?php endif; ?>
                
</div><!-- #secondary .widget-area -->		
