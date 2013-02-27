<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <title>
            <?php wp_title('&#124;', true, 'right'); ?><?php bloginfo('name'); ?>
        </title> 		
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" /> 
        <?php
        /* We add some JavaScript to pages with the comment form
         * to support sites with threaded comments (when in use).
         */
        if (is_singular() && get_option('thread_comments'))
            wp_enqueue_script('comment-reply');

        wp_head();
        ?>
    </head>
    <body <?php body_class(); ?>>
        <div class="wrapper">
            <div class="container_24">
                <div class="grid_24 body_wrapper">
                    <div class="main-container">
                        <div class="header">
                            <div class="grid_14 alpha">
                                <div class="logo">
                                    <a href="<?php echo home_url(); ?>"><img src="<?php if (localbusiness_get_option('localbusiness_logo') != '') { ?><?php echo localbusiness_get_option('localbusiness_logo'); ?><?php } else { ?><?php echo get_template_directory_uri(); ?>/images/logo.png<?php } ?>" alt="<?php bloginfo('name'); ?>" alt="logo"/></a>
                                </div>                    
                            </div>
                            <div class="grid_10 omega">
                                <div class="call">
                                    <div class="social_logo">
                                        <ul class="social_links">  
                                            
                                        </ul>
                                    </div>
                                    <div class="call-us">
                                        <?php if (localbusiness_get_option('localbusiness_topright') != '') { ?>
                                            <a href="tel:<?php echo stripslashes(localbusiness_get_option('localbusiness_contact_number')); ?>"> <?php echo stripslashes(localbusiness_get_option('localbusiness_topright')); ?></a>
                                            </br><a class="btn" href="tel:<?php echo stripslashes(localbusiness_get_option('localbusiness_contact_number')); ?>">
                                                <span></span></a>
                                            <?php } else {
                                                ?>
                                            <a href="tel:5551234567">Call 24 Hours: 1.888.222.5847</a>
                                            </br>
                                            <a class="btn" href="tel:5551234567"><span>Tap To Call</span></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="menu_container">
                            <div class="menu_bar">
                                <div id="MainNav">
                                    <a href="#" class="mobile_nav closed">Pages Navigation Menu<span></span></a>
                        <?php localbusiness_nav(); ?> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>