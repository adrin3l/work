<?php //Retrieve Theme Options Data
global $sp_options;
$sp_options = get_option('sp_theme_options');?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'standardpack' ), max( $paged, $page ) );
	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
</head>
 
<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
					
    <div id="header">
<div id="top">			
						<?php wp_nav_menu( array( 'theme_location' => 'top' , 'container_class' => 'top_menu' ) ); ?>
						<?php get_search_form(); ?>
				</div>
        <div id="masthead">

			<div id="branding">
			
  <a href="<?php echo home_url('/') ?>"><img src="<?php header_image() ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
			<?php if ( is_home() || is_front_page() ) { ?>
	<h1 id="blog-title"><span><a href="<?php echo home_url('/') ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php if ($sp_options['logo']) { ?>
					<img src="<?php echo $sp_options['logo']; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
			<?php } else {
					bloginfo('name');
} ?></a></span></h1>
				<div id="blog-description"><?php if ( isset($sp_options['hide_tag']) && ($sp_options['hide_tag']!="") ){ ?>
<?php } else { ?>
<?php bloginfo( 'description' ); ?>
<?php } ?></div>
<?php } else { ?>
			<h2 id="blog-title"><span><a href="<?php echo home_url('/') ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php if($sp_options['logo']) { ?>
					<img src="<?php echo $sp_options['logo']; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
			<?php } else {
					bloginfo('name');
} ?></a></span></h2>
			<div id="blog-description"><?php if ( isset($sp_options['hide_tag']) && ($sp_options['hide_tag']!="") ){ ?>
<?php } else { ?>
<?php bloginfo( 'description' ); ?>
<?php } ?></div>
			
<?php } ?>

            </div><!-- #branding -->
			
<?php if ( !dynamic_sidebar( 'header_widget_area' ) ) : ?>
	<div id="headerbanner">
	<p>
	<?php 
	$feedburner_link = get_bloginfo( 'rss2_url' );
	if( !empty($sp_options['feedburner'] ) ) {
		$feedburner_link = $sp_options['feedburner'] ;
	}
	
	printf( __( 'Thanks for dropping by %1$s! Take a look around, we hope you find something both interesting and useful, and if you like the site then please leave a comment or consider <a href="%2$s">subscribing to our RSS feed</a>', 'standardpack' ),
		get_bloginfo( 'name' ),
		$feedburner_link
	);
	?>
	</p>
	</div>
<?php endif; ?>
 
            <div id="access">
				<div class="skip-link"><a href="#content" title="<?php _e( 'Skip to content', 'standardpack' ) ?>"><?php _e( 'Skip to content', 'standardpack' ) ?></a></div>
				<?php wp_nav_menu( array( 'theme_location' => 'primary-nav' , 'container_class' => 'menu-header' ) ); ?>
            </div><!-- #access -->
 
        </div><!-- #masthead -->
    </div><!-- #header -->
 
    <div id="main">