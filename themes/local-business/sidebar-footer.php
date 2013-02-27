<div class="grid_8 alpha">
    <div class="footer_widget">
        <?php if (is_active_sidebar('first-footer-widget-area')) : ?>
            <?php dynamic_sidebar('first-footer-widget-area'); ?>
        <?php else : ?> 
            <h4><?php _e('Setting Footer Widgets', 'local-business'); ?></h4>
            <p><?php _e('Footer is widgetized. To setup the footer, drag the required Widgets in Appearance -> Widgets Tab in the First, Second or Third Footer Widget Areas.', 'local-business'); ?></p>
            <br/>
        <?php endif; ?>
    </div>
</div>
<div class="grid_8">
    <div class="footer_widget">
        <?php if (is_active_sidebar('second-footer-widget-area')) : ?>
            <?php dynamic_sidebar('second-footer-widget-area'); ?>
        <?php else : ?> 
            <h4><?php _e('Contact Us', 'local-business'); ?></h4>
            <?php _e('Address: Chuna Bhatti Bhopal, MP India', 'local-business'); ?><br/>
            <?php _e('Contact : (111) 234 - 5678', 'local-business'); ?> <br/>
            <?php _e('Email: ', 'local-business'); ?><a href="mailto:youremail@domain.com">youremail@domain.com</a> <br/>
            <?php _e('Website : ', 'local-business'); ?><a href="#">www.example.com</a><br/>
            <br/>
        <?php endif; ?>
    </div>
</div>
<div class="grid_8 omega">
    <div class="footer_widget last">
        <?php if (is_active_sidebar('third-footer-widget-area')) : ?>
            <?php dynamic_sidebar('third-footer-widget-area'); ?>
        <?php else : ?>
            <h4><?php _e('Our Location', 'local-business'); ?></h4>                    
            <iframe width="100%" height="140" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=Chuna+Bhatti,+Bhopal,+Madhya+Pradesh,+India&aq=0&oq=bh&sll=37.0625,-95.677068&sspn=56.506174,79.013672&ie=UTF8&hq=&hnear=Chuna+Bhatti,+Bhopal,+Madhya+Pradesh,+India&t=m&ll=23.202617,77.413874&spn=0.007866,0.004932&z=14&iwloc=A&output=embed"></iframe>
        <?php endif; ?>
    </div>
</div>
