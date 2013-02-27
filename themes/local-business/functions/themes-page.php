<?php

// Add scripts and stylesheet

function enqueue_styles() {

    global $themename, $themeslug, $options;
    wp_register_style($themeslug . 'storecss', get_template_directory_uri() . '/functions/theme-page-style.css');


    wp_enqueue_style($themeslug . 'storecss');
}

// Add page to the menu
function inkthemes_add_menu() {
    $page = add_theme_page('InkThemes Themes Page', 'InkThemes Themes', 'administrator', 'themes', 'inkthemes_page_init');


    add_action('admin_print_styles-' . $page, 'enqueue_styles');
}

add_action('admin_menu', 'inkthemes_add_menu');

// Create the page
function inkthemes_page_init() {
    $root = get_template_directory_uri();
    ?>

    <div id="contain">
        <div id="themesheader">
            <a href="http://www.inkthemes.com/" target="_blank"><img src="<?php echo $root; ?>/functions/images/inkthemes-logo.png" /></a>
            <br />
            <div class="menu">	   
                <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.inkthemes.com" data-text="Check out the Professional Premium WordPress Themes at InkThemes">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                <iframe src="http://www.facebook.com/plugins/like.php?app_id=153286811409231&href=www.inkthemes.com&send=false&layout=button_count&width=90&show_faces=false&action=like&colorscheme=light&font&height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true"></iframe>
                <g:plusone size="medium" href="http://www.inkthemes.com"></g:plusone>
                <script type="text/javascript">
                    (function() {
                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                        po.src = 'https://apis.google.com/js/plusone.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                    })();
                </script>
                <br/>
                <hr/>
            </div>
            <div style="clear: both;"></div>
        </div>
        <div id="container">
            <div class="theme-image">
                <a href="http://www.inkthemes.com/wp-themes/blackbird-responsive-wordpress-theme/" target="_blank"><img src="<?php echo $root; ?>/functions/images/blackbird.png" /></a>
            </div>
            <div class="theme-desc">
                <div class="theme-title"><a href="http://www.inkthemes.com/wp-themes/blackbird-responsive-wordpress-theme/" target="_blank">Blackbird Theme</a></div>
                <br />
                Blackbird Theme is a very clean and elegantly designed Responsive WordPress Theme. Its created with the aim to make your business website look professional to your visitors.<br />
				The Theme is built on a unique circular pattern for feature boxes. Unlike many other themes, even if you are going to upload a square image, the theme would automatically make it circular.
                <br /><br />
                Starting from the top header area, the Blackbird WordPress Theme allows you to upload your own Custom Logo and had a space on the top right to enter your contact details. This details are useful for the first time visitors as they can clearly see your contact details right on top. <br /><br />
                <div class="buy"><a href="http://www.inkthemes.com/wp-themes/blackbird-responsive-wordpress-theme/" target="_blank">Buy Blackbird Theme</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="http://wordpress.org/extend/themes/blackbird" target="_blank">Try Blackbird Lite for FREE</a></div>

            </div>

            <div class="theme-image">
                <a href="http://www.inkthemes.com/wp-themes/golden-eagle-wordpress-theme/" target="_blank"><img src="<?php echo $root; ?>/functions/images/goldenscreen.png" /></a>
            </div>
            <div class="theme-desc">
                <div class="theme-title"><a href="http://www.inkthemes.com/wp-themes/golden-eagle-wordpress-theme/" target="_blank">Golden Eagle Theme</a></div>
                <br />
                Golden Eagle Theme is a Responsive business style wordpress Theme which adapts itself with the tablet and mobile devices automatically. It comes with a uniquely designed Slider and comes with the Themes Options Panel which you can use to control all the aspects of your website. You can easily convert the Theme in different Niches with ease.
                <br /><br />
                Golden Eagle is a very powerful theme which suits both type of users which have no programming experience and as well as advanced developers. Using Golden Eagle you can build your site with minimal effort in no time to your liking. It allows you to upload your own Custom Logos, insert Google Analytics Tracking Codes, write your own Custom CSS and supports Child Theme creation.
                <br /><br />
                <div class="buy"><a href="http://www.inkthemes.com/wp-themes/golden-eagle-wordpress-theme/" target="_blank">Buy Golden Eagle Theme</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="http://wordpress.org/extend/themes/golden-eagle-lite" target="_blank">Try Golden Eagle Lite for FREE</a></div>
            </div>

            <div class="theme-image">
                <a href="http://www.inkthemes.com/wp-themes/bizway-responsive-wordpress-theme/" target="_blank"><img src="<?php echo $root; ?>/functions/images/bizway-bigthumb.png" /></a>
            </div>
            <div class="theme-desc">
                <div class="theme-title"><a href="http://www.inkthemes.com/wp-themes/bizway-responsive-wordpress-theme/" target="_blank">BizWay Theme</a></div>
                <br />
                Bizway is a professional and outstanding responsive Business WordPress Theme. BizWay was built keeping the simplicity of design in mind. The whole interface of the BizWay Theme is clutter free and the place for the most important business content is provided. 
                <br/>
                <br/>
               BizWay Theme comes with 10 different Color Schemes to suit your business style. The Main Heading and sub heading are given the space on the top for creating a long lasting impression to the visitors of your website regarding what your business is all about.  
				<br/>
                <br/>
                <div class="buy"><a href="http://www.inkthemes.com/wp-themes/bizway-responsive-wordpress-theme/" target="_blank">Buy BizWay Theme</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="http://wordpress.org/extend/themes/bizway" target="_blank">Try BizWay Lite for FREE</a></div>
            </div><br />

            <div class="theme-image">
                <a href="http://www.inkthemes.com/wp-themes/andrina-theme/" target="_blank"><img src="<?php echo $root; ?>/functions/images/andrina.png" /></a>
            </div>
            <div class="theme-desc">
                <div class="theme-title"><a href="http://www.inkthemes.com/wp-themes/andrina-theme/" target="_blank">Andrina Theme</a></div>
                <br />
                The Andrina Theme allows the user to show his blogposts on the frontpage. Hence the main Home Page is always updated on the release of new blogposts. Hence the site is more Search Engine friendly.
                <br/>
                <br/>
                The Theme had a simple layout which attracts the Client to the Website. Also, the professional and Clean design always suites the requirements of almost any kind of business Website. Andrina Theme is very simple to built and you don&acute;t even need to be a code junkie to start using the Andrina Theme and get your website ready.
                <br /> <br />
                <div class="buy"><a href="http://www.inkthemes.com/wp-themes/andrina-theme/" target="_blank">Buy Andrina Theme</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="http://wordpress.org/extend/themes/andrina-lite" target="_blank">Try Andrina Lite for FREE</a></div>
            </div>
            <div class="theme-image">
                <a href="http://www.inkthemes.com/wp-themes/dzonia-premium-wordpress-themes/" target="_blank"><img src="<?php echo $root; ?>/functions/images/dzoniascreen.png" /></a>
            </div>
            <div class="theme-desc">
                <div class="theme-title"><a href="http://www.inkthemes.com/wp-themes/dzonia-premium-wordpress-themes/" target="_blank">Dzonia Theme</a></div>
                <br />
                Dzonia is a Single Click Install Theme, Simply by pressing the &quot;Activate&quot; Button on the Themes Area. Your WP Theme is READY. Once you do that, just fill your own content to replace the generic content using the Themes Options Panel and your website is ready to use. Its really very easy and you need not be a techie to do it all.
                <br/><br/>
                Dzonia Theme had a unique slider which attract the attention of the visitors. Your visitors would love to see the whole content clearly. Dzonia Theme had several useful theme options to allow changing and manipulating literally everything on your site, still keeping everything simple and easy.
                <br /> <br />
                <div class="buy"><a href="http://www.inkthemes.com/wp-themes/dzonia-premium-wordpress-themes/" target="_blank">Buy Dzonia Theme</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a target="_blank" href="http://wordpress.org/extend/themes/dzonia-lite">Try Dzonia Lite for FREE</a></div>
            </div>	
                   </div>
		   </div>

    <?php
}
