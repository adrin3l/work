<?php
/**
 * The template for displaying front page pages.
 *
 */
?>
<?php ob_start(); ?>
<?php get_header(); ?>  	
<div class="signup">
    <div class="grid_10 alpha">
        <div class="signupright">
            <div class="signupimgbox">
              <!-- <div class="signupimgbox_inner"><img class="signupimg" src="images/signupimg.png" /> </div>-->
                <div class="flexslider">
                    <ul class="slides">
                        <?php
                        //The strpos funtion is comparing the strings to allow uploading of the Videos & Images in the Slider
                        $mystring1 = localbusiness_get_option('localbusiness_slideimage1');
                        $value_img = array('.jpg', '.png', '.jpeg', '.gif', '.bmp', '.tiff', '.tif');
                        $check_img_ofset = 0;
                        foreach ($value_img as $get_value) {
                            if (preg_match("/$get_value/", $mystring1)) {
                                $check_img_ofset = 1;
                            }
                        }
                        // Note our use of ===.  Simply == would not work as expected
                        // because the position of 'a' was the 0th (first) character.                            
                        ?>
                        <?php if ($check_img_ofset == 0 && localbusiness_get_option('localbusiness_slideimage1') != '') { ?>
                            <li><?php echo localbusiness_get_option('localbusiness_slideimage1'); ?></li>
                        <?php } else { ?> 
                            <li>
                                <?php if (localbusiness_get_option('localbusiness_slideimage1') != '') { ?>
                                    <a href="<?php echo localbusiness_get_option('localbusiness_slidelink1'); ?>"><img  src="<?php echo localbusiness_get_option('localbusiness_slideimage1'); ?>" alt=""/></a>
                                <?php } else { ?>
                                    <a href="#"><img  src="<?php echo get_template_directory_uri(); ?>/images/signupimg.jpg" alt=""/></a>
                                <?php } ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class=" grid_14 omega">	
        <div class="signupleft">
            <div class="signupinfo">
                <?php if (localbusiness_get_option('localbusiness_slider_heading') != '') { ?>
                    <h1><?php echo stripslashes(localbusiness_get_option('localbusiness_slider_heading')); ?></h1>
                <?php } else { ?>
                    <h1><?php _e('Book a cab easily in less than 60 seconds!', 'local-business'); ?></h1>
                <?php } ?>  
            </div>
            <?php
            ?>
            <div class="signup-text">
                <?php if (localbusiness_get_option('localbusiness_slider_description') != '') { ?>
                    <p><?php echo stripslashes(localbusiness_get_option('localbusiness_slider_description')); ?></p>
                <?php } else { ?>
                    <p><?php _e('Restaurants range from unpretentious lunching or dining places catering to people working with simple food served in simple settings at low prices.', 'local-business'); ?></p>			
                    <p><?php _e('To expensive  serving refined food and wines in a formal setting. unpretentious lunching or dining places catering to people.', 'local-business'); ?></p>
                <?php } ?>
                <?php if (localbusiness_get_option('localbusiness_slider_read_more') != '') { ?>
                    <a class="button1" href="<?php echo localbusiness_get_option('localbusiness_slider_link'); ?>"><span></span><?php echo stripslashes(localbusiness_get_option('localbusiness_slider_read_more')); ?></a>
                <?php } else { ?><a class="button1" href="#"><span></span><?php _e('Read More&hellip;', 'local-business'); ?></a><?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="signup-bottom"></div>
<div class="feature_content">   
    <div class="grid_8 alpha">
        <div class="feature_contentbox box1">
            <?php if (localbusiness_get_option('localbusiness_firsthead') != '') { ?>
                <h1><?php echo stripslashes(localbusiness_get_option('localbusiness_firsthead')); ?></h1>
            <?php } else { ?>
                <h1><?php _e('Travel Safe with Us', 'local-business'); ?></h1>
            <?php } ?> 
            <?php if (localbusiness_get_option('localbusiness_firstdesc') != '') { ?>
                <p><?php echo stripslashes(localbusiness_get_option('localbusiness_firstdesc')); ?></p>
            <?php } else { ?>
                <p><?php _e('Restaurants range from unpretentious lunching or dining places catering to people working with simple food served in simple settings at low prices, to expensive  serving refined food and wines in a formal setting.', 'local-business'); ?></p>
            <?php } ?>  
            <a class="readmore" href="<?php echo localbusiness_get_option('localbusiness_feature_link1'); ?>"><?php _e('Read More&hellip;', 'local-business'); ?></a> </div>
    </div>
    <div class="grid_8">
        <div class="feature_contentbox box2">
            <?php if (localbusiness_get_option('localbusiness_secondhead') != '') { ?>
                <h1><?php echo stripslashes(localbusiness_get_option('localbusiness_secondhead')); ?></h1>
            <?php } else { ?>
                <h1><?php _e('Great Service Ever', 'local-business'); ?></h1>
            <?php } ?> 
            <?php if (localbusiness_get_option('localbusiness_seconddesc') != '') { ?>
                <p><?php echo stripslashes(localbusiness_get_option('localbusiness_seconddesc')); ?></p>
            <?php } else { ?>
                <p><?php _e('Restaurants range from unpretentious lunching or dining places catering to people working with simple food served in simple settings at low prices, to expensive  serving refined food and wines in a formal setting.', 'local-business'); ?></p>
            <?php } ?>  
            <a class="readmore" href="<?php echo localbusiness_get_option('localbusiness_feature_link2'); ?>"><?php _e('Read More....', 'local-business'); ?></a> </div>
    </div>
    <div class="grid_8 omega">
        <div class="feature_contentbox box3">
            <?php if (localbusiness_get_option('localbusiness_thirdhead') != '') { ?>
                <h1><?php echo stripslashes(localbusiness_get_option('localbusiness_thirdhead')); ?></h1>
            <?php } else { ?>
                <h1><?php _e('Love your Journey', 'local-business'); ?></h1>
            <?php } ?> 
            <?php if (localbusiness_get_option('localbusiness_thirddesc') != '') { ?>
                <p><?php echo stripslashes(localbusiness_get_option('localbusiness_thirddesc')); ?></p>
            <?php } else { ?>
                <p><?php _e('Restaurants range from unpretentious lunching or dining places catering to people working with simple food served in simple settings at low prices, to expensive  serving refined food and wines in a formal setting.', 'local-business'); ?></p>
            <?php } ?>  
            <a class="readmore" href="<?php echo localbusiness_get_option('localbusiness_feature_link3'); ?>"><?php _e('Read More&hellip;', 'local-business'); ?></a> </div>
    </div>
</div>
<div class="clear"></div>
<div class="feature_info">
    <div class="grid_16 alpha">
        <div class="feature_infobox">
            <?php if (localbusiness_get_option('localbusiness_lefthead') != '') { ?>
                <h1><?php echo stripslashes(localbusiness_get_option('localbusiness_lefthead')); ?></h1>
            <?php } else { ?>
                <h1><?php _e('Our Taxi service is really awesome and you gonna love it.', 'local-business'); ?></h1>
            <?php } ?>
            <?php if (localbusiness_get_option('localbusiness_leftdesc') != '') { ?>
                <p><?php echo stripslashes(localbusiness_get_option('localbusiness_leftdesc')); ?></p>            
            <?php } else { ?>
                <p><?php _e('Restaurants range from unpretentious lunching or dining places catering to people working with simple food served in simple settings at low prices, to expensive  serving refined food and wines in a formal setting. In the former case, customers usually wear casual clothing. In the latter case, depending on culture and local traditions, customers might wear semi-casual.', 'local-business'); ?></p>
                <p><?php _e('From unpretentious lunching or dining places catering to people working with simple food served in simple settings at low prices, to expensive  serving refined food and wines in a formal setting. In the former case, customers usually wear casual clothing. In the latter case, depending on culture and local traditions, customers might wear semi-casual.', 'local-business'); ?></p>
            <?php } ?>
        </div>
    </div>
    <div class="grid_8 omega">
        <?php if (localbusiness_get_option('localbusiness_rightdesc') != '') { ?>
            <div class="feature_videobox">
                <?php echo stripslashes(localbusiness_get_option('localbusiness_rightdesc')); ?>   
            </div>
        <?php } else { ?>
            <div class="feature_videobox"> <img class="feature_video" src="<?php echo get_template_directory_uri(); ?>/images/video.png" alt="feature video" /> </div>
            <?php } ?>
    </div>
</div>
<?php get_footer(); ?>
<?php ob_flush(); ?>