<?php
/*
  Plugin Name: TinyMCE Excerpt
  Description: Create new options where you choose what ips to be banned
  Author: Daniel Andrei-Adrian
  Version: 1.0
  */

define( 'tinye_DIR', dirname( __FILE__ ) );
define( 'tinye_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) );


    function tinymce_excerpt_js(){ ?>  
    <script type="text/javascript">  
        jQuery(document).ready( tinymce_excerpt );  
        function tinymce_excerpt() {  
        jQuery("#excerpt").addClass("mceEditor");  
        tinyMCE.execCommand("mceAddControl", false, "excerpt");  
        }  
    </script>  
    <?php }  
    add_action( 'admin_head-post.php', 'tinymce_excerpt_js');  
    add_action( 'admin_head-post-new.php', 'tinymce_excerpt_js');  
      
    function tinymce_excerpt_css(){ ?>  
    <style type='text/css'>  
        #postexcerpt .inside{margin:0;padding:0;background:#fff;}  
        #postexcerpt .inside p{padding:0px 0px 5px 10px;}  
    </style>  
    <?php }  
    add_action( 'admin_head-post.php', 'tinymce_excerpt_css');  
    add_action( 'admin_head-post-new.php', 'tinymce_excerpt_css');  